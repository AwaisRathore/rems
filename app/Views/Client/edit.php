<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Edit Client <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Edit Client</h5>
    <div class="card-body">
        <form action="<?= site_url("Client/update/" . $Client['Id']) ?>" id="submit-form" method="post">
            <div class="row">
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="text" value="<?= htmlspecialchars($Client['Name']) ?>" class="form-control" required id="clientName" name="clientName" placeholder="John Doe">
                        <label for="clientName">Name</label>
                    </div>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="email" class="form-control" value="<?= htmlspecialchars($Client['Email_Address'])  ?>" required id="clientEmailAddress" name="clientEmailAddress" placeholder="example@gmail.com">

                        <label for="clientEmailAddress">Email Address</label>
                    </div>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" value="<?= $Client['Phone_Number'] ?>" required id="clientPhoneNumber" name="clientPhoneNumber" placeholder="1-541-754-3010">

                        <label for="clientPhoneNumber">Phone Number</label>
                    </div>
                </div>
                <div class="col-lg-6 my-2">
                    <div class="form-floating">
                        <select id="clientType" name="clientType" placeholder="Client Type" class="form-control">
                            <option value="" selected disabled>Select Client Type</option>
                            <?php foreach ($ClientType as $value) : ?>
                                <option <?php if ($value['Id'] == $Client['Client_Type']) {
                                            echo "selected";
                                        } ?> value="<?= $value['Id']  ?>"><?= $value['Type']  ?></option>
                            <?php endforeach ?>
                        </select>
                        <label for="clientType">Client Type</label>
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
        $(".menu-inner>li.menu-item:nth-of-type(3)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(3)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
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
                clientPhoneNumber: {
                    required: true,
                    phoneUS: true
                },
                clientEmailAddress: {
                    required: true,
                    email: true
                }
            }
        });
    })
</script>
<?= $this->endSection() ?>