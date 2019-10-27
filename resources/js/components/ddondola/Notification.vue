<template>
    <div>
        <div class="user-activity__item pr-3 py-3">
            <div class="user-activity__item__icon">
                <i class="material-icons"></i>
            </div>
            <div class="user-activity__item__content">
                <span class="text-light">23 Minutes ago</span>
                <p>Assigned himself to the <a href="#">Shards Dashboards</a> project.</p>
            </div>
            <div class="user-activity__item__action ml-auto">
                <button class="ml-auto btn btn-sm btn-white">View Project</button>
            </div>
        </div>
        <div class="user-activity__item pr-3 py-3">
            <div class="user-activity__item__icon">
                <i class="material-icons"></i>
            </div>
            <div class="user-activity__item__content">
                <span class="text-light">2 Hours ago</span>
                <p>Marked <a href="#">7 tasks</a> as <span class="badge badge-pill badge-outline-success">Complete</span> inside the <a href="#">DesignRevision</a> project.</p>
            </div>
        </div>
        <div class="user-activity__item pr-3 py-3">
            <div class="user-activity__item__icon">
                <i class="material-icons"></i>
            </div>
            <div class="user-activity__item__content">
                <span class="text-light">3 Hours and 10 minutes ago</span>
                <p>Added <a href="#">Jack Nicholson</a> and <a href="#">3 others</a> to the <a href="#">DesignRevision</a> team.</p>
            </div>
            <div class="user-activity__item__action ml-auto">
                <button class="ml-auto btn btn-sm btn-white">View Team</button>
            </div>
        </div>
        <div class="user-activity__item pr-3 py-3">
            <div class="user-activity__item__icon">
                <i class="material-icons"></i>
            </div>
            <div class="user-activity__item__content">
                <span class="text-light">2 Days ago</span>
                <p>Opened <a href="#">3 issues</a> in <a href="#">2 projects</a>.</p>
            </div>
        </div>
        <div class="user-activity__item pr-3 py-3">
            <div class="user-activity__item__icon">
                <i class="material-icons"></i>
            </div>
            <div class="user-activity__item__content">
                <span class="text-light">2 Days ago</span>
                <p>Added <a href="#">3 new tasks</a> to the <a href="#">DesignRevision</a> project:</p>
                <ul class="user-activity__item__task-list mt-2">
                    <li>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user-activity-task-1">
                            <label class="custom-control-label" for="user-activity-task-1">Fix blog pagination issue.</label>
                        </div>
                    </li>
                    <li>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="user-activity-task-2">
                            <label class="custom-control-label" for="user-activity-task-2">Remove extra padding from blog post container.</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="user-activity__item pr-3 py-3">
            <div class="user-activity__item__icon">
                <i class="material-icons"></i>
            </div>
            <div class="user-activity__item__content">
                <span class="text-light">2 Days ago</span>
                <p>Marked <a href="#">3 tasks</a> as <span class="badge badge-pill badge-outline-danger">Invalid</span> inside the <a href="#">Shards Dashboards</a> project.</p>
            </div>
        </div>
    </div>
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