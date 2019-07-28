<template>
    <div class="card" id="attributes">
        <div class="card-header form-wizard-step border-right border-top border-top-right-radius-0">
            <h5>
                <a class="btn btn-link" href="javascript:void(0)">
                    <span><i class="material-icons">more_vert</i></span>
                    <i class="material-icons">create</i> Attributes
                </a>
            </h5>
        </div>
        <div class="card-body p-4 border border-top-0">
            <div class="form-row" v-for="(attribute, indx) in attributes" :key="indx">
                <div class="form-group col-md-5">
                    <input type="text" class="form-control" placeholder="Name" v-model="attribute.name" :id="indx + '_name'" required>
                </div>
                <div class="form-group col-md-5">
                    <input type="text" class="form-control" placeholder="Value" v-model="attribute.value" :id="indx + '_value'" required>
                </div>
                <div class="form-group col-md-2 p-0">
                    <button type="button" class="btn btn-sm btn-success" @click="addRow">
                        <i class="material-icons">add</i> Add
                    </button>
                    <button type="button" class="btn btn-sm btn-link text-danger" v-if="showRemove" @click="removeRow(indx)">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
            </div>
            <div class="form-group mb-0" :class="{'is-invalid': errors}">
                <input type="hidden" name="attributes" :value="attributesToJson"/>
                <div class="invalid-feedback" v-if="errors">{{ errors }}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductAttributes",
        mounted() {
            if (this.oldAttributes) {
                this.attributes = JSON.parse(this.oldAttributes);
            }
        },
        data() {
            return {
                attributes: [{name: '', value: ''}],
            }
        },
        props: {
            oldAttributes: {
                type: String,
                required: false
            },
            errors: {
                type: String,
                required: false
            }
        },
        methods: {
            clearError(id) {
                $('#' + id).removeClass('is-invalid');
                $('#' + id + "_feedback").hide();
            },
            showError(id, message) {
                $('#' + id).addClass('is-invalid');
                $('#' + id + "_feedback").text(message).show();
            },
            addRow() {
                if (this.numberOfAttributes < 10) {
                    this.attributes.push({name: '', value: ''});
                } else {
                    DToast('error', "Only 10 attributes are supported")
                }
            },
            removeRow(index) {
                if (this.numberOfAttributes > 1) {
                    this.attributes.splice(index, 1)
                }
            }
        },
        watch: {
            attributes: {
                handler(data) {
                    for(var i = 0; i < this.numberOfAttributes; i++) {
                        this.clearError(i + '_name');
                        this.clearError(i + '_value');
                    }
                },
                deep: true
            }
        },
        computed: {
            numberOfAttributes() {
                return this.attributes.length;
            },
            showRemove() {
                return this.numberOfAttributes > 1;
            },
            attributesToJson() {
                return JSON.stringify(this.attributes);
            }
        }
    }
</script>

<style scoped>
    div#attributes .form-row:last-child .form-group {
        margin-bottom: 0 !important;
    }
</style>