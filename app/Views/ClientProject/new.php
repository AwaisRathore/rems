<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Add Project <?= $this->endSection() ?>
<?= $this->section("PageCss") ?>
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/Select2/css/select2.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<form action="<?= site_url("ClientProject/new") ?>" method="post" id="submit-form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Add Project</h5>
                <div class="card-body add-row">
                    
                    <div class="row">
                        <h6>Project 1</h6>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="project-name-1" name="project-name-1" required placeholder="Remote Estimation">
                                <label for="project-name-1">Project Name</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" id="delivery_date_1" name="delivery_date_1" required>
                                <label for="delivery_date_1">Expected Delivery Date</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="file" class="form-control lump-sum-check" id="project_file_1" name="project_file_1[]" placeholder="" multiple required>
                                <label for="project_file_1">Project Plan File</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control lump-sum-check" id="project_file_link_1" name="project_file_link_1" placeholder="" required>
                                <label for="project_file_link_1">Project Plan File Link(Multiple with , separated)</label>
                            </div>
                        </div>

                        <div class="col-lg-6 my-2">
                            <label for="project-scope-1" class="form-label">Project Scope</label>
                            <select class="select2 form-select" id="project-scope-1" name="project-scope-1[]" multiple required>
                                <?php foreach ($ProjectScopes as $value) { ?>
                                    <option value="<?= $value['Id'] ?>"><?= $value['Type_Names'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 my-2">
                            <label for="project-type-1" class="form-label">Project Type</label>
                            <select class="form-select" id="project-type-1" name="project-type-1" required>
                                <option value="" selected disabled>Select Value</option>
                                <option value="Takeoff">Takeoff</option>
                                <option value="Estimate">Estimate</option>
                                <option value="Takeoff & Estimate">Both Takeoff & Estimate</option>
                            </select>
                        </div>
                        <div class="col-lg-12 my-2">
                            <div class="form-floating">

                                <textarea name="notes-1" id="notes" style="height: 100px" class="form-control" placeholder="Describe your project"></textarea>
                                <label for="project-file-link">Describe your project</label>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $currentclient[0]['Id'] ?>" name='client_id'>
                    </div>
                    <hr>

                    <div class="row">

                        <div class="col-12 text-end">
                            <button type="button" id="btn-add-more" class="btn btn-outline-primary btn-icon rounded-pill"><i class='bx bx-plus'></i></button>
                        </div>
                        <div class="col-12 text-center my-3">
                            <input type="submit" class="btn btn-primary" value="Request Quotation" name="submit">
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submit-form-client">
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" required id="clientName" name="clientName" placeholder="John Doe">
                                <label for="clientName">Name</label>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" required id="clientEmailAddress" name="clientEmailAddress" placeholder="example@gmail.com">

                                <label for="clientEmailAddress">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-1">
                            <div class="form-floating">
                                <input type="text" class="form-control" required id="clientPhoneNumber" name="clientPhoneNumber" placeholder="1-541-754-3010">

                                <label for="clientPhoneNumber">Phone Number</label>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="client-submit" id="client-submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="<?= site_url("public/assets/vendor/libs/Select2/js/select2.js") ?>"></script>
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        <?php if (current_userRole()->name = 'Admin') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(2)").addClass("open active");
            $(".menu-inner>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("active");
        <?php endif ?>
        <?php if (current_userRole()->name = 'Client') : ?>
            $("li.menu-item").removeClass("active");
            $(".menu-inner>li.menu-item:nth-of-type(3)").addClass("active");
        <?php endif ?>
        // Set default jQuery validator settings
        $(".select2").select2();
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

        $.validator.addMethod('totalfilesize', function(value, element, param) {
            var totalSize = 0;
            var files = element.files;

            for (var i = 0; i < files.length; i++) {
                totalSize += files[i].size;
            }

            return this.optional(element) || (totalSize <= param * 1024 * 1024);
        }, 'Total file size must be less than {0} MB');

        $("#submit-form").validate({
            rules: {
                'project_file_1[]': {
                    required: function() {
                        return $("#project_file_link_1").val() === "";
                    },
                    totalfilesize: 500 // set the maximum total file size in MB,
                },
                project_file_link_1: {
                    required: function() {
                        return $("#project_file_1").val() === "";
                    }
                },
                'project_file_2[]': {
                    required: function() {
                        return $("#project_file_link_2").val() === "";
                    },
                    totalfilesize: 500 // set the maximum total file size in MB,
                },
                project_file_link_2: {
                    required: function() {
                        return $("#project_file_2").val() === "";
                    }
                },
                'project_file_3[]': {
                    required: function() {
                        return $("#project_file_link_3").val() === "";
                    },
                    totalfilesize: 500 // set the maximum total file size in MB,
                },
                project_file_link_3: {
                    required: function() {
                        return $("#project_file_3").val() === "";
                    }
                },
                'project_file_4[]': {
                    required: function() {
                        return $("#project_file_link_4").val() === "";
                    },
                    totalfilesize: 500 // set the maximum total file size in MB,
                },
                project_file_link_4: {
                    required: function() {
                        return $("#project_file_4").val() === "";
                    }
                },
            },
            messages: {
                'project_file_1[]': "Please provide a file or a file link.",
                project_file_link_1: "Please provide a file or a file link.",
                'project_file_2[]': "Please provide a file or a file link.",
                project_file_link_2: "Please provide a file or a file link.",
                'project_file_3[]': "Please provide a file or a file link.",
                project_file_link_3: "Please provide a file or a file link.",
                'project_file_4[]': "Please provide a file or a file link.",
                project_file_link_4: "Please provide a file or a file link.",
                'project_file_4[]': "Please provide a file or a file link.",
                project_file_link_4: "Please provide a file or a file link.",
            }
        });

       
        $("#btn-add-more").click(function() {
            var i = $(".add-row").children("div.row").length;
            $(this).parent('.row').prev('hr').prev('.del-btn').remove();
            var html = `<div class="row">
                        <h6>Project `+i+`</h6>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="project-name-` + i + `" name="project-name-` + i + `" required placeholder="Remote Estimation">
                                <label for="project-name">Project Name</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="delivery_date_` + i + `" name="delivery_date_` + i + `" min="<?= date('Y-m-d') ?>" required>
                                <label for="delivery_date">Expected Delivery Date</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="file" class="form-control lump-sum-check" id="project_file_` + i + `" name="project_file_` + i + `[]" placeholder="" multiple required>
                                <label for="project_file">Project Plan File</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control lump-sum-check" id="project_file_link_` + i + `" name="project_file_link_` + i + `" placeholder="" required>
                                <label for="project_file_link">Project Plan File Link</label>
                            </div>
                        </div>

                        <div class="col-lg-6 my-2">
                            <label for="project-scope-1" class="form-label">Project Scope</label>
                            <select class="select2 form-select" id="project-scope-` + i + `" name="project-scope-` + i + `[]" multiple required>
                                <?php foreach ($ProjectScopes as $value) { ?>
                                    <option value="<?= $value['Id'] ?>"><?= $value['Type_Names'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 my-2">
                            <label for="project-type-` + i + `" class="form-label">Project Type</label>
                            <select class="form-select" id="project-type-` + i + `" name="project-type-` + i + `" required>
                                <option value="" selected disabled>Select Value</option>
                                <option value="Takeoff">Takeoff</option>
                                <option value="Estimate">Estimate</option>
                                <option value="Takeoff & Estimate">Both Takeoff & Estimate</option>
                            </select>
                        </div>
                        <div class="col-lg-12 my-2">
                            <div class="form-floating">
                                <textarea name="notes-` + i + `" id="notes" style="height: 100px" class="form-control" placeholder="Describe your project"></textarea>
                                <label for="project-file-link">Describe your project</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-end del-btn"><button class="btn btn-outline-danger btn-icon rounded-pill deleteproject" type="button"><i class="bx bx-trash"></i> </button></div>
                    <hr>`;
            $(".add-row").children("div").last().prev().after(html);
            $("#project-scope-" + i + "").select2();
            add_total();
            form_select_2();
        });

        $(document).on("click", ".deleteproject", function() {
            $(this).parent().prev(".row").remove();
            $(this).parent().next().remove();
            $(this).remove();
        });



    });
</script>
<script src="<?= site_url("public/assets/js/forms-selects.js") ?>"></script>
<?= $this->endSection() ?>