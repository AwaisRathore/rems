<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Home <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<style>
    .bg-sent {
        background-color: #FFBE4A;
    }

    .bg-paid {
        background-color: green;
    }

    .bg-partially-paid {
        background-color: #FFBE4E;
    }

    .bg-marked-as-paid {
        background-color: #3C6255;
    }

    .bg-unpaid {
        background-color: #3F497F;
    }

    .bg-payment-pending {
        background-color: #630606;
    }

    .bg-cancelled {
        background-color: red;
    }

    .bg-scheduled {
        background-color: violet;
    }

    .bg-refunded {
        background-color: orangered;
    }

    .bg-partially-refunded {
        background-color: orange;
    }

    .bg-marked-as-refunded {
        background-color: rgb(255, 119, 0);
    }

    .f-195rem {
        font-size: 1.95rem;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="loader-container">
    <div class="loader"></div>
</div>
<div class="card">
    <h5 class="card-header">Invoices</h5>
    <div class="card-body">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-hover border-top">
                <thead>
                    <tr>
                        <th>Quotation Id</th>
                        <th>Client</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Delivery status</th>
                        <th>Total amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $count = 1;
                    foreach ($invoices as $invoice) : ?>
                        <tr data-id="<?= site_url("invoices/view/") . $invoice->id ?>">
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

                            <td>
                                <?php if (isset($invoice->primary_recipients)) : ?>
                                    <b><?= (isset($invoice->primary_recipients[0]->billing_info->name)) ? $invoice->primary_recipients[0]->billing_info->name->full_name : $invoice->primary_recipients[0]->billing_info->email_address ?></b> <br>
                                <?php endif ?>
                                <span class="text-sm"><?= $invoice->detail->invoice_number ?></span>
                            </td>
                            <td><?= $invoice->detail->payment_term->due_date ?></td>

                            <td>
                                <?php if ($invoice->status == "DRAFT") : ?>
                                    <span class="badge bg-draft">Draft</span>
                                <?php elseif ($invoice->status == "SENT") : ?>
                                    <span class="badge bg-sent">Sent</span>
                                <?php elseif ($invoice->status == "SCHEDULED") : ?>
                                    <span class="badge bg-scheduled">Scheduled</span>
                                <?php elseif ($invoice->status == "REFUNDED") : ?>
                                    <span class="badge bg-refunded">Refunded</span>
                                <?php elseif ($invoice->status == "PARTIALLY_REFUNDED") : ?>
                                    <span class="badge bg-partially-refunded">PARTIALLY REFUNDED</span>
                                <?php elseif ($invoice->status == "MARKED_AS_REFUNDED") : ?>
                                    <span class="badge bg-marked-as-refunded">MARKED AS REFUNDED</span>
                                <?php elseif ($invoice->status == "PAID") : ?>
                                    <span class="badge bg-paid">Paid</span>
                                <?php elseif ($invoice->status == "PARTIALLY_PAID") : ?>
                                    <span class="badge bg-partially-paid">PARTIALLY PAID</span>
                                <?php elseif ($invoice->status == "MARKED_AS_PAID") : ?>
                                    <span class="badge bg-marked-as-paid">MARKED AS PAID</span>
                                <?php elseif ($invoice->status == "CANCELLED") : ?>
                                    <span class="badge bg-cancelled">Cancelled</span>
                                <?php elseif ($invoice->status == "UNPAID") : ?>
                                    <span class="badge bg-unpaid">Unpaid</span>
                                <?php elseif ($invoice->status == "PAYMENT_PENDING") : ?>
                                    <span class="badge bg-payment-pending">PAYMENT PENDING</span>
                                <?php endif ?>
                                <br><span class="text-sm"><?= $invoice->detail->invoice_date ?></span>
                            </td>
                            <td class="text-center">
                                <?php if ($invoice->detail->viewed_by_recipient) : ?>
                                    <i class='bx bx-check-double f-195rem' style="color:blue;" title='Viewed.'></i>
                                <?php else : ?>
                                    <i class='bx bx-check f-195rem' title='Not yet viewed.'></i>
                                <?php endif ?>
                            </td>
                            <td><b>$<?= $invoice->amount->value ?></b></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= site_url("invoices/view/") . $invoice->id ?>"><i class='bx bx-receipt'></i> View</a>
                                        <?php if ($invoice->status == "SENT" || $invoice->status == "UNPAID" || $invoice->status == "PARTIALLY_PAID") : ?>
                                            <a class="dropdown-item sendReminderButton" data-id="<?= $invoice->id ?>" href="javascript:void(0);"><i class='bx bx-bell'></i> Send reminder</a>
                                        <?php endif ?>
                                        <?php if ($invoice->status == "DRAFT" || $invoice->status == "SCHEDULED") : ?>
                                            <a class="dropdown-item deleteButton" href="javascript:void(0);" data-id="<?= $invoice->id ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                        <?php elseif ($invoice->status == "SENT") : ?>
                                            <a class="dropdown-item cancelInvoiceButton" href="javascript:void(0);" data-id="<?= $invoice->id ?>"><i class='bx bx-x-circle'></i> Cancel Invoice</a>
                                        <?php endif ?>
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
                html: "The invoice will be deleted and cannot be recovered!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    $(".loader-container").show();
                    $.ajax({
                        url: '<?= site_url('Invoices/delete') ?>',
                        type: 'POST',
                        data: {
                            delete_id: invoice_id
                        },
                        success: function(response) {
                            $(".loader-container").hide();
                            // response = JSON.parse(response);
                            swal.fire(response.message, ' ', response.status).then(function() {
                                location.reload();
                            });
                        },
                        error: function(response) {
                            $(".loader-container").hide();
                            swal.fire("Failed!", response.status, "failure").then(function() {
                                location.reload();
                            });
                        }
                    });

                }
            })
        });
        $(document).on('click', '.cancelInvoiceButton', function(e) {
            e.preventDefault();
            var invoice_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                html: "The invoice will be cancelled and user will not be able to pay it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, cancel it!'
            }).then(function(result) {
                if (result.value) {
                    $(".loader-container").show();
                    $.ajax({
                        url: '<?= site_url('Invoices/cancel') ?>',
                        type: 'POST',
                        data: {
                            cancel_id: invoice_id
                        },
                        success: function(response) {
                            $(".loader-container").hide();
                            // response = JSON.parse(response);
                            swal.fire(response.message, ' ', response.status).then(function() {
                                location.reload();
                            });
                        },
                        error: function(response) {
                            $(".loader-container").hide();
                            swal.fire("Failed!", response.status, "failure").then(function() {
                                location.reload();
                            });
                        }
                    });

                }
            })
        });
        $(document).on('click', '.sendReminderButton', function(e) {
            e.preventDefault();
            var invoice_id = $(this).data('id');
            $(".loader-container").show();
            $.ajax({
                url: '<?= site_url('Invoices/remind') ?>',
                type: 'POST',
                data: {
                    invoice_id: invoice_id
                },
                success: function(response) {
                    $(".loader-container").hide();
                    swal.fire(response.message, ' ', response.status);
                },
                error: function(response) {
                    $(".loader-container").hide();
                    swal.fire("Failed!", response.status, "failure");
                }
            });
        });
        $('table').on('click', 'tr', function(event) {
            if (!$(event.target).closest('td').is(':last-child')) {
                window.location.href = $(this).data('id');
            }
        });
    })
</script>
<?= $this->endSection() ?>