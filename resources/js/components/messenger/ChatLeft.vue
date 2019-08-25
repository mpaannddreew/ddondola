<template>
    <div class="chat chat-left">
        <div class="chat-avatar">
            <a :href="url" class="avatar">
                <img :alt="sender.name" :src="sender.avatar.url" class="img-fluid rounded-circle">
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
            sender() {
                return this.chat.sender;
            },
            type() {
                return this.lowerCase(this.sender.type);
            },
            url() {
                return `/${this.type === 'shop' ? 'shops':'people'}/${this.sender.code}`;
            },
        }
    }
</script>

<style scoped>

</style>