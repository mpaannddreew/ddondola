<template>
    <li>
        <router-link :to="homeUrl + 'code'">
            <div class="contact-cont">
                <div class="pull-left user-img m-r-10">
                    <a href="profile.html" title="John Doe">
                        <img src="/images/avatars/0.jpg" alt="" class="w-40 rounded-circle">
                        <span class="status online"></span>
                    </a>
                </div>
                <div class="contact-info">
                    <span class="contact-name text-ellipsis">John Doe</span>
                    <span class="contact-date text-ellipsis">Hey there, this is Andrew. Did you get it?</span>
                </div>
            </div>
        </router-link>
    </li>
</template>

<script>
    export default {
        name: "ChatUser",
        data() {
            return {

            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            }
        }
    }
</script>

<style scoped>

</style>