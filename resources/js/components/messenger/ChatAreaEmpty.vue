<template>
    <div class="chat-area">
        <div class="card card-small h-100" style="border-radius: 0; box-shadow: none;">
            <div class="card-body d-flex flex-column">
                <div class="error">
                    <div class="error__content">
                        <h4 class="m-0"><i class="material-icons">chat</i></h4>
                        <p class="mb-3">Choose a conversation/contact to start chatting.</p>
                        <button type="button" class="btn btn-success btn-pill" @click="newConversation">
                            <i class="material-icons">add</i> New Conversation
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatAreaEmpty",
        data() {
            return {}
        },
        methods: {
            newConversation() {
                Bus.$emit("show-platform-repository");
            }
        }
    }
</script>

<style scoped>

</style>