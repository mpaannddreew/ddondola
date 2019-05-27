<template>
    <div class="card card-small border">
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-4" v-if="biography">
                <strong class="d-block mb-2 text-muted">Biography</strong>
                <span>{{ biography }}</span>
            </li>
            <li class="list-group-item p-4" v-if="phoneNumber">
                <strong class="d-block mb-2 text-muted">Phone number</strong>
                <span>{{ phoneNumber }}</span>
            </li>
            <li class="list-group-item p-4">
                <strong class="d-block mb-2 text-muted">Email</strong>
                <span>{{ user.email }}</span>
            </li>
            <li class="list-group-item p-4" v-if="address">
                <strong class="d-block mb-2 text-muted">Address</strong>
                <span>{{ address }}</span>
            </li>
        </ul>
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