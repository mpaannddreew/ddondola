<template>
    <div>
        <div class="chat-area">
            <div class="card card-small h-100 main" style="border-radius: 0; box-shadow: none;" v-if="!loaded || (loaded && !conversation)">
                <div class="card-body d-flex flex-column">
                    <div class="center-xy" v-if="!loaded">
                        <div align="center">
                            <div class="loader"></div>
                            <p>{{ message }}</p>
                        </div>
                    </div>
                    <div class="error" v-if="loaded && !conversation">
                        <div class="error__content">
                            <h4 class="m-0"><i class="material-icons">chat</i></h4>
                            <p class="mb-3">You have not started a conversation with this entity.</p>
                            <button type="button" class="btn btn-success btn-pill" @click="startConversation">
                                <i class="material-icons">check_box</i> Start Conversation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-small h-100 main" style="border-radius: 0; box-shadow: none;" v-if="loaded && conversation">
                <div class="card-header border-bottom px-2" style="padding-top: 0.6em; padding-bottom: 0.6em;">
                    <a href="javascript:void(0)" @click="back" class="btn btn-pill btn-outline-primary active">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                    <strong>{{ converser.name }}</strong>
                </div>
                <div class="card-body d-flex flex-column" id="chat-body">
                    <template v-if="!messagesLoaded">
                        <div align="center" class="p-4">
                            <div class="loader"></div>
                            <p>Loading messages...</p>
                        </div>
                    </template>
                    <template v-else-if="!hasMessages && messagesLoaded">
                        <div align="center" class="p-4">
                            <h4 class="m-0"><i class="material-icons">chat</i></h4>
                            <p class="mb-0">Empty conversation.</p>
                        </div>
                    </template>
                    <div class="chats" v-else-if="hasMessages && messagesLoaded" id="chats">
                        <chat-group v-for="(group, indx) in groupedMessages" :key="indx" :group="group" :initiator="initiator" :participant="participant"></chat-group>
                    </div>
                </div>
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
    </div>
</template>

<script>
    import ChatGroup from "./ChatGroup";
    export default {
        name: "ChatArea",
        components: {ChatGroup},
        mounted() {
            this.listen();
        },
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
                sending: false
            }
        },
        created () {
            this.fetchConversation()
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
            hasText() {
                return this.text.length > 0;
            },
            groupedMessages() {
                return _.groupBy(_.sortBy(this.messages, function (message) {
                    return Moment(message.created_at);
                }), function(message){
                    return Moment(message.created_at).format("MMMM Do YYYY");
                });
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
            },
            watchConversation() {
                Echo.private(`conversation.${parseInt(this.conversation.id)}`)
                    .listen('.new.message', (e) => {
                        this.messages.push(e);
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
            },
            listen() {

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
                    // todo show typing indicators to others
                }
            },
            message: {
                handler(data) {

                },
                deep: true
            }
        }
    }
</script>

<style scoped>

</style>