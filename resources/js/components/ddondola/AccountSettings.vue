<template>
    <div class="row">
        <div class="col-md-3 px-2">
            <div class="card card-small border">
                <div class="card-header border-bottom">
                    <h5 class="mb-0"><i class="fa fa-cog"></i> Account Settings</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group border-0">
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action" @click="toggle('settings')" :class="{selected: isActive('settings')}">
                            <i class="material-icons">perm_data_setting</i> Settings
                        </a>
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action" @click="toggle('information')" :class="{selected: isActive('information')}">
                            <i class="material-icons">account_circle</i> General Information
                        </a>
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action" @click="toggle('change-password')" :class="{selected: isActive('change-password')}">
                            <i class="material-icons">lock</i> Change Password
                        </a>
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action" @click="toggle('cover-pictures')" :class="{selected: isActive('cover-pictures')}">
                            <i class="material-icons">camera_alt</i> Cover Pictures
                        </a>
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action" @click="toggle('profile-pictures')" :class="{selected: isActive('profile-pictures')}">
                            <i class="material-icons">portrait</i> Profile Pictures
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 px-2 checkout-process">
            <settings v-if="isActive('settings')"></settings>
            <information v-if="isActive('information')"></information>
            <change-password v-if="isActive('change-password')"></change-password>
            <cover-pictures v-if="isActive('cover-pictures')"></cover-pictures>
            <profile-pictures v-if="isActive('profile-pictures')"></profile-pictures>
        </div>
    </div>
</template>

<script>
    import Settings from "./settings/UserSettings";
    import Information from "./settings/UserInformation";
    import ChangePassword from "./settings/ChangePassword";
    import CoverPictures from "./settings/AccountCoverPictures";
    import ProfilePictures from "./settings/AccountProfilePictures";
    export default {
        name: "AccountSettings",
        components: {ProfilePictures, CoverPictures, ChangePassword, Information, Settings},
        data() {
            return {
                active: "settings"
            }
        },
        methods: {
            toggle(section) {
                this.active = section;
            },
            isActive(section) {
                return this.active === section;
            }
        }
    }
</script>

<style scoped>
    .selected {
        border-left: medium solid #ce1d76 !important;
    }

    .list-group-item {
        border-right: none;
        border-left: none;
    }

    .list-group-item:first-child {
        border-top: none;
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }

    .list-group-item:last-child {
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px;
        border-bottom: none;
    }
</style>