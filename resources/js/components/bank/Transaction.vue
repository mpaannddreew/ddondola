<template>
    <tr>
        <td class="text-primary">{{ transaction.code }}</td>
        <td class="text-center">{{ transaction.note }}</td>
        <td class="text-center"><span :class="indicator"><i class="material-icons">{{ icon }}</i></span> {{ transaction.amount|commas }}</td>
        <td class="text-center">{{ transaction.created_at|fromNow }}</td>
    </tr>
</template>

<script>
    export default {
        name: "Transaction",
        props: {
            transaction: {
                type: Object,
                required: true
            }
        },
        computed: {
            icon() {
                return this.transaction.debit ? 'arrow_upward': 'arrow_downward';
            },
            indicator() {
                return {
                    'text-success': this.transaction.debit,
                    'text-danger': this.transaction.credit
                };
            }
        }
    }
</script>

<style scoped>

</style>