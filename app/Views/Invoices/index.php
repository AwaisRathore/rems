<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Home <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Invoices</h5>
    <div class="card-body">
        <div class="card-datatable table-responsive pt-0">

            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th>Quotation Id</th>
                        <th>Client</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Total amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $count = 1;
                    foreach ($invoices as $invoice) : ?>
                        <tr>
                            <td>
                                <?php $isQuoted = false;
                                foreach ($invoice_quotations as $quotation) : ?>
                                    <?php if ($quotation->Invoice_Id == $invoice->id) : ?>
                                        <?= $quotation->Quotation_Id ?>
                                        <?php $isQuoted = true ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <?php if (!$isQuoted) : ?>
                                    N/A
                                <?php endif ?>
                            </td>
                            <td><b><?= (isset($invoice->primary_recipients[0]->billing_info->name)) ? $invoice->primary_recipients[0]->billing_info->name->full_name : $invoice->primary_recipients[0]->billing_info->email_address ?></b><br> <span class="text-sm"><?= $invoice->detail->invoice_number ?></span></td>
                            <td><?= $invoice->detail->payment_term->due_date ?></td>

                            <td>
                                <?php if ($invoice->status == "DRAFT") : ?>
                                    <span class="badge bg-draft">Draft</span>
                                <?php elseif ($invoice->status == "SENT") : ?>
                                    <span class="badge bg-secondary">Sent</span>
                                <?php elseif ($invoice->status == "SCHEDULED") : ?>
                                    <span class="badge bg-primary">Scheduled</span>
                                <?php elseif ($invoice->status == "REFUNDED") : ?>
                                    <span class="badge bg-warning">Refunded</span>
                                <?php elseif ($invoice->status == "PARTIALLY_REFUNDED") : ?>
                                    <span class="badge bg-warning">PARTIALLY REFUNDED</span>
                                <?php elseif ($invoice->status == "MARKED_AS_REFUNDED") : ?>
                                    <span class="badge bg-warning">MARKED AS REFUNDED</span>
                                <?php elseif ($invoice->status == "PAID") : ?>
                                    <span class="badge bg-success">Paid</span>
                                <?php elseif ($invoice->status == "PARTIALLY_PAID") : ?>
                                    <span class="badge bg-success">PARTIALLY PAID</span>
                                <?php elseif ($invoice->status == "MARKED_AS_PAID") : ?>
                                    <span class="badge bg-success">MARKED AS PAID</span>
                                <?php elseif ($invoice->status == "CANCELLED") : ?>
                                    <span class="badge bg-danger">Cancelled</span>
                                <?php elseif ($invoice->status == "UNPAID") : ?>
                                    <span class="badge bg-danger">Unpaid</span>
                                <?php elseif ($invoice->status == "PAYMENT_PENDING") : ?>
                                    <span class="badge bg-secondary">PAYMENT PENDING</span>
                                <?php endif ?>
                                <br><span class="text-sm"><?= $invoice->detail->invoice_date ?></span>
                            </td>
                            <td><b>$<?= $invoice->amount->value ?></b></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= site_url("invoices/view/") . $invoice->id ?>"><i class='bx bx-receipt'></i>View</a>
                                        <!-- <a class="dropdown-item" href=""><i class="bx bx-edit-alt me-1"></i>Edit</a> -->
                                        <a class="dropdown-item deleteButton" href="javascript:void(0);" data-id="<?= $invoice->id ?>"><i class="bx bx-trash me-1"></i>Delete</a>
                                        <!-- <a class="dropdown-item" href=""><i class='bx bx-download me-1'></i>Download PDF</a> -->
                                        <!-- <a class="dropdown-item" href=""><i class='bx bx-share-alt me-1'></i> Share Link</a> -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $count++;
                    endforeach ?>


                </tbody>
            </table>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item:nth-of-type(5)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(5)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        // Data Table 
        $(".datatables-basic").DataTable();
        $(document).on('click', '.deleteButton', function(e) {
            e.preventDefault();
            var invoice_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                html: "The invoice will be deleted and user will not be able to pay it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?= site_url('Invoices/delete/') ?>',
                        type: 'get',
                        data: {
                            delete_id: invoice_id
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
    })
</script>
<?= $this->endSection() ?>