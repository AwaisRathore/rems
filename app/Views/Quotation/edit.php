<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Add Quotation <?= $this->endSection() ?>
<?= $this->section("PageCss") ?>
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/Select2/css/select2.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<form action="<?= site_url("Quotation/edit/" . $qoutation['Id'] . "") ?>" method="post" id="submit-form">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <h5 class="card-header">Edit Quotation Information</h5>
                <div class="card-body add-row">
                    <div class="row">
                        <div class="col-12 my-2">
                            <label class="form-label" for="client">Clients</label>
                            <select name="client" required class="select2 form-select" data-allow-clear="true" id="client">
                                <option value="" selected disabled>Select Client</option>
                                <?php foreach ($ClientsData as $value) { ?>
                                    <option value="<?= $value['Id'] ?>" <?php if ($value['Id'] == $qoutation['Client_Id']) : ?>selected<?php endif ?>> <?= $value['Email_Address'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-12 my-2">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bx bxs-user-plus bx-sm"></i> Add New Client</button>
                        </div>
                    </div><?php $i = 1;
                            $k = 0;
                            $total_bill = 0;
                            ?>
                    <?php if (count($projectDetail) > 0) : ?>
                        <?php foreach ($projectDetail as $projects) : ?>
                            <div class="row">

                                <div class="col-lg-6 my-2">
                                    <div class="form-floating">
                                        <input type="text" value="<?= htmlspecialchars($projects['Project_Name']) ?>" class="form-control" id="project-name-<?= $i ?>" name="project-name-<?= $i ?>" required placeholder="Remote Estimation">
                                        <label for="project-name-1">Project Name</label>
                                    </div>
                                </div>
                                <input type="hidden" value="<?= $projects['Id'] ?>" class="form-control" id="project-id-<?= $i ?>" name="project-id-<?= $i ?>" required placeholder="Remote Estimation">
                                <div class="col-lg-6 my-2">
                                    <div class="form-floating">
                                        <input type="date" value="<?= $projects['Delivery_Date'] ?>" class="form-control" id="delivery-date-<?= $i ?>" name="delivery-date-<?= $i ?>" required>
                                        <label for="delivery-date-1">Delivery Date</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 my-2">
                                    <div class="form-floating">
                                        <input type="number" value="<?= $projects['Lump_Sump_Charges'] ?>" class="form-control lump-sum-check" id="lump-sump-<?= $i ?>" name="lump-sump-<?= $i ?>" placeholder="0.00" required>
                                        <label for="lump-sump-<?= $i ?>">Lump Sump Amount</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 my-2">
                                    <label for="project-scope-<?= $i ?>" class="form-label">Project Scope</label>
                                    <select class="select2 form-select" id="project-scope-<?= $i ?>" name="project-scope-<?= $i ?>[]" multiple required>
                                        <?php foreach ($ProjectScopes as $value) { ?>
                                            <option value="<?= $value['Id'] ?>" <?php foreach ($previousScopes as $vs) : ?> <?php if ($projects['Id'] == $vs["Project_Id"]) : ?> <?php if ($value['Id'] == $vs['ProjectScopeType']) : ?>selected<?php endif ?> <?php endif  ?> <?php endforeach ?>><?= $value['Type_Names'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php $i++;
                            $k++;
                            $total_bill += $projects['Lump_Sump_Charges'];
                            ?>
                            <div class="text-end"><a href="" class="deleteButton btn btn-outline-danger btn-icon rounded-pill" id="<?= $projects['Id'] ?>"><i class="bx bx-trash"></i> </a></div>
                            <hr>
                        <?php endforeach ?>
                    <?php endif ?>
                    <div class="row">
                        <!-- <div class="col-12 text-end">
                            <button type="button" id="btn-add-more" class="btn btn-outline-primary btn-icon rounded-pill"><i class='bx bx-plus'></i></button>
                        </div> -->
                        <div class="col-12 text-center my-3">
                            <input type="submit" class="btn btn-primary" value="SUBMIT" name="submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-3 mt-lg-0">
            <div class="card">
                <h5 class="card-header">Bill</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="number" value="<?= $qoutation['Discount'] ?>" min="0" class="form-control" id="Discount" name="Discount" placeholder="0.00">
                                <label for="Discount">Discount</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive text-nowrap">
                            <table class="table">
                                <tr>
                                    <th>Total</th>
                                    <td><span>$</span><span id="total-bill"><?= $total_bill; ?></span></td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td><span id="discount-bill"><?= $qoutation['Discount'] ?></span><span>%</span></td>
                                </tr>
                                <tr>
                                    <th>Total Payable</th>
                                    <td><span>$</span><span id="total-payable-bill"><?= $total_bill - ($total_bill * ($qoutation['Discount'] / 100)) ?></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submit-form-client">
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" required id="clientName" name="clientName" placeholder="John Doe">
                                <label for="clientName">Name</label>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-floating">
                                <input type="email" class="form-control" required id="clientEmailAddress" name="clientEmailAddress" placeholder="example@gmail.com">

                                <label for="clientEmailAddress">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-1">
                            <div class="form-floating">
                                <input type="text" class="form-control" required id="clientPhoneNumber" name="clientPhoneNumber" placeholder="1-541-754-3010">

                                <label for="clientPhoneNumber">Phone Number</label>
                            </div>
                        </div>
                        <div class="col mb-1">
                            <div class="form-floating">
                                <select id="clientType" name="clientType" placeholder="Client Type" class="form-control">
                                    <option value="" selected disabled>Select Client Type</option>
                                    <?php foreach ($ClientType as $value) : ?>
                                        <option value="<?= $value['Id']  ?>"><?= $value['Type']  ?></option>
                                    <?php endforeach ?>
                                </select>
                                <label for="clientType">Client Type</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" name="client-submit" id="client-submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="<?= site_url("public/assets/vendor/libs/Select2/js/select2.js") ?>"></script>
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item:nth-of-type(4)").addClass("open active");
        // $(".menu-inner>li.menu-item:nth-of-type(2)>.menu-sub>li.menu-item:nth-of-type(2)").addClass("active");

        // Set default jQuery validator settings
        // $(".select2").select2();
        // $('.select2').each(function() {
        //     $(this).select2();
        // });
        jQuery.validator.setDefaults({
            errorClass: "error",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('invalid').removeClass(validClass);
                $(element).next("span").addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass(validClass).removeClass('invalid');
                $(element).next("span").addClass(errorClass);
            }
        });
        //Form Validation and Ajax Submit
        $("#submit-form-client").validate({
            rules: {
                clientPhoneNumber: {
                    required: true,
                    phoneUS: true
                },
                clientEmailAddress: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function() {
                $.ajax({
                    type: 'post',
                    url: '<?= site_url("Client/ajaxSubmit") ?>',
                    data: $("#submit-form-client").serialize(),
                    dataType: "json",
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            console.log("error");
                        }
                    }
                });
            }
        });

        //Discount and Total Bill Calculation
        $("#Discount").keyup(function() {
            $("#discount-bill").text($(this).val());
            if ($("#discount-bill").text() != "") {
                var discount = parseFloat($(this).val());
                var totalBill = parseFloat($("#total-bill").text());
                var totalPayable = totalBill - (totalBill * (discount / 100));
                $("#total-payable-bill").text(totalPayable.toFixed(2));
            } else {
                $("#discount-bill").text("0");
                var discount = 0;
                var totalBill = parseFloat($("#total-bill").text());
                var totalPayable = totalBill - (totalBill * (discount / 100));
                $("#total-payable-bill").text(totalPayable.toFixed(2));
            }
        });
        $("#submit-form").validate();

        function add_total() {
            $(".lump-sum-check").keyup(function() {
                // if (isNaN($("#total-bill").text()) || isNaN($("#total-payable-bill").text())) {
                //     $("#total-bill").text("0.0");
                //     $("#total-payable-bill").text("0.0");
                // }
                var total = 0;
                var i = 1;
                while (true) {
                    if ($("#lump-sump-" + i + "").length == 0) {
                        break;
                    } else {
                        if ($("#lump-sump-" + i + "").val() == "") {
                            var discount = parseFloat($("#discount-bill").text());
                            total = total + 0;
                            var totalPayable = total - (total * (discount / 100));
                            $("#total-payable-bill").text(totalPayable.toFixed(2));
                            $("#total-bill").text(total.toFixed(2));
                        } else {
                            var discount = parseFloat($("#discount-bill").text());
                            total = total + parseFloat($("#lump-sump-" + i + "").val());
                            var totalPayable = total - (total * (discount / 100));
                            $("#total-payable-bill").text(totalPayable.toFixed(2));
                            $("#total-bill").text(total.toFixed(2));
                        }
                    }
                    i++;
                }

            });
        }
        add_total();

    });
</script>
<script src="<?= site_url("public/assets/js/forms-selects.js") ?>"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Ajax for project -->
<script>
    $(document).ready(function() {



        // delete project function
        var number_of_project = <?= $k ?>;
        
        if (number_of_project == 1) {
            $(document).on('click', '.deleteButton', function(e) {
                e.preventDefault();
                swal.fire("Deleted", "Atleast One Project is Required for Qoutation", "warning").then(function() {});
            });
            // console.log(number_of_project);
        } else {
            $(document).on('click', '.deleteButton', function(e) {
                e.preventDefault();
                var project_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    html: "You won't to delete the Project!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#696cff',
                    cancelButtonColor: '#8592a3',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: '<?= site_url('Quotation/deleteproject') ?>',
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
        }


    });
</script>


<?= $this->endSection() ?>