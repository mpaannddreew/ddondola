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
                <div class="contact-info">
                    <span class="contact-name text-ellipsis">{{ converser.name }}</span>
                    <span class="contact-date text-ellipsis">{{ lastMessage.message }}</span>
                </div>
            </a>
            <div class="contact-action">
                <span class="posted_time">{{ lastMessage.created_at|time }}</span>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "Conversation",
        mounted() {
            this.setLastMessage(this.conversation.latestMessage);
        },
        data() {
            return {
                lastMessage: null,
                unreadCount: 0
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
                return this.homeUrl + "/" + this.converser.code;
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
                return this.ownerId.toString() === id.toString() && _.lowerCase(this.ownerType) === _.lowerCase(type);
            },
            transitionTo() {
                this.$router.push(this.route)
            },
            watchConversation() {
                Echo.private(`conversation.${parseInt(this.conversation.id)}`)
                    .listen('.new.message', this.setLastMessage);
            },
            setLastMessage(message) {
                this.lastMessage = message;
            }
        },
        filters: {
            time(date) {
                if (Moment().isSame(Moment(date), 'd'))
                    return Moment(date).format("h:mm a");

                if (Moment().subtract(1, 'days').isSame(Moment(date), 'd'))
                    return 'Yesterday';

                return Moment(date).format("MM/DD/YY");
            }
        }
    }
</script>

<style scoped>

</style>