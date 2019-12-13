<template>
    <div>
        <file-pond
                class="mb-2"
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
                :max-files="maxFiles"
                v-bind:files="myFiles"
                instant-upload="false"
                v-on:processfile="fileUploaded"
                v-on:processfiles="filesUploaded"
                :file-rename-function="rename"
        />
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-pill btn-outline-primary" @click="process">
                <i class="material-icons">check_circle</i> Upload
            </button>
        </div>
    </div>
</template>

<script>

    // Create FilePond component
    const FilePond = VueFilePond( FilePondPluginFileValidateType, FilePondPluginImagePreview,
        FilePondPluginImageCrop, FilePondPluginImageTransform, FilePondPluginImageEdit, FilePondPluginFileRename);

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
            },
            maxFiles: {
                type: String,
                default: '6'
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
                this.$refs.pond.processFile(file.id).then(this.removeFile);
            },
            removeFile(file) {
                this.$refs.pond.removeFile(file.id);
            },
            rename(file) {
                return `${Uuid()}${file.extension}`;
            },
            fileUploaded(error, file) {
                if (error === null)
                    this.removeFile(file)
            },
            filesUploaded() {
                window.location.href = this.url;
            }
        }
    }
</script>

<style scoped>

</style>