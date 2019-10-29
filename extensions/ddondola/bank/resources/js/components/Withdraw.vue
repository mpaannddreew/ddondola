<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-body h-100">
                <div class="center-xy">
                    <div class="card card-small border user-details" style="min-width: 400px !important;">
                        <div class="card-body">
                            <div class="user-details__avatar mx-auto border lis-border-width-4 bg-white p-4" style="box-shadow: none !important; border-radius: 500px !important; border: thin solid #e1e5eb !important;">
                                <img src="/images/wallet/withdraw_ico.png" alt="User Avatar">
                            </div>
                            <h6 class="text-center m-0 mt-2 mb-4 text-uppercase">Withdraw</h6>
                            <div class="p-4">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="amount" style="border-radius: 500px !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div align="center">
                        <button class="btn btn-lg btn-pill btn-outline-primary my-2">
                            <i class="fa fa-check"></i> Initiate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Withdraw",
        props: {
            shop: {
                type: String
            }
        }
    }
</script>

<style scoped>
    .directory .card.main {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }
</style>