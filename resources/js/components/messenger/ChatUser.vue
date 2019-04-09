<template>
    <li>
        <div class="contact-cont">
            <router-link :to="homeUrl + 'code'">
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
            </router-link>
            <ul class="contact-action" style="list-style: none;">
                <li class="dropdown dropdown-action dropdown-menu-sm-left">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-small" style="display: none;">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="material-icons">delete_forever</i> Delete</a>
                    </div>
                </li>
            </ul>
        </div>
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