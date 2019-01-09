<template>
    <div class="alert fade show mb-0" :class="alert" role="alert" v-show="show">
        <button type="button" class="close" @click="hideAlert">
            <span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-info mx-2"></i>
        {{ message }}
    </div>
</template>

<script>
    export default {
        name: "Alert",
        mounted() {
            this.listenForAlerts();
            this.hideAlert();
        },
        data() {
            return {
                message: '',
                isDanger: false,
                isInfo: false,
                isSuccess: false
            }
        },
        computed: {
            alert() {
                return { 'alert-danger': this.isDanger, 'alert-info': this.isInfo, 'alert-success': this.isSuccess}
            },
            show() {
                return this.isDanger || this.isInfo || this.isSuccess;
            }
        },
        watch: {
            isDanger: {
                handler: function (isDanger) {
                    if (isDanger) {
                        this.isInfo = false;
                        this.isSuccess = false;
                    }
                }
            },
            isInfo: {
                handler: function (isInfo) {
                    if (isInfo) {
                        this.isDanger = false;
                        this.isSuccess = false;
                    }
                }
            },
            isSuccess: {
                handler: function (isSuccess) {
                    if (isSuccess) {
                        this.isDanger = false;
                        this.isInfo = false;
                    }
                }
            }
        },
        methods: {
            listenForAlerts() {
                Bus.$on('alert', alert => {
                    this.showAlert(alert);
                });
            },
            showAlert(alert) {
                this.message = alert.message;
                if (alert.type === 'danger') {
                    this.isDanger = true;
                }else if (alert.type === 'info') {
                    this.isInfo = true;
                }else  {
                    this.isSuccess = false;
                }
            },
            hideAlert() {
                this.isInfo = false;
                this.isSuccess = false;
                this.isDanger = false;
            }
        }
    }
</script>

<style scoped>

</style>