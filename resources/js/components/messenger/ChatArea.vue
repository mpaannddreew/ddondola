<template>
    <div>
        <div class="chat-area">
            <div class="card card-small h-100 main" style="border-radius: 0; box-shadow: none;" v-if="!loaded || (loaded && !conversation)">
                <div class="card-body d-flex flex-column" :class="{'chat-body-loading': !loaded}">
                    <div class="center-xy" v-if="!loaded">
                        <div align="center">
                            <div class="loader"></div>
                            <p>{{ message }}</p>
                        </div>
                    </div>
                    <div class="error" v-if="loaded && !conversation">
                        <div class="error__content">
                            <h4 class="m-0"><i class="material-icons">error</i></h4>
                            <p class="mb-3">You have not started a conversation with this entity.</p>
                            <button type="button" class="btn btn-success btn-pill" @click="startConversation">
                                <i class="material-icons">check_box</i> Start Conversation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="conversation" v-if="loaded && conversation">
                <div class="chat-messages">
                    <div class="card card-small h-100 main" style="border-radius: 0; box-shadow: none;">
                        <div class="card-header border-bottom px-2" style="padding-top: 0.6em; padding-bottom: 0.6em;">
                            <a href="javascript:void(0)" @click="back" class="btn btn-link">
                                <i class="fa fa-remove mr-2"></i><strong>{{ converser.name }}</strong>
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column" id="chat-body">
                            <template v-if="!messagesLoaded">
                                <div align="center" class="p-4">
                                    <div class="loader"></div>
                                    <p>Loading messages...</p>
                                </div>
                            </template>
                            <div class="chats" id="chats" v-if="messagesLoaded">
                                <template v-if="hasMessages">
                                    <chat-group v-for="(group, indx) in groupedMessages" :key="indx" :group="group" :initiator="initiator" :participant="participant"></chat-group>
                                </template>
                                <div class="chat chat-left" v-if="typing">
                                    <div class="chat-avatar">
                                        <a :href="converserProfile" class="avatar">
                                            <img alt="John Doe" :src="converser.avatar.url" class="img-fluid rounded-circle">
                                        </a>
                                    </div>
                                    <div class="chat-body">
                                        <div class="chat-bubble">
                                            <div class="chat-content">
                                                <p>Typing ...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="card-footer px-3 pt-1 pb-3 border-radius-0" id="chat-footer">-->
                            <!--<form @submit.prevent="sendMessage" class="d-flex">-->
                                <!--<div class="input-group m-0">-->
                                    <!--<div class="input-group input-group-seamless">-->
                                        <!--<input class="form-control" type="text" style="border-radius: 500px;" v-model="text" placeholder="Type a message here">-->
                                        <!--<span class="input-group-append">-->
                                          <!--<span class="input-group-text">-->
                                            <!--<button class="btn btn-link p-0" type="button"><i class="material-icons">attach_file</i></button>-->
                                          <!--</span>-->
                                        <!--</span>-->
                                    <!--</div>-->
                                <!--</div>-->
                                <!--<button type="submit" class="btn btn-primary btn-pill my-auto ml-3" :class="{disabled: !hasText || sending}">-->
                                    <!--<i class="fa fa-send"></i>-->
                                <!--</button>-->
                            <!--</form>-->
                        <!--</div>-->
                        <div class="card-footer border-top p-0">
                            <div class="typing-msg border-0 py-4">
                                <form>
                                    <textarea placeholder="Type a message here" class="pr-5" v-model="text"></textarea>
                                    <button type="button" @click="sendMessage" :class="{disabled: !hasText || sending}"><i class="fa fa-send"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-profile close-chat-profile h-100 border-left bg-white" style="overflow-x: hidden; overflow-y: auto;">
                    <shop-information :shop="converser" :directory="false" v-if="shopConverser"></shop-information>
                    <user-information :user="converser" v-else></user-information>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ChatGroup from "./ChatGroup";
    export default {
        name: "ChatArea",
        components: {ChatGroup},
        data() {
            return {
                message: "",
                messages: [],
                loaded: false,
                conversation: null,
                messagesLoaded: false,
                loadingMoreMessages: false,
                count: 0,
                paginatorInfo: null,
                text: '',
                sending: false,
                typing: false
            }
        },
        created () {
            this.fetchConversation()
        },
        beforeDestroy() {
            Echo.leave(this.channel);
        },
        props: {
            participant: {
                type: String,
                required: true
            },
            initiator: {
                type: String
            }
        },
        computed: {
            converserProfile() {
                return `/${this.shopConverser ? 'shops':'people'}/${this.converser.code}`;
            },
            home() {
                return this.initiator ? `/shops/${this.initiator}/messenger` : '/me/messenger'
            },
            conversationVariables() {
                var variables = {participant: this.participant};
                if (this.initiator) {
                    variables["initiator"] = this.initiator;
                }

                return variables;
            },
            sendVariables() {
                var variables = this.conversationVariables;
                variables["message"] = this.text;

                return variables;
            },
            messagesVariables() {
                var variables = this.conversationVariables;
                variables["count"] = this.count;
                variables["page"] = 1;

                return variables;
            },
            hasMessages() {
                return this.messages.length > 0;
            },
            converser() {
                if(this.conversation){
                    if(this.isConverser(this.conversation.initiator.code)) {
                        return this.conversation.initiator;
                    }

                    if(this.isConverser(this.conversation.participant.code)) {
                        return this.conversation.participant;
                    }
                }

                return null;
            },
            current() {
                if(this.conversation){
                    if(!this.isConverser(this.conversation.initiator.code)) {
                        return this.conversation.initiator;
                    }

                    if(!this.isConverser(this.conversation.participant.code)) {
                        return this.conversation.participant;
                    }
                }

                return null;
            },
            converserType() {
                if (this.converser)
                    return this.lowerCase(this.converser.type);
                return null;
            },
            hasText() {
                return this.text.length > 0;
            },
            groupedMessages() {
                let sorted = _.sortBy(this.messages, (message) => {
                    return Moment(message.created_at);
                });

                let grouped = _.groupBy(sorted, (message) => {
                    return Moment(message.created_at).format("MMMM Do YYYY");
                });

                let groups = _.map(_.keys(grouped), (group) => {
                    return {label: group, date: null, chats: []};
                });

                return _.map(groups, (group) => {
                    let messages = grouped[group.label];
                    group.date = _.head(messages).created_at;
                    var chat = null;

                    _.forEach(messages, (message, key) => {
                        // if message is first and last
                        if (key === 0 && key === messages.length - 1) {
                            group.chats.push({sender: message.sender, bubbles: [message]});
                        } else {
                            // if message is first and not last
                            if (key === 0 && key !== messages.length - 1) {
                                // get following message after current
                                let next = messages[key + 1];
                                if (next.sender.code === message.sender.code) {
                                    chat = {sender: message.sender, bubbles: [message]};
                                } else {
                                    group.chats.push({sender: message.sender, bubbles: [message]});
                                }
                                // if message is not first and not last
                            }else if (key !== 0 && key !== messages.length - 1) {
                                if (chat) {
                                    let previous = messages[key - 1];
                                    if (previous.sender.code === message.sender.code) {
                                        chat.bubbles.push(message);
                                    } else {
                                        group.chats.push(chat);
                                        chat = {sender: message.sender, bubbles: [message]};
                                    }
                                } else {
                                    chat = {sender: message.sender, bubbles: [message]};
                                }
                                // if message is last
                            }else if (key === messages.length - 1) {
                                if (chat) {
                                    let previous = messages[key - 1];
                                    if (previous.sender.code === message.sender.code) {
                                        chat.bubbles.push(message);
                                        group.chats.push(chat);
                                    } else {
                                        group.chats.push(chat);
                                        group.chats.push({sender: message.sender, bubbles: [message]});
                                    }
                                } else {
                                    group.chats.push({sender: message.sender, bubbles: [message]});
                                }
                            }
                        }
                    });

                    return group;
                });
            },
            shopConverser() {
                return this.converserType === 'shop';
            },
            channel() {
                if (this.converser)
                    return `conversation.${this.conversation.id}`;

                return null;
            }
        },
        methods: {
            back() {
                this.$router.push(this.home);
            },
            fetchConversation() {
                this.loaded = false;
                this.conversation = null;
                this.message = "loading conversation...";
                this.messagesLoaded = false;
                this.messages = [];
                axios.post(graphql.api, {
                    query: graphql.conversation,
                    variables: this.conversationVariables
                }).then(this.loadConversation).catch(function (error) {});
            },
            loadConversation(response) {
                this.loaded = true;
                this.conversation = response.data.data.conversation;
                this.message = null;
                this.watchConversation();
                this.readAll();
            },
            readAll() {
                if (this.conversation) {
                    axios.post(graphql.api, {
                        query: graphql.readConversation,
                        variables: {conversation: this.conversation.id, converser: {id: this.current.id, type: this.current.type}}
                    }).then(function (response) {}).catch(function (e) {});
                }
            },
            watchConversation() {
                Echo.private(this.channel)
                    .listen('.new.message', (e) => {
                        this.messages.push({created_at: e.created_at, id: e.id, message: e.message, sender: e.sender});
                        this.readAll();
                    })
                    .listenForWhisper('typing', (e) => {
                        this.typing = true;
                        setTimeout(() => {
                            this.typing = false
                        }, 2000);
                    });
            },
            startConversation() {
                this.message = "starting conversation...";
                this.loaded = false;
                axios.post(graphql.api, {
                    query: graphql.startConversation,
                    variables: this.conversationVariables
                }).then(this.loadConversation).catch(function (error) {});
            },
            initialCount() {
                this.count = 100;
            },
            fetchMessages() {
                this.messages = [];
                this.messagesLoaded = false;
                axios.post(graphql.api, {
                    query: graphql.conversationMessages,
                    variables: this.messagesVariables
                }).then(this.loadMessages).catch(function (error) {});
            },
            loadMessages(response) {
                this.messagesLoaded = true;
                this.messages = response.data.data.conversation.messages.data;
                this.paginatorInfo = response.data.data.conversation.messages.paginatorInfo;
            },
            isConverser(code) {
                return this.participant === code;
            },
            sendMessage() {
                this.sending = true;
                axios.post(graphql.api, {
                    query: graphql.sendMessage,
                    variables: this.sendVariables
                }).then(this.messageSent).catch(function (error) {});
            },
            messageSent(response) {
                this.sending = false;
                this.text = '';
            }
        },
        watch: {
            '$route': 'fetchConversation',
            conversation(data) {
                if (data) {
                    this.initialCount();
                    this.fetchMessages();
                }
            },
            text(data) {
                if (data) {
                    Echo.private(this.channel)
                        .whisper('typing', {
                            converser: {
                                id: this.converser.id,
                                code: this.converser.code,
                                type: this.converser.type
                            }
                        });
                }
            }
        }
    }
</script>

<style scoped>
    .chat-messages {
        padding: 0;
        position: relative;
        width: calc(100% - 350px);
        float: left;
    }

    .close-chat-profile {
    }

    .chat-profile {
        padding: 0;
        position: relative;
        width: 350px;
        float: left;
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }

    @media only screen and (max-width: 768px) {
        .chat-messages {
            width: 100% !important;
        }

        .close-chat-profile {
            margin-right: -350px;
        }
    }
</style>