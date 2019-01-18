<template>
    <div class="chat-area">
        <div class="card card-small h-100" style="border-radius: 0; box-shadow: none;">
            <div class="card-header border-bottom">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <button @click="chatList" class="btn btn-white chat-list-btn">
                        <i class="material-icons" style="font-size: 200%;">contacts</i>
                    </button>
                    <div id="user-active">
                        <div class="user-active">
                            <span class="font-bold user-name" style="text-transform: uppercase;">Mike Litorus</span>
                            <span class="last-seen">Last seen today at 7:50 AM</span>
                        </div>
                    </div>
                    <button @click="chatProfile" class="btn btn-white chat-profile-btn">
                        <i class="material-icons" style="font-size: 200%;">person</i>
                    </button>
                </div>
            </div>
            <div class="card-body d-flex flex-column" id="chat-area">
                <div class="chats">
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
                        <button type="submit"><i class="fa fa-send"></i></button>
                    </form>
                    <ul class="ft-options">
                        <li><a href="#" title=""><i class="fa fa-camera"></i></a></li>
                        <li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatArea",
        mounted() {
            this.chatArea();
        },
        data() {
            return {

            }
        },
        methods: {
            chatList() {
                $("#chat_list").addClass( "open-chat-list" ).removeClass( "close-chat-list" );
                $("#chat_profile").removeClass( "open-chat-profile" ).addClass('close-chat-profile');
            },
            chatProfile() {
                $("#chat_list").removeClass( "open-chat-list" ).addClass( "close-chat-list" );
                $("#chat_profile").addClass( "open-chat-profile" ).removeClass('close-chat-profile');
            },
            chatArea() {
                $('#chat-area, #user-active').bind('click', function () {
                    $("#chat_list").removeClass( "open-chat-list" ).addClass( "close-chat-list" );
                    $("#chat_profile").removeClass( "open-chat-profile" ).addClass('close-chat-profile');
                });
            }
        }
    }
</script>

<style scoped>

</style>