<template>
    <li>
        <div class="contact-cont">
            <a href="javascript:void(0)" @click="transitionTo">
                <div class="pull-left user-img m-r-10">
                    <a href="javascript:void(0)" title="Home Concepts">
                        <img :src="shop.avatar.url" alt="" class="w-40 rounded-circle">
                        <span class="status online"></span>
                    </a>
                </div>
                <div class="contact-info" style="padding: 0px 10px 0px 50px;">
                    <span class="contact-name text-ellipsis">{{ shop.name }}</span>
                    <span class="contact-date text-ellipsis">
                    <span class="text-light">{{ shop.category.name }}</span>
                </span>
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
        name: "Shop",
        data() {
            return {

            }
        },
        props: {
            shop: {
                type: Object,
                required: true
            }
        },
        methods: {
            transitionTo() {
                this.$router.push(this.route);
            }
        },
        computed: {
            route() {
                return `/admin/shops/${this.shop.code}`;
            }
        }
    }
</script>

<style scoped>

</style>