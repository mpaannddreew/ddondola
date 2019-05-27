<template>
    <a href="javascript:void(0)" @click="transitionTo" class="list-group-item list-group-item-action d-flex" :class="{selected: isActive}">
        <div>
            <span class="category-name text-ellipsis"><i class="material-icons">library_books</i> {{ category.name }}</span>
            <span class="category-description text-ellipsis">{{ category.description }}</span>
        </div>
        <i class="material-icons ml-auto text-right view-report">chevron_right</i>
    </a>
</template>

<script>
    export default {
        name: "Category",
        props: {
            category: {
                type: Object,
                required: true
            },
            directory: {
                type: String,
                required: true
            }
        },
        computed: {
            route() {
                return "/" + this.directory + "/" + this.category.code;
            },
            isActive() {
                if (this.$route.params.category)
                    return this.category.code === this.$route.params.category;

                return false;
            }
        },
        methods: {
            transitionTo() {
                this.$router.push(this.route);
            }
        }
    }
</script>

<style scoped>

</style>