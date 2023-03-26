<?= $this->extend('Layouts/default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session('success') ?>
                    </div>
                <?php endif ?>
                <form action="" method="post" id="form-validate">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="opassword">Old Password</label>
                                <input type="password" class="form-control <?php if (isset($validation) && $validation->hasError('opwd')) : ?>
                                    <?= "is-invalid" ?>
                                <?php endif ?>" name="opassword" id="opassword" required placeholder="********">
                                <span class="invalid-feedback">
                                    <?php if (isset($validation) && $validation->hasError('opwd')) : ?>
                                        <?= $validation->getError('opwd') ?>
                                    <?php endif ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="npassword">New Password</label>
                                <input type="password" class="form-control <?php if (isset($validation) && $validation->hasError('npwd')) : ?>
                                    <?= "is-invalid" ?>
                                <?php endif ?>" name="npassword" id="npassword" required placeholder="********">
                                <span class="invalid-feedback">
                                    <?php if (isset($validation) && $validation->hasError('npwd')) : ?>
                                        <?= $validation->getError('npwd') ?>
                                    <?php endif ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="cpassword">Confirm Password</label>
                                <input type="password" class="form-control   <?php if (isset($validation) && $validation->hasError('cpassword')) : ?>
                                    <?= "is-invalid" ?>
                                <?php endif ?>" name="cpassword" id="cpassword" required placeholder="********">
                                <span class="invalid-feedback">
                                    <?php if (isset($validation) && $validation->hasError('cpassword')) : ?>
                                        <?= $validation->getError('cpassword') ?>
                                    <?php endif ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" id="updatepwd">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<!-- Validation Script -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
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
        $("#form-validate").validate({
            rules: {
                npassword: {
                    required: true
                },
                cpassword: {
                    required: true,
                    equalTo: '[name="npassword"]'
                }
            }
        });

    });
</script>
<?= $this->endSection() ?>