<template>
    <div class="chat chat-left">
        <div class="chat-avatar">
            <a href="javascript:void(0)" class="avatar">
                <img alt="John Doe" :src="chat.sender.avatar.url" class="img-fluid rounded-circle">
            </a>
        </div>
        <div class="chat-body">
            <div class="chat-bubble">
                <div class="chat-content">
                    <p>{{ chat.message }}</p>
                    <span class="chat-time">{{ chat.created_at|time }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatLeft",
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

        },
        filters: {
            time(date) {
                return Moment(date).format("h:mm a");
            }
        }
    }
</script>

<style scoped>

</style>