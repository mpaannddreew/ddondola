<template>
    <file-pond
            :server="server"
            name="images"
            ref="pond"
            label-idle='Drag & Drop your pictures or <span class="filepond--label-action border">Browse</span>'
            allow-multiple="true"
            accepted-file-types="image/jpeg, image/png"
            allow-image-crop="true"
            image-resize-target-width="800"
            image-crop-aspect-ratio="1:1"
            allow-image-transform="true"
            allow-image-edit="true"
            max-files="6"
            v-bind:files="myFiles"
            instant-upload="false"
    />
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
        props: {
            url: {
                type: String,
                required: true
            }
        },
        computed: {
            server() {
                return {
                    process: {
                        url: this.url,
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
            hasFiles() {
                return this.$refs.pond.getFiles().length > 0;
            },
            process() {
                if (!this.hasFiles()) {
                    DToast('warning', 'Add some images first!');
                    return;
                }

                _.each(this.$refs.pond.getFiles(), this.processFile)
            },
            processFile(file) {
                this.$refs.pond.processFile(file.id).then(this.handleFileProcess);
            },
            handleFileProcess(file) {
                this.$refs.pond.removeFile(file.id);
            }
        }
    }
</script>

<style scoped>

</style>