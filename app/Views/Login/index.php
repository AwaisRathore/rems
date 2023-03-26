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
          <h4 class="mb-2">Welcome! 👋</h4>
          <p class="mb-4">Please sign-in to your account.</p>

          <form id="loginform" class="mb-3" action="" method="POST">
            <?php if (session()->has('warning')) : ?>
              <div class="alert alert-danger" role="alert">
                <b>Error:</b> <?= session('warning') ?>
              </div>
            <?php endif ?>
            <div class="mb-3">
              <label for="email" class="form-label">Email or Username</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
              <?php if (session()->has('errors') &&  isset(session('errors')['email'])) : ?>
                <div class="text-danger">
                  <?= session('errors')['email'] ?>
                </div>
              <?php endif ?>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="<?= site_url('login/forget') ?>">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div>
                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                
              </div>
            </div>
            
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>

          <!-- <p class="text-center">
            <span>New on our platform?</span>
            <a href="<?= site_url("Login/signup") ?>">
              <span>Create an account</span>
            </a>
          </p> -->
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

    $("#loginform").validate({
            rules: {
                
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                }
            },
            
        });

</script>
<?= $this->include('Layouts/footer'); ?>