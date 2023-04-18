<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Employee Detail <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">

    <div class="card-body">
        <div class="d-flex" style="box-shadow: 0 2px 6px 0 rgba(67, 89, 113, .12); border-radius : 8px; overflow: hidden;">
            <div style="width : 250px; height: 250px;">
                <img class="w-100" src="<?= site_url($employee[0]['profile_image']) ?>" alt="">
            </div>
            <div style="margin-left: 35px; margin-top: 20px ; margin-bottom : 5px;">
                <div style="margin-bottom : 20px !important;">
                    <h4 style="margin-bottom : 5px !important; color : black;"><?= $employee[0]['username'] ?></h4>
                    <span><?= $employee[0]['type'] ?></span>
                </div>
                <div class="d-flex ml-4 employee-detail-list">
                    <ul class="list-unstyled">
                        <li><b>Email</b></li>
                        <?php if(!empty($employee[0]['join_date'])): ?>
                        <li><b>Join Date</b></li>
                        <?php endif ?>
                        <?php if(!empty($employee[0]['salary'])): ?>
                        <li><b>Salary</b></li>
                        <?php endif ?>
                    </ul>
                    <ul class="list-unstyled" style="margin-left : 35px !important;">
                        <li><?= $employee[0]['email'] ?></li>
                        <?php if(!empty($employee[0]['join_date'])): ?>
                        <li><?= $employee[0]['join_date'] ?></li>
                        <?php endif ?>
                        <?php if(!empty($employee[0]['salary'])): ?>
                        <li><?= $employee[0]['salary'] ?></li>
                        <?php endif ?>
                    </ul>
                </div>
                <div>
                    <a href="<?= site_url('users/edit/'.$employee[0]['id']) ?>" class="btn btn-primary"><i class='bx bxs-edit'></i>Edit</a>
                </div>
            </div>
        </div>

        <div style="padding: 35px 40px 20px 4px;">
            <?= $employee[0]['description'] ?>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
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
            <div class="col-lg-3 col-md-6 col-12 mt-3 mt-md-0 mt-lg-0">
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
                        <?= $inprogressProjectCount ?></h3>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mt-3 mt-lg-0">
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
                        <?= $completeProjectCount ?></h3>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mt-3 mt-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar d-flex justify-content-center bg-red rounded text-white">
                                <i class='my-auto mx-auto fs-3 bx bx-stopwatch'></i>
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
                        <span class="fw-semibold d-block mb-1">Late Projects</span>
                        <h3 class="card-title mb-2 text-red"><?= $LateProjectCount ?></h3>
                    </div>
                </div>
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
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        // $(".menu-inner>li.menu-item:nth-of-type(6)").addClass("open active");
        // $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("open active");
        // $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(1)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        // Data Table
        $(".datatables-basic").DataTable();
    });
</script>
<?= $this->endSection() ?>