<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Home <?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
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
                                <a class="dropdown-item" href="#">View All</a>
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
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">


        <div class="card  mt-4">
            <div class="bg-light d-flex justify-content-between">
                <h5 class="px-4 pt-3">Notification</h5>
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
                        <tbody class="table-border-bottom-0">
                            <?php


                            $i = 1;
                            foreach ($notification as $value) :
                            ?>

                                <tr class="<?php
                                            if ($value['status'] == 0) {
                                                echo "light-info-bg";
                                            }
                                            ?>">
                                    <td><?= $i ?></td>

                                    <td> <a href="<?php if ($value['qoutation_id'] == ' ' || $value['qoutation_id'] != null) : ?><?= site_url('Quotation/view/' . $value['qoutation_id'] . '') ?> <?php endif ?>
                                    <?php if ($value['project_id'] == ' ' || $value['project_id'] != null) : ?><?= site_url('ClientProject/view/' . $value['project_id'] . '') ?> <?php endif ?>" class="nav-link" style="padding: 0px !important"><?= $value['message'] ?></a></td>
                                    <td><a href="<?php if ($value['qoutation_id'] == ' ' || $value['qoutation_id'] != null) : ?><?= site_url('Quotation/view/' . $value['qoutation_id'] . '') ?> <?php endif ?>
                                    <?php if ($value['project_id'] == ' ' || $value['project_id'] != null) : ?><?= site_url('ClientProject/view/' . $value['project_id'] . '') ?> <?php endif ?>" class="nav-link" style="padding: 0px !important"><?= $value['created_at'] ?></a></td>

                                </tr>


                            <?php
                                $i++;
                            endforeach
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <?php if ($ProjectCount != 0) : ?>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">

            <div id="chart-container bg-white" class="mt-4">
                <div id="barchart_values" style="width: 100%; height: 300px;"></div>
            </div>

        </div>
    <?php endif ?>
    <?php if (current_userRole()->name == "Admin") : ?>
        <div class="col-lg-6 col-md-12 col-sm-12 col-12">

            <div class="mt-4">
                <div style="padding : 10px;border:1px solid #d3d3d3; background-color: white;">
                    <div id="curve_chart" style="height: 300px; width: 100%; "></div>
                </div>
            </div>

        </div>
    <?php endif ?>

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
<script src="<?= site_url('public/assets/js/graph.js') ?>"></script>
<script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
            data.addColumn('date', 'Day');
            data.addColumn('number', 'Total Quotation');
            data.addColumn('number', 'Accepted Qoutation');

            var maxLength = Math.max(allQoutationcountthismonth.length, allacceptedQoutationcountthismonth.length);

            for (var i = 0; i < maxLength; i++) {
                var day = new Date(allQoutationcountthismonth[i]?.day);
                var totalQuotation = parseInt(allQoutationcountthismonth[i]?.num_quotations || 0);
                var acceptedQuotation = parseInt(allacceptedQoutationcountthismonth[i]?.num_quotations || 0);
                if (day && !isNaN(totalQuotation)) {
                    data.addRow([day, totalQuotation, acceptedQuotation]);
                }
            }


            var options = {
                chart: {
                    title: 'Quotations',
                },
                legend: {
                    position: 'top'
                },
                hAxis: {
                    title: 'Day'
                },
                vAxis: {
                    title: 'Number of Quotations'
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
        }else if(current_userRole()->name == 'Employee'){
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
                ["Remaining Project",remainingPercent , "#FFC0CB"],
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
                title: "Projects",
                width: 450,
                height: 400,
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

        $(".datatables-basic").DataTable({
            pageLength: 5,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
        });






    })
</script>
<?= $this->endSection() ?>