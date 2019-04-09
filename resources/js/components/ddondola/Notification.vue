<template>
    <li>
        <div class="activity-user">
            <a href="#" title="" data-toggle="tooltip" class="avatar" data-original-title="Lesley Grauer">
                <img alt="Lesley Grauer" src="/images/avatars/0.jpg" class="img-fluid rounded-circle">
            </a>
        </div>
        <div class="activity-content d-flex">
            <div class="timeline-content">
                <a href="#" class="name">Lesley Grauer</a> added new task <a href="#">Hospital Administration</a>
                <span class="time">4 mins ago</span>
            </div>
            <ul class="ml-auto" style="list-style: none;">
                <li class="dropdown dropdown-action dropdown-menu-sm-left">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-small" style="display: none;">
                        <a class="dropdown-item" href="javascript:void(0)"><i class="material-icons">notifications_none</i> Mark as read</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="material-icons">notifications_active</i> Mark as unread</a>
                        <a class="dropdown-item" href="javascript:void(0)"><i class="material-icons">delete_forever</i> Delete</a>
                    </div>
                </li>
            </ul>
        </div>
    </li>
</template>

<script>
    export default {
        name: "Notification",
        data() {
            return {

            }
        }
    }
</script>

<style scoped>

</style>