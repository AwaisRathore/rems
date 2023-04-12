<?= $this->extend('Layouts/default') ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="true">
                        Profile Information
                    </button>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-top-profile" role="tabpanel">
                    <form action="" method="Post" id="profile_form" enctype="multipart/form-data">


                        <div class="row">
                            <div class="col-lg-12 my-2">
                                <div style="width : 80px; margin : 10px; border : 1px solid black;height : 80px; overflow : hidden;border-radius : 50%"><img style="width : 100%; " src="<?= site_url($user->profile_image) ?>" alt=""></div>
                                <div class="form-floating">
                                    <input type="file" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" id="profile_image" name="profile_image" value="<?= old('username'); ?>" placeholder="John Doe" accept="image/*">
                                    <label for="profile_image">Profile Image</label>
                                </div>
                                <?php if (session()->has('errors') && isset(session('errors')['profile_image'])) : ?>
                                    <div class="text-danger">
                                        <?= session('errors')['profile_image'] ?>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" required id="username" name="username" value="<?= old('username', $user->username); ?>" placeholder="John Doe">
                                    <label for="username">Username</label>
                                </div>
                                <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                    <div class="text-danger">
                                        <?= session('errors')['username'] ?>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="col-lg-6 my-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" disabled required id="email" name="email" value="<?= old('email', $user->email); ?>" placeholder="John Doe">
                                    <label for="username">Email</label>
                                </div>
                                <?php if (session()->has('errors') &&  isset(session('errors')['username'])) : ?>
                                    <div class="text-danger">
                                        <?= session('errors')['username'] ?>
                                    </div>
                                <?php endif ?>
                            </div>
                            <?php if(current_userRole()->name == 'Employee'): ?>
                            <div class="col-lg-12 my-2">
                                <div class="form-floating">
                                    <textarea name="description" id="description" style="height: 100px" class="form-control" placeholder="Describe About you"><?= $user->description ?></textarea>
                                    <label for="description">Description</label>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                <input type="hidden" name="imageurl" value="<?= $user->profile_image ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" id="signup">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<!-- BS table js -->
<script src="<?= site_url("public/assets/vendor/libs/datatables/jquery.dataTables.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive/datatables.responsive.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons/datatables-buttons.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js") ?>"></script>
<!-- Validation Script -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $(".datatables-basic").DataTable();
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
        jQuery.validator.addMethod(
            "validDOB",
            function(value, element) {
                var d = new Date();
                var today = d.getFullYear() + "/" + (d.getMonth() + 1) + "/" + d.getDate();
                if (new Date(value) < new Date(today)) {
                    return true;
                } else {
                    return false;
                }
            },
            "Please enter a valid DOB."
        );
        $("#form-validate").validate({
            rules: {
                Dob: {
                    validDOB: true,
                    required: true
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>