<template>
    <div class="card card-small mb-4 pt-3 border">
        <div class="card-header border-bottom text-center">
            <div class="mb-3 mx-auto">
                <img class="rounded-circle" src="/images/avatars/0.jpg" alt="User Avatar" width="110">
            </div>
            <h4 class="mb-0">Sierra Brooks</h4>
            <span class="text-muted d-block mb-2">Project Manager</span>
            <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2"><i class="material-icons mr-1">thumb_up</i> Like</button>
            <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2"><i class="material-icons mr-1">chat_bubble</i> Message</button>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-4">
                <strong class="text-muted d-block mb-2">Description</strong>
                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?</span>
            </li>
            <li class="list-group-item p-4">
                <strong class="text-muted d-block mb-2">Phone number</strong>
                <span>+256785631375</span>
            </li>
            <li class="list-group-item p-4">
                <strong class="text-muted d-block mb-2">Email</strong>
                <span>andrewmvp007@gmail.com</span>
            </li>
            <li class="list-group-item p-4">
                <strong class="text-muted d-block mb-2">Location</strong>
                <span>Menlo Park, California, United States</span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ShopInfo"
    }
</script>

<style scoped>

</style>