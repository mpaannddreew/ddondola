<template>
    <div>
        <div class="card card-small mb-2 border" v-if="biography">
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4">
                    <strong class="d-block mb-2"><i class="fa fa-info-circle"></i> Biography</strong>
                    <span>{{ biography }}</span>
                </li>
            </ul>
        </div>
        <div class="card card-small mb-2 border" v-if="phoneNumber">
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4">
                    <strong class="d-block mb-2"><i class="fa fa-phone"></i> Phone number</strong>
                    <span>{{ phoneNumber }}</span>
                </li>
            </ul>
        </div>
        <div class="card card-small mb-2 border">
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4">
                    <strong class="d-block mb-2"><i class="fa fa-envelope"></i> Email</strong>
                    <span>{{ user.email }}</span>
                </li>
            </ul>
        </div>
        <div class="card card-small mb-2 border" v-if="address">
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-4">
                    <strong class="d-block mb-2"><i class="fa fa-map-o"></i> Address</strong>
                    <span>{{ address }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "About",
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        computed: {
            address() {
                return Collect(this.user.profile).get('address', '');
            },
            phoneNumber() {
                return Collect(this.user.profile).get('phone_number', '');
            },
            biography() {
                return Collect(this.user.profile).get('biography', '');
            }
        }
    }
</script>

<style scoped>

</style>