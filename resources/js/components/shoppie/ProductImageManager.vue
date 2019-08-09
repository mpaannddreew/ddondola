<template>
    <div class="card mb-2">
        <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
            <h5>
                <a class="btn btn-link" href="javascript:void(0)">
                    <span><i class="material-icons">more_vert</i></span>
                    <i class="material-icons">add_a_photo</i> Product Pictures
                </a>
            </h5>
        </div>
        <div class="card-body p-4 border border-top-0">
            <file-pond
                    :server="server"
                    name="images"
                    ref="pond"
                    class-name="my-pond"
                    label-idle='Drag & Drop your pictures or <span class="filepond--label-action">Browse</span>'
                    allow-multiple="true"
                    accepted-file-types="image/jpeg, image/png"
                    :allow-image-crop="true"
                    image-resize-target-width="800"
                    image-crop-aspect-ratio="1:1"
                    :allow-image-transform="true"
                    :allow-image-edit="true"
                    max-files="6"
                    v-bind:files="myFiles"
                    instant-upload="false"
                    v-on:init="handleFilePondInit"/>
        </div>
    </div>
</template>

<script>

    // Create FilePond component
    const FilePond = VueFilePond( FilePondPluginFileValidateType, FilePondPluginImagePreview,
        FilePondPluginImageCrop, FilePondPluginImageTransform, FilePondPluginImageEdit);

    export default {
        name: "ProductImageManager",
        components: {FilePond},
        data() {
            return {
                myFiles: []
            }
        },
        computed: {
            server() {
                return {
                    process: {
                        url: './process',
                        method: 'POST',
                        withCredentials: false,
                        headers: this.headers,
                    }
                }
            },
            headers() {
                return Collect(SearchHeaders).only(['X-Requested-With', 'X-CSRF-TOKEN']).all();
            }
        },
        methods: {
            handleFilePondInit: function() {
                // example of instance method call on pond reference
                this.$refs.pond.getFiles();
            }
        }
    }
</script>

<style scoped>

</style>