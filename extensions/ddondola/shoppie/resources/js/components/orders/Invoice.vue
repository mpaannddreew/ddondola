<template>
    <div class="directory-area">
        <div class="card card-small main">
            <div class="card-body h-100">
                <div class="p-5">
                    <div class="mb-2 align-items-center">
                        <div class="ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">
                            <a class="btn btn-white btn-sm text-danger" href="javascript:void(0)" @click="transitionBack">
                                <i class="material-icons">arrow_back</i>
                            </a>
                        </div>
                    </div>
                    <div class="flat-card is-auto order-list-card p-4 border bg-white border-radius"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Invoice",
        mounted(){
            // todo initialize invoice
        },
        props: {
            order: {
                type: String,
                required: true
            }
        },
        computed: {
            orderRoute() {
                return `/me/orders/${this.order}`;
            }
        },
        methods: {
            transitionBack() {
                this.$router.push(this.orderRoute);
            }
        }
    }
</script>

<style scoped>

</style>