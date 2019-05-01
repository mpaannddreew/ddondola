<template>
    <div>
        <div class="chat-area" v-if="!loaded || (loaded && !conversation)">
            <div class="card card-small h-100" style="border-radius: 0; box-shadow: none;">
                <div class="card-body">
                    <div class="center-xy" v-if="!loaded">
                        <div align="center">
                            <div class="loader"></div>
                            <p>{{ message }}</p>
                        </div>
                    </div>
                    <div v-if="loaded && !conversation">
                        <div class="error">
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
            </div>
        </div>
        <div class="chat-area" v-if="loaded && conversation">
            <div class="card card-small h-100" style="border-radius: 0; box-shadow: none;">
                <div class="card-header border-bottom d-flex">
                    <div class="contact-cont">
                        <div class="pull-left user-img m-r-10">
                            <a href="javascript:void(0)" :title="converser.name">
                                <img :src="converser.avatar.url" alt="" class="w-40 rounded-circle">
                                <span class="status online"></span>
                            </a>
                        </div>
                        <div class="contact-info">
                            <span class="contact-name text-uppercase text-primary">{{ converser.name }}</span>
                            <span class="contact-date text-ellipsis">Last seen today at 7:50 AM</span>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    <template v-if="!messagesLoaded">
                        <div align="center" class="p-4">
                            <div class="loader"></div>
                            <p>Loading messages...</p>
                        </div>
                    </template>
                    <template v-else-if="!hasMessages && messagesLoaded">
                        <div align="center" class="p-4">
                            <h4 class="m-0"><i class="material-icons">error</i></h4>
                            <p class="mb-0">No messages.</p>
                        </div>
                    </template>
                    <div class="chats" v-else-if="hasMessages && messagesLoaded">
                        <div class="chat chat-right">
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>Hello. What can I do for you?</p>
                                        <span class="chat-time">8:30 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-line">
                            <span class="chat-date">October 8th, 2015</span>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-avatar">
                                <a href="#" class="avatar">
                                    <img alt="John Doe" src="/images/avatars/0.jpg" class="img-fluid rounded-circle">
                                </a>
                            </div>
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>I'm just looking around.</p>
                                        <p>Will you tell me something about yourself? </p>
                                        <span class="chat-time">8:35 am</span>
                                    </div>
                                </div>
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>Are you there? That time!</p>
                                        <span class="chat-time">8:40 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-right">
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>Where?</p>
                                        <span class="chat-time">8:35 am</span>
                                    </div>
                                </div>
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>OK, my name is Limingqiang. I like singing, playing basketballand so on.</p>
                                        <span class="chat-time">8:42 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-avatar">
                                <a href="#" class="avatar">
                                    <img alt="John Doe" src="/images/avatars/0.jpg" class="img-fluid rounded-circle">
                                </a>
                            </div>
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>You wait for notice.</p>
                                        <span class="chat-time">8:30 am</span>
                                    </div>
                                </div>
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>Consectetuorem ipsum dolor sit?</p>
                                        <span class="chat-time">8:50 am</span>
                                    </div>
                                </div>
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>OK?</p>
                                        <span class="chat-time">8:55 am</span>
                                    </div>
                                </div>
                                <div class="chat-bubble">
                                    <div class="chat-content img-content">
                                        <div class="chat-img-group clearfix">
                                            <p>Uploaded 3 Images</p>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                    <div class="chat-file-desc">842 KB</div>
                                                </div>
                                            </a>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">842 KB</div>
                                                </div>
                                            </a>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                    <div class="chat-file-desc">842 KB</div>
                                                </div>
                                            </a>
                                        </div>
                                        <span class="chat-time">9:00 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-right">
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>OK!</p>
                                        <span class="chat-time">9:00 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-avatar">
                                <a href="#" class="avatar">
                                    <img alt="John Doe" src="/images/avatars/0.jpg" class="img-fluid rounded-circle">
                                </a>
                            </div>
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>Uploaded 3 files</p>
                                        <ul class="attach-list">
                                            <li><i class="fa fa-file"></i> <a href="#">example.avi</a></li>
                                            <li><i class="fa fa-file"></i> <a href="#">activity.psd</a></li>
                                            <li><i class="fa fa-file"></i> <a href="#">example.psd</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>Consectetuorem ipsum dolor sit?</p>
                                        <span class="chat-time">8:50 am</span>
                                    </div>
                                </div>
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <p>OK?</p>
                                        <span class="chat-time">8:55 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-right">
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content img-content">
                                        <div class="chat-img-group clearfix">
                                            <p>Uploaded 6 Images</p>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                    <div class="chat-file-desc">842 KB</div>
                                                </div>
                                            </a>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">842 KB</div>
                                                </div>
                                            </a>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                    <div class="chat-file-desc">842 KB</div>
                                                </div>
                                            </a>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                    <div class="chat-file-desc">842 KB</div>
                                                </div>
                                            </a>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                    <div class="chat-file-desc">842 KB</div>
                                                </div>
                                            </a>
                                            <a class="chat-img-attach" href="#">
                                                <img alt="" src="/images/placeholder.jpg" width="182" height="137">
                                                <div class="chat-placeholder">
                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                    <div class="chat-file-desc">842 KB</div>
                                                </div>
                                            </a>
                                        </div>
                                        <span class="chat-time">9:00 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-avatar">
                                <a href="#" class="avatar">
                                    <img alt="John Doe" src="/images/avatars/0.jpg" class="img-fluid rounded-circle">
                                </a>
                            </div>
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <ul class="attach-list">
                                            <li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
                                        </ul>
                                        <span class="chat-time">9:00 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-right">
                            <div class="chat-body">
                                <div class="chat-bubble">
                                    <div class="chat-content">
                                        <ul class="attach-list">
                                            <li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
                                        </ul>
                                        <span class="chat-time">9:00 am</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat chat-left">
                            <div class="chat-avatar">
                                <a href="#" class="avatar">
                                    <img alt="John Doe" src="/images/avatars/0.jpg" class="img-fluid rounded-circle">
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
                <div class="card-footer border-top p-0">
                    <div class="typing-msg border-0">
                        <form>
                            <textarea placeholder="Type a message here" class="pr-5"></textarea>
                            <button type="button"><i class="fa fa-send"></i></button>
                        </form>
                        <ul class="ft-options">
                            <li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatArea",
        mounted() {},
        data() {
            return {
                message: "",
                messages: [],
                loaded: false,
                conversation: null,
                messagesLoaded: false,
                loadingMoreMessages: false,
                count: 0,
                paginatorInfo: null
            }
        },
        created () {
            this.fetchConversation()
        },
        props: {
            converserCode: {
                type: String,
                required: true
            },
            code: {
                type: String
            }
        },
        computed: {
            conversationVariables() {
                var variables = {participant: this.converserCode};
                if (this.code) {
                    variables["initiator"] = this.code;
                }

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
            }
        },
        methods: {
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
                this.count = graphql.rowCount;
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
                return this.converserCode === code;
            }
        },
        watch: {
            '$route': 'fetchConversation',
            conversation(data) {
                if (data) {
                    this.initialCount();
                    this.fetchMessages();
                }
            }
        }
    }
</script>

<style scoped>

</style>