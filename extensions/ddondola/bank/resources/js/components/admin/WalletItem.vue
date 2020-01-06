<template>
    <div class="card card-small border border-radius">
        <div class="card-body">
            <div class="d-flex mb-4">
                <img :src="holder" alt="Avatar" class="round my-auto" style="width: 50px !important;">
                <div class="ml-2 my-auto">
                    <h6 class="text-ellipsis m-0">{{ name }}</h6>
                    <p class="m-0">Balance: UGX 7,000,000</p>
                </div>
            </div>
            <div class="bg-light border p-1 border-radius d-flex">
                <div class="p-2 border-radius" style="background: #f00"></div>
                <div class="text-uppercase ml-2 text-ellipsis my-auto">559292e5-447b-4a8e-a1b2-fac2d99acebc</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WalletItem",
        data() {
            return {
                holder: 'data:image/png;base64,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',
                name: 'Mpande Andrew'
            }
        },
        props: {
            wallet: {
                type: Number
            }
        }
    }
</script>

<style scoped>

</style>