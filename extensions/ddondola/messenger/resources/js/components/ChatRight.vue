<template>
    <div class="chat chat-right">
        <div class="chat-body">
            <div class="chat-bubble" v-for="(bubble, indx) in chat.bubbles">
                <div class="chat-content border" v-if="!bubble.images">
                    <p>{{ bubble.message }}</p>
                    <span class="chat-time">{{ bubble.created_at|time }}</span>
                </div>
                <div class="chat-content img-content" v-else>
                    <div class="chat-img-group clearfix">
                        <p v-if="bubble.message">{{ bubble.message }}</p>
                        <a class="chat-img-attach" href="#">
                            <img alt="" src="assets/img/placeholder.jpg" width="182" height="137">
                            <div class="chat-placeholder">
                                <div class="chat-img-name">placeholder.jpg</div>
                                <div class="chat-file-desc">842 KB</div>
                            </div>
                        </a>
                        <a class="chat-img-attach" href="#">
                            <img alt="" src="assets/img/placeholder.jpg" width="182" height="137">
                            <div class="chat-placeholder">
                                <div class="chat-img-name">842 KB</div>
                            </div>
                        </a>
                        <a class="chat-img-attach" href="#">
                            <img alt="" src="assets/img/placeholder.jpg" width="182" height="137">
                            <div class="chat-placeholder">
                                <div class="chat-img-name">placeholder.jpg</div>
                                <div class="chat-file-desc">842 KB</div>
                            </div>
                        </a>
                        <a class="chat-img-attach" href="#">
                            <img alt="" src="assets/img/placeholder.jpg" width="182" height="137">
                            <div class="chat-placeholder">
                                <div class="chat-img-name">placeholder.jpg</div>
                                <div class="chat-file-desc">842 KB</div>
                            </div>
                        </a>
                        <a class="chat-img-attach" href="#">
                            <img alt="" src="assets/img/placeholder.jpg" width="182" height="137">
                            <div class="chat-placeholder">
                                <div class="chat-img-name">placeholder.jpg</div>
                                <div class="chat-file-desc">842 KB</div>
                            </div>
                        </a>
                        <a class="chat-img-attach" href="#">
                            <img alt="" src="assets/img/placeholder.jpg" width="182" height="137">
                            <div class="chat-placeholder">
                                <div class="chat-img-name">placeholder.jpg</div>
                                <div class="chat-file-desc">842 KB</div>
                            </div>
                        </a>
                    </div>
                    <span class="chat-time">{{ bubble.created_at|time }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatRight",
        mounted() {},
        data() {
            return {}
        },
        props: {
            chat: {
                type: Object,
                required: true
            }
        },
        computed: {

        }
    }
</script>

<style scoped>
    .border {
        border: 1px solid #cccccc54 !important;
    }
</style>