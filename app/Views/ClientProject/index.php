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
            </ul>
            <div class="tab-content bg-lightgray">
                <!-- All project Content Start -->
                <div class="tab-pane fade show active" id="all-project" role="tabpanel">
                    <div class="row">
                        <?php foreach ($clientproject as $value) : ?>

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
                                                        }else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
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



                        <?php endforeach ?>

                    </div>
                </div>
                <!-- All project Content End -->
                <!-- In progress project Content Start -->
                <div class="tab-pane fade" id="inprogress-project" role="tabpanel">

                    <div class="row">
                        <?php foreach ($clientproject as $value) : ?>
                            <?php if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] != 0 && $value['user_id'] != null) : ?>
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
                                                            }else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
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
                </div>
                <!-- In progress project Content End -->
                <!-- Completed project Content Start-->
                <div class="tab-pane fade" id="complete-project" role="tabpanel">
                    <div class="row">
                        <?php foreach ($clientproject as $value) : ?>
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
                                                        <span class="ms-2 <?php if ($value['projectStatus'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                                echo "text-lightgreen";
                                                                            } else if ($value['projectStatus'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                                echo "text-danger-bg";
                                                                            } else if ($value['projectStatus'] == 0 && $value['status'] == 1) {
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
                                                            }else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
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
                </div>

                <!-- Completed Content End -->
                <!-- Not Qouted Content Start-->
                <?php if (current_userRole()->name != 'Employee') : ?>
                    <div class="tab-pane fade" id="not-qouted" role="tabpanel">
                        <div class="row">
                            <?php foreach ($clientproject as $value) : ?>
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
                                                            <span class="ms-2 <?php if ($value['status'] == 0 && $value['Lump_Sump_Charges'] == 0) {
                                                                                    echo "text-lightgreen";
                                                                                } else if ($value['status'] == 0 && date("Y-m-d") > $value['Delivery_Date']) {
                                                                                    echo "text-danger-bg";
                                                                                } else if ($value['status'] == 0) {
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
                                                                }else if ($value['projectStatus'] == 0  && $value['deliver_file'] != '') {
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
                    </div>
                <?php endif ?>
                <!-- Not Qouted -->
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

    });
    // $(".select2").select2();
    $('.select2').select2({
        dropdownParent: $('#basicModal')
    });
</script>
<script src="<?= site_url("public/assets/js/forms-selects.js") ?>"></script>
<?= $this->endSection() ?>