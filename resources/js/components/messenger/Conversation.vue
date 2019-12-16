<template>
    <li v-if="lastMessage">
        <div class="contact-cont">
            <a href="javascript:void(0)" @click="transitionTo">
                <div class="pull-left user-img m-r-10">
                    <a href="javascript:void(0)" :title="converser.name">
                        <img :src="converser.avatar.url" alt="" class="w-40 rounded-circle">
                        <span class="status" :class="{online: online}"></span>
                    </a>
                </div>
                <div class="contact-info" :class="{unread: unreadCount}">
                    <span class="contact-name text-ellipsis">{{ converser.name }}</span>
                    <span class="contact-date text-ellipsis" v-if="typing">Typing ...</span>
                    <span class="contact-date text-ellipsis" v-else>{{ lastMessage.message }}</span>
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
            this.setUnreadCount(this.conversation.unreadCount);
            this.watchConversation();
        },
        data() {
            return {
                unreadCount: 0,
                participants: [],
                typing: false
            }
        },
        beforeDestroy() {
            Echo.leave(this.onlineChannel);
            Echo.leave(this.channel);
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
            },
            lastMessage() {
                return this.conversation.latestMessage;
            },
            opened() {
                if (this.$route.params.participant) {
                    return this.$route.params.participant === this.converser.code;
                }

                return false;
            },
            converserType() {
                return this.lowerCase(this.converser.type);
            },
            online() {
                return this.participants.length > 1;
            },
            channel() {
                return `conversation.${this.conversation.id}`;
            },
            onlineChannel() {
                return `online.${this.conversation.id}`;
            }
        },
        methods: {
            watchConversation() {
                Echo.join(this.onlineChannel)
                    .here((participants) => {
                        this.participants = participants;
                    })
                    .joining((participant) => {
                        let participants = _.filter(this.participants, (converser) => {
                            return converser.code === participant.code;
                        });

                        if (participants.length === 0) {
                            this.participants.push(participant);
                        }
                    })
                    .leaving((participant) => {
                        this.participants = _.reject(this.participants, (converser) => {
                            return converser.code === participant.code;
                        });
                    });

                Echo.private(this.channel)
                    .listenForWhisper('typing', (e) => {
                        this.typing = true;
                        setTimeout(() => {
                            this.typing = false
                        }, 2000);
                    });
            },
            isOwner(id, type) {
                return this.ownerId.toString() === id.toString() && this.lowerCase(this.ownerType) === this.lowerCase(type);
            },
            readAll() {
                if (this.unreadCount) {
                    if (this.ownerType === 'user') {
                        Bus.$emit('unread-messages', -this.unreadCount);
                    }
                    this.setUnreadCount(0);
                }
            },
            transitionTo() {
                this.readAll();
                if (!this.opened) {
                    this.$router.push(this.route);
                }
            },
            setUnreadCount(count) {
                if (!this.opened) {
                    this.unreadCount = count;
                }
            }
        },
        watch: {
            'conversation.unreadCount': 'setUnreadCount'
        }
    }
</script>

<style scoped>
    .unread {
        font-weight: bold !important;
    }
</style>