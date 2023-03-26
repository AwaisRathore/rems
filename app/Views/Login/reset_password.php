<?= $this->extend('Layouts/header'); ?>
<?= $this->section('PageCss') ?>
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/css/pages/page-auth.css") ?>">
<?= $this->endSection() ?>
<link rel="icon" type="image/x-icon" href="<?= site_url("public/assets/img/favicon/icon.png") ?>" />
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <img src="<?= site_url("public/assets/img/optimizedtransparent_logo.png") ?>" alt="">
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Reset Password!</h4>
                    <form id="formforget" class="mb-3" action="" method="POST">
                        <?php if (session()->has('errors')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <b>Error:</b> <?= session('errors') ?>
                            </div>
                        <?php endif ?>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your New passwrod" autofocus />
                            <?php if (session()->has('errors') &&  isset(session('errors')['Password'])) : ?>
                                <div class="text-danger">
                                    <?= session('errors')['Password'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Enter confirm passwrod" autofocus />
                            <?php if (session()->has('errors') &&  isset(session('errors')['confirmPassword'])) : ?>
                                <div class="text-danger">
                                    <?= session('errors')['confirmPassword'] ?>
                                </div>
                            <?php endif ?>
                        </div>


                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script>
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

    $("#formforget").validate({
            rules: {
                
                Password: {
                    required: true,
                },
                confirmPassword: {
                    required: true,
                    equalTo: '[name="Password"]'
                }
            },
            
        });

</script>
<?= $this->include('Layouts/footer'); ?>