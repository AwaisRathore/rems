<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Project View<?= $this->endSection() ?>
<?= $this->section('PageCss') ?>

<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/Select2/css/select2.css") ?>">
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<div class="row my-3">
    <div class="">
        <div>

            <?php foreach ($assignusers as $Assignuser) : ?>
                <?php if (current_user()->id == $Assignuser['user_id']) : ?>

                    <?php if ($Assignuser['status'] == 0 && $Assignuser['assignReview'] == NULL) : ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Hey <?= $Assignuser['username'] ?> !</strong> Would you like to accept or reject this Project?
                                </div>
                                <div>
                                    <a type="button" class="text-danger" style="padding-right: 10px; border-right : 1px solid black" data-bs-toggle="modal" data-bs-target="#rejectandreview">Reject</a>
                                    <a href="<?= site_url('ClientProject/acceptProject/' . $project[0]['Id'] . '') ?>" style="padding-left: 10px;" class="text-success">Accept</a>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>

        </div>
    </div>
</div>

<?php if (current_userRole()->name == 'Client' || current_userRole()->name == 'Admin') : ?>
    <div class="row my-3">
        <div class="">
            <div>

                <?php if ($project[0]['projectStatus'] == 0 && $project[0]['deliver_file'] != NULL) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div class="d-flex justify-content-between">
                            <div>
                                <?php if (current_userRole()->name == 'Client') : ?>
                                    <strong>Hey !</strong> Your Project <?= $project[0]['Project_Name'] ?> has been reviewed and delivered by the administrator
                                <?php endif ?>
                                <?php if (current_userRole()->name == 'Admin') : ?>
                                    <strong>Hey !</strong> You deliver the Project <?= $project[0]['Project_Name'] ?>
                                <?php endif ?>
                            </div>
                            <div>
                                <!-- <a type="button" class="text-danger" style="padding-right: 10px; border-right : 1px solid black" data-bs-toggle="modal" data-bs-target="#rejectandreview">Reject</a> -->
                                <a href="<?= site_url('ClientProject/markascompletedProject/' . $project[0]['Id'] . '') ?>" style="padding-left: 10px;" class="text-success">Mark as Completed</a>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>


            </div>
        </div>
    </div>
<?php endif ?>

<div class="row">
    <div class="col-lg-7 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-head d-flex justify-content-between align-items-center">
                <h5 class="px-4 pt-3">Project Information</h5>
                <div class="px-4">



                    <?php if (current_userRole()->name == 'Admin') : ?>
                        <?php
                        $assigncount = 0;
                        foreach ($assignusers as $assignprojects) {
                            if ($assignprojects['project_id'] == $project[0]['Id'] && $assignprojects['status'] == 1) {
                                $assigncount++;
                            }
                        }
                        ?>
                        <?php
                        $total_progress = 0;
                        $i = 0;
                        foreach ($totalprojectprogress as $projectProgress) {
                            if ($projectProgress['project_id'] == $project[0]['Id']) {
                                $total_progress += $projectProgress['avg_max_progress'];
                                $i++;
                            }
                        }
                        if ($i == 0) {
                            $total_progress = 0;
                        } else {
                            $total_progress = $total_progress / $assigncount;
                        }

                        ?>
                        <?php if ($total_progress == 100 && $project[0]['projectStatus'] == 0 && empty($project[0]['deliver_file'])) : ?>

                            <a href="" id="" data-bs-toggle="modal" data-bs-target="#deliverProject" class="mt-2">
                                <div class="btn-sm btn-success position-relative">
                                    Deliver Project
                                </div>
                            </a>


                        <?php endif ?>
                    <?php endif ?>


                </div>
            </div>
            <div class="card-body text-dark" style="padding: 0px;">

                <ul class="list-group list-group-unbordered p-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <b>Project Name</b> <a class="text-right"><?= $project[0]['Project_Name'] ?></a>
                    </li>

                    <?php if (current_userRole()->name != 'Employee') : ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <b>Client Name</b> <a class="pull-right"> <?= $project[0]['Name'] ?></a>
                        </li>
                    <?php endif ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <b>Scopes</b> <a class="" style="margin-left : 15px; text-align : right;"><?php foreach ($projectscope as $value) : ?><?= $value['Type_Names'] . " <br>" ?><?php endforeach ?></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <b>Delivery Date</b> <a class="pull-right"><?= $project[0]['Delivery_Date'] ?></a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <b>Project Type</b> <a class="pull-right"><?= $project[0]['project_type'] ?></a>
                    </li>
                    <?php if (current_userRole()->name != 'Employee') : ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <b>Lump Sump Charges</b> <?php if ($project[0]['Lump_Sump_Charges'] == 0) : ?> Not Qouted <?php else : ?><a class="pull-right"><?= $project[0]['Lump_Sump_Charges'] ?><?php endif ?></a>
                        </li>
                    <?php endif ?>

                </ul>
            </div>
        </div>
        <?php if (current_userRole()->name != 'Client') : ?>
            <div class="card mt-4">
                <div class="card-head d-flex justify-content-between">
                    <h5 class="px-4 pt-3">
                        <?php if (current_userRole()->name == 'Employee') : ?>Team Members <?php else : ?> Assign Members <?php endif ?>
                    </h5>
                    <?php if (current_userRole()->CanAssignProject) : ?>
                        <div class="px-4 pt-2">

                            <a href="" id="" data-bs-toggle="modal" data-bs-target="#assignProject" class="nav-link assign_project">
                                <div class="btn-sm btn-primary position-relative">
                                    Assign Estimator <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?= $countassignusers[0]['assignusercount']; ?>
                                    </span>
                                </div>
                            </a>

                        </div>
                    <?php endif ?>
                </div>
                <div class="card-body text-dark" style="padding: 0px;">

                    <ul class="list-group list-group-unbordered p-3">
                        <?php foreach ($assignusers as $Assignuser) : ?>

                            <li class="list-group-item d-flex justify-content-between">
                                <b>
                                    <img src="<?= site_url($Assignuser['profile_image']) ?>" alt="" style="width : 35px; border-radius : 50%; margin-right : 10px"> <?= $Assignuser['username'] ?> </b>
                                <div class="align-middle mt-1">

                                    <?php if ($Assignuser['status'] == 0 && $Assignuser['assignReview'] == NULL) : ?>
                                        <a class="btn-sm text-white bg-red">Assigned And Waiting for Response</a>

                                    <?php elseif ($Assignuser['status'] == 0 && $Assignuser['assignReview'] != NULL) : ?>
                                        <a class="btn-sm text-white bg-red">Rejected</a>
                                        <span class="me-1"><?= $Assignuser['assignReview'] ?></span>
                                    <?php endif ?>
                                    <?php if ($Assignuser['status'] == 1) : ?>
                                        <a class="btn-sm text-white bg-success ">Accepted</a>
                                    <?php endif ?>
                                    <?php if (current_userRole()->name != 'Employee') : ?>
                                        <a class="deleteAssign" style="vertical-align: middle;" id="<?= $Assignuser['user_id'] ?>" href=""><i class="bx bx-trash text-danger"></i></a>
                                </div>

                            <?php endif ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>

            <?php if (current_userRole()->name == 'Employee' || current_userRole()->name == 'Admin') : ?>
                <div class="card  mt-4">
                    <div class="card-head d-flex justify-content-between">
                        <h5 class="px-4 pt-3">Work Log</h5>
                        <div class="px-4 pt-1">



                            <?php foreach ($assignusers as $Assignuser) : ?>
                                <?php if ((current_user()->id == $Assignuser['user_id'] && $Assignuser['status'] == 1)) : ?>
                                    <a href="" id="" data-bs-toggle="modal" data-bs-target="#worklog" class="nav-link assign_project">
                                        <div class="btn-sm btn-primary position-relative">
                                            Add Work
                                        </div>
                                    </a>
                                <?php endif ?>
                            <?php endforeach ?>

                        </div>

                    </div>
                    <div class="card-body text-dark" style="padding: 0px;">

                        <div class="card-datatable table-responsive pt-0">
                            <table class="datatables-basic table border-top">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th style="width : 40%;">Progress</th>
                                        <th style="width : 40%;">Time Spend</th>
                                        <th style="width : 40%;"> Created At</th>

                                        <th style="width : 40%;">File</th>
                                        <th style="width : 40%;">Notes</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php if (current_userRole()->name == 'Employee') : ?>
                                        <?php foreach ($worklog as $value) : ?>
                                            <tr>
                                                <?php
                                                $start_time = new DateTime($value['start_time']);
                                                $end_time = new DateTime($value['end_time']);

                                                // Calculate the difference between the two datetime values
                                                $time_spend = $end_time->diff($start_time);

                                                // dd($time_spend->h);
                                                // Check if the total number of hours is greater than or equal to 24
                                                if ($time_spend->d >= 1) {
                                                    // Format the interval as days, hours, and minutes
                                                    $time_spend_str = $time_spend->format('%a days, %H hrs, %I mins');
                                                } else {
                                                    // Format the interval as hours and minutes
                                                    $time_spend_str = $time_spend->format('%h hrs, %i mins');
                                                }

                                                ?>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: <?= $value['progress'] ?>%;" aria-valuenow="<?= $value['progress'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $value['progress'] ?>%</div>
                                                    </div>
                                                </td>
                                                <td><?= $time_spend_str  ?></td>
                                                <td><?= $value['created_at'] ?></td>
                                                <td><?php if ($value['file'] != '') : ?>
                                                        <a href="<?= site_url($value['file']) ?>" target="_blank">View File</a> <?php endif ?>
                                                </td>
                                                <td><?= $value['description'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                    <?php if (current_userRole()->name == 'Admin') : ?>
                                        <?php foreach ($allworks as $value) : ?>
                                            <tr>
                                                <?php
                                                $start_time = new DateTime($value['start_time']);
                                                $end_time = new DateTime($value['end_time']);

                                                // Calculate the difference between the two datetime values
                                                $time_spend = $end_time->diff($start_time);

                                                // dd($time_spend->h);
                                                // Check if the total number of hours is greater than or equal to 24
                                                if ($time_spend->d >= 1) {
                                                    // Format the interval as days, hours, and minutes
                                                    $time_spend_str = $time_spend->format('%a days, %H hrs, %I mins');
                                                } else {
                                                    // Format the interval as hours and minutes
                                                    $time_spend_str = $time_spend->format('%h hrs, %i mins');
                                                }

                                                ?>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: <?= $value['progress'] ?>%;" aria-valuenow="<?= $value['progress'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $value['progress'] ?>%</div>
                                                    </div>
                                                </td>
                                                <td><?= $time_spend_str  ?></td>
                                                <td><?= $value['created_at'] ?></td>
                                                <td><?php if ($value['file'] != '') : ?>
                                                        <a href="<?= site_url($value['file']) ?>" target="_blank">View File</a> <?php endif ?>
                                                </td>
                                                <td><?= $value['description'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="col-lg-5 col-md-12 col-sm-12 col-12">


        <?php if (current_userRole()->name == 'Employee') : ?>
            <?php foreach ($assignusers as $Assignuser) : ?>
                <?php if ($Assignuser['user_id'] == current_user()->id) : ?>
                    <?php if ($Assignuser['CanViewFile']) : ?>

                        <div class="card text-dark">
                            <div class="card-head ">
                                <h5 class="px-4 pt-3">Attached Files</h5>

                            </div>
                            <div class="card-body " style="padding: 0px;">
                                <?php if (!empty($project[0]['Project_file'])) : ?>
                                    <?php if ($project[0]['Project_file'][0] != '') : ?>
                                        <ul class="list-group list-group-unbordered p-3">
                                            <?php $i = 1;
                                            foreach ($project[0]['Project_file'] as $projectfile) : ?>
                                                <li class="list-group-item custom-border-padding d-flex justify-content-between">
                                                    <b>File <?= $i; ?></b> <a class="file_link" href="<?= site_url($projectfile) ?>" target="_blank" download>Download</a>
                                                </li>
                                            <?php $i++;
                                            endforeach ?>



                                        </ul>
                                    <?php endif ?>
                                <?php endif ?>
                            </div>
                        </div>

                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>

        <?php else : ?>

            <div class="card text-dark">
                <div class="card-head d-flex justify-content-between align-items-center">
                    <h5 class="px-4 pt-3">Attached Files</h5>
                    <div class="px-4">
                        <?php if (current_userRole()->name == 'Admin') : ?>

                            <?php if ($total_progress < 100) : ?>

                                <a href="" id="" data-bs-toggle="modal" data-bs-target="#addfile" class="mt-2">
                                    <div class="btn-sm btn-primary position-relative">
                                        Add Files
                                    </div>
                                </a>
                            <?php endif ?>

                        <?php endif ?>


                    </div>

                </div>
                <div class="card-body " style="padding: 0px;">
                    <?php if (!empty($project[0]['Project_file'])) : ?>
                        <?php if ($project[0]['Project_file'][0] != '') : ?>
                            <ul class="list-group list-group-unbordered p-3">
                                <?php $i = 1;
                                foreach ($project[0]['Project_file'] as $projectfile) : ?>
                                    <li class="list-group-item custom-border-padding d-flex justify-content-between">
                                        <b>File <?= $i; ?></b> <a class="file_link" href="<?= site_url($projectfile) ?>" target="_blank" download>Download</a>
                                    </li>
                                <?php $i++;
                                endforeach ?>



                            </ul>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>

        <?php endif ?>


        <?php if (current_userRole()->name == 'Employee') : ?>
            <?php foreach ($assignusers as $Assignuser) : ?>
                <?php if ($Assignuser['user_id'] == current_user()->id) : ?>
                    <?php if ($Assignuser['CanViewFileUrl']) : ?>

                        <div class="card text-dark mt-4">
                            <div class="card-head ">
                                <h5 class="px-4 pt-3">Files Links</h5>
                            </div>
                            <div class="card-body " style="padding: 0px;">
                                <?php if (!empty($project[0]['project_file_link'])) : ?>
                                    <?php if ($project[0]['project_file_link'][0] != '') : ?>
                                        <ul class="list-group list-group-unbordered p-3">
                                            <?php $i = 1;
                                            foreach ($project[0]['project_file_link'] as $projectfilelink) : ?>
                                                <li class="list-group-item custom-border-padding d-flex justify-content-between">
                                                    <b>Link <?= $i; ?></b> <a class="file_link" href="<?= $projectfilelink ?>" target="_blank">Browse</a>
                                                </li>
                                            <?php $i++;
                                            endforeach ?>



                                        </ul>
                                    <?php endif ?>
                                <?php endif ?>
                            </div>
                        </div>

                    <?php endif ?>

                <?php endif ?>
            <?php endforeach ?>
        <?php else : ?>
            <div class="card text-dark mt-4">
                <div class="card-head ">
                    <h5 class="px-4 pt-3">Files Links</h5>

                </div>
                <div class="card-body " style="padding: 0px;">

                    <?php if (!empty($project[0]['project_file_link'])) : ?>
                        <?php if ($project[0]['project_file_link'][0] != '') : ?>
                            <ul class="list-group list-group-unbordered p-3">
                                <?php $i = 1;
                                foreach ($project[0]['project_file_link'] as $projectfilelink) : ?>
                                    <li class="list-group-item custom-border-padding d-flex justify-content-between">
                                        <b>Link <?= $i; ?></b> <a class="file_link" href="<?= $projectfilelink ?>" target="_blank">Browse</a>
                                    </li>
                                <?php $i++;
                                endforeach ?>



                            </ul>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>

        <?php endif ?>
        <?php if ($project[0]['notes'] != '') : ?>
            <div class="card text-dark mt-4">
                <div class="card-head">
                    <h5 class="px-4 pt-3">Project Description</h5>
                </div>
                <div class="card-body " style="padding: 0px;">

                    <ul class="list-group list-group-unbordered p-3">

                        <li class="list-group-item custom-border-padding ">
                            <?= $project[0]['notes'] ?>
                        </li>




                    </ul>
                </div>
            </div>

        <?php endif ?>
        <?php if (current_userRole()->name == 'Admin') : ?>
            <div class="card text-dark mt-4">
                <div class="card-head d-flex justify-content-between">
                    <h5 class="px-4 pt-3">Deliverable File</h5>
                    <div class="pt-1">
                        <?php $filecount = 0;
                        foreach ($progressFile as $progressfiles) : ?>
                            <?php if ($progressfiles['file'] != '') : ?>

                            <?php $filecount++;
                            endif ?>
                        <?php endforeach ?>
                        <?php if ($filecount > 0) : ?>
                            <a href="" id="" class="nav-link download_zip assign_project">
                                <div class="btn-sm btn-primary position-relative">
                                    Download files Zip
                                </div>
                            </a>
                        <?php endif ?>
                    </div>

                </div>
                <div class="card-body " style="padding: 0px;">

                    <ul class="list-group list-group-unbordered p-3">
                        <?php $i = 1;
                        foreach ($progressFile as $progressfiles) : ?>
                            <?php if ($progressfiles['file'] != '') : ?>
                                <?php foreach ($progressfiles['file'] as $file) : ?>
                                    <li class="list-group-item custom-border-padding d-flex justify-content-between">
                                        <b>File <?= $i ?></b>

                                        <div><?= $progressfiles['username'] ?></div> <a class="file_link progressfile" href="<?= site_url($file) ?>" target="_blank" download>Download</a>

                                    </li>
                                <?php $i++;
                                endforeach ?>
                            <?php
                            endif ?>
                        <?php endforeach ?>



                    </ul>
                </div>
            </div>
        <?php endif ?>

        <?php if (current_userRole()->name == 'Client') : ?>
            <?php if ($project[0]['deliver_file'] != '') : ?>
                <div class="card text-dark mt-4">
                    <div class="card-head d-flex justify-content-between">
                        <h5 class="px-4 pt-3">Deliver File</h5>


                    </div>
                    <div class="card-body " style="padding: 0px;">

                        <ul class="list-group list-group-unbordered p-3">

                            <?php $i = 1;
                            foreach ($project[0]['deliver_file'] as $d_file) : ?>
                                <li class="list-group-item custom-border-padding d-flex justify-content-between">
                                    <b>Deliver File <?= $i ?></b>
                                    <a class="file_link progressfile" href="<?= site_url($d_file) ?>" target="_blank" download>Download</a>
                                </li>
                            <?php $i++;
                            endforeach ?>

                        </ul>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>

    </div>

</div>


<!-- comment section -->

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card mt-4">
            <div class="card-head">
                <h5 class="px-4 pt-3">Comments</h5>
            </div>
            <div class="card-body text-dark" style="padding: 0px;">

                <ul class="list-group list-group-unbordered p-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="col-lg-12">
                            <div class="mt-4">
                                <form action="<?= site_url('ClientProject/newComment/' . $project[0]['Id'] . '') ?>" id="comment_form" method="post">
                                    <h5>Add Comment</h5>
                                    <div class="form-group mb-3">
                                        <label for="comment">Comment</label>
                                        <textarea name="comment" id="comment" style="height: 100px" class="form-control" placeholder="Comment" required></textarea>

                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="1" id="RFI" name="RFI">
                                        <label class="form-check-label" for="RFI">
                                            Request for Information
                                        </label>
                                    </div>
                                    <input type="hidden" name="project_name" value="<?= $project[0]['Project_Name'] ?>">
                                    <input type="hidden" name="clientname" value="<?= $project[0]['clientId'] ?>">

                                    <div class="row">
                                        <div class="col-12 text-end my-3">
                                            <button type="submit" class="btn btn-primary">Send <i class='bx bx-send'></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </li>

                    <?php foreach ($comments as $comment) : ?>
                        <?php if ($comment['parentComment_id'] === null) : ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <div class="col-lg-12">
                                    <div class="mt-4 bg-white p-3">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <div>
                                                    <img src="<?= site_url($comment['profile_image']) ?>" alt="" style="width : 40px; border-radius : 50%;">
                                                </div>
                                                <div style="margin-left : 15px">
                                                    <h6 class="text-black" style="margin-bottom : 3px !important;"><b><?= $comment['username'] ?></b> <small class="ml-2 text-dark" style="margin-left: 4px; padding : 0 10px; border-left : 1px solid black"><span><?= $comment['created_at'] ?></span> </small> <?php if ($comment['RFI'] == 1) : ?> <small class="ml-2 text-dark " style="margin-left: 4px; padding : 0 10px; border-left : 1px solid black"><span class="btn bg-red btn-sm text-white">RFI</span> </small><?php endif ?></h6>
                                                    <div><?= $comment['comment'] ?></div>
                                                </div>

                                            </div>

                                            <?php if ($comment['user_id'] == current_user()->id) : ?>
                                                <div>
                                                    <a class="deleteComment" href="" id="<?= $comment['id'] ?>"><i class="bx bx-trash text-danger"></i></a>
                                                    <a class="editCommentbtn" href="" id="<?= $comment['id'] ?>"><i class="bx bx-edit text-primary"></i></a>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <div class="editcomment">

                                            <form action="<?= site_url('ClientProject/EditComment/' . $comment['id'] . '') ?>" id="editcomment" method="post">

                                                <div class="col-lg-12 my-2">
                                                    <div class="form-group">

                                                        <label for="commentreply">Comment Update</label>
                                                        <textarea name="commentreply" id="commentreply" style="height: 100px" class="form-control" placeholder="Comment" required><?= $comment['comment'] ?></textarea>

                                                    </div>
                                                </div>
                                                <div class="form-check ">
                                                    <input class="form-check-input" value="1" <?php if ($comment['RFI'] == 1) : ?><?= 'checked' ?><?php endif ?> type="checkbox" value="1" id="RFI" name="RFI">
                                                    <label class="form-check-label" for="RFI">
                                                        Request for Information
                                                    </label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 text-end my-2">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="text-end">
                                            <a href="" class="comment_reply btn ">Reply</a>
                                        </div>
                                        <div class="comment-form">

                                            <form action="<?= site_url('ClientProject/replyComment/' . $project[0]['Id'] . '/' . $comment['id'] . '') ?>" id="commentreply_form" method="post">

                                                <div class="col-lg-12 my-2">
                                                    <div class="form-group">

                                                        <label for="commentreply">Comment Reply</label>
                                                        <textarea name="commentreply" id="commentreply" style="height: 100px" class="form-control" placeholder="Comment" required></textarea>

                                                    </div>
                                                </div>

                                                <input type="hidden" name="project_name" value="<?= $project[0]['Project_Name'] ?>">
                                                <input type="hidden" name="clientname" value="<?= $project[0]['clientId'] ?>">
                                                <div class="row">
                                                    <div class="col-12 text-end my-2">
                                                        <button type="submit" class="btn btn-primary">Reply <i class='bx bx-send'></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <?php foreach ($comments as $child) : ?>
                                            <?php if ($child['parentComment_id'] === $comment['id']) : ?>
                                                <div class="mt-3 bg-white" style="margin-left : 25px;">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex">
                                                            <div>
                                                                <img src="<?= site_url($child['profile_image']) ?>" alt="" style="width : 35px; border-radius : 50%;">
                                                            </div>
                                                            <div style="margin-left : 15px">
                                                                <h6 class="text-black" style="margin-bottom : 3px !important;"><b><?= $child['username'] ?></b> <small class="ml-2 text-dark" style="margin-left: 4px; padding : 0 10px; border-left : 1px solid black"><span><?= $child['created_at'] ?></span> </small> <?php if ($child['RFI'] == 1) : ?> <small class="ml-2 text-dark" style="margin-left: 4px; padding : 0 10px; border-left : 1px solid black"><span class="btn btn-primary btn-sm">RFI</span> </small><?php endif ?></h6>
                                                                <div><?= $child['comment'] ?></div>
                                                            </div>
                                                        </div>
                                                        <?php if ($child['user_id'] == current_user()->id) : ?>
                                                            <div>

                                                                <a class="deleteComment" href="" id="<?= $child['id'] ?>"><i class="bx bx-trash text-danger"></i></a>
                                                                <a class="editCommentbtn" href="" id="<?= $child['id'] ?>"><i class="bx bx-edit text-primary"></i></a>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                    <div class="editcomment">

                                                        <form action="<?= site_url('ClientProject/EditComment/' . $child['id'] . '') ?>" id="editcomment" method="post">

                                                            <div class="col-lg-12 my-2">
                                                                <div class="form-group">

                                                                    <label for="commentreply">Comment Update</label>
                                                                    <textarea name="commentreply" id="commentreply" style="height: 100px" class="form-control" placeholder="Comment" required><?= $child['comment'] ?></textarea>

                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-12 text-end my-2">
                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="text-end">
                                                        <a href="" class="comment_reply btn ">Reply</a>
                                                    </div>
                                                    <div class="comment-form">

                                                        <form action="<?= site_url('ClientProject/replyComment/' . $project[0]['Id'] . '/' . $child['id'] . '') ?>" id="commentreply_form" method="post">

                                                            <div class="col-lg-12 my-2">
                                                                <div class="form-group">

                                                                    <label for="commentreply">Comment Reply</label>
                                                                    <textarea name="commentreply" id="commentreply" style="height: 100px" class="form-control" placeholder="Comment" required></textarea>

                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="project_name" value="<?= $project[0]['Project_Name'] ?>">
                                                            <input type="hidden" name="clientname" value="<?= $project[0]['clientId'] ?>">
                                                            <div class="row">
                                                                <div class="col-12 text-end my-2">
                                                                    <button type="submit" class="btn btn-primary">Reply <i class='bx bx-send'></i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <?php foreach ($subcomments as $subchild) : ?>
                                                        <?php if ($subchild['parentComment_id'] === $child['id']) : ?>
                                                            <div class="mt-3 bg-white" style="margin-left : 25px;">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex">
                                                                        <div>
                                                                            <img src="<?= site_url($subchild['profile_image']) ?>" alt="" style="width : 30px; border-radius : 50%;">
                                                                        </div>
                                                                        <div style="margin-left : 15px">
                                                                            <h6 class="text-black" style="margin-bottom : 3px !important;"><b><?= $subchild['username'] ?></b> <small class="ml-2 text-dark" style="margin-left: 4px; padding : 0 10px; border-left : 1px solid black"><span><?= $subchild['created_at'] ?></span> </small> <?php if ($subchild['RFI'] == 1) : ?> <small class="ml-2 text-dark" style="margin-left: 4px; padding : 0 10px; border-left : 1px solid black"><span class="btn btn-primary btn-sm">RFI</span> </small><?php endif ?></h6>
                                                                            <div><?= $subchild['comment'] ?></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php if ($subchild['user_id'] == current_user()->id || current_userRole()->name == 'Admin') : ?>
                                                                        <div>

                                                                            <a class="deleteComment" href="" id="<?= $subchild['id'] ?>"><i class="bx bx-trash text-danger"></i></a>
                                                                            <a class="editCommentbtn" href="" id="<?= $subchild['id'] ?>"><i class="bx bx-edit text-primary"></i></a>
                                                                        </div>
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="editcomment">

                                                                    <form action="<?= site_url('ClientProject/EditComment/' . $subchild['id'] . '') ?>" id="editcomment" method="post">

                                                                        <div class="col-lg-12 my-2">
                                                                            <div class="form-group">

                                                                                <label for="commentreply">Comment Update</label>
                                                                                <textarea name="commentreply" id="commentreply" style="height: 100px" class="form-control" placeholder="Comment" required><?= $subchild['comment'] ?></textarea>

                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-12 text-end my-2">
                                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="text-end">
                                                                    <a href="" class="comment_reply btn ">Reply</a>
                                                                </div>
                                                                <div class="comment-form">

                                                                    <form action="<?= site_url('ClientProject/replyComment/' . $project[0]['Id'] . '/' . $child['id'] . '') ?>" id="commentreply_form" method="post">

                                                                        <div class="col-lg-12 my-2">
                                                                            <div class="form-group">

                                                                                <label for="commentreply">Comment Reply</label>
                                                                                <textarea name="commentreply" id="commentreply" style="height: 100px" class="form-control" placeholder="Comment" required></textarea>

                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="project_name" value="<?= $project[0]['Project_Name'] ?>">
                                                                        <div class="row">
                                                                            <div class="col-12 text-end my-2">
                                                                                <button type="submit" class="btn btn-primary">Reply <i class='bx bx-send'></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>


                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>


                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </div>



                                </div>
                            </li>
                        <?php endif ?>

                    <?php endforeach ?>




                </ul>
            </div>
        </div>

    </div>

</div>



<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="<?= site_url("public/assets/vendor/libs/datatables/jquery.dataTables.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive/datatables.responsive.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons/datatables-buttons.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js") ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="modal fade" id="deliverProject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Deliver Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deliver-project" method="post" action="<?= site_url('ClientProject/deliverProject/' . $project[0]['Id'] . '') ?>" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row g-2">
                        <div class="form-floating">
                            <input type="file" class="form-control lump-sum-check" id="deliver_file" name="deliver_file[]" placeholder="" required multiple>
                            <label for="deliver_file">File</label>
                            <span></span>
                        </div>

                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="1" id="reviewed" name="reviewed" required>
                        <label class="form-check-label" for="reviewed">
                            Reviewed
                        </label>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="deliver-project" id="deliver-project" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="addfile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deliver-project" method="post" action="<?= site_url('ClientProject/Addfiles/' . $project[0]['Id'] . '') ?>" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="col-lg-12 my-2">
                        <div class="form-floating">
                            <input type="file" class="form-control lump-sum-check" id="project_file" name="project_file[]" placeholder="" multiple>
                            <label for="project_file_1">Project Plan File</label>
                        </div>
                        <?php if (!empty($project[0]['Project_file'])) : ?>
                            <div class="d-flex">
                                <?php $f = 1;
                                foreach ($project[0]['Project_file'] as $pf_value) : ?>
                                    <?php if (!empty($pf_value)) : ?>
                                        <div class="ml-3 mt-3 bg-primary p-1 rounded">

                                            <a href="<?= site_url($pf_value) ?>" target="_blank" class="text-white">File <?= $f ?></a>
                                            <button type="button" class="btn-close btn-close-white close_file remove_file" aria-label="Close"></button>
                                            <input type="hidden" name="previous_file[]" value="<?= $pf_value ?>">
                                        </div>
                                    <?php endif ?>
                                <?php $f++;
                                endforeach ?>

                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-lg-12 my-2">
                        <div class="form-floating">
                            <input type="text" class="form-control lump-sum-check" id="project_file_link" <?php if (!empty($project[0]['project_file_link'])) : ?> <?php $projectfileLinks = join(",", $project[0]['project_file_link']) ?> value="<?= $projectfileLinks ?>" ; <?php endif ?> name="project_file_link" placeholder="" required>
                            <label for="project_file_link">Project Plan File Link(Multiple with , separated)</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="deliver-project" id="deliver-project" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="assignProject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Assign Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submit-form-assign-project" method="post" action="<?= site_url('ClientProject/assignProject') ?>">
                <div class="modal-body">

                    <div class="row g-2">
                        <div class="col-lg-12 mb-1">
                            <label for="assign-project" class="form-label">Assign Project</label>
                            <select class="select2 form-select" id="assign-project" name="assign-user[]" required multiple>

                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" name="CanViewFile" value="1" id="CanViewFile">
                                <label class="form-check-label" for="CanViewFile">Can View File</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-check my-2">
                                <input class="form-check-input" type="checkbox" name="CanViewFileUrl" value="1" id="CanViewFileUrl">
                                <label class="form-check-label" for="CanViewFileUrl"> Can View FileUrl</label>
                            </div>
                        </div>
                        <input type="hidden" value='<?= $project[0]['Id'] ?>' name='projectid' id='projectid'>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="assign-project" id="assign-project" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="worklog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Work Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="progressProject" method="post" action="<?= site_url('ProjectProgress/new/' . $project[0]['Id'] . '') ?>" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row g-2">

                        <div class="col-lg-12 mb-1">
                            <div>Progress</div>
                            <div class="range-wrap">

                                <div class="range-value" id="rangeV"></div>
                                <input id="range" type="range" name="range" min="<?= $employeeprogress ?>" value="<?= $employeeprogress ?>" max="100" value="" step="1" required>
                            </div>
                        </div>
                        <div>Time Spend</div>
                        <div class="col-lg-6 mb-1">
                            <div class="form-floating">
                                <input type="datetime-local" min="" class="form-control" id="start_time" name="start_time" required>
                                <label for="start_time">Start Time</label>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-1">
                            <div class="form-floating">
                                <input type="datetime-local" min="" class="form-control" id="end_time" name="end_time" required>
                                <label for="end_time">End Time</label>
                            </div>
                        </div>

                        <div class="form-floating">
                            <input type="file" class="form-control lump-sum-check" id="progress_file" name="progress_file[]" placeholder="" required multiple>
                            <label for="progress_file">File</label>
                            <span></span>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" id="notes" style="height: 100px" class="form-control" placeholder="Notes"></textarea>

                        </div>

                        <input type="hidden" value='<?= $project[0]['Id'] ?>' name='projectid' id='projectid'>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="assign-project" id="assign-project" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="rejectandreview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Reason for Rejection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submit-form-review" method="post" action="<?= site_url('ClientProject/rejectProject/' . $project[0]['Id'] . '') ?>">
                <div class="modal-body">

                    <div class="row g-2">
                        <div class="form-group">
                            <label for="project-file-link">Reason for Rejection</label>
                            <textarea name="review" id="review" style="height: 100px" class="form-control" placeholder="Reason for Rejection" required></textarea>

                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="assign-project" id="assign-project" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        <?php if (current_userRole()->name == 'Admin') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(2)").addClass("open active");
            $(".menu-inner>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php endif ?>
        <?php if (current_userRole()->name == 'Client') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(2)").addClass("open active");
            $(".menu-inner>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php endif ?>
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
        $('.alert').alert()




        $('.datatables-basic').DataTable({
            order: [
                [0, 'desc']
            ],
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],

        });





        $("#comment_form").validate();
        $("#deliver-project").validate();
        $("#editcomment").validate();
        $("#commentreply_form").validate();
        $("#submit-form-assign-project").validate();
        $("#submit-form-review").validate();


        var startTimeInput = $('#start_time');
        var endTimeInput = $('#end_time');

        // Add validation rule for end time greater than start time
        $.validator.addMethod('endgreaterthan', function(value, element, param) {
            var startDateTime = new Date(startTimeInput.val());
            var endDateTime = new Date(value);
            console.log(endDateTime);
            return startDateTime < endDateTime;
        }, 'End time must be greater than start time.');

        // 

        $("#progressProject").validate({
            rules: {
                end_time: {
                    required: true,
                    endgreaterthan: true
                },
                'progress_file[]': {
                    required: function(element) {
                        return $('#range').val() == 100;
                    }
                }
            },
            messages: {
                end_time: {
                    required: 'Please enter an end time.',
                    greaterthan: 'End time must be greater than start time.'
                },
                'progress_file[]': {
                    required: 'File required When progress is 100%',
                }
            }
        });


        $(document).on('click', '.assign_project', function() {
            let projectid = $('#projectid').val();
            console.log(projectid);

            $.ajax({
                url: '<?= site_url("ClientProject/getusersforassignproject") ?>',
                method: 'post',
                data: {
                    projectid: projectid,
                },
                success: function(response) {
                    $('#assign-project').html('');
                    $.each(response.allusers, function(key, value) {
                        console.log(value['id']);
                        $('#assign-project').append('<option value="' + value['id'] + '">' + value['username'] + ' (' + value['name'] + ')</option>');
                    });
                }

            });
        });
        $('.select2').select2();
        $('.comment-form').hide();
        $('.editcomment').hide();
        $(document).on('click', '.comment_reply', function(e) {
            e.preventDefault();
            // $('.comment-form').hide();
            $(this).parent().next('.comment-form').toggle();
        });
        $(document).on('click', '.editCommentbtn', function(e) {
            e.preventDefault();
            // $('.comment-form').hide();
            $(this).parent().parent().next('.editcomment').toggle();
        });


        // sweet alert for delete assign memeber
        $(document).on('click', '.deleteAssign', function(e) {
            e.preventDefault();
            var user_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                html: "On deleting the assign user all the progress of the user is deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?= site_url('ClientProject/deleleAssignUser/' . $project[0]['Id'] . '') ?>',
                        type: 'get',
                        data: {
                            delete_id: user_id
                        },
                        success: function(response) {
                            swal.fire("Deleted", response.status, "success").then(function() {
                                location.reload();
                            });
                        }
                    });

                }
            })
        });


        // sweet alert for delete comment
        $(document).on('click', '.deleteComment', function(e) {
            e.preventDefault();
            var comment_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                html: "Could You want to Delete the Comment!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?= site_url('ClientProject/deleteComment/') ?>',
                        type: 'get',
                        data: {
                            delete_id: comment_id
                        },
                        success: function(response) {
                            swal.fire("Deleted", response.status, "success").then(function() {
                                location.reload();
                            });
                        }
                    });

                }
            })
        });









        // When the "Download file Zip" button is clicked
        $(".download_zip").click(function(e) {
            e.preventDefault();
            // Create a new instance of JSZip
            const zip = new JSZip();

            // Create an array of Promises that fetch the file content and add it to the zip file
            const promises = $(".progressfile").map(function() {
                const fileUrl = $(this).attr("href");
                const fileName = fileUrl.substring(fileUrl.lastIndexOf('/') + 1);

                return new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', fileUrl, true);
                    xhr.responseType = 'blob';
                    xhr.onload = () => {
                        if (xhr.status === 200) {
                            const blob = xhr.response;
                            zip.file(fileName, blob);
                            resolve();
                        } else {
                            reject(xhr.statusText);
                        }
                    };
                    xhr.onerror = () => reject('Network error');
                    xhr.send();
                });
            }).get();

            // Wait for all the Promises to resolve before generating the zip file
            Promise.all(promises).then(() => {
                // Generate the zip file and initiate the download
                zip.generateAsync({
                    type: "blob"
                }).then(function(content) {
                    const tempLink = document.createElement('a');
                    tempLink.download = '<?= $project[0]['Project_Name'] ?>.zip';
                    tempLink.href = URL.createObjectURL(content);
                    document.body.appendChild(tempLink);
                    tempLink.click();
                    document.body.removeChild(tempLink);
                });
            });
        });


        $(document).on('click', '.remove_file', function() {
            $(this).parent().remove();
        })



    });
    // js for the range 
    const
        range = document.getElementById('range'),
        rangeV = document.getElementById('rangeV'),
        setValue = () => {
            const
                newValue = Number((range.value - range.min) * 100 / (range.max - range.min)),
                newPosition = 10 - (newValue * 0.2);
            rangeV.innerHTML = `<span>${range.value}</span>`;
            rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
        };
    document.addEventListener("DOMContentLoaded", setValue);
    range.addEventListener('input', setValue);
</script>
<script src="<?= site_url("public/assets/js/forms-selects.js") ?>"></script>
<?= $this->endSection() ?>