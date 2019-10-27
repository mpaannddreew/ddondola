<template>
    <li v-if="lastMessage">
        <div class="contact-cont">
            <a href="javascript:void(0)" @click="transitionTo">
                <div class="pull-left user-img m-r-10">
                    <a href="javascript:void(0)" :title="converser.name">
                        <img :src="converser.avatar.url" alt="" class="w-40 rounded-circle">
                        <span class="status online"></span>
                    </a>
                </div>
                <div class="contact-info" :class="{unread: unreadCount}">
                    <span class="contact-name text-ellipsis">{{ converser.name }}</span>
                    <span class="contact-date text-ellipsis">{{ lastMessage.message }}</span>
                </div>
            </a>
            <div class="contact-action" :style="{top: unreadCount ? '0px': '10px'}">
                <span class="posted_time" style="display: block;">{{ lastMessage.created_at|dayOrTime }}</span>
                <span class="badge badge-pill badge-primary" v-if="unreadCount" :style="{paddingBottom: '0.375rem', fontSize: '100%'}">{{ unreadCount }}</span>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "Conversation",
        mounted() {
            this.watchConversation();
            this.setLastMessage(this.conversation.latestMessage);
            this.setUnreadCount(this.conversation.unreadCount);
        },
        data() {
            return {
                lastMessage: null,
                unreadCount: 0,
                isOpen: false
            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            },
            conversation: {
                type: Object,
                required: true
            },
            ownerId: {
                required: true
            },
            ownerType: {
                type: String,
                required: true
            }
        },
        computed: {
            route() {
                return `${this.homeUrl}/${this.converser.code}`;
            },
            converser() {
                if(!this.isOwner(this.conversation.initiator.id, this.conversation.initiator.type)) {
                    return this.conversation.initiator;
                }

                if(!this.isOwner(this.conversation.participant.id, this.conversation.participant.type)) {
                    return this.conversation.participant;
                }

                return null;
            }
        },
        methods: {
            isOwner(id, type) {
                return this.ownerId.toString() === id.toString() && this.lowerCase(this.ownerType) === this.lowerCase(type);
            },
            readAll() {
                if (this.unreadCount) {
                    if (this.ownerType !== 'shop') {
                        Bus.$emit('unread-messages', {type: 'decrease', size: this.unreadCount});
                    }
                    this.setUnreadCount(0);
                }
            },
            transitionTo() {
                this.$router.push(this.route);
                this.open();
                this.readAll();
            },
            open() {
                Bus.$emit('is-open', this.conversation.id);
            },
            watchConversation() {
                Echo.private(`conversation.${parseInt(this.conversation.id)}`)
                    .listen('.new.message', this.makeConversationChanges);
                Bus.$on('is-open', this.isOpened);
            },
            isOpened(id) {
                this.isOpen = this.conversation.id === id;
            },
            makeConversationChanges(message) {
                this.setLastMessage(message);
                if (!this.isOpen) {
                    if (!this.isOwner(this.lastMessage.sender.id, this.lastMessage.sender.type)) {
                        this.setUnreadCount(this.unreadCount++);
                        Bus.$emit('unread-messages', {type: 'increase', size: 1});
                    }
                }
            },
            setLastMessage(message) {
                this.lastMessage = message;
            },
            setUnreadCount(count) {
                this.unreadCount = count;
            }
        }
    }
</script>

<style scoped>
    .unread {
        font-weight: bold !important;
    }
</style>