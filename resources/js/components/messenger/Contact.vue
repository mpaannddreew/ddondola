<template>
    <li>
        <div class="contact-cont">
            <a href="javascript:void(0)" @click="transitionTo">
                <div class="pull-left user-img m-r-10">
                    <a href="javascript:void(0)" :title="contact.name">
                        <img :src="contact.avatar.url" alt="" class="w-40 rounded-circle">
                        <span class="status online"></span>
                    </a>
                </div>
                <div class="contact-info" style="padding: 0 10px 0 50px;">
                    <span class="contact-name text-ellipsis">{{ contact.name }}</span>
                    <span class="contact-date text-ellipsis" v-html="social"></span>
                </div>
            </a>
            <div class="contact-action">
                <span class="posted_time"><i class="material-icons">chevron_right</i></span>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        name: "Contact",
        data() {
            return {

            }
        },
        props: {
            homeUrl: {
                type: String,
                require: true
            },
            contact: {
                type: Object,
                required: true
            }
        },
        computed: {
            route() {
                return this.homeUrl + "/" + this.contact.code;
            },
            social() {
                if (typeof this.contact.followerCount !== 'undefined' && typeof this.contact.followingCount !== 'undefined')
                    return '<span class="text-light">' + this.contact.followerCount + ' Follower(s) | ' + this.contact.followingCount + ' Following</span>';

                return '<span class="text-light">' + this.contact.category.name + ' | ' + this.contact.likes + ' Like(s) | ' + this.contact.reviewCount + ' Review(s)</span>';
            }
        },
        methods: {
            transitionTo() {
                this.$router.push(this.route);
            }
        }
    }
</script>

<style scoped>

</style>