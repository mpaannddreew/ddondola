<template>
    <tr>
        <template v-if="saving">
            <td colspan="5">
                <div align="center">
                    <div class="loader"></div>
                    <p class="m-0">Saving brand changes...</p>
                </div>
            </td>
        </template>
        <template v-else>
            <td v-if="editEnabled">
                <div class="form-group">
                    <input class="form-control form-control-sm" type="text" placeholder="Name" v-model="name" :id="`name_${brand.id}`">
                    <div class="invalid-feedback" :id="`name_${brand.id}_feedback`"></div>
                </div>
            </td>
            <td v-else>{{ brand.name }}</td>
            <td class="lo-stats__items text-center">{{ brand.productCount }}</td>
            <td v-if="editEnabled"><textarea placeholder="Description" v-model="description" class="form-control"></textarea></td>
            <td v-else>{{ brand.description }}</td>
            <td>
                <div class="btn-group d-table ml-auto" role="group">
                    <a href="javascript:void(0)" class="btn btn-white" v-html="action" @click="buttonAction" :class="{disabled: disableEditButton}"></a>
                    <a href="javascript:void(0)" class="btn btn-white" @click="showForm(null)" v-if="editEnabled"><i class="material-icons">clear</i> Cancel</a>
                </div>
            </td>
        </template>
    </tr>
</template>

<script>
    export default {
        name: "ShopBrand",
        mounted() {
            this.listen();
        },
        data() {
            return {
                editEnabled: false,
                disableEditButton: false,
                saving: false,
                name: '',
                description: '',
                error: false
            }
        },
        props: {
            brand: {
                type: Object,
                required: true
            }
        },
        computed: {
            action() {
                if (this.editEnabled) {
                    return '<i class="material-icons">check</i> Save';
                }

                return '<i class="material-icons">mode_edit</i> Edit';
            }
        },
        methods: {
            listen() {
                Bus.$on('enable-edit', this.showForm);
                Bus.$on('disable-editing', this.disableEditing);
            },
            buttonAction() {
                if (this.editEnabled) {
                    this.validate();
                }else {
                    Bus.$emit('enable-edit', this.brand.id);
                }
            },
            showForm(id) {
                this.name = this.brand.name;
                this.description = this.brand.description;
                this.editEnabled = (this.brand.id === id);
            },
            disableEditing() {
                this.disableEditButton = true;
            },
            validate() {
                if (!this.name.length > 0)
                    this.showError(`name_${this.brand.id}`, "Brand name is required");

                if (!this.error) {
                    this.saveChanges();
                }
            },
            clearError(id) {
                $(`#${id}`).removeClass('is-invalid');
                $(`#${id}_feedback`).hide();
                this.error = false;
            },
            showError(id, message) {
                $(`#${id}`).addClass('is-invalid');
                $(`#${id}_feedback`).text(message).show();
                this.error = true;
                this.loading = false;
            },
            saveChanges() {
                this.saving = true;
                this.editEnabled = false;
                Bus.$emit('disable-editing');
                axios.post(graphql.api, {
                    query: graphql.editBrand,
                    variables: {brandId: this.brand.id, brand: {name: this.name, description: this.description}}
                }).then(this.emitDoneSaving).catch(function (error) {});
            },
            emitDoneSaving(response) {
                this.saving = false;
                this.$emit('done-saving');
            }
        },
        watch: {
            name: function (data) {
                if (data.length > 0) {
                    this.clearError(`name_${this.brand.id}`);
                }
            }
        }
    }
</script>

<style scoped>

</style>