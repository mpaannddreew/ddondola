<template>
    <div class="directory-list close-directory-list">
        <div class="card card-small h-100 border-right main">
            <div class="card-header border-bottom border-top-radius-0 bg-light">
                <div class="input-group input-group-seamless">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" :placeholder="placeholder" aria-label="Search" v-model="query">
                </div>
            </div>
            <div class="card-body" style="overflow-y: hidden; overflow-x: hidden">
                <div class="header-navbar collapse d-lg-flex p-0 bg-light border-bottom">
                    <div class="container p-0">
                        <div class="row">
                            <div class="col">
                                <ul class="nav nav-tabs nav-justified border-0 flex-column flex-lg-row">
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link" :class="{active: featured}" @click="showingFeatured"><i class="material-icons">{{ icon }}</i> Featured</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link" :class="{active: !featured}" @click="showingCategories"><i class="material-icons">folder_open</i> Categories</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-100" style="overflow-y: auto; overflow-x: hidden; height: calc(99.9vh - 13.7rem - 1px) !important;"  v-if="featured">
                    <div class="center-xy">
                        <div align="center">
                            <h4 class="m-0"><i class="material-icons">error</i></h4>
                            <p class="m-0">No featured {{ directory|lowerCase }} yet!</p>
                        </div>
                    </div>
                    <!--<div class="friend-card">-->
                        <!--<img src="/images/hero_in_shop_detail.jpg" alt="profile-cover" class="img-responsive cover">-->
                        <!--<div class="card-info">-->
                            <!--<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABkUlEQVR4nO3dMUpjURSA4aPYuYrpBXdhPwvRDUzvBmxEcAWCu7CZRhBhdjHlwIgaCysbMZLkfcX/QcrkHvi5771cAtlbXc5qwthfeoB8VBBMQTAFwRQEUxBMQTAFwRQEUxBMQTAFwRQEUxBMQTAFwRQEUxBMQTAFwRQEUxBMQTAFwRQEUxBMQTAFwRQEUxBMQTAFwRzsZJWT25kfPzf3edeHM8//1l/r8WLm7mxzc2xBOwRTEExBMAXB7Oam/pmX/zOvT0tPwVg+yJ8r/slnl7pkYQqCKQimIJiCYAqCWf6x9+j0/fVVN8czfx+2N8/C2iGYgmAKgikIZvmb+rqHi6vX7c0CWD5Ih4sfdMnCFARTEExBMAXBFARTEExBMMt/MVz3+H3m89/2bnqtmZnfv2buz9d/3ze0QzAFwRQEUxBMQTB7/eWRpR2CKQimIJiCYAqCKQimIJiCYAqCKQimIJiCYAqCKQimIJiCYAqCKQimIJiCYAqCKQimIJiCYAqCKQimIJiCYAqCKQimIJiCYN4Ax84ohhqXJPEAAAAASUVORK5CYII=" alt="user" class="profile-photo-lg">-->
                            <!--<div class="friend-info">-->
                                <!--<a href="#" class="pull-right text-green">My Friend</a>-->
                                <!--<h5><a href="javascript:void(0)" class="profile-link">Sophia Lee</a></h5>-->
                                <!--<p>Student at Harvard</p>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                </div>
                <categories :directory="directory" v-else></categories>
            </div>
        </div>
    </div>
</template>

<script>
    import Categories from "./Categories";
    export default {
        name: "DirectoryFilters",
        components: {Categories},
        mounted() {
            this.fetchCategories();
        },
        data() {
            return {
                query: '',
                featured: true
            }
        },
        props: {
            directory: {
                type: String,
                required: true
            }
        },
        methods: {
            showingFeatured() {
                this.featured = true;
            },
            showingCategories() {
                this.featured = false;
            }
        },
        computed: {
            placeholder() {
                return `Filter ${this.ucFirst(this.directory)}`;
            },
            shopDirectory() {
                return this.lowerCase(this.directory) === 'shops';
            },
            icon() {
                if (this.shopDirectory) {
                    return 'shop_two';
                }

                return 'local_mall';
            }
        }
    }
</script>

<style scoped>
    .nav-link {
        margin: 0 !important;
    }

    .nav-item {
        border-right:1px solid #e1e5eb!important;
    }

    .nav-item:last-child {
        border-right: none !important;
    }
</style>