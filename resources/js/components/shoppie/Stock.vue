<template>
    <div>
        <div class="header-navbar collapse d-lg-flex p-0 bg-white border-bottom">
            <div class="container p-0">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="#" class="nav-link active"><i class="material-icons">list</i> All</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="material-icons">done</i> In stock</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="material-icons">clear</i> Out Stock</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container py-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-small border">
                        <div class="card-body p-0 text-center">
                            <table class="table mb-0">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Quantity</th>
                                    <th scope="col" class="border-0">Type</th>
                                    <th scope="col" class="border-0">Date</th>
                                    <th scope="col" class="border-0">Note</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Ali</td>
                                    <td>Kerry</td>
                                    <td>Russian Federation</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-small mb-3" style="background: none !important;">
                        <div class="card-header border-bottom">
                            <h6 class="m-0"><i class="material-icons">notifications_none</i> Notify Below Quantity</h6>
                        </div>
                        <div class="card-body">
                            <form class="quick-post-form">
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="text" placeholder="Quantity">
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-small mb-3" style="background: none !important;">
                        <div class="card-header border-bottom">
                            <h6 class="m-0"><i class="material-icons">mode_edit</i> Update Stock</h6>
                        </div>
                        <div class="card-body">
                            <form class="quick-post-form">
                                <div class="form-group">
                                    <input class="form-control form-control-lg" type="text" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <select class="form-control  form-control-lg custom-select custom-select-md">
                                        <option>In</option>
                                        <option>Out</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control form-control-lg" placeholder="Note"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Stock"
    }
</script>

<style scoped>

</style>