<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | New User <?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- <div class="card">
    <h5 class="card-header">Edit User</h5>
    <div class="card-body">
        <form action="<?= site_url('users/edit/' . $users->id . '') ?>" id="submit-form" method="post" enctype="multipart/form-data">
            <?php if (session()->has('warning')) : ?>
                <div class="alert alert-danger" role="alert">
                    <b>Error:</b> <?= session('warning') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" value="<?= $users->username ?>" required id="username" name="username" placeholder="John Doe">
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
                                <?= "is-invalid" ?><?php endif ?>" value="<?= $users->email ?>" required id="userEmailAddress" name="email" placeholder="example@gmail.com">
                        <label for="userEmailAddress">Email Address</label>
                    </div>
                    <?php if (session()->has('errors') &&  isset(session('errors')['email'])) : ?>
                        <div class="text-danger">
                            <?= session('errors')['email'] ?>
                        </div>
                    <?php endif ?>
                </div>

                <input type="hidden" value="<?= $users->password ?>" name="password">
                <input type="hidden" value="<?= $users->id ?>" name="id">
                <input value="<?= $users->profile_image ?>" type="hidden" name="imageurl">
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="file" class="form-control " required id="profile_image" name="profile_image" placeholder="" accept="image/*">
                        <label for="profile_image">Profile image</label>
                    </div>
                    <div style="width : 60px; margin : 10px; border : 1px solid black;height : 60px; overflow : hidden;border-radius : 50%"><img style="width : 100%; " src="<?= site_url($users->profile_image) ?>" alt=""></div>
                </div>

                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <select id="role" name="role" placeholder="Client Type" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['role_id'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>">
                            <option value="" selected disabled>Select User Role</option>
                            <?php foreach ($role as $value) : ?>
                                <option value="<?= $value->id ?>" <?php if ($users->role_id == $value->id) : ?>selected<?php endif ?>><?= $value->name ?></option>
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
</div> -->

<div class="row">
    <div class="col-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="true">
                        Edit User
                    </button>
                </li>
                <?php if ($users->role_id == 2) : ?>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#additional-information" aria-controls="additional-information" aria-selected="false">
                            Additional Information
                        </button>
                    </li>
                <?php endif ?>

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-top-profile" role="tabpanel">
                    <form action="<?= site_url('users/edit/' . $users->id . '') ?>" id="submit-form" method="post" enctype="multipart/form-data">
                        <?php if (session()->has('warning')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <b>Error:</b> <?= session('warning') ?>
                            </div>
                        <?php endif ?>
                        <div class="row">
                            <div class="col-lg-6 my-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" value="<?= htmlspecialchars($users->username) ?>" required id="username" name="username" placeholder="John Doe">
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
                                <?= "is-invalid" ?><?php endif ?>" value="<?= htmlspecialchars($users->email) ?>" required id="userEmailAddress" name="email" placeholder="example@gmail.com">
                                    <label for="userEmailAddress">Email Address</label>
                                </div>
                                <?php if (session()->has('errors') &&  isset(session('errors')['email'])) : ?>
                                    <div class="text-danger">
                                        <?= session('errors')['email'] ?>
                                    </div>
                                <?php endif ?>
                            </div>

                            <input type="hidden" value="<?= $users->password ?>" name="password">
                            <input type="hidden" value="<?= $users->id ?>" name="id">
                            <input value="<?= $users->profile_image ?>" type="hidden" name="imageurl">
                            <div class="col-lg-6 my-2">
                                <div class="form-floating">
                                    <input type="file" class="form-control " required id="profile_image" name="profile_image" placeholder="" accept="image/*">
                                    <label for="profile_image">Profile image</label>
                                </div>
                                <div style="width : 60px; margin : 10px; border : 1px solid black;height : 60px; overflow : hidden;border-radius : 50%"><img style="width : 100%; " src="<?= site_url($users->profile_image) ?>" alt=""></div>
                            </div>

                            <div class="col-lg-6 my-2">
                                <div class="form-floating">
                                    <select id="role" name="role" placeholder="Client Type" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['role_id'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>">
                                        <option value="" selected disabled>Select User Role</option>
                                        <?php foreach ($role as $value) : ?>
                                            <option value="<?= $value->id ?>" <?php if ($users->role_id == $value->id) : ?>selected<?php endif ?>><?= $value->name ?></option>
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

                            <input type="hidden" name= 'returnUrl' value="<?= $returnUrl ?>">

                            <div class="col-12 my-3 text-center">
                                <input type="submit" class="btn btn-primary" value="SUBMIT" name="submit">
                            </div>
                        </div>
                    </form>
                </div>
                <?php if ($users->role_id == 2) : ?>
                    <div class="tab-pane fade" id="additional-information" role="tabpanel">
                        <form action="<?= site_url('users/editemployeeAdditionalInfo/' . $users->id . '') ?>" id="additional-info" method="post" enctype="multipart/form-data">
                            <?php if (session()->has('warning')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <b>Error:</b> <?= session('warning') ?>
                                </div>
                            <?php endif ?>
                            <div class="row">
                                <div class="col-lg-6 my-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['salary'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" value="<?= $users->salary ?>" required id="salary" name="salary" placeholder="10.00">
                                        <label for="salary">Salary</label>
                                    </div>
                                    <?php if (session()->has('errors') &&  isset(session('errors')['salary'])) : ?>
                                        <div class="text-danger">
                                            <?= session('errors')['salary'] ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <div class="form-floating">
                                        <input type="date" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['join_date'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" value="<?= $users->join_date ?>" required id="join_date" name="join_date" placeholder="example@gmail.com">
                                        <label for="join_date">Join Date</label>
                                    </div>
                                    <?php if (session()->has('errors') &&  isset(session('errors')['join_date'])) : ?>
                                        <div class="text-danger">
                                            <?= session('errors')['join_date'] ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <div class="">
                                        <select name="EmployeeType" id="" class="form-select">
                                            <option value="" selected disabled>Select Employee Type</option>
                                            <?php foreach($employeetype as $value): ?>
                                                <option value="<?= $value['id'] ?>" <?php if($value['id']== $users->employeetype_id){echo 'selected';} ?>><?= $value['type'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                   
                                </div>

                                <div class="col-lg-12 my-2">
                                    <div class="">
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="10" style="height : 100px;"><?= $users->description ?></textarea>
                                       
                                    </div>

                                </div>
                                <input type="hidden" name= 'returnUrl' value="<?= $returnUrl ?>">
                                <div class="col-12 my-3 text-center">
                                    <input type="submit" class="btn btn-primary" value="SUBMIT" name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item:nth-of-type(6)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(4)").addClass("open active");

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

        ClassicEditor
		.create( document.querySelector( '#description' ) )
		.catch( error => {
			console.error( error );
		} );

    });
</script>
<?= $this->endSection() ?>