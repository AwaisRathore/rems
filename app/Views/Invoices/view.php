<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Invoice View<?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<style>
    #pdfmake * {
        color: black;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Invoice #<?= $invoice->detail->invoice_number ?></h5>
        <div>
            <a href="<?= $invoice->detail->metadata->recipient_view_url ?>" target="_blank" class="btn btn-primary me-3 px-3"><i class='bx bxl-paypal'></i>View Invoice on PayPal</a>
            <button type="button" class="btn btn-success" id="download-pdf" data-qoutename="<?= $invoice->id ?>"><i class='bx bxs-download'></i> Download</button>
        </div>

    </div>
    <div class="card-body">
        <!-- Pdf Table -->
        <div class="row justify-content-center p-3">
            <div class="shadow col-12" style="width: 21cm; min-height: 29.7cm;" id="pdfmake">
                <table class="table table-border-bottom-0 w-100">
                    <tr>
                        <td class="pt-4">
                            <img src="<?= site_url("public/assets/img/optimizedtransparent_logo.png") ?>" alt="abc">
                        </td>
                        <td class="text-end pt-4">
                            <h5 class="my-0">Remote Estimation LLC</h5>
                            356 WAYNE ST JERSEY CITY, NEW JERSEY 07302<br>
                            info@remoteestimation.us <br>
                            www.remoteestimation.us <br>
                            (630)-999-6501 <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="my-0"><?php if (isset($invoice->primary_recipients[0]->billing_info->name)) {
                                                    echo $invoice->primary_recipients[0]->billing_info->name->full_name;
                                                } else if (isset($invoice->primary_recipients[0]->billing_info->business_name)) {
                                                    echo $invoice->primary_recipients[0]->billing_info->business_name;
                                                } else {
                                                    echo "";
                                                } ?></h5>
                            <?= $invoice->primary_recipients[0]->billing_info->email_address ?><br>
                        </td>
                        <td class="align-bottom text-end">Invoice # <?= $invoice->detail->invoice_number ?></td>
                    </tr>
                    <tr>
                        <!-- <td colspan="2" class="border-bottom-0">Thank you for your inquiry dated: <?= date('m/d/Y') ?></td> -->
                    </tr>
                    <tr>
                        <td>Invoice includes following:</td>
                    </tr>
                </table>
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Project Name/Site Address</th>
                            <th>Project Scope</th>
                            <th>Delivery Date</th>
                            <th>Lump Sump Charges</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $j = 1;

                        foreach ($invoice->items as $item) : ?>
                            <tr>
                                <td><?= $j ?></td>
                                <td><?= $item->name ?></td>
                                <td><?= isset($item->description) ? $item->description : '' ?></td>
                                <td><?= $invoice->detail->payment_term->due_date ?></td>
                                <td><?= $item->unit_amount->value * $item->quantity ?></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total</td>
                            <td><span>$</span><?= $invoice->amount->breakdown->item_total->value  ?></td>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Tax</td>
                            <td><span>$</span><?= $invoice->amount->breakdown->tax_total->value  ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Discount</td>
                            <td><?= isset($invoice->amount->breakdown->discount->invoice_discount->percent) ? $invoice->amount->breakdown->discount->invoice_discount->percent : "0" ?><span>%</span></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end text-danger fw-bold">Total Payable</td>
                            <td class="text-danger fw-bold"><span class="text-danger">$</span><?= $invoice->due_amount->value ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-border-bottom-0 w-100">
                    <tr>
                        <td colspan="2" class="fw-bold py-4">Note: <?= isset($invoice->detail->note) ? $invoice->detail->note : 'All checks must be Paid to Remote Estimation LLC.'?></td>
                    </tr>
                    <tr>
                        <td class="d-flex flex-column text-center py-5">
                            <div class="fw-bold">UMAR</div>
                            <div class="fw-light border-2 border-top">Manager Estimation Department</div>
                            <div class="fw-light">Remote Estimation</div>
                        </td>
                        <td class="text-end align-top py-5 w-50">Date: <?= $invoice->detail->invoice_date ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
<script src="http://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        <?php if (current_userRole()->name == 'Admin') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(5)").addClass("active");
            // $(".menu-inner>li.menu-item:nth-of-type(5)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php endif ?>
        <?php if (current_userRole()->name == 'Client') : ?>
            $("li.menu-item").removeClass("active");
            $(".menu-inner>li.menu-item:nth-of-type(5)").addClass("active");
        <?php endif ?>
        $("#download-pdf").click(function() {
            var doc = new jsPDF("p", "mm", "a4");
            doc.setFillColor(255, 255, 255);
            var width = doc.internal.pageSize.getWidth();
            var height = doc.internal.pageSize.getHeight();
            html2canvas(document.querySelector("#pdfmake"), {
                scale: 4
            }).then(canvas => {
                doc.addImage(canvas, 'JPEG', 0, 0, width, height);
                doc.save("Qoute_" + this.dataset.qoutename + ".pdf");
            });
        });

        $("#submit-form-review").validate();
    });
</script>
<?= $this->endSection() ?>