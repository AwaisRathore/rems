<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | New Role <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Add New Role</h5>
    <div class="card-body">
        <form action="<?= site_url('roles/new') ?>" id="submit-form" method="post" enctype="multipart/form-data">
            <?php if (session()->has('warning')) : ?>
                <div class="alert alert-danger" role="alert">
                    <b>Error:</b> <?= session('warning') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-12 my-2">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['name'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" required id="rolename" name="rolename" placeholder="John Doe" >
                        <label for="rolename">Role Name</label>
                    </div>
                    <?php if (session()->has('errors') &&  isset(session('errors')['name'])) : ?>
                        <div class="invalid text-danger mt-1">
                            <?= session('errors')['name'] ?>
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
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(3)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(3)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("active");
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