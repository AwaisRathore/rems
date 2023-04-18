<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | All Project <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/Select2/css/select2.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row">
    <div>
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <div class="d-flex">
                    <div class="form-group w-100">
                        <input type="text" class="form-control mb-3" id="project-name" placeholder="Search Project by Name">
                    </div>
                    <div class="px-2">
                        <button type="button" id="search-project" class="btn btn-primary d-flex align-items-center"><i class='bx bx-search-alt-2' style="margin-right : 5px"></i> Search</button>

                    </div>
                    <div class="">
                        <button type="button" id="reset-project" class="btn btn-danger" style="display: none;">
                            <div class="d-flex align-items-center"><i class='bx bx-reset' style="margin-right : 5px"></i> Reset</div>
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="col-12">
        <input type="hidden" id="questions" name="questions[]" value="">
        <div class="nav-align-top mb-4">

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#all-project" aria-controls="all-project" aria-selected="true">
                        All Project
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#inprogress-project" aria-controls="inprogress-project" aria-selected="false">
                        In-progress Project
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#complete-project" aria-controls="complete-project" aria-selected="false">
                        Completed Project
                    </button>
                </li>
                <?php if (current_userRole()->name != 'Employee') : ?>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#not-qouted" aria-controls="not-qouted" aria-selected="false">
                            Not Qouted
                        </button>
                    </li>
                <?php endif ?>
                <?php if (current_userRole()->name != 'Employee') : ?>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#Awating-Qoutation-Acceptance" aria-controls="Awating-Qoutation-Acceptance" aria-selected="false">
                            Awaiting Quotation Acceptance
                        </button>
                    </li>
                <?php endif ?>
            </ul>
            <div class="tab-content bg-lightgray">
                <!-- All project Content Start -->
                <div class="tab-pane fade show active" id="all-project" role="tabpanel">
                    <div class="row" id="project-list">
                        <?php foreach ($clientproject as $value) : ?>
                            <?php
                            if ($value['quotationStatus'] != 0) :
                            ?>

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-5">

                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <span class="small text-muted project_name fw-bold">
                                                    <?php
                                                    foreach ($ProjectScopes as $projectscope) {
                                                        if ($projectscope['Project_Id'] == $value['Id']) {
                                                            echo $projectscope['Type_Names'] . "<br>";
                                                        }
                                                    } ?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <div class="lesson_name">
                                                    <div class="
                                                <?php
                                                foreach ($ProjectScopes as $projectscope) {
                                                    if ($projectscope['Project_Id'] == $value['Id']) {

                                                        if ($projectscope['Type_Names'] == 'Castings' || $projectscope['Type_Names'] == 'All Concrete Except Curb') {
                                                            echo "light-success-bg ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Polish Concrete' || $projectscope['Type_Names'] == 'Piping' || $projectscope['Type_Names'] == 'pipings') {
                                                            echo "light-warning-bg  ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Hatches & Modular Retaining Walls Takeoffs' || $projectscope['Type_Names'] == 'All Trades Including MEP') {
                                                            echo "light-danger-bg ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Erosion & Sediment Control' || $projectscope['Type_Names'] == 'Earthwork - Cut/Fill Analysis' || $projectscope['Type_Names'] == 'Flooring') {
                                                            echo "bg-lightgreen ";
                                                            break;
                                                        } else {
                                                            echo "bg-lightgreen ";
                                                            break;
                                                        }
                                                    }
                                                } ?>
                                                
                                                project-block">
                                                        <img src="<?= site_url('public/assets/img/icons/briefing.png') ?>" alt="">
                                                    </div>

                                                    <h6 class="mb-0 fw-bold  fs-6  mb-2"><?= $value['Project_Name'] ?></h6>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="<?= site_url("ClientProject/view/" . $value['Id'] . "") ?>" class="btn btn-outline-secondary"><i class='bx bx-info-circle text-info'></i></a>

                                                    <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                                        <?php if (current_userRole()->CanEditClientProject) : ?>
                                                            <a class="btn btn-outline-secondary" href="<?= site_url('ClientProject/edit/' . $value['Id'] . '') ?>"><i class="bx bx-edit-alt text-success"></i></a>
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->CanDeleteClientProject) : ?>
                                                            <a class="btn btn-outline-secondary deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash text-danger"></i></a>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') : ?>
                                                    <div class="avatar-list avatar-list-stacked pt-2">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($assignproject as $assignprojects) {
                                                            if ($assignprojects['project_id'] == $value['Id']) { ?>
                                                                <img class="avatar rounded-circle sm" src="<?= site_url($assignprojects['profile_image']) ?>" alt="">';
                                                        <?php

                                                                $count++;
                                                            }
                                                        }
                                                        ?>
                                                        <?php if (current_userRole()->CanAssignProject) : ?>
                                                            <span class="avatar rounded-circle text-center pointer sm" id=<?= $value['Id'] ?> data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span>
                                                        <?php endif ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (current_userRole()->name == 'Client') : ?>
                                                    <Span class="">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($assignproject as $assignprojects) {
                                                            if ($assignprojects['project_id'] == $value['Id']) {
                                                                $count++;
                                                            }
                                                        }

                                                        if ($count != 0) {
                                                            echo "Assign for " . $value['project_type'] . "";
                                                        }
                                                        ?>
                                                    </span>

                                                <?php endif ?>

                                            </div>
                                            <div class="row g-2 pt-4">
                                                <?php if (!empty($value['Project_file'])) : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bx bx-paperclip"></i>
                                                            <span class="ms-2"><a href="<?php if ($value['Project_file'][0] != '') : ?>
                                                    <?= site_url($value['Project_file'][0]) ?> <?php else : ?><?= $value['project_file_link'][0] ?><?php endif ?>" class="file_link" target="_blank">View File</a></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-time-five'></i>
                                                        <span class="ms-2"><?= $value['Delivery_Date'] ?></span>
                                                    </div>
                                                </div>
                                                <?php if (!empty($value['project_type'])) : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-clipboard'></i>
                                                            <span class="ms-2"><?= $value['project_type'] ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (current_userRole()->name != 'Employee') : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-purchase-tag'></i>
                                                            <span class="ms-2"><?php if ($value['Lump_Sump_Charges'] == 0) {
                                                                                    echo "Not Qouted";
                                                                                } else {
                                                                                    echo "$" . $value['Lump_Sump_Charges'];
                                                                                }
                                                                                ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-loader-alt'></i>
                                                        <span class="ms-2 <?php if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                                echo "text-lightgreen";
                                                                            } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                                echo "text-danger-bg";
                                                                            } else if ($value['projectStatus'] == 0) {
                                                                                echo "text-lightgreen";
                                                                            } elseif ($value['projectStatus'] == 1) {
                                                                                echo "text-success-bg";
                                                                            }
                                                                            ?> ">
                                                            <?php
                                                            if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                echo "In-review";
                                                            } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                echo "Late";
                                                            } else if ($value['projectStatus'] == 0 && $count == 0) {
                                                                echo "Not Assign";
                                                            } else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
                                                                echo "Delivered";
                                                            } else if ($value['projectStatus'] == 0  && $count > 0) {
                                                                echo "In-progress";
                                                            } else if ($value['projectStatus'] == 1) {
                                                                echo "Completed";
                                                            } ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php if (current_userRole()->name != 'Employee') : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">


                                                            <?php if (current_userRole()->name == 'Admin') : ?>
                                                                <i class='bx bxs-badge-dollar'></i>
                                                                <span class="ms-2">
                                                                    <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                </span>
                                                            <?php endif ?>
                                                            <?php if (current_userRole()->name == 'Client') : ?>
                                                                <?php if ($value['Lump_Sump_Charges'] != 0) : ?>
                                                                    <i class='bx bxs-badge-dollar'></i>
                                                                    <span class="ms-2">
                                                                        <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                    </span>
                                                                <?php endif ?>
                                                            <?php endif ?>

                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <?php
                                                $assigncount = 0;
                                                foreach ($assignproject as $assignprojects) {
                                                    if ($assignprojects['project_id'] == $value['Id'] && $assignprojects['status'] == 1) {
                                                        $assigncount++;
                                                    }
                                                }
                                                ?>
                                                <?php
                                                $total_progress = 0;
                                                $i = 0;
                                                foreach ($totalprojectprogress as $projectProgress) {
                                                    if ($projectProgress['project_id'] == $value['Id']) {
                                                        $total_progress += $projectProgress['avg_max_progress'];
                                                        $i++;
                                                    }
                                                }
                                                if ($assigncount == 0) {
                                                    $total_progress = 0;
                                                } else {
                                                    $total_progress = $total_progress / $assigncount;
                                                }

                                                ?>
                                                <?php if ($total_progress != 0) : ?>
                                                    <div class="pt-2">


                                                        <div class="progress">
                                                            <div class="progress-bar
                                                             <?php if ($total_progress <= 20) {
                                                                    echo "bg-warning";
                                                                } else if ($total_progress < 100 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                    echo "bg-danger";
                                                                } else if ($total_progress <= 50) {
                                                                    echo "bg-info";
                                                                } else if ($total_progress > 50 && $total_progress < 100) {
                                                                    echo "bg-primary";
                                                                } else if ($total_progress == 100) {
                                                                    echo "bg-success";
                                                                } ?>" role="progressbar" style="width: <?= $total_progress ?>%;" aria-valuenow="<?= $total_progress ?>" aria-valuemin="0" aria-valuemax="100"><?= round($total_progress, 2) ?>%</div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                            <?php endif ?>


                        <?php endforeach ?>



                    </div>
                    <?php if(count($clientproject) > 11 ): ?>
                    <div class="pt-3 text-center">
                        <button id="load-more-project" data-offset = '<?= count($clientproject) ?>' class="btn btn-primary load-more">Load More</button>
                    </div>
                    <?php endif ?>

                </div>
                <!-- All project Content End -->
                <!-- In progress project Content Start -->
                <div class="tab-pane fade" id="inprogress-project" role="tabpanel">

                    <div class="row" id="inprogress-project-list">
                        <?php foreach ($clientinprogressproject as $value) : ?>
                            <?php if ($value['quotationStatus'] != 0 && $value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] != 0 && $value['user_id'] != null) : ?>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-5">

                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <span class="small text-muted project_name fw-bold">
                                                    <?php
                                                    foreach ($ProjectScopes as $projectscope) {
                                                        if ($projectscope['Project_Id'] == $value['Id']) {
                                                            echo $projectscope['Type_Names'] . "<br>";
                                                        }
                                                    } ?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <div class="lesson_name">
                                                    <div class="
                                                    <?php
                                                    foreach ($ProjectScopes as $projectscope) {
                                                        if ($projectscope['Project_Id'] == $value['Id']) {

                                                            if ($projectscope['Type_Names'] == 'Castings' || $projectscope['Type_Names'] == 'All Concrete Except Curb') {
                                                                echo "light-success-bg ";
                                                                break;
                                                            } else if ($projectscope['Type_Names'] == 'Polish Concrete' || $projectscope['Type_Names'] == 'Piping' || $projectscope['Type_Names'] == 'pipings') {
                                                                echo "light-warning-bg  ";
                                                                break;
                                                            } else if ($projectscope['Type_Names'] == 'Hatches & Modular Retaining Walls Takeoffs' || $projectscope['Type_Names'] == 'All Trades Including MEP') {
                                                                echo "light-danger-bg ";
                                                                break;
                                                            } else if ($projectscope['Type_Names'] == 'Erosion & Sediment Control' || $projectscope['Type_Names'] == 'Earthwork - Cut/Fill Analysis' || $projectscope['Type_Names'] == 'Flooring') {
                                                                echo "bg-lightgreen ";
                                                                break;
                                                            } else {
                                                                echo "bg-lightgreen ";
                                                                break;
                                                            }
                                                        }
                                                    } ?>
                                                project-block">
                                                        <img src="<?= site_url('public/assets/img/icons/briefing.png') ?>" alt="">
                                                    </div>

                                                    <h6 class="mb-0 fw-bold  fs-6  mb-2"><?= $value['Project_Name'] ?></h6>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="<?= site_url("ClientProject/view/" . $value['Id'] . "") ?>" class="btn btn-outline-secondary"><i class='bx bx-info-circle text-info'></i></a>

                                                    <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                                        <?php if (current_userRole()->CanEditClientProject) : ?>
                                                            <a class="btn btn-outline-secondary" href="<?= site_url('ClientProject/edit/' . $value['Id'] . '') ?>"><i class="bx bx-edit-alt text-success"></i></a>
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->CanDeleteClientProject) : ?>
                                                            <a class="btn btn-outline-secondary deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash text-danger"></i></a>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') : ?>
                                                    <div class="avatar-list avatar-list-stacked pt-2">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($assignproject as $assignprojects) {
                                                            if ($assignprojects['project_id'] == $value['Id']) { ?>
                                                                <img class="avatar rounded-circle sm" src="<?= site_url($assignprojects['profile_image']) ?>" alt="">';
                                                        <?php

                                                                $count++;
                                                            }
                                                        }
                                                        ?>
                                                        <?php if (current_userRole()->CanAssignProject) : ?>
                                                            <span class="avatar rounded-circle text-center pointer sm" id=<?= $value['Id'] ?> data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span>
                                                        <?php endif ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (current_userRole()->name == 'Client') : ?>
                                                    <Span class="">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($assignproject as $assignprojects) {
                                                            if ($assignprojects['project_id'] == $value['Id']) {
                                                                $count++;
                                                            }
                                                        }

                                                        if ($count != 0) {
                                                            echo "Assign for " . $value['project_type'] . "";
                                                        }
                                                        ?>
                                                    </span>

                                                <?php endif ?>

                                            </div>
                                            <div class="row g-2 pt-4">
                                                <?php if (!empty($value['Project_file'])) : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bx bx-paperclip"></i>
                                                            <span class="ms-2"><a href="<?php if ($value['Project_file'][0] != '') : ?>
                                                    <?= site_url($value['Project_file'][0]) ?> <?php else : ?><?= $value['project_file_link'][0] ?><?php endif ?>" class="file_link" target="_blank">View File</a></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-time-five'></i>
                                                        <span class="ms-2"><?= $value['Delivery_Date'] ?></span>
                                                    </div>
                                                </div>
                                                <?php if (!empty($value['project_type'])) : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-clipboard'></i>
                                                            <span class="ms-2"><?= $value['project_type'] ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (current_userRole()->name != 'Employee') : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-purchase-tag'></i>
                                                            <span class="ms-2"><?php if ($value['Lump_Sump_Charges'] == 0) {
                                                                                    echo "Not Qouted";
                                                                                } else {
                                                                                    echo "$" . $value['Lump_Sump_Charges'];
                                                                                }
                                                                                ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-loader-alt'></i>
                                                        <span class="ms-2 <?php if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                                echo "text-lightgreen";
                                                                            } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                                echo "text-danger-bg";
                                                                            } else if ($value['projectStatus'] == 0) {
                                                                                echo "text-lightgreen";
                                                                            } else {
                                                                                echo "text-success-bg";
                                                                            }
                                                                            ?> ">
                                                            <?php
                                                            if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                echo "In-review";
                                                            } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                echo "Late";
                                                            } else if ($value['projectStatus'] == 0 && $count == 0) {
                                                                echo "Not Assign";
                                                            } else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
                                                                echo "Delivered";
                                                            } else if ($value['projectStatus'] == 0  && $count > 0) {
                                                                echo "In-progress";
                                                            } else if ($value['projectStatus'] == 1) {
                                                                echo "Completed";
                                                            } ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php if (current_userRole()->name != 'Employee') : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">


                                                            <?php if (current_userRole()->name == 'Admin') : ?>
                                                                <i class='bx bxs-badge-dollar'></i>
                                                                <span class="ms-2">
                                                                    <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                </span>
                                                            <?php endif ?>
                                                            <?php if (current_userRole()->name == 'Client') : ?>
                                                                <?php if ($value['Lump_Sump_Charges'] != 0) : ?>
                                                                    <i class='bx bxs-badge-dollar'></i>
                                                                    <span class="ms-2">
                                                                        <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                    </span>
                                                                <?php endif ?>
                                                            <?php endif ?>

                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <?php
                                                $assigncount = 0;
                                                foreach ($assignproject as $assignprojects) {
                                                    if ($assignprojects['project_id'] == $value['Id'] && $assignprojects['status'] == 1) {
                                                        $assigncount++;
                                                    }
                                                }
                                                ?>
                                                <?php
                                                $total_progress = 0;
                                                $i = 0;
                                                foreach ($totalprojectprogress as $projectProgress) {
                                                    if ($projectProgress['project_id'] == $value['Id']) {
                                                        $total_progress += $projectProgress['avg_max_progress'];
                                                        $i++;
                                                    }
                                                }
                                                if ($assigncount == 0) {
                                                    $total_progress = 0;
                                                } else {
                                                    $total_progress = $total_progress / $assigncount;
                                                }

                                                ?>
                                                <?php if ($total_progress != 0) : ?>
                                                    <div class="pt-2">


                                                        <div class="progress">
                                                            <div class="progress-bar
                                                             <?php if ($total_progress <= 20) {
                                                                    echo "bg-warning";
                                                                } else if ($total_progress < 100 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                    echo "bg-danger";
                                                                } else if ($total_progress <= 50) {
                                                                    echo "bg-info";
                                                                } else if ($total_progress > 50 && $total_progress < 100) {
                                                                    echo "bg-primary";
                                                                } else if ($total_progress == 100) {
                                                                    echo "bg-success";
                                                                } ?>" role="progressbar" style="width: <?= $total_progress ?>%;" aria-valuenow="<?= $total_progress ?>" aria-valuemin="0" aria-valuemax="100"><?= round($total_progress, 2) ?>%</div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                    <?php if(count($clientinprogressproject) > 11 ): ?>
                    <div class="pt-3 text-center">
                        <button id="load-more-inproject" data-offset = '<?= count($clientinprogressproject) ?>' class="btn btn-primary load-more">Load More</button>
                    </div>
                    <?php endif ?>
                </div>
                <!-- In progress project Content End -->
                <!-- Completed project Content Start-->
                <div class="tab-pane fade" id="complete-project" role="tabpanel">
                    <div class="row" id="complete-project-list">
                        <?php foreach ($completedproject as $value) : ?>
                            <?php if ($value['projectStatus'] == 1) : ?>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-5">

                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <span class="small text-muted project_name fw-bold">
                                                    <?php
                                                    foreach ($ProjectScopes as $projectscope) {
                                                        if ($projectscope['Project_Id'] == $value['Id']) {
                                                            echo $projectscope['Type_Names'] . "<br>";
                                                        }
                                                    } ?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-3">
                                                <div class="lesson_name">
                                                    <div class="
                                                    <?php
                                                    foreach ($ProjectScopes as $projectscope) {
                                                        if ($projectscope['Project_Id'] == $value['Id']) {

                                                            if ($projectscope['Type_Names'] == 'Castings' || $projectscope['Type_Names'] == 'All Concrete Except Curb') {
                                                                echo "light-success-bg ";
                                                                break;
                                                            } else if ($projectscope['Type_Names'] == 'Polish Concrete' || $projectscope['Type_Names'] == 'Piping' || $projectscope['Type_Names'] == 'pipings') {
                                                                echo "light-warning-bg  ";
                                                                break;
                                                            } else if ($projectscope['Type_Names'] == 'Hatches & Modular Retaining Walls Takeoffs' || $projectscope['Type_Names'] == 'All Trades Including MEP') {
                                                                echo "light-danger-bg ";
                                                                break;
                                                            } else if ($projectscope['Type_Names'] == 'Erosion & Sediment Control' || $projectscope['Type_Names'] == 'Earthwork - Cut/Fill Analysis' || $projectscope['Type_Names'] == 'Flooring') {
                                                                echo "bg-lightgreen ";
                                                                break;
                                                            } else {
                                                                echo "bg-lightgreen ";
                                                                break;
                                                            }
                                                        }
                                                    } ?>
                                                
                                                project-block">
                                                        <img src="<?= site_url('public/assets/img/icons/briefing.png') ?>" alt="">
                                                    </div>

                                                    <h6 class="mb-0 fw-bold  fs-6  mb-2"><?= $value['Project_Name'] ?></h6>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="<?= site_url("ClientProject/view/" . $value['Id'] . "") ?>" class="btn btn-outline-secondary"><i class='bx bx-info-circle text-info'></i></a>

                                                    <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                                        <?php if (current_userRole()->CanEditClientProject) : ?>
                                                            <a class="btn btn-outline-secondary" href="<?= site_url('ClientProject/edit/' . $value['Id'] . '') ?>"><i class="bx bx-edit-alt text-success"></i></a>
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->CanDeleteClientProject) : ?>
                                                            <a class="btn btn-outline-secondary deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash text-danger"></i></a>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') : ?>
                                                    <div class="avatar-list avatar-list-stacked pt-2">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($assignproject as $assignprojects) {
                                                            if ($assignprojects['project_id'] == $value['Id']) { ?>
                                                                <img class="avatar rounded-circle sm" src="<?= site_url($assignprojects['profile_image']) ?>" alt="">';
                                                        <?php

                                                                $count++;
                                                            }
                                                        }
                                                        ?>
                                                        <?php if (current_userRole()->CanAssignProject) : ?>
                                                            <span class="avatar rounded-circle text-center pointer sm" id=<?= $value['Id'] ?> data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span>
                                                        <?php endif ?>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (current_userRole()->name == 'Client') : ?>
                                                    <Span class="">
                                                        <?php
                                                        $count = 0;
                                                        foreach ($assignproject as $assignprojects) {
                                                            if ($assignprojects['project_id'] == $value['Id']) {
                                                                $count++;
                                                            }
                                                        }

                                                        if ($count != 0) {
                                                            echo "Assign for " . $value['project_type'] . "";
                                                        }
                                                        ?>
                                                    </span>

                                                <?php endif ?>

                                            </div>
                                            <div class="row g-2 pt-4">
                                                <?php if (!empty($value['Project_file'])) : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bx bx-paperclip"></i>
                                                            <span class="ms-2"><a href="<?php if ($value['Project_file'][0] != '') : ?>
                                                    <?= site_url($value['Project_file'][0]) ?> <?php else : ?><?= $value['project_file_link'][0] ?><?php endif ?>" class="file_link" target="_blank">View File</a></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-time-five'></i>
                                                        <span class="ms-2"><?= $value['Delivery_Date'] ?></span>
                                                    </div>
                                                </div>
                                                <?php if (!empty($value['project_type'])) : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-clipboard'></i>
                                                            <span class="ms-2"><?= $value['project_type'] ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <?php if (current_userRole()->name != 'Employee') : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-purchase-tag'></i>
                                                            <span class="ms-2"><?php if ($value['Lump_Sump_Charges'] == 0) {
                                                                                    echo "Not Qouted";
                                                                                } else {
                                                                                    echo "$" . $value['Lump_Sump_Charges'];
                                                                                }
                                                                                ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-loader-alt'></i>
                                                        <span class="ms-2 ">
                                                            <?php
                                                            if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                echo "In-review";
                                                            } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                echo "Late";
                                                            } else if ($value['projectStatus'] == 0 && $count == 0) {
                                                                echo "Not Assign";
                                                            } else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
                                                                echo "Delivered";
                                                            } else if ($value['projectStatus'] == 0  && $count > 0) {
                                                                echo "In-progress";
                                                            } else if ($value['projectStatus'] == 1) {
                                                                echo "Completed";
                                                            } ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <?php if (current_userRole()->name != 'Employee') : ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">


                                                            <?php if (current_userRole()->name == 'Admin') : ?>
                                                                <i class='bx bxs-badge-dollar'></i>
                                                                <span class="ms-2">
                                                                    <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                </span>
                                                            <?php endif ?>
                                                            <?php if (current_userRole()->name == 'Client') : ?>
                                                                <?php if ($value['Lump_Sump_Charges'] != 0) : ?>
                                                                    <i class='bx bxs-badge-dollar'></i>
                                                                    <span class="ms-2">
                                                                        <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                    </span>
                                                                <?php endif ?>
                                                            <?php endif ?>

                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                                <?php
                                                $assigncount = 0;
                                                foreach ($assignproject as $assignprojects) {
                                                    if ($assignprojects['project_id'] == $value['Id'] && $assignprojects['status'] == 1) {
                                                        $assigncount++;
                                                    }
                                                }
                                                ?>
                                                <?php
                                                $total_progress = 0;
                                                $i = 0;
                                                foreach ($totalprojectprogress as $projectProgress) {
                                                    if ($projectProgress['project_id'] == $value['Id']) {
                                                        $total_progress += $projectProgress['avg_max_progress'];
                                                        $i++;
                                                    }
                                                }
                                                if ($assigncount == 0) {
                                                    $total_progress = 0;
                                                } else {
                                                    $total_progress = $total_progress / $assigncount;
                                                }

                                                ?>
                                                <?php if ($total_progress != 0) : ?>
                                                    <div class="pt-2">


                                                        <div class="progress">
                                                            <div class="progress-bar
                                                             <?php if ($total_progress <= 20) {
                                                                    echo "bg-warning";
                                                                } else if ($total_progress < 100 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                    echo "bg-danger";
                                                                } else if ($total_progress <= 50) {
                                                                    echo "bg-info";
                                                                } else if ($total_progress > 50 && $total_progress < 100) {
                                                                    echo "bg-primary";
                                                                } else if ($total_progress == 100) {
                                                                    echo "bg-success";
                                                                } ?>" role="progressbar" style="width: <?= $total_progress ?>%;" aria-valuenow="<?= $total_progress ?>" aria-valuemin="0" aria-valuemax="100"><?= round($total_progress, 2) ?>%</div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                    <?php if(count($completedproject) > 11 ): ?>
                    <div class="pt-3 text-center">
                        <button id="load-more-complete-project" data-offset = '<?= count($completedproject) ?>' class="btn btn-primary load-more">Load More</button>
                    </div>
                    <?php endif ?>
                </div>

                <!-- Completed Content End -->
                <!-- Not Qouted Content Start-->
                <?php if (current_userRole()->name != 'Employee') : ?>
                    <div class="tab-pane fade" id="not-qouted" role="tabpanel">
                        <div class="row" id="not-qoute-project-list">
                            <?php foreach ($notquotedproject as $value) : ?>
                                <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-5">

                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <span class="small text-muted project_name fw-bold">
                                                        <?php
                                                        foreach ($ProjectScopes as $projectscope) {
                                                            if ($projectscope['Project_Id'] == $value['Id']) {
                                                                echo $projectscope['Type_Names'] . "<br>";
                                                            }
                                                        } ?></span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-3">
                                                    <div class="lesson_name">
                                                        <div class="
                                                <?php
                                                foreach ($ProjectScopes as $projectscope) {
                                                    if ($projectscope['Project_Id'] == $value['Id']) {

                                                        if ($projectscope['Type_Names'] == 'Castings' || $projectscope['Type_Names'] == 'All Concrete Except Curb') {
                                                            echo "light-success-bg ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Polish Concrete' || $projectscope['Type_Names'] == 'Piping' || $projectscope['Type_Names'] == 'pipings') {
                                                            echo "light-warning-bg  ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Hatches & Modular Retaining Walls Takeoffs' || $projectscope['Type_Names'] == 'All Trades Including MEP') {
                                                            echo "light-danger-bg ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Erosion & Sediment Control' || $projectscope['Type_Names'] == 'Earthwork - Cut/Fill Analysis' || $projectscope['Type_Names'] == 'Flooring') {
                                                            echo "bg-lightgreen ";
                                                            break;
                                                        } else {
                                                            echo "bg-lightgreen ";
                                                            break;
                                                        }
                                                    }
                                                } ?>
                                                
                                                project-block">
                                                            <img src="<?= site_url('public/assets/img/icons/briefing.png') ?>" alt="">
                                                        </div>

                                                        <h6 class="mb-0 fw-bold  fs-6  mb-2"><?= $value['Project_Name'] ?></h6>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="<?= site_url("ClientProject/view/" . $value['Id'] . "") ?>" class="btn btn-outline-secondary"><i class='bx bx-info-circle text-info'></i></a>

                                                        <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                                            <?php if (current_userRole()->CanEditClientProject) : ?>
                                                                <a class="btn btn-outline-secondary" href="<?= site_url('ClientProject/edit/' . $value['Id'] . '') ?>"><i class="bx bx-edit-alt text-success"></i></a>
                                                            <?php endif ?>
                                                            <?php if (current_userRole()->CanDeleteClientProject) : ?>
                                                                <a class="btn btn-outline-secondary deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash text-danger"></i></a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') : ?>
                                                        <div class="avatar-list avatar-list-stacked pt-2">
                                                            <?php
                                                            $count = 0;
                                                            foreach ($assignproject as $assignprojects) {
                                                                if ($assignprojects['project_id'] == $value['Id']) { ?>
                                                                    <img class="avatar rounded-circle sm" src="<?= site_url($assignprojects['profile_image']) ?>" alt="">';
                                                            <?php

                                                                    $count++;
                                                                }
                                                            }
                                                            ?>
                                                            <?php if (current_userRole()->CanAssignProject) : ?>
                                                                <span class="avatar rounded-circle text-center pointer sm" id=<?= $value['Id'] ?> data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if (current_userRole()->name == 'Client') : ?>
                                                        <Span class="">
                                                            <?php
                                                            $count = 0;
                                                            foreach ($assignproject as $assignprojects) {
                                                                if ($assignprojects['project_id'] == $value['Id']) {
                                                                    $count++;
                                                                }
                                                            }

                                                            if ($count != 0) {
                                                                echo "Assign for " . $value['project_type'] . "";
                                                            }
                                                            ?>
                                                        </span>

                                                    <?php endif ?>

                                                </div>
                                                <div class="row g-2 pt-4">
                                                    <?php if (!empty($value['Project_file'])) : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bx bx-paperclip"></i>
                                                                <span class="ms-2"><a href="<?php if ($value['Project_file'][0] != '') : ?>
                                                    <?= site_url($value['Project_file'][0]) ?> <?php else : ?><?= $value['project_file_link'][0] ?><?php endif ?>" class="file_link" target="_blank">View File</a></span>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-time-five'></i>
                                                            <span class="ms-2"><?= $value['Delivery_Date'] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($value['project_type'])) : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <i class='bx bx-clipboard'></i>
                                                                <span class="ms-2"><?= $value['project_type'] ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if (current_userRole()->name != 'Employee') : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <i class='bx bx-purchase-tag'></i>
                                                                <span class="ms-2"><?php if ($value['Lump_Sump_Charges'] == 0) {
                                                                                        echo "Not Qouted";
                                                                                    } else {
                                                                                        echo "$" . $value['Lump_Sump_Charges'];
                                                                                    }
                                                                                    ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-loader-alt'></i>
                                                            <span class="ms-2">
                                                                <?php
                                                                if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                    echo "In-review";
                                                                } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                    echo "Late";
                                                                } else if ($value['projectStatus'] == 0 && $count == 0) {
                                                                    echo "Not Assign";
                                                                } else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
                                                                    echo "Delivered";
                                                                } else if ($value['projectStatus'] == 0  && $count > 0) {
                                                                    echo "In-progress";
                                                                } else if ($value['projectStatus'] == 1) {
                                                                    echo "Completed";
                                                                } ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <?php if (current_userRole()->name != 'Employee') : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">


                                                                <?php if (current_userRole()->name == 'Admin') : ?>
                                                                    <i class='bx bxs-badge-dollar'></i>
                                                                    <span class="ms-2">
                                                                        <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                    </span>
                                                                <?php endif ?>
                                                                <?php if (current_userRole()->name == 'Client') : ?>
                                                                    <?php if ($value['Lump_Sump_Charges'] != 0) : ?>
                                                                        <i class='bx bxs-badge-dollar'></i>
                                                                        <span class="ms-2">
                                                                            <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                        </span>
                                                                    <?php endif ?>
                                                                <?php endif ?>

                                                            </div>
                                                        </div>
                                                    <?php endif ?>


                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                        <?php if(count($notquotedproject) > 11 ): ?>
                        <div class="pt-3 text-center">
                            <button id="load-more-not-qouted-project" data-offset = '<?= count($notquotedproject) ?>' class="btn btn-primary load-more">Load More</button>
                        </div>
                        <?php endif ?>
                    </div>
                <?php endif ?>
                <!-- Not Qouted -->
                <!-- Awating Qoutation Acceptance Content Start-->
                <?php if (current_userRole()->name != 'Employee') : ?>
                    <div class="tab-pane fade" id="Awating-Qoutation-Acceptance" role="tabpanel">
                        <div class="row" id="not-accepted-qoute-project-list">
                            <?php foreach ($notacceptedquotationproject as $value) : ?>

                                <?php if ($value['quotationStatus'] == 0 && $value['Lump_Sump_Charges'] != 0) : ?>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-5">

                                        <div class="card">
                                            <div class="card-body">
                                                <div>
                                                    <span class="small text-muted project_name fw-bold">
                                                        <?php
                                                        foreach ($ProjectScopes as $projectscope) {
                                                            if ($projectscope['Project_Id'] == $value['Id']) {
                                                                echo $projectscope['Type_Names'] . "<br>";
                                                            }
                                                        } ?></span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between mt-3">
                                                    <div class="lesson_name">
                                                        <div class="
                                                <?php
                                                foreach ($ProjectScopes as $projectscope) {
                                                    if ($projectscope['Project_Id'] == $value['Id']) {

                                                        if ($projectscope['Type_Names'] == 'Castings' || $projectscope['Type_Names'] == 'All Concrete Except Curb') {
                                                            echo "light-success-bg ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Polish Concrete' || $projectscope['Type_Names'] == 'Piping' || $projectscope['Type_Names'] == 'pipings') {
                                                            echo "light-warning-bg  ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Hatches & Modular Retaining Walls Takeoffs' || $projectscope['Type_Names'] == 'All Trades Including MEP') {
                                                            echo "light-danger-bg ";
                                                            break;
                                                        } else if ($projectscope['Type_Names'] == 'Erosion & Sediment Control' || $projectscope['Type_Names'] == 'Earthwork - Cut/Fill Analysis' || $projectscope['Type_Names'] == 'Flooring') {
                                                            echo "bg-lightgreen ";
                                                            break;
                                                        } else {
                                                            echo "bg-lightgreen ";
                                                            break;
                                                        }
                                                    }
                                                } ?>
                                                
                                                project-block">
                                                            <img src="<?= site_url('public/assets/img/icons/briefing.png') ?>" alt="">
                                                        </div>

                                                        <h6 class="mb-0 fw-bold  fs-6  mb-2"><?= $value['Project_Name'] ?></h6>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="<?= site_url("ClientProject/view/" . $value['Id'] . "") ?>" class="btn btn-outline-secondary"><i class='bx bx-info-circle text-info'></i></a>

                                                        <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                                            <?php if (current_userRole()->CanEditClientProject) : ?>
                                                                <a class="btn btn-outline-secondary" href="<?= site_url('ClientProject/edit/' . $value['Id'] . '') ?>"><i class="bx bx-edit-alt text-success"></i></a>
                                                            <?php endif ?>
                                                            <?php if (current_userRole()->CanDeleteClientProject) : ?>
                                                                <a class="btn btn-outline-secondary deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash text-danger"></i></a>
                                                            <?php endif ?>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') : ?>
                                                        <div class="avatar-list avatar-list-stacked pt-2">
                                                            <?php
                                                            $count = 0;
                                                            foreach ($assignproject as $assignprojects) {
                                                                if ($assignprojects['project_id'] == $value['Id']) { ?>
                                                                    <img class="avatar rounded-circle sm" src="<?= site_url($assignprojects['profile_image']) ?>" alt="">';
                                                            <?php

                                                                    $count++;
                                                                }
                                                            }
                                                            ?>
                                                            <?php if (current_userRole()->CanAssignProject) : ?>
                                                                <span class="avatar rounded-circle text-center pointer sm" id=<?= $value['Id'] ?> data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if (current_userRole()->name == 'Client') : ?>
                                                        <Span class="">
                                                            <?php
                                                            $count = 0;
                                                            foreach ($assignproject as $assignprojects) {
                                                                if ($assignprojects['project_id'] == $value['Id']) {
                                                                    $count++;
                                                                }
                                                            }

                                                            if ($count != 0) {
                                                                echo "Assign for " . $value['project_type'] . "";
                                                            }
                                                            ?>
                                                        </span>

                                                    <?php endif ?>

                                                </div>
                                                <div class="row g-2 pt-4">
                                                    <?php if (!empty($value['Project_file'])) : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bx bx-paperclip"></i>
                                                                <span class="ms-2"><a href="<?php if ($value['Project_file'][0] != '') : ?>
                                                    <?= site_url($value['Project_file'][0]) ?> <?php else : ?><?= $value['project_file_link'][0] ?><?php endif ?>" class="file_link" target="_blank">View File</a></span>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-time-five'></i>
                                                            <span class="ms-2"><?= $value['Delivery_Date'] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($value['project_type'])) : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <i class='bx bx-clipboard'></i>
                                                                <span class="ms-2"><?= $value['project_type'] ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                    <?php if (current_userRole()->name != 'Employee') : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <i class='bx bx-purchase-tag'></i>
                                                                <span class="ms-2"><?php if ($value['Lump_Sump_Charges'] == 0) {
                                                                                        echo "Not Qouted";
                                                                                    } else {
                                                                                        echo "$" . $value['Lump_Sump_Charges'];
                                                                                    }
                                                                                    ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class='bx bx-loader-alt'></i>
                                                            <span class="ms-2">
                                                                <?php
                                                                if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                    echo "In-review";
                                                                } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                    echo "Late";
                                                                } else if ($value['projectStatus'] == 0 && $count == 0) {
                                                                    echo "Not Assign";
                                                                } else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
                                                                    echo "Delivered";
                                                                } else if ($value['projectStatus'] == 0  && $count > 0) {
                                                                    echo "In-progress";
                                                                } else if ($value['projectStatus'] == 1) {
                                                                    echo "Completed";
                                                                } ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <?php if (current_userRole()->name != 'Employee') : ?>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">


                                                                <?php if (current_userRole()->name == 'Admin') : ?>
                                                                    <i class='bx bxs-badge-dollar'></i>
                                                                    <span class="ms-2">
                                                                        <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                    </span>
                                                                <?php endif ?>
                                                                <?php if (current_userRole()->name == 'Client') : ?>
                                                                    <?php if ($value['Lump_Sump_Charges'] != 0) : ?>
                                                                        <i class='bx bxs-badge-dollar'></i>
                                                                        <span class="ms-2">
                                                                            <a href="<?= site_url("Quotation/projectqoutation/" . $value['Id'] . "") ?>" class="file_link">View Qoutation</a>
                                                                        </span>
                                                                    <?php endif ?>
                                                                <?php endif ?>

                                                            </div>
                                                        </div>
                                                    <?php endif ?>


                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                        <?php if(count($notacceptedquotationproject) > 11 ): ?>
                        <div class="pt-3 text-center">
                            <button id="load-more-not-accepted-qoutation-project" data-offset = '<?= count($notacceptedquotationproject) ?>' class="btn btn-primary load-more">Load More</button>
                        </div>
                        <?php endif ?>
                    </div>
                <?php endif ?>
                <!-- end Awating Qoutation Acceptance content -->
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<!-- BS table js -->
<script src="<?= site_url("public/assets/vendor/libs/datatables/jquery.dataTables.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive/datatables.responsive.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons/datatables-buttons.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/Select2/js/select2.js") ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                            <select class="select2 form-select" id="assign-project" name="assign-user[]" aria-placeholder="select value" required multiple>
                                <option></option>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <div class="form-floating">
                                <input type="date" min="<?= date('Y-m-d') ?>" class="form-control" id="delivery_date" name="delivery_date" required>
                                <label for="delivery_date">Delivery Date</label>
                            </div>
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
                        <input type="hidden" value='' name='projectid' id='projectid'>
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
        $(".datatables-basic").DataTable();
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        <?php if (current_userRole()->name == 'Admin') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(2)").addClass("open active");
            $(".menu-inner>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php endif ?>
        <?php if (current_userRole()->name == 'Client') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(2)").addClass("active");
            $(".menu-inner>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php endif ?>

        $(document).on('click', '.avatar', function() {
            let projectid = $(this).attr('id');

            $('#projectid').val(projectid);
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
                        $('#assign-project').append('<option value="' + value['id'] + '">' + value['username'] + ' (' + value['name'] + ')</option>');
                    });
                }

            });
        });

        $("#submit-form-assign-project").validate();

        <?php if (current_userRole()->CanDeleteClientProject) : ?>
            $(document).on('click', '.deleteButton', function(e) {
                e.preventDefault();
                var project_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    html: "Do you want to Delete the Project!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#696cff',
                    cancelButtonColor: '#8592a3',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: '<?= site_url('ClientProject/deleteproject/') ?>',
                            type: 'get',
                            data: {
                                delete_id: project_id
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
        <?php endif ?>




        // search project ajax

        $('#project-name').keypress(function(event) {
            if (event.key === "Enter") {
                console.log('enter');
                $('#search-project').trigger('click');
            }
        });
        $('#search-project').click(function() {
            console.log('search');
            var projectName = $('#project-name').val();
            if (projectName != '') {

                $.ajax({

                    url: '<?= base_url('ClientProject/searchProjects') ?>',
                    type: 'get',
                    data: {
                        projectName: projectName,
                    },
                    dataType: 'json',
                    success: function(response) {

                        if (response.projects != '') {

                            $('#project-list').empty();
                            $('#inprogress-project-list').empty();
                            $('#complete-project-list').empty();
                            $('#not-qoute-project-list').empty();
                            $('#not-accepted-qoute-project-list').empty();
                            $.each(response.projects, function(key, value) {

                                // Create a variable to store the projects HTML
                                var projectHTML = '';
                                var projectScopesHTML = '';
                                var projectScopesClass = '';
                                var assignmember = '';
                                var assigned = '';
                                var project_file = '';
                                var project_type = '';
                                var lump_sump_charges = '';
                                var project_status = '';
                                var progress = '';
                                var deliveryDate = new Date(value['Delivery_Date']);
                                deliveryDate.setHours(23, 59, 0, 0);
                                const currentDate = new Date();

                                // Loop through the project scopes and add them to the HTML string
                                $.each(response.ProjectScopes, function(index, projectScope) {
                                    if (projectScope.Project_Id == value['Id']) {
                                        projectScopesHTML += projectScope.Type_Names + '<br>';
                                        if (projectScope.Type_Names == 'Castings' || projectScope.Type_Names == 'All Concrete Except Curb') {
                                            projectScopesClass = "light-success-bg ";

                                        } else if (projectScope.Type_Names == 'Polish Concrete' || projectScope.Type_Names == 'Piping' || projectScope.Type_Names == 'pipings') {
                                            projectScopesClass = "light-warning-bg  ";

                                        } else if (projectScope.Type_Names == 'Hatches & Modular Retaining Walls Takeoffs' || projectScope.Type_Names == 'All Trades Including MEP') {
                                            projectScopesClass = "light-danger-bg ";

                                        } else if (projectScope.Type_Names == 'Erosion & Sediment Control' || projectScope.Type_Names == 'Earthwork - Cut/Fill Analysis' || projectScope.Type_Names == 'Flooring') {
                                            projectScopesClass = "bg-lightgreen ";

                                        } else {
                                            projectScopesClass = "bg-lightgreen ";

                                        }
                                    }
                                });
                                var count = 0;
                                $.each(response.assignproject, function(index, assignprojects) {
                                    // console.log(response.assignproject);
                                    if (assignprojects.project_id == value['Id']) {
                                        count++;
                                        assignmember += '<img class="avatar rounded-circle sm" src="<?= site_url() ?>' + assignprojects.profile_image + '" alt="">';
                                    }
                                });
                                if (count != 0) {
                                    assigned = "Assigned for Estimate"
                                }


                                var assigncount = 0;
                                $.each(response.assignproject, function(index, assignprojects) {
                                    // console.log(response.assignproject);
                                    if (assignprojects.project_id == value['Id'] && assignprojects.status == 1) {
                                        assigncount++;
                                    }
                                });

                                var total_progress = 0;
                                var i = 0;
                                $.each(response.totalprojectprogress, function(index, projectProgress) {
                                    if (projectProgress['project_id'] == value['Id']) {
                                        total_progress += parseInt(projectProgress['avg_max_progress']);
                                        i++;
                                    }
                                });

                                if (assigncount == 0) {
                                    total_progress = 0;
                                } else {
                                    total_progress = total_progress / assigncount;

                                }

                                if (total_progress != 0) {

                                    progressClass = '';

                                    if (total_progress <= 20) {
                                        progressClass = "bg-warning";
                                    } else if (total_progress < 100 && deliveryDate.getTime() < currentDate.getTime() && value['projectStatus'] != 1) {
                                        console.log(total_progress);
                                        progressClass = "bg-danger";
                                    } else if (total_progress <= 50) {
                                        progressClass = "bg-info";
                                    } else if (total_progress > 50 && total_progress < 100) {
                                        progressClass = "bg-primary";
                                    } else if (total_progress == 100) {
                                        progressClass = "bg-success";
                                    }

                                    progress += `
                                <div class="pt-2">
                                    <div class="progress">
                                        <div class="progress-bar ` + progressClass + `
                                        " role="progressbar" style="width: ` + total_progress + `%" aria-valuenow="` + total_progress + `" aria-valuemin="0" aria-valuemax="100">` + total_progress + `%</div>
                                    </div>
                                </div>
                                `;

                                }


                                if ($.trim(value['Project_file']) !== '') {
                                    // console.log(value['Project_file']);
                                    var file_url;
                                    if (value['Project_file'][0] != '') {
                                        file_url = "<?= site_url() ?>" + value['Project_file'][0] + "";
                                    } else {
                                        file_url = "<?= site_url() ?>" + value['project_file_link'][0] + "";

                                    }
                                    project_file += `<div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bx bx-paperclip"></i>
                                                            <span class="ms-2"><a href="` + file_url + `" class="file_link" target="_blank">View File</a></span>
                                                        </div>
                                                    </div>`;


                                }

                                if ($.trim(value['project_type']) !== '') {
                                    project_type += `
                                <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class='bx bx-clipboard'></i>
                                                    <span class="ms-2">` + value['project_type'] + `</span>
                                                </div>
                                            </div>
                                `;
                                }

                                if (value['Lump_Sump_Charges'] == 0) {
                                    lump_sump_charges = "Not Qouted";
                                } else {
                                    lump_sump_charges = "$" + value['Lump_Sump_Charges'];
                                }

                                // console.log(currentDate.getTime() , deliveryDate.getTime());
                                if (value['projectStatus'] == 0 && value['Lump_Sump_Charges'] == 0) {
                                    project_status = "In-review";
                                } else if (total_progress < 100 && value['projectStatus'] == 0 && deliveryDate.getTime() < currentDate.getTime()) {
                                    project_status = "Late";
                                } else if (value['projectStatus'] == 0 && count == 0) {
                                    project_status = "Not Assign";
                                } else if (value['projectStatus'] == 0 && value['deliver_file'] != null) {
                                    console.log(value['deliver_file']);
                                    project_status = "Delivered";
                                } else if (value['projectStatus'] == 0 && count > 0) {
                                    project_status = "In-progress";
                                } else if (value['projectStatus'] == 1) {
                                    project_status = "Completed";
                                }


                                projectHTML = `<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <span class="small text-muted project_name fw-bold">
                                                ` + projectScopesHTML + `
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <div class="lesson_name">
                                                <div class="` + projectScopesClass + ` project-block">
                                                    <img src="<?= site_url('public/assets/img/icons/briefing.png') ?>" alt="">
                                                </div>
                                                <h6 class="mb-0 fw-bold  fs-6  mb-2">` + value['Project_Name'] + `</h6>
                                            </div>

                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="<?= site_url("ClientProject/view/") ?>` + value['Id'] + `" class="btn btn-outline-secondary"><i class='bx bx-info-circle text-info'></i></a>

                                                    <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                                        <?php if (current_userRole()->CanEditClientProject) : ?>
                                                            <a class="btn btn-outline-secondary" href="<?= site_url('ClientProject/edit/') ?>` + value['Id'] + `"><i class="bx bx-edit-alt text-success"></i></a>
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->CanDeleteClientProject) : ?>
                                                            <a class="btn btn-outline-secondary deleteButton" id="` + value['Id'] + `" href=""><i class="bx bx-trash text-danger"></i></a>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                            </div>

                                        </div>

                                        <div class="d-flex align-items-center">
                                            <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') : ?>
                                                <div class="avatar-list avatar-list-stacked pt-2">

                                                    ` + assignmember + `
                                                    <?php if (current_userRole()->CanAssignProject) : ?>
                                                        <span class="avatar rounded-circle text-center pointer sm" id=` + value['Id'] + ` data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span>
                                                    <?php endif ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if (current_userRole()->name == 'Client') : ?>
                                                <Span class="">
                                                    ` + assigned + `
                                                </span>

                                            <?php endif ?>

                                        </div>
                                        <div class="row g-2 pt-4">
                                            ` + project_file + `
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class='bx bx-time-five'></i>
                                                    <span class="ms-2">` + value['Delivery_Date'] + `</span>
                                                </div>
                                            </div>
                                            ` + project_type + `
                                            <?php if (current_userRole()->name != 'Employee') : ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-purchase-tag'></i>
                                                        <span class="ms-2">` + lump_sump_charges + `</span>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class='bx bx-loader-alt'></i>
                                                    <span class="ms-2">` + project_status + `</span>
                                                </div>
                                            </div>
                                            <?php if (current_userRole()->name != 'Employee') : ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                    <?php if (current_userRole()->name == 'Admin') : ?>
                                                        <i class='bx bxs-badge-dollar'></i>
                                                        <span class="ms-2">
                                                            <a href="<?= site_url("Quotation/projectqoutation/") ?>` + value['Id'] + `" class="file_link">View Qoutation</a>
                                                        </span>
                                                    <?php endif ?>
                                                    <?php if (current_userRole()->name == 'Client') : ?>
                                                        <?php if ($value['Lump_Sump_Charges'] != 0) : ?>
                                                        <i class='bx bxs-badge-dollar'></i>
                                                        <span class="ms-2">
                                                            <a href="<?= site_url("Quotation/projectqoutation/") ?> ` + value['Id'] + `" class="file_link">View Qoutation</a>
                                                        </span>
                                                        <?php endif ?>
                                                    <?php endif ?>

                                                    </div>
                                                </div>
                                            <?php endif ?>
                                            ` + progress + `
                                        </div>
                                    </div>
                                </div>
                                </div>`;


                                if (value['quotationStatus'] != 0 && value['quotationStatus'] != 0 && value['Lump_Sump_Charges'] != 0) {
                                    $('#project-list').append(projectHTML);
                                    $('.load-more').hide();
                                }
                                if (value['quotationStatus'] != 0 && value['projectStatus'] == 0 && value['Lump_Sump_Charges'] != 0 && value['user_id'] != null) {
                                    $('#inprogress-project-list').append(projectHTML);
                                    $('.load-more').hide();
                                }
                                if (value['projectStatus'] == 1) {
                                    $('#complete-project-list').append(projectHTML);
                                    $('.load-more').hide();
                                }
                                if (value['Lump_Sump_Charges'] == 0) {
                                    $('#not-qoute-project-list').append(projectHTML);
                                    $('.load-more').hide();
                                }
                                if (value['quotationStatus'] == 0 && value['Lump_Sump_Charges'] != 0) {
                                    $('#not-accepted-qoute-project-list').append(projectHTML);
                                    $('.load-more').hide();
                                }

                            });

                            if (response.hasGenerated) {
                                $('#reset-project').show();
                            }
                        } else {
                            $('#project-list').empty();
                            $('#inprogress-project-list').empty();
                            $('#complete-project-list').empty();
                            $('#not-qoute-project-list').empty();
                            $('#not-accepted-qoute-project-list').empty();
                            $('.load-more').hide();
                        }
                    }
                });
            } else {

            }
        });
        $('#reset-project').click(function() {
            location.reload();
        })

        // load_more ajax



        $('#load-more-project').click(function() {
            
            var allproject = 'allproject';
            var offset = $('#load-more-project').attr('data-offset');
            loadmoreprojects(allproject,offset);
        });
        $('#load-more-inproject').click(function() {
            
            var inprogressproject = 'inprogressproject';
            var offset =$('#load-more-inproject').attr('data-offset');
            loadmoreprojects(inprogressproject,offset);
        });
        $('#load-more-complete-project').click(function() {
            
            var completeproject = 'completeproject';
            var offset = $('#load-more-complete-project').attr('data-offset');
            loadmoreprojects(completeproject,offset);
        });
        $('#load-more-not-qouted-project').click(function() {
            var notquotedproject = 'notquotedproject';
            var offset = $('#load-more-not-qouted-project').attr('data-offset');
            loadmoreprojects(notquotedproject,offset);
        });
        $('#load-more-not-accepted-qoutation-project').click(function() {
            var notquotedproject = 'notacceptedquotationproject';
            var offset = $('#load-more-not-accepted-qoutation-project').attr('data-offset');
            loadmoreprojects(notquotedproject,offset);
        });

    });
    // $(".select2").select2();
    $('.select2').select2({
        placeholder: "Select Value",
        allowClear: true
    });

    function loadmoreprojects(whichprojects,offset) {
        var limit = 12;
        $.ajax({
            url: '<?= base_url('ClientProject/loadMoreProjects') ?>',
            type: 'get',
            data: {
                limit: limit,
                offset: offset,
                whichprojects: whichprojects
            },
            dataType: 'json',
            success: function(response) {
                // console.log(response);
                if (response.projects != '') {
                    $.each(response.projects, function(key, value) {


                        // Create a variable to store the project scopes HTML
                        var projectHTML = '';
                        var projectScopesHTML = '';
                        var projectScopesClass = '';
                        var assignmember = '';
                        var assigned = '';
                        var project_file = '';
                        var project_type = '';
                        var lump_sump_charges = '';
                        var project_status = '';
                        var progress = '';
                        var deliveryDate = new Date(value['Delivery_Date']);
                        deliveryDate.setHours(23, 59, 0, 0);
                        const currentDate = new Date();
                        // Loop through the project scopes and add them to the HTML string
                        $.each(response.ProjectScopes, function(index, projectScope) {
                            if (projectScope.Project_Id == value['Id']) {
                                projectScopesHTML += projectScope.Type_Names + '<br>';
                                if (projectScope.Type_Names == 'Castings' || projectScope.Type_Names == 'All Concrete Except Curb') {
                                    projectScopesClass = "light-success-bg ";

                                } else if (projectScope.Type_Names == 'Polish Concrete' || projectScope.Type_Names == 'Piping' || projectScope.Type_Names == 'pipings') {
                                    projectScopesClass = "light-warning-bg  ";

                                } else if (projectScope.Type_Names == 'Hatches & Modular Retaining Walls Takeoffs' || projectScope.Type_Names == 'All Trades Including MEP') {
                                    projectScopesClass = "light-danger-bg ";

                                } else if (projectScope.Type_Names == 'Erosion & Sediment Control' || projectScope.Type_Names == 'Earthwork - Cut/Fill Analysis' || projectScope.Type_Names == 'Flooring') {
                                    projectScopesClass = "bg-lightgreen ";

                                } else {
                                    projectScopesClass = "bg-lightgreen ";

                                }
                            }
                        });
                        var count = 0;
                        $.each(response.assignproject, function(index, assignprojects) {
                            // console.log(response.assignproject);
                            if (assignprojects.project_id == value['Id']) {
                                count++;
                                assignmember += '<img class="avatar rounded-circle sm" src="<?= site_url() ?>' + assignprojects.profile_image + '" alt="">';
                            }
                        });
                        if (count != 0) {
                            assigned = "Assigned for Estimate"
                        }


                        var assigncount = 0;
                        $.each(response.assignproject, function(index, assignprojects) {
                            // console.log(response.assignproject);
                            if (assignprojects.project_id == value['Id'] && assignprojects.status == 1) {
                                assigncount++;
                            }
                        });

                        var total_progress = 0;
                        var i = 0;
                        $.each(response.totalprojectprogress, function(index, projectProgress) {
                            if (projectProgress['project_id'] == value['Id']) {
                                total_progress += parseInt(projectProgress['avg_max_progress']);
                                i++;
                            }
                        });

                        if (assigncount == 0) {
                            total_progress = 0;
                        } else {
                            total_progress = total_progress / assigncount;
                        }

                        if (total_progress != 0) {

                            progressClass = '';



                            if (total_progress <= 20) {
                                progressClass = "bg-warning";
                            } else if (total_progress < 100 && deliveryDate.getTime() < currentDate.getTime() && value['projectStatus'] != 1) {
                                progressClass = "bg-danger";
                            } else if (total_progress <= 50) {
                                progressClass = "bg-info";
                            } else if (total_progress > 50 && total_progress < 100) {
                                progressClass = "bg-primary";
                            } else if (total_progress == 100) {
                                progressClass = "bg-success";
                            }

                            progress += `
                                <div class="pt-2">
                                    <div class="progress">
                                        <div class="progress-bar ` + progressClass + `
                                        " role="progressbar" style="width: ` + total_progress + `%" aria-valuenow="` + total_progress + `" aria-valuemin="0" aria-valuemax="100">` + total_progress + `%</div>
                                    </div>
                                </div>
                                `;

                        }


                        if ($.trim(value['Project_file']) !== '') {
                            // console.log(value['Project_file']);
                            var file_url;
                            if (value['Project_file'][0] != '') {
                                file_url = "<?= site_url() ?>" + value['Project_file'][0] + "";
                            } else {
                                file_url = "<?= site_url() ?>" + value['project_file_link'][0] + "";

                            }
                            project_file += `<div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bx bx-paperclip"></i>
                                                            <span class="ms-2"><a href="` + file_url + `" class="file_link" target="_blank">View File</a></span>
                                                        </div>
                                                    </div>`;


                        }

                        if ($.trim(value['project_type']) !== '') {
                            project_type += `
                                <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class='bx bx-clipboard'></i>
                                                    <span class="ms-2">` + value['project_type'] + `</span>
                                                </div>
                                            </div>
                                `;
                        }

                        if (value['Lump_Sump_Charges'] == 0) {
                            lump_sump_charges = "Not Qouted";
                        } else {
                            lump_sump_charges = "$" + value['Lump_Sump_Charges'];
                        }

                        if (value['projectStatus'] == 0 && value['Lump_Sump_Charges'] == 0) {
                            project_status = "In-review";
                        } else if (value['projectStatus'] == 0 && deliveryDate.getTime() < currentDate.getTime()) {
                            project_status = "Late";
                        } else if (value['projectStatus'] == 0 && count == 0) {
                            project_status = "Not Assign";
                        } else if (value['projectStatus'] == 0 && value['deliver_file'] != null) {
                            project_status = "Delivered";
                        } else if (value['projectStatus'] == 0 && count > 0) {
                            project_status = "In-progress";
                        } else if (value['projectStatus'] == 1) {
                            project_status = "Completed";
                        }


                        projectHTML = `<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <span class="small text-muted project_name fw-bold">
                                                ` + projectScopesHTML + `
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-3">
                                            <div class="lesson_name">
                                                <div class="` + projectScopesClass + ` project-block">
                                                    <img src="<?= site_url('public/assets/img/icons/briefing.png') ?>" alt="">
                                                </div>
                                                <h6 class="mb-0 fw-bold  fs-6  mb-2">` + value['Project_Name'] + `</h6>
                                            </div>

                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="<?= site_url("ClientProject/view/") ?>` + value['Id'] + `" class="btn btn-outline-secondary"><i class='bx bx-info-circle text-info'></i></a>

                                                    <?php if ($value['Lump_Sump_Charges'] == 0) : ?>
                                                        <?php if (current_userRole()->CanEditClientProject) : ?>
                                                            <a class="btn btn-outline-secondary" href="<?= site_url('ClientProject/edit/') ?>` + value['Id'] + `"><i class="bx bx-edit-alt text-success"></i></a>
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->CanDeleteClientProject) : ?>
                                                            <a class="btn btn-outline-secondary deleteButton" id="` + value['Id'] + `" href=""><i class="bx bx-trash text-danger"></i></a>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                            </div>

                                        </div>

                                        <div class="d-flex align-items-center">
                                            <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') : ?>
                                                <div class="avatar-list avatar-list-stacked pt-2">

                                                    ` + assignmember + `
                                                    <?php if (current_userRole()->CanAssignProject) : ?>
                                                        <span class="avatar rounded-circle text-center pointer sm" id=` + value['Id'] + ` data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span>
                                                    <?php endif ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if (current_userRole()->name == 'Client') : ?>
                                                <Span class="">
                                                    ` + assigned + `
                                                </span>

                                            <?php endif ?>

                                        </div>
                                        <div class="row g-2 pt-4">
                                            ` + project_file + `
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class='bx bx-time-five'></i>
                                                    <span class="ms-2">` + value['Delivery_Date'] + `</span>
                                                </div>
                                            </div>
                                            ` + project_type + `
                                            <?php if (current_userRole()->name != 'Employee') : ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class='bx bx-purchase-tag'></i>
                                                        <span class="ms-2">` + lump_sump_charges + `</span>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center">
                                                    <i class='bx bx-loader-alt'></i>
                                                    <span class="ms-2">` + project_status + `</span>
                                                </div>
                                            </div>
                                            <?php if (current_userRole()->name != 'Employee') : ?>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                    <?php if (current_userRole()->name == 'Admin') : ?>
                                                        <i class='bx bxs-badge-dollar'></i>
                                                        <span class="ms-2">
                                                            <a href="<?= site_url("Quotation/projectqoutation/") ?>` + value['Id'] + `" class="file_link">View Qoutation</a>
                                                        </span>
                                                    <?php endif ?>
                                                    <?php if (current_userRole()->name == 'Client') : ?>
                                                        <?php if ($value['Lump_Sump_Charges'] != 0) : ?>
                                                        <i class='bx bxs-badge-dollar'></i>
                                                        <span class="ms-2">
                                                            <a href="<?= site_url("Quotation/projectqoutation/") ?> ` + value['Id'] + `" class="file_link">View Qoutation</a>
                                                        </span>
                                                        <?php endif ?>
                                                    <?php endif ?>

                                                    </div>
                                                </div>
                                            <?php endif ?>
                                            ` + progress + `
                                        </div>
                                    </div>
                                </div>
                                </div>`;

                        if (whichprojects == 'allproject') {
                            $('#project-list').append(projectHTML);
                        }
                        if (whichprojects == 'inprogressproject') {
                            $('#inprogress-project-list').append(projectHTML);
                        }
                        if (whichprojects == 'completeproject') {
                            $('#complete-project-list').append(projectHTML);
                        }
                        if (whichprojects == 'notquotedproject') {
                            $('#not-qoute-project-list').append(projectHTML);
                        }
                        if (whichprojects == 'notacceptedquotationproject') {
                            $('#not-accepted-qoute-project-list').append(projectHTML);
                        }

                    });
                    // $('.project-list').append(response.projects);
                    offset = response.offset;
                    if(whichprojects == 'allproject'){
                        $('#load-more-project').attr('data-offset',offset);
                    }
                    if(whichprojects == 'inprogressproject'){
                        $('#load-more-inproject').attr('data-offset',offset);
                    }
                    if(whichprojects == 'completeproject'){
                        
                        $('#load-more-complete-project').attr('data-offset',offset);
                    }
                    if(whichprojects == 'notquotedproject'){
                        
                        $('#load-more-not-qouted-project').attr('data-offset',offset);
                    }
                    if(whichprojects == 'notacceptedquotationproject'){
                        
                        $('#load-more-not-accepted-qoutation-project').attr('data-offset',offset);
                    }
                }else{
                    if(whichprojects == 'allproject'){
                        if (!response.hasMore) {
                            $('#load-more-project').hide();
                        }
                    }
                    if(whichprojects == 'inprogressproject'){
                        if (!response.hasMore) {
                            $('#load-more-inproject').hide();
                        } 
                    }
                    if(whichprojects == 'completeproject'){
                        if (!response.hasMore) {
                            $('#load-more-complete-project').hide();
                        } 
                    }
                    if(whichprojects == 'notquotedproject'){
                        if (!response.hasMore) {
                            $('#load-more-not-qouted-project').hide();
                        } 
                    }
                    if(whichprojects == 'notacceptedquotationproject'){
                        if (!response.hasMore) {
                            $('#load-more-not-accepted-qoutation-project').hide();
                        } 
                    }
                }
            }
        });

    }


</script>
<script src="<?= site_url("public/assets/js/forms-selects.js") ?>"></script>
<?= $this->endSection() ?>