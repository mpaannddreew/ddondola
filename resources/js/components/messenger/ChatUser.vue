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
            <ul class="contact-action">
                <li class="dropdown dropdown-action">
                    <a href="#" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-sm-right p-1">
                        <a class="dropdown-item p-1" href="javascript:void(0)"><i class="fa fa-trash-o"></i> Delete</a>
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