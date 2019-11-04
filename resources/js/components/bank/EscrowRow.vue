<template>
    <tr>
        <td class="text-primary">{{ escrow.code }}</td>
        <td class="text-center">{{ escrow.amount|commas }}</td>
        <td class="text-center" v-html="status"></td>
        <td class="text-center">{{ escrow.created_at|fromNow }}</td>
    </tr>
</template>

<script>
    export default {
        name: "EscrowRow",
        props: {
            escrow: {
                type: Object,
                required: true
            }
        },
        computed: {
            status() {
                if (!this.escrow.completed && !this.escrow.reversed) {
                    return `<span class="text-warning">Pending</span>`;
                }else if(this.escrow.completed) {
                    return `<span class="text-success">Successful</span>`;
                }else {
                    return `<span class="text-danger">Cancelled</span>`;
                }
            }
        }
    }
</script>

<style scoped>

</style>