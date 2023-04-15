<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Edit Role <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Edit Role</h5>
    <div class="card-body">
        <form action="<?= site_url('roles/edit/' . $role->id . '') ?>" id="submit-form" method="post" enctype="multipart/form-data">
            <?php if (session()->has('warning')) : ?>
                <div class="alert alert-danger" role="alert">
                    <b>Error:</b> <?= session('warning') ?>
                </div>
            <?php endif ?>
            <div class="row">
                <div class="col-lg-12 my-2">
                    <div class="form-floating">
                        <input type="text" class="form-control <?php if (session()->has('errors') &&  isset(session('errors')['name'])) : ?>
                                <?= "is-invalid" ?><?php endif ?>" value="<?= $role->name ?>" required id="rolename" name="rolename" placeholder="John Doe">
                        <label for="rolename">Role Name</label>
                    </div>
                    <input type="hidden" value="<?= $role->id ?>" name="id">
                    <?php if (session()->has('errors') &&  isset(session('errors')['name'])) : ?>
                        <div class="invalid text-danger mt-1">
                            <?= session('errors')['name'] ?>
                        </div>
                    <?php endif ?>
                </div>

                <div class="col-12 mt-3 mb-1 fw-bold">
                    Users Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewUser" value="1" id="CanViewUser" <?php if ($role->CanViewUser) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewUser"> Can View Users </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddUser" type="checkbox" value="1" id="CanAddUser" <?php if ($role->CanAddUser) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddUser"> Can Add Users </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditUser" value="1" id="CanEditUser" <?php if ($role->CanEditUser) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditUser"> Can Edit Users </label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanDeleteUser" type="checkbox" value="1" id="CanDeleteUser" <?php if ($role->CanDeleteUser) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteUser"> Can Delete Users </label>
                    </div>
                </div>
                <!-- User Permission Ends -->

                <!-- Role Permission Start -->
                
                <div class="col-12 mt-3 mb-1 fw-bold">
                    Roles Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewRole" value="1" id="CanViewRole" <?php if ($role->CanViewRole) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewRole"> Can View Roles </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddRole" type="checkbox" value="1" id="CanAddRole" <?php if ($role->CanAddRole) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddRole"> Can Add Roles </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditRole" value="1" id="CanEditRole" <?php if ($role->CanEditRole) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditRole"> Can Edit Roles </label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanDeleteRole" type="checkbox" value="1" id="CanDeleteRole" <?php if ($role->CanDeleteRole) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteRole"> Can Delete Roles </label>
                    </div>
                </div>
                <!-- User Permission Ends -->
                <!-- Quotation Permission -->
                <div class="col-12 mt-3 mb-1 fw-bold">
                    Quotation Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewQuotation" value="1" id="CanViewQuotation" <?php if ($role->CanViewQuotation) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewQuotation"> Can View Quotation </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddQuotation" type="checkbox" value="1" id="CanAddQuotation" <?php if ($role->CanAddQuotation) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddQuotation"> Can Add Quotation </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditQuotation" value="1" id="CanEditQuotation" <?php if ($role->CanEditQuotation) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditQuotation"> Can Edit Quotation </label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanDeleteQuotation" type="checkbox" value="1" id="CanDeleteQuotation" <?php if ($role->CanDeleteQuotation) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteQuotation"> Can Delete Quotation </label>
                    </div>
                </div>
                <!-- Quotation Permission Ends -->
                <!-- Clints Permission -->
                <div class="col-12 mt-3 mb-1 fw-bold">
                    Clients Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewClient" value="1" id="CanViewClient" <?php if ($role->CanViewClient) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewClient"> Can View Client </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddClient" type="checkbox" value="1" id="CanAddClient" <?php if ($role->CanAddClient) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddClient"> Can Add Client </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditClient" value="1" id="CanEditClient" <?php if ($role->CanEditClient) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditClient"> Can Edit Client </label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanDeleteClient" value="1" id="CanDeleteClient" <?php if ($role->CanDeleteClient) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteClient"> Can Delete Client </label>

                    </div>
                </div>


                <div class="col-12 mt-3 mb-1 fw-bold">
                    Clients Type Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewClientType" value="1" id="CanViewClientType" <?php if ($role->CanViewClientType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewClientType"> Can View Client Type </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddClientType" type="checkbox" value="1" id="CanAddClientType" <?php if ($role->CanAddClientType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddClientType"> Can Add Client Type</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditClientType" value="1" id="CanEditClientType" <?php if ($role->CanEditClientType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditClientType"> Can Edit Client Type</label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanDeleteClientType" value="1" id="CanDeleteClient" <?php if ($role->CanDeleteClientType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteClientType"> Can Delete Client Type</label>

                    </div>
                </div>

                <div class="col-12 mt-3 mb-1 fw-bold">
                    Project Scope Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewProjectScope" value="1" id="CanViewProjectScope" <?php if ($role->CanViewProjectScope) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewProjectScope"> Can View Project Scope </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddProjectScope" type="checkbox" value="1" id="CanAddProjectScope" <?php if ($role->CanAddProjectScope) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddProjectScope"> Can Add Project Scope</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditProjectScope" value="1" id="CanEditProjectScope" <?php if ($role->CanEditProjectScope) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditProjectScope"> Can Edit Project Scope</label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanDeleteProjectScope" value="1" id="CanDeleteProjectScope" <?php if ($role->CanDeleteProjectScope) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteProjectScope"> Can Delete Project Scope</label>

                    </div>
                </div>

                <div class="col-12 mt-3 mb-1 fw-bold">
                    Client Project Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewClientProject" value="1" id="CanViewClientProject" <?php if ($role->CanViewClientProject) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewClientProject"> Can View Client Project </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddClientProject" type="checkbox" value="1" id="CanAddClientProject" <?php if ($role->CanAddClientProject) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddClientProject"> Can Add Client Project</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditClientProject" value="1" id="CanEditClientProject" <?php if ($role->CanEditClientProject) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditClientProject"> Can Edit Client Project </label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanDeleteClientProject" value="1" id="CanDeleteClientProject" <?php if ($role->CanDeleteClientProject) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteClientProject"> Can Delete Project Client</label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanAssignProject" value="1" id="CanAssignProject" <?php if ($role->CanAssignProject) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAssignProject"> Can Assign Project</label>

                    </div>
                </div>
                <div class="col-12 mt-3 mb-1 fw-bold">
                    Invoice Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewInvoice" value="1" id="CanViewInvoice" <?php if ($role->CanViewInvoice) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewInvoice"> Can View Invoice </label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddInvoice" type="checkbox" value="1" id="CanAddInvoice" <?php if ($role->CanAddInvoice) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddInvoice"> Can Add Invoice</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditInvoice" value="1" id="CanEditInvoice" <?php if ($role->CanEditInvoice) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditInvoice">Can Edit Invoice</label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanDeleteInvoice" value="1" id="CanDeleteInvoice" <?php if ($role->CanDeleteInvoice) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteInvoice"> Can Delete Invoice</label>

                    </div>
                </div>
                <div class="col-12 mt-3 mb-1 fw-bold">
                    Employee Type Permissions
                </div>
                <hr>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanViewEmployeeType" value="1" id="CanViewEmployeeType" <?php if ($role->CanViewEmployeeType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanViewEmployeeType"> Can View Employee Type</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" name="CanAddEmployeeType" type="checkbox" value="1" id="CanAddEmployeeType" <?php if ($role->CanAddEmployeeType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanAddEmployeeType"> Can Add Invoice</label>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanEditEmployeeType" value="1" id="CanEditEmployeeType" <?php if ($role->CanEditEmployeeType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanEditEmployeeType">Can Edit Employee Type</label>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" name="CanDeleteEmployeeType" value="1" id="CanDeleteEmployeeType" <?php if ($role->CanDeleteEmployeeType) : ?> <?= 'checked' ?><?php endif ?>>
                        <label class="form-check-label" for="CanDeleteEmployeeType"> Can Delete Invoice</label>

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
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(3)").addClass("open active");
        // $(".menu-inner>li.menu-item:nth-of-type(5)>.menu-sub>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("active");
        // $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("active");
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