<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | All Quotations <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<style>
    .swal2-container {
        z-index: 10601 !important;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="loader-container">
    <div class="loader"></div>
</div>
<div class="row">
    <div class="col-12">
        <input type="hidden" id="questions" name="questions[]" value="">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#all-quotation" aria-controls="all-quotation" aria-selected="true">
                        All Qoutation
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#qouted-qoutation" aria-controls="qouted-qoutation" aria-selected="false">
                        Qouted
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#not-qouted" aria-controls="not-qouted" aria-selected="false">
                        Not Qouted <span class="badge bg-warning"><?= $notqoutedcount ?></span>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <!-- All Qoutation Content Start -->
                <div class="tab-pane fade show active" id="all-quotation" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="datatables-basic table border-top">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Quotation Id</th>
                                        <th>Client Name</th>
                                        <th>Client Email</th>
                                        <th>Status</th>
                                        <th>Comments</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1;
                                    foreach ($QuotationData as $value) { ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $value['Quotation_Id'] ?></td>
                                            <td><?= $value['Client_Name'] ?></td>
                                            <td><?= $value['Client_EmailAddress'] ?></td>
                                            <td>
                                                <span><?php
                                                        if ($value['status'] == 0 && $value['review'] == NULL) {
                                                            echo '<span class="text-primary">In-review</span>';
                                                        } else if ($value['status'] == 0) {
                                                            echo '<span class="text-danger">Rejected</span>';
                                                        } else if ($value['status'] == 1) {
                                                            echo '<span class="text-success">Accepted<span>';
                                                        }
                                                        ?></span> <br>
                                                <span>
                                                    <?php if ($value['Lump_Sump_Charges'] == 0 && ($value['status'] == 0 && $value['review'] == NULL)) : ?>
                                                        Admin
                                                    <?php endif ?>
                                                    <?php if ($value['Lump_Sump_Charges'] != 0 && ($value['status'] == 0 && $value['review'] == NULL)) : ?>
                                                        Client
                                                    <?php endif ?>
                                                </span>

                                            </td>
                                            <td><?= $value['review'] ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?= site_url("Quotation/view/" . $value['Id'] . "") ?>"><i class="bx bxs-report me-1"></i>View Quotation</a>
                                                        <?php if (current_userRole()->CanEditQuotation) : ?>
                                                            <a class="dropdown-item" href="<?= site_url("Quotation/edit/" . $value['Id'] . "") ?>"><i class="bx bx-edit-alt me-1"></i>Edit Quotation</a>
                                                        <?php endif ?>
                                                        <?php if (isset($value['invoice'])) : ?>
                                                            <a class="dropdown-item" href="<?= site_url('invoices/view/') . $value['invoice'] ?>" data-id="<?= $value['Id'] ?>"><i class='bx bx-receipt'></i> View Invoice</a>
                                                        <?php else : ?>
                                                            <a class="dropdown-item generateInvoiceButton" href="" data-id="<?= $value['Id'] ?>"><i class='bx bx-receipt'></i> Generate Invoice</a>
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->name == "Admin") : ?>
                                                            <!-- <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeStatus" href=""><i class="bx bx-edit-alt me-1"></i>Change Status</a> -->
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->CanDeleteQuotation) : ?>
                                                            <a class="dropdown-item deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash me-1"></i> Delete</a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- All Qoutaion Content End -->
                <!-- qouted qoutaion Content Start -->
                <div class="tab-pane fade" id="qouted-qoutation" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="datatables-basic table border-top">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Quotation Id</th>
                                        <th>Client Name</th>
                                        <th>Client Email</th>
                                        <th>Status</th>
                                        <th>Comments</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1;
                                    foreach ($QuotedQoutation as $value) { ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $value['Quotation_Id'] ?></td>
                                            <td><?= $value['Client_Name'] ?></td>
                                            <td><?= $value['Client_EmailAddress'] ?></td>
                                            <td>
                                                <span><?php
                                                        if ($value['status'] == 0 && $value['review'] == NULL) {
                                                            echo '<span class="text-primary">In-review</span>';
                                                        } else if ($value['status'] == 0) {
                                                            echo '<span class="text-danger">Rejected</span>';
                                                        } else if ($value['status'] == 1) {
                                                            echo '<span class="text-success">Accepted<span>';
                                                        }
                                                        ?></span> <br>
                                                <span>
                                                    <?php if ($value['Lump_Sump_Charges'] == 0 && ($value['status'] == 0 && $value['review'] == NULL)) : ?>
                                                        Admin
                                                    <?php endif ?>
                                                    <?php if ($value['Lump_Sump_Charges'] != 0 && ($value['status'] == 0 && $value['review'] == NULL)) : ?>
                                                        Client
                                                    <?php endif ?>
                                                </span>

                                            </td>
                                            <td><?= $value['review'] ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?= site_url("Quotation/view/" . $value['Id'] . "") ?>"><i class="bx bxs-report me-1"></i>View Quotation</a>
                                                        <?php if (current_userRole()->CanEditQuotation) : ?>
                                                            <a class="dropdown-item" href="<?= site_url("Quotation/edit/" . $value['Id'] . "") ?>"><i class="bx bx-edit-alt me-1"></i>Edit Quotation</a>
                                                        <?php endif ?>
                                                        <?php if (isset($value['invoice'])) : ?>
                                                            <a class="dropdown-item" href="<?= site_url('invoices/view/') . $value['invoice'] ?>" data-id="<?= $value['Id'] ?>"><i class='bx bx-receipt'></i> View Invoice</a>
                                                        <?php else : ?>
                                                            <a class="dropdown-item generateInvoiceButton" href="" data-id="<?= $value['Id'] ?>"><i class='bx bx-receipt'></i> Generate Invoice</a>
                                                        <?php endif ?>
                                                        <?php if (current_userRole()->CanDeleteQuotation) : ?>
                                                            <a class="dropdown-item deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash me-1"></i> Delete</a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- qouted qoutation Content End -->
                <!-- Not Qouted Qoutation Start-->
                <div class="tab-pane fade" id="not-qouted" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="datatables-basic table border-top">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Quotation Id</th>
                                        <th>Client Name</th>
                                        <th>Client Email</th>
                                        <th>Status</th>
                                        <th>Comments</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php $i = 1;
                                    foreach ($NotQuotedQoutation as $value) { ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $value['Quotation_Id'] ?></td>
                                            <td><?= $value['Client_Name'] ?></td>
                                            <td><?= $value['Client_EmailAddress'] ?></td>
                                            <td>
                                                <span><?php
                                                        if ($value['status'] == 0 && $value['review'] == NULL) {
                                                            echo '<span class="text-primary">In-review</span>';
                                                        } else if ($value['status'] == 0) {
                                                            echo '<span class="text-danger">Rejected</span>';
                                                        } else if ($value['status'] == 1) {
                                                            echo '<span class="text-success">Accepted<span>';
                                                        }
                                                        ?></span> <br>
                                                <span>
                                                    <?php if ($value['Lump_Sump_Charges'] == 0 && ($value['status'] == 0 && $value['review'] == NULL)) : ?>
                                                        Admin
                                                    <?php endif ?>
                                                    <?php if ($value['Lump_Sump_Charges'] != 0 && ($value['status'] == 0 && $value['review'] == NULL)) : ?>
                                                        Client
                                                    <?php endif ?>
                                                </span>

                                            </td>
                                            <td><?= $value['review'] ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?= site_url("Quotation/view/" . $value['Id'] . "") ?>"><i class="bx bxs-report me-1"></i>View Quotation</a>
                                                        <?php if (current_userRole()->CanEditQuotation) : ?>
                                                            <a class="dropdown-item" href="<?= site_url("Quotation/edit/" . $value['Id'] . "") ?>"><i class="bx bx-edit-alt me-1"></i>Edit Quotation</a>
                                                        <?php endif ?>
                                                        <!-- <a class="dropdown-item" href="" ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a> -->
                                                        <?php if (isset($value['invoice'])) : ?>
                                                            <a class="dropdown-item" href="<?= site_url('invoices/view/') . $value['invoice'] ?>" data-id="<?= $value['Id'] ?>"><i class='bx bx-receipt'></i> View Invoice</a>
                                                        <?php else : ?>
                                                            <a class="dropdown-item generateInvoiceButton" href="" data-id="<?= $value['Id'] ?>"><i class='bx bx-receipt'></i> Generate Invoice</a>
                                                        <?php endif ?>

                                                        <?php if (current_userRole()->CanDeleteQuotation) : ?>
                                                            <a class="dropdown-item deleteButton" id="<?= $value['Id'] ?>" href=""><i class="bx bx-trash me-1"></i> Delete</a>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- not qouted qoutation Content End -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="changeStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Reason for Rejection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submit-form-review" method="post" action="">
                <div class="modal-body">

                    <div class="row g-2">
                        <div class="form-group ">
                            <label for="project-file-link">Reason</label>
                            <textarea name="review" id="review" style="height: 100px" class="form-control" placeholder="Reason for Rejection" required></textarea>

                        </div>


                        <div  class="form-check col-lg-6">
                            <input class="form-check-input" type="radio" name="changestatus" id="accept" checked>
                            <label class="form-check-label" for="accept">
                                Accept
                            </label>
                        </div>
                        <div class="form-check col-lg-6">
                            <input class="form-check-input" type="radio" name="changestatus" id="reject" >
                            <label class="form-check-label" for="reject">
                                Reject
                            </label>
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


<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<!-- BS table js -->
<script src="<?= site_url("public/assets/vendor/libs/datatables/jquery.dataTables.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive/datatables.responsive.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons/datatables-buttons.js") ?>"></script>
<script src="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js") ?>"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $(".datatables-basic").DataTable();
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item:nth-of-type(4)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(4)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php if (current_userRole()->name == 'Admin') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(4)").addClass("open active");
            $(".menu-inner>li.menu-item:nth-of-type(4)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php endif ?>
        <?php if (current_userRole()->name == 'Client') : ?>
            $("li.menu-item").removeClass("active");
            $(".menu-inner>li.menu-item:nth-of-type(4)").addClass("active");
        <?php endif ?>
        // delete project function
        $(document).on('click', '.deleteButton', function(e) {
            e.preventDefault();
            var qoutation_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                html: "On deleting Quotation, All project in its are deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?= site_url('Quotation/delete/') ?>',
                        type: 'get',
                        data: {
                            delete_id: qoutation_id
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
        $(document).on('click', '.generateInvoiceButton', function(e) {
            e.preventDefault();
            $(".loader-container").show();
            var qoutation_id = $(this).data('id');
            $.ajax({
                url: "<?= site_url("Quotation/generateInvoice") ?>",
                method: "POST",
                data: {
                    qoutation_id: qoutation_id
                },
                success: function(response) {
                    $(".loader-container").hide();
                    response = JSON.parse(response);
                    Swal.fire("Invoice created successfully").then(function() {
                        location.reload();
                    });
                },
                failure: function(response) {
                    $(".loader-container").hide();
                    Swal.fire("Failed could not be created.");
                }
            });
        });
    })
</script>





<?= $this->endSection() ?>