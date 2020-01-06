<template>
    <div class="directory-area">
        <div class="card card-small h-100 main">
            <div class="card-body h-100 p-4">
                <dial-pad :shop="shop" :admin="admin"></dial-pad>
            </div>
        </div>
    </div>
</template>

<script>
    import DialPad from "./DialPad";
    export default {
        name: "Deposit",
        components: {DialPad},
        props: {
            shop: {
                type: String
            },
            admin: {
                type: Boolean,
                default: false
            }
        }
    }
</script>

<style scoped>
    .directory .card.main {
        height: calc(99.9vh - 3.75rem - 1px) !important;
    }
</style>