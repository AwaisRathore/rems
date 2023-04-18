<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Edit Employee Type<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Edit Employee Type</h5>
    <div class="card-body">
        <form action="" id="submit-form" method="post">
            <div class="row">
                <div class="col-lg-12 my-2">
                    <div class="form-floating">
                        <input type="text" value="<?= htmlspecialchars($EmployeeType['type']) ?>" class="form-control" required id="employeetype" name="employeetype" placeholder="Designation">
                        <label for="employeetype">Type Name</label>
                    </div>
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
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("open active");
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
        $("#submit-form").validate();
    })
</script>
<?= $this->endSection() ?>