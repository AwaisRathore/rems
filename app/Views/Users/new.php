<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | New User <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Add New User</h5>
    <div class="card-body">
        <form action="<?= site_url('users/new') ?>" id="submit-form" method="post" enctype="multipart/form-data">
            <?php if (session()->has('warning')) : ?>
                <div class="alert alert-danger" role="alert">
                    <b>Error:</b> <?= session('warning') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" required id="username" name="username" value="<?= old('username');?>" placeholder="John Doe">
                        <label for="username">Name</label>
                    </div>
                    <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                        <div class="text-danger">
                            <?= session('errors')['username'] ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="email" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['email'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" required id="userEmailAddress" name="email" value="<?= old('email');?>" placeholder="example@gmail.com">
                        <label for="userEmailAddress">Email Address</label>
                    </div>
                    <?php if (session()->has('errors') &&  isset(session('errors')['email'])) : ?>
                        <div class="text-danger">
                            <?= session('errors')['email'] ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['password'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" required id="password" value="<?= old('password');?>" name="password" >

                        <label for="password">Password</label>
                    </div>
                    <?php if (session()->has('errors') &&  isset(session('errors')['password'])) : ?>
                        <div class="text-danger">
                            <?= session('errors')['password'] ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="file" class="form-control " required id="profile_image" name="profile_image" value="<?= old('profile_image');?>" placeholder="" accept="image/*">
                        <label for="profile_image">Profile image</label>
                    </div>
                </div>

                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <select id="role" name="role" placeholder="Client Type" value="<?= old('role');?>" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['role_id'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>">
                                <option value="" selected disabled>Select User Role</option>
                                <?php foreach ($role as $value) : ?>
                                    <option value="<?= $value->id ?>" <?php if($value->id == old('role')): ?>selected<?php endif ?>><?= $value->name ?></option>
                                <?php endforeach ?>
                            
                            

                        </select>
                        <label for="role">User role</label>
                    </div>
                    <?php if (session()->has('errors') &&  isset(session('errors')['role_id'])) : ?>
                        <div class="text-danger">
                            <?= session('errors')['role_id'] ?>
                        </div>
                    <?php endif ?>
                </div>

                <div class="col-12 my-3 text-center">
                    <input type="submit" class="btn btn-primary" value="SUBMIT" name="submit">
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item:nth-of-type(6)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(4)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(4)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("active");
        // Set default jQuery validator settings
        jQuery.validator.setDefaults({
            errorClass: "error",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('invalid').removeClass(validClass);
                $(element).next("span").addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass(validClass).removeClass('invalid');
                $(element).next("span").addClass(errorClass);
            }
        });
        $("#submit-form").validate({
            rules: {
                userEmailAddress: {
                    required: true,
                    email: true
                },
                profile_image: {
                    required: false,
                },
                role: {
                    required: true,
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>