<template>
    <div class="chat-profile close-chat-profile" id="chat_profile">
        <div class="card card-small h-100 border-left" style="border-radius: 0; box-shadow: none;">
            <div class="card-body d-flex flex-column p-0">
                <div class="chat-profile-img">
                    <div class="edit-profile-img">
                        <img src="/images/avatars/0.jpg" alt="">
                    </div>
                    <h3 class="user-name m-t-10 m-b-0">John Doe</h3>
                    <small class="text-muted">Web Designer</small>
                </div>
                <div class="chat-profile-info">
                    <ul class="user-det-list">
                        <li>
                            <span>Username:</span>
                            <span class="pull-right text-muted">johndoe</span>
                        </li>
                        <li>
                            <span>DOB:</span>
                            <span class="pull-right text-muted">24 July</span>
                        </li>
                        <li>
                            <span>Email:</span>
                            <span class="pull-right text-muted">johndoe@example.com</span>
                        </li>
                        <li>
                            <span>Phone:</span>
                            <span class="pull-right text-muted">9876543210</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatProfile",
        data() {
            return {

            }
        }
    }
</script>

<style scoped>

</style>