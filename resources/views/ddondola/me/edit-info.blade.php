@extends('ddondola.me.edit')
@section('title')@parent General @endsection
@section('info-active') active @endsection
@section('profile')
    <div class="card card-small edit-user-details border">
        <div class="card-header p-0">
            <div class="edit-user-details__bg">
                <img src="/images/hero_in_shop_detail.jpg" alt="User Details Background Image">
                <label class="edit-user-details__change-background">
                    <i class="material-icons mr-1"></i> Change Background Photo <input class="d-none" type="file">
                </label>
            </div>
        </div>
        <div class="card-body p-0">
            <form action="#" class="py-4">
                <div class="form-row mx-4">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">General</h6>
                        <p class="form-text text-muted m-0">Setup your general profile details.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <div class="col-lg-8">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" value="Sierra">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" value="Brooks">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emailAddress">Email</label>
                                <div class="input-group input-group-seamless">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="material-icons"></i>
                                        </div>
                                    </div>
                                    <input type="email" class="form-control" id="emailAddress">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phoneNumber">Phone Number</label>
                                <div class="input-group input-group-seamless">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="material-icons"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="phoneNumber" value="+40 1234 567 890">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="userLocation">Location</label>
                                <textarea style="min-height: 87px;" id="userBio" name="userBio" class="form-control">I'm a design focused engineer.</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="userProfilePicture" class="text-center w-100 mb-4">Profile Picture</label>
                        <div class="edit-user-details__avatar m-auto">
                            <img src="/images/avatars/0.jpg" alt="User Avatar">
                            <label class="edit-user-details__avatar__change">
                                <i class="material-icons mr-1"></i>
                                <input type="file" id="userProfilePicture" class="d-none">
                            </label>
                        </div>
                        <button class="btn btn-sm btn-white d-table mx-auto mt-4"><i class="material-icons"></i> Upload Image</button>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <div class="form-group col-md-12">
                        <label for="userBio">Bio</label>
                        <textarea style="min-height: 87px;" id="userBio" name="userBio" class="form-control">I'm a design focused engineer.</textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="userTags">Tags</label>
                        <div class="bootstrap-tagsinput"><span class="tag label label-info">User Experience<span data-role="remove"></span></span> <span class="tag label label-info">UI Design<span data-role="remove"></span></span> <span class="tag label label-info"> React JS<span data-role="remove"></span></span> <span class="tag label label-info"> HTML &amp; CSS<span data-role="remove"></span></span> <span class="tag label label-info"> JavaScript<span data-role="remove"></span></span> <span class="tag label label-info"> Bootstrap 4<span data-role="remove"></span></span> <input type="text" placeholder=""></div><input id="userTags" name="userTags" value="User Experience,UI Design, React JS, HTML &amp; CSS, JavaScript, Bootstrap 4" class="d-none" style="display: none;">
                    </div>
                </div>
                <hr>
                <div class="form-row mx-4">
                    <div class="col mb-3">
                        <h6 class="form-text m-0">Change Password</h6>
                        <p class="form-text text-muted m-0">Change your current password.</p>
                    </div>
                </div>
                <div class="form-row mx-4">
                    <div class="form-group col-md-4">
                        <label for="firstName">Old Password</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Old Password">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lastName">New Password</label>
                        <input type="text" class="form-control" id="lastName" placeholder="New Password">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="emailAddress">Repeat New Password</label>
                        <input type="email" class="form-control" id="emailAddress" placeholder="Repeat New Password">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer border-top">
            <a href="#" class="btn btn-sm btn-accent ml-auto d-table mr-3">Save Changes</a>
        </div>
    </div>
@endsection
