<template>
    <div class="chat chat-right">
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

</style>