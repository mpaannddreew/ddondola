<template>
    <tr>
        <td class="text-primary">{{ withdrawRequest.code }}</td>
        <td class="text-center">{{ withdrawRequest.amount|commas }}</td>
        <td class="text-center" v-html="status"></td>
        <td class="text-center">{{ withdrawRequest.created_at|fromNow }}</td>
    </tr>
</template>

<script>
    export default {
        name: "WithdrawRequest",
        props: {
            withdrawRequest: {
                type: Object,
                required: true
            }
        },
        computed: {
            status() {
                if (!this.escrow.processed) {
                    return `<span class="text-warning">Pending</span>`;
                }else {
                    return `<span class="text-danger">Successful</span>`;
                }
            }
        }
    }
</script>

<style scoped>

</style>