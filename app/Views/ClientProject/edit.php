<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Edit Project <?= $this->endSection() ?>
<?= $this->section("PageCss") ?>
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/Select2/css/select2.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<form action="<?= site_url("ClientProject/Edit/" . $project["Id"] . "") ?>" method="post" id="submit-form" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Edit Project</h5>
                <div class="card-body add-row">

                    <div class="row">
                        <h6><?= $project['Project_Name'] ?></h6>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="project-name-1" value="<?= $project['Project_Name'] ?>" name="project-name-1" required placeholder="Remote Estimation">
                                <label for="project-name-1">Project Name</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" id="delivery_date_1" value="<?= $project['Delivery_Date'] ?>" name="delivery_date_1" required>
                                <label for="delivery_date_1">Expected Delivery Date</label>
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="file" class="form-control lump-sum-check" id="project_file_1" name="project_file_1[]" placeholder="" multiple>
                                <label for="project_file_1">Project Plan File</label>
                            </div>

                            <?php $project_file = explode(',', $project['Project_file']) ?>
                            <div class="d-flex">

                                <?php $f = 1;
                                foreach ($project_file as $pf_value) : ?>
                                    <?php if (!empty($pf_value)) : ?>
                                        <div class="ml-3 mt-3 bg-primary p-1 rounded">

                                            <a href="<?= site_url($pf_value) ?>" target="_blank" class="text-white">File <?= $f ?></a>
                                            <button type="button" class="btn-close btn-close-white remove_file" aria-label="Close"></button>
                                            <input type="hidden" name="previous_file[]" value="<?= $pf_value ?>">
                                        </div>
                                    <?php endif ?>
                                <?php $f++;
                                endforeach ?>

                            </div>
                        </div>

                        <div class="col-lg-6 my-2">
                            <div class="form-floating">
                                <input type="text" class="form-control lump-sum-check" id="project_file_link_1" value="<?= $project['project_file_link'] ?>" name="project_file_link_1" placeholder="">
                                <label for="project_file_link_1">Project Plan File Link(Multiple with , separated)</label>
                            </div>
                        </div>

                        <div class="col-lg-6 my-2">
                            <label for="project-scope-1" class="form-label">Project Scope</label>
                            <select class="select2 form-select" id="project-scope-1" name="project-scope-1[]" multiple required>
                                <?php foreach ($ProjectScopes as $value) { ?>
                                    <option value="<?= $value['Id'] ?>" <?php foreach ($previousScopes as $vs) : ?> <?php if ($project['Id'] == $vs["Project_Id"]) : ?> <?php if ($value['Id'] == $vs['ProjectScopeType']) : ?>selected<?php endif ?> <?php endif  ?> <?php endforeach ?>><?= $value['Type_Names'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6 my-2">
                            <label for="project-type-1" class="form-label">Project Type</label>
                            <select class="form-select" id="project-type-1" name="project-type-1" required>
                                <option value="" selected disabled>Select Value</option>
                                <option value="Takeoff" <?php if ($project['project_type'] == 'Takeoff') {
                                                            echo "selected";
                                                        } ?>>Takeoff</option>
                                <option value="Estimate" <?php if ($project['project_type'] == 'Estimate') {
                                                                echo "selected";
                                                            } ?>>Estimate</option>
                                <option value="Takeoff & Estimate" <?php if ($project['project_type'] == 'Takeoff & Estimate') {
                                                                        echo "selected";
                                                                    } ?>>Both Takeoff & Estimate</option>
                            </select>
                        </div>
                        <div class="col-lg-12 my-2">
                            <div class="form-floating">

                                <textarea name="notes" id="notes" style="height: 100px" class="form-control" placeholder="Describe your project"><?= $project['notes'] ?></textarea>
                                <label for="project-file-link">Describe your project</label>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $currentclient[0]['Id'] ?>" name='client_id'>
                    </div>
                    <hr>

                    <div class="row">

                        <div class="col-12 text-center my-3">
                            <input type="submit" class="btn btn-primary" value="Update" name="submit">
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</form>

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
            $(".menu-inner>li.menu-item:nth-of-type(2)").addClass("open active");
            $(".menu-inner>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("active");
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

        <?php if($project['Project_file'] && $project['project_file_link'] ): ?>
            $("#submit-form").validate({
                rules: {
                    'project_file_1[]': {
                        required: function() {
                            return $("#project_file_link_1").val() === "";
                        }
                    },
                    project_file_link_1: {
                        required: function() {
                            return $("#project_file_1").val() === "";
                        }
                    },
                },
                messages: {
                    'project_file_1[]': "Please provide a file or a file link.",
                    project_file_link_1: "Please provide a file or a file link.",
                }
            });
        <?php endif ?>



        $(document).on('click', '.remove_file', function() {
            $(this).parent().remove();
        })


    });
</script>
<script src="<?= site_url("public/assets/js/forms-selects.js") ?>"></script>
<?= $this->endSection() ?>