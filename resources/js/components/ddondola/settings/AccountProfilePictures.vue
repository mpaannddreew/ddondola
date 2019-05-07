<template>
    <div class="card mb-2">
        <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
            <h5>
                <a class="btn btn-link" href="javascript:void(0)">
                    <span><i class="material-icons">more_vert</i></span>
                    <i class="material-icons">portrait</i> Profile Pictures
                </a>
            </h5>
        </div>
        <div class="card-body p-4 border border-top-0">
            <div class="form-row">
                <div class="col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-12 m-0">
                            <div>
                                <div class="card card-small">
                                    <div class="row no-gutters">
                                        <div class="file-manager-cards__dropzone w-100">
                                            <div class="dropzone dz-clickable">
                                                <div class="dz-default dz-message">
                                                    <label class="text-reagent-gray mb-0">
                                                        <i class="material-icons">add_a_photo</i> Change Profile Picture
                                                        <input class="d-none" type="file" accept="image/*" @change="handleSelectedImage">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AccountProfilePictures",
        data() {
            return {

            }
        },
        methods: {
            handleSelectedImage(e) {

            }
        }
    }
</script>

<style scoped>

</style>