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
                    <h4 class="mb-2">Forget Password!</h4>
                    <?php 
                        if (!session()->has('success')) : 
                        ?>
                    <p class="mb-4">Please provide your Email Address.</p>
                    <?php endif ?>
                    <form id="formforget" class="mb-3" action="" method="POST">
                        <?php if (session()->has('warning')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <b>Error:</b> <?= session('warning') ?>
                            </div>
                        <?php endif ?>
                        <?php if (session()->has('errors')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <b>Error:</b> <?= session('errors') ?>
                            </div>
                        <?php endif ?>
                        <div class="mb-3">
                        <?php if (session()->has('success')) : ?>
                            <div class="alert alert-success" role="alert">
                            <?= session('success') ?>
                            </div>
                        <?php endif ?>
                        <?php 
                        if (!session()->has('success')) : 
                        ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
                            <?php if (session()->has('errors') &&  isset(session('errors')['email'])) : ?>
                                <div class="text-danger">
                                    <?= session('errors')['email'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                        


                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Send Link</button>
                        </div>
                        <?php 
                        endif 
                        ?>
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
                
                email: {
                    required: true,
                    email: true
                }
            },
            
        });

</script>
<?= $this->include('Layouts/footer'); ?>