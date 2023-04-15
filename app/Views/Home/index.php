<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Home <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/Select2/css/select2.css") ?>">
<link rel="stylesheet" href="<?= site_url('public/assets/css/swiper-bundle.min.css') ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<?php if (current_userRole()->name == "Admin") : ?>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar d-flex justify-content-center bg-success rounded text-white">
                            <i class="my-auto mx-auto fs-3 bx bxs-badge-dollar"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="<?= site_url("Quotation/index") ?>">View All</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Quotations</span>
                    <h3 class="card-title mb-2 text-success"><?= $QuotationCount ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-3 mt-md-0 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar d-flex justify-content-center bg-info rounded text-white">
                            <i class='my-auto mx-auto fs-3 bx bxs-group'></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="<?= site_url("Client/index") ?>">View All</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Clients</span>
                    <h3 class="card-title mb-2 text-info"><?= $ClientsCount ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-3 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar d-flex justify-content-center bg-danger rounded text-white">
                            <i class="my-auto mx-auto fs-3 bx bx-money"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="<?= site_url("Quotation/index") ?>">View All</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Sales</span>
                    <h3 class="card-title mb-2 text-danger">$<?= $Sales ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mt-3 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar d-flex justify-content-center bg-primary rounded text-white">
                            <i class="my-auto mx-auto fs-3 bx bx-user"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="<?= site_url('Users/') ?>">View All</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Users</span>
                    <h3 class="card-title mb-2 text-primary"><?= $usercount ?></h3>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if (current_userRole()->name == "Client" || current_userRole()->name == "Employee") : ?>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar d-flex justify-content-center bg-success rounded text-white">
                            <img style="padding : 6px;" src="<?= site_url('public/assets/img/icons/project.png') ?>" alt="">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="">View All</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Projects</span>
                    <h3 class="card-title mb-2 text-success"><?= $ProjectCount ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-3 mt-md-0 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar d-flex justify-content-center bg-info rounded text-white">
                            <img style="padding : 6px;" src="<?= site_url('public/assets/img/icons/in_project.png') ?>" alt="">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="">View All</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Inprogress Project</span>

                    <h3 class="card-title mb-2 text-info">
                        <?php if (current_userRole()->name == "Client") : ?>
                            <?= $inprogressProjectCount ?></h3>
                <?php endif ?>
                <?php if (current_userRole()->name == "Employee") : ?>
                    <?= $inprogressProjectCount ?></h3>
                <?php endif ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-3 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar d-flex justify-content-center bg-danger rounded text-white">
                            <img style="padding : 6px;" src="<?= site_url('public/assets/img/icons/comp_project.png') ?>" alt="">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="">View All</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Complete project</span>
                    <h3 class="card-title mb-2 text-danger">
                        <?php if (current_userRole()->name == "Client") : ?>
                            <?= $completeProjectCount[0]['projectcount'] ?></h3>
                <?php endif ?>
                <?php if (current_userRole()->name == "Employee") : ?>
                    <?= $completeProjectCount ?></h3>
                <?php endif ?>
                </div>
            </div>
        </div>

    </div>
<?php endif ?>



<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">


        <div class="card  mt-4">
            <div class="bg-light d-flex justify-content-between">
                <h5 class="px-4 pt-3"><i class='bx bxs-bell px-2'></i>Notification <span class="badge badge-sm bg-danger notification" id="badge"></span></h5>
            </div>
            <div class="card-body text-dark" style="padding: 0px;">


                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table border-top">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Message</th>
                                <th>Datetime</th>

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0 notificationsTable">

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end px-4 pt-2">
                        <a class="btn btn-primary" href="<?= site_url('/Notification') ?>">See all</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php if (current_userRole()->name == 'Admin') : ?>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card mt-4">
                <div class="bg-light d-flex justify-content-between">
                    <h5 class="px-4 pt-3"><i class='bx px-2 bx-time'></i> Upcoming Delivery</h5>
                </div>
                <div class="card-body border-top text-dark" style="padding: 0px;">

                    <div class="slider">
                        <div class="swiper">

                            <div class="slide-content">
                                <div class="card-wrapper swiper-wrapper">
                                    <?php foreach ($clientproject as $value) : ?>

                                        <?php $delivery_time = strtotime("+5 days");
                                        if (strtotime($value['Delivery_Date']) <= $delivery_time && strtotime($value['Delivery_Date']) >= time()) : ?>
                                            <div class="swiper-slide px-5 pb-5 mr-2">
                                                <div class="col-xxl-12 col-xl-12 col-lg-4 col-md-12 col-sm-6 mt-5">

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
                                                                            <!-- <span class="avatar rounded-circle text-center pointer sm" id=<?= $value['Id'] ?> data-bs-toggle="modal" data-bs-target="#assignProject"><i class="bx bx-plus m-t-10"></i></span> -->
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
                                            </div>
                                        <?php endif ?>

                                    <?php endforeach ?>






                                </div>
                            </div>

                            <div class="swiper-pagination"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>

                    </div>

                </div>
            </div>


        </div>
    <?php endif ?>

    <?php if ($ProjectCount != 0) : ?>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">

            <div class="card mt-4">
                <div class="bg-light d-flex justify-content-between">
                    <h5 class="px-4 pt-3"><i class='bx px-2 bx-notepad'></i></i> Projects</h5>
                </div>
                <div class="card-body text-dark border-top" style="padding: 10px;">
                    <div id="chart-container bg-white">
                        <div id="barchart_values" style="width: 100%; height: 400px;"></div>
                    </div>

                </div>
            </div>

        </div>
    <?php endif ?>
    <?php if (current_userRole()->name == "Admin") : ?>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">

            <div class="card  mt-4">
                <div class="bg-light d-flex justify-content-between">
                    <h5 class="px-4 pt-3"><i class='bx px-2 bxs-badge-dollar'></i> Qoutation</h5>
                </div>
                <div class="card-body border-top text-dark" style="padding: 0px;">
                    <div style="padding : 30px 20px; background-color: white;">
                        <div id="curve_chart" style="height: 360px; width: 100%; "></div>
                    </div>
                </div>
            </div>


        </div>
    <?php endif ?>

</div>

<?php if(current_userRole()->name == 'Admin'): ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card mt-4">
            <div class="bg-light d-flex justify-content-between">
                <h5 class="px-4 pt-3"><i class='bx px-2 bx-time'></i>Employees</h5>
            </div>
            <div class="card-body border-top text-dark">

                <div class="slider">
                    <div class="swiper">

                        <div class="slide-employee" style="padding: 25px 40px;">
                            <div class="card-wrapper swiper-wrapper">

                                <?php foreach($employees as $value): ?>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url($value['profile_image']) ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;"><?= $value['username'] ?></h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                <?php endforeach ?>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url('public/assets/img/users/1677951604_75a1e9c02de162018a4b.jpg') ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;">Hammad Awan</h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url('public/assets/img/users/1677951604_75a1e9c02de162018a4b.jpg') ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;">Hammad Awan</h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url('public/assets/img/users/1677951604_75a1e9c02de162018a4b.jpg') ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;">Hammad Awan</h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url('public/assets/img/users/1677951604_75a1e9c02de162018a4b.jpg') ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;">Hammad Awan</h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url('public/assets/img/users/1677951604_75a1e9c02de162018a4b.jpg') ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;">Hammad Awan</h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url('public/assets/img/users/1677951604_75a1e9c02de162018a4b.jpg') ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;">Hammad Awan</h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                <div class="swiper-slide mr-2">
                                    <a href="#">
                                        <div class="p-2" style="box-shadow : 0 2px 6px 0 rgba(67, 89, 113, .12); padding : 20px 5px;">
                                            <div class="img text-center" style=" width : 120px; height : 120px; border-radius: 50%; margin: auto; overflow : hidden;">
                                                <img src="<?= site_url('public/assets/img/users/1677951604_75a1e9c02de162018a4b.jpg') ?>" class="w-100" alt="">
                                            </div>
                                            <div class="text-center">
                                                <h5 style="margin-bottom: 2px; margin-top : 10px; font-size : 16px; color: #3a3a3a;">Hammad Awan</h5>
                                                <span style="font-size : 14px; color: #666464;">Developer</span>
                                            </div>

                                        </div>
                                    </a>
                                    
                                </div>
                                
                                


                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

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
<script src="<?= site_url("public/assets/vendor/libs/Select2/js/select2.js") ?>"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="<?= site_url('public/assets/js/slider.js') ?>"></script>

<script src="<?= site_url('public/assets/js/graph.js') ?>"></script>
<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>


<!-- <div class="modal fade" id="assignProject" tabindex="-1" aria-hidden="true">
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
</div> -->




<?php if (current_userRole()->name == "Admin") : ?>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['line']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var allQoutationcountthismonth = <?php echo json_encode($allQoutationcountthismonth); ?>;
            var allacceptedQoutationcountthismonth = <?php echo json_encode($allacceptedQoutationcountthismonth); ?>;

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Total Quotation');
            data.addColumn('number', 'Accepted Qoutation');

            var maxLength = Math.max(allQoutationcountthismonth.length, allacceptedQoutationcountthismonth.length);



            for (var i = 0; i < maxLength; i++) {
                var date = new Date(allQoutationcountthismonth[i]?.created_at);
                var month = date.toLocaleString('default', {
                    month: 'short'
                });
                var totalQuotation = parseInt(allQoutationcountthismonth[i]?.num_quotations || 0);
                var acceptedQuotation = parseInt(allacceptedQoutationcountthismonth[i]?.num_quotations || 0);
                if (!isNaN(totalQuotation)) {
                    data.addRow([month, totalQuotation, acceptedQuotation]);
                }
            }

            var options = {
                // chart: {
                //     title: 'Quotations',
                // },
                legend: {
                    position: 'top'
                },
                hAxis: {
                    title: 'Month'
                },
                vAxis: {
                    title: 'Number of Quotations'
                },

                tooltip: {
                    trigger: 'selection',
                    isHtml: true,
                    textStyle: {
                        color: '#333'
                    },
                    showColorCode: true,
                    format: 'MMM'
                }
            };

            var chart = new google.charts.Line(document.getElementById('curve_chart'));

            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    </script>

<?php endif ?>

<?php if ($ProjectCount != 0) : ?>
    <script type="text/javascript">
        <?php if (current_userRole()->name == 'Client' || current_userRole()->name == 'Admin') {
            $completeProjectcount = $completeProjectCount[0]['projectcount'];
        } else if (current_userRole()->name == 'Employee') {
            $completeProjectcount = $completeProjectCount;
        } ?>
        var remainingPercent = <?= $ProjectCount - $inprogressProjectCount - $completeProjectcount ?>;
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Projects", {
                    role: "style"
                }],
                ["Remaining Project", remainingPercent, "#FFC0CB"],
                ["Complete Project", <?= $completeProjectcount ?>, "#87ceeb"],
                ["Inprogress Project", <?= $inprogressProjectCount ?>, "gold"],
                ["Total Project", <?= $ProjectCount ?>, "#BF40BF"]
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                // title: "Projects",
                // width: 450,
                // height: 400,
                bar: {
                    groupWidth: "100%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(view, options);
        }
    </script>
<?php endif ?>

<script>
    // Adding classes to sidebar to show it active
    $(document).ready(function() {
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item").first().addClass("active");


        getNotification();
        setInterval(function() {
            getNotification();
        }, 5000);

    });
    $("#submit-form-assign-project").validate();


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

    $('.select2').select2();

    function getNotification() {
        var no = $(".notification").text();

        $.ajax({
            url: "<?= site_url("Notification/get_notification") ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {

                // Clear the existing table rows
                $(".notificationsTable").empty();


                for (var i = 0; i < 5; i++) {
                    var notification = response.notification[i];
                    var rowClass = (notification.status == 0) ? "light-info-bg" : "";
                    var row = $("<tr>").addClass(rowClass);
                    $("<td>").text(i + 1).appendTo(row);

                    var messageTd = $("<td>").html("<a href='" + getLink(notification) + "' class='nav-link ' style='padding: 0px !important'>" + notification.message + "</a>").appendTo(row);
                    if (notification.status == 0) {
                        var badgeDiv = $("<div>").addClass("blink").appendTo(messageTd);
                        $("<span>").addClass("badge badge-sm bg-danger").attr("id", "badge").text("New").appendTo(badgeDiv);
                    }

                    $("<td>").html("<a href='" + getLink(notification) + "' class='nav-link' style='padding: 0px !important'>" + notification.created_at + "</a>").appendTo(row);
                    row.appendTo(".notificationsTable");
                }
                $('.blink').prev().parent().addClass('d-flex');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });



    }
    // Function to get the link for a notification based on its type
    function getLink(notification) {
        var link = "";
        if (notification.qoutation_id != null) {
            link = "<?= site_url('Quotation/view/') ?>" + notification.qoutation_id;
        } else if (notification.project_id != null) {
            link = "<?= site_url('ClientProject/view/') ?>" + notification.project_id;
        }
        return link;
    }
</script>
<?= $this->endSection() ?>