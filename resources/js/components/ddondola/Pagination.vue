<template>
    <div v-if="showPagination">
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item" v-if="hasPrevious">
                    <a class="page-link" href="javascript:void(0)" @click="loadPage(previousPage)" tabindex="-1"><i class="fa fa-chevron-left"></i> Previous</a>
                </li>
                <li class="page-item disabled" v-else>
                    <a class="page-link" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> Previous</a>
                </li>

                <li class="page-item" v-if="addToCurrent(-4) > 1">
                    <a class="page-link" href="javascript:void(0)" @click="loadPage(addToCurrent(-5))">&hellip;</a>
                </li>

                <template v-for="i in paginatorInfo.lastPage">
                    <li class="page-item active" v-if="paginatorInfo.currentPage === i">
                        <a class="page-link" href="javascript:void(0)">{{ i }}</a>
                    </li>
                    <li class="page-item" v-else-if="i > addToCurrent(-5) && i < addToCurrent(5)">
                        <a class="page-link" href="javascript:void(0)" @click="loadPage(i)">{{ i }}</a>
                    </li>
                </template>

                <li class="page-item" v-if="paginatorInfo.lastPage > addToCurrent(4)">
                    <a class="page-link" href="javascript:void(0)" @click="loadPage(addToCurrent(5))">&hellip;</a>
                </li>

                <li class="page-item" v-if="hasNext">
                    <a class="page-link" href="javascript:void(0)" @click="loadPage(nextPage)">Next <i class="fa fa-chevron-right"></i></a>
                </li>
                <li class="page-item disabled" v-else>
                    <a class="page-link" href="javascript:void(0)">Next <i class="fa fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            paginatorInfo: {
                type: Object,
                required: true
            }
        },
        methods: {
            addToCurrent(number) {
                return this.paginatorInfo.currentPage + number;
            },
            loadPage(page) {
                this.$emit('page', page)
            }
        },
        computed: {
            hasPrevious() {
                return this.paginatorInfo != null ? this.paginatorInfo.currentPage > 1: false;
            },
            previousPage() {
                return this.paginatorInfo.currentPage - 1;
            },
            hasNext() {
                return this.paginatorInfo != null ? this.paginatorInfo.hasMorePages: false;
            },
            nextPage() {
                return this.paginatorInfo.currentPage + 1;
            },
            showPagination() {
                return this.paginatorInfo.hasMorePages || this.paginatorInfo.currentPage !== 1 && !this.paginatorInfo.hasMorePages
            }
        }
    }
</script>

<style scoped>

</style>