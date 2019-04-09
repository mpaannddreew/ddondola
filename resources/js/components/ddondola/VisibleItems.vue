<template>
    <div class="my-2">
        <span class="visible-items" v-if="showItems">Showing <strong>{{ start }}-{{ end }}</strong> of <strong>{{ paginatorInfo.total }}</strong> results</span>
        <span class="visible-items" v-else></span>
    </div>
</template>

<script>
    export default {
        name: "VisibleItems",
        data() {
            return {}
        },
        props: {
            paginatorInfo: {
                type: Object,
                required: true
            }
        },
        computed: {
            showItems() {
                return this.paginatorInfo.count > 0;
            },
            countBehind() {
                return (this.paginatorInfo.currentPage - 1) * this.paginatorInfo.perPage;
            },
            start() {
                return this.paginatorInfo.currentPage === 1 ? 1: this.countBehind();
            },
            end() {
                return this.paginatorInfo.currentPage === 1 ? this.paginatorInfo.count: this.start + this.paginatorInfo.count;
            }
        }
    }
</script>

<style scoped>

</style>