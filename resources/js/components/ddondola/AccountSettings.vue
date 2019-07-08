<template>
    <div>
        <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom">
            <div class="container p-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="toggle('settings')" :class="{active: isActive('settings')}">
                            <i class="material-icons">perm_data_setting</i> Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="toggle('information')" :class="{active: isActive('information')}">
                            <i class="material-icons">account_circle</i> General Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="toggle('change-password')" :class="{active: isActive('change-password')}">
                            <i class="material-icons">lock</i> Change Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="toggle('cover-pictures')" :class="{active: isActive('cover-pictures')}">
                            <i class="material-icons">camera_alt</i> Cover Pictures
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" @click="toggle('profile-pictures')" :class="{active: isActive('profile-pictures')}">
                            <i class="material-icons">portrait</i> Profile Pictures
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container py-2">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <settings v-if="isActive('settings')"></settings>
                    <information v-if="isActive('information')"></information>
                    <change-password v-if="isActive('change-password')"></change-password>
                    <cover-pictures v-if="isActive('cover-pictures')"></cover-pictures>
                    <profile-pictures v-if="isActive('profile-pictures')"></profile-pictures>
                </div>
            </div>
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