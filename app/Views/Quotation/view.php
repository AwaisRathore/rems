<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Quotation View<?= $this->endSection() ?>
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
        <h5>Quotation No <?= $Quotation['Quotation_Id'] ?></h5>
        <div>
            <?php if (current_userRole()->name == 'Client') : ?>

                <?php  if ($Projects[0]['Lump_Sump_Charges'] != 0) : ?>

                    <?php if ($Quotation['status'] != 1) : ?>
                        <button type="button" class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#review">Reject and Review</button>

                        <a href="<?= site_url('Quotation/acceptquotation/' . $Quotation['Id'] . '') ?>" class="btn btn-success">Accept and Move Forword</a><?php endif ?>
                    <?php if ($Quotation['status'] == 1) : ?>
                        <div class="d-inline-block text-white status bg-success">Accepted</div>
                    <?php endif ?>

                <?php endif ?>
            <?php endif ?>
            <button type="button" class="btn btn-success" id="download-pdf" data-qoutename="<?= $Quotation['Quotation_Id'] ?>"><i class='bx bxs-download'></i> Download</button>
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
                            <h5 class="my-0"><?= $Quotation['Client_Name'] ?></h5>
                            <?= $Quotation['Client_EmailAddress'] ?><br>
                        </td>
                        <td class="align-bottom text-end">Quotation No# <?= $Quotation['Quotation_Id'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="border-bottom-0">Thank you for your inquiry dated: <?= date('m/d/Y') ?></td>
                    </tr>
                    <tr>
                        <td>We are pleased to quote you the following:</td>
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
                        $total = 0;
                        foreach ($Projects as $value) { ?>
                            <tr>
                                <td><?= $j ?></td>
                                <td><?= $value['Project_Name'] ?></td>
                                <td>
                                    <?php
                                    foreach ($ProjectScopes as $projectscope) {
                                        if ($projectscope['Project_Id'] == $value['Id']) {
                                            echo $projectscope['Type_Names'] . " ";
                                        }
                                    } ?>
                                </td>
                                <td><?= date("m/d/Y", strtotime($value['Delivery_Date']));   ?></td>
                                <td><span>$</span><?= $value['Lump_Sump_Charges'] ?></td>
                            </tr>
                        <?php $j++;
                            $total = $total + $value['Lump_Sump_Charges'];
                        } ?>

                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total</td>
                            <td><span>$</span><?= $total ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Discount</td>
                            <td><?= $Quotation['Discount'] ?><span>%</span></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end text-danger fw-bold">Total Payable</td>
                            <td class="text-danger fw-bold"><span class="text-danger">$</span><?= $total - $total * ($Quotation['Discount'] / 100) ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-border-bottom-0 w-100">
                    <tr>
                        <td colspan="2" class="py-4"><p class="fw-bold">Note: 50 % of the quote is to be paid upfront before starting the project. </p>
                       <p><i> All payments made to Remote Estimation LLC are Tax write-offs. Please contact us for tax id or W-9 form.<i></p>
                    </td>
                    </tr>
                    <tr>
                        <td class="d-flex flex-column text-center py-5">
                            <div class="fw-bold">UMAR</div>
                            <div class="fw-light border-2 border-top">Manager Estimation Department</div>
                            <div class="fw-light">Remote Estimation</div>
                        </td>
                        <td class="text-end align-top py-5 w-50">Date: <?= date('m/d/Y') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="review" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Reason for Rejection</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submit-form-review" method="post" action="<?= site_url('Quotation/ReviewQuotation/' . $Quotation['Id'] . '') ?>">
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

<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        <?php if (current_userRole()->name == 'Admin') : ?>
            $(".menu-inner>li.menu-item:nth-of-type(4)").addClass("open active");
            $(".menu-inner>li.menu-item:nth-of-type(4)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        <?php endif ?>
        <?php if (current_userRole()->name == 'Client') : ?>
            $("li.menu-item").removeClass("active");
            $(".menu-inner>li.menu-item:nth-of-type(4)").addClass("active");
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