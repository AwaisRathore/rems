<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Role <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Role Detail</h5>
    <div class="card-body">
        <div class="card-datatable table-responsive pt-0">
            <?php if (session()->has('warning')) : ?>
                <div class="alert alert-danger" role="alert">
                    <b>Error:</b> <?= session('warning') ?>
                </div>
            <?php endif ?>
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>role name</th>
                        <th>CanViewUsers</th>
                        <th>CanAddUsers</th>
                        <th>CanEditUsers</th>
                        <th>CanDeleteUsers</th>
                        <th>CanViewRole</th>
                        <th>CanAddRole</th>
                        <th>CanEditRole</th>
                        <th>CanDeleteRole</th>
                        <th>CanViewQuotation</th>
                        <th>CanAddQuotation</th>
                        <th>CanEditQuotation</th>
                        <th>CanDeleteQuotation</th>
                        <th>CanViewClient</th>
                        <th>CanAddClient</th>
                        <th>CanEditClient</th>
                        <th>CanDeleteClient</th>
                        <th>CanViewClientType</th>
                        <th>CanAddClientType</th>
                        <th>CanEditClientType</th>
                        <th>CanDeleteClientType</th>
                        <th>CanViewProjectScope</th>
                        <th>CanAddProjectScope</th>
                        <th>CanEditProjectScope</th>
                        <th>CanDeleteProjectScope</th>
                        <th>CanViewClientProject</th>
                        <th>CanAddClientProject</th>
                        <th>CanEditClientProject</th>
                        <th>CanDeleteClientProject</th>
                        <th>CanAssignProject</th>
                        <th>CanViewInvoice</th>
                        <th>CanAddInvoice</th>
                        <th>CanEditInvoice</th>
                        <th>CanDeleteInvoice</th>
                        <th>CanViewEmployeeType</th>
                        <th>CanAddEmployeeType</th>
                        <th>CanEditEmployeeType</th>
                        <th>CanDeleteEmployeeType</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($role as $value) : ?>
                        <tr>
                            <td><?= $value->id ?></td>
                            <td><?= $value->name ?></td>
                            <?= dispalyPermissionsIcons($value->CanViewUser) ?>
                            <?= dispalyPermissionsIcons($value->CanAddUser) ?>
                            <?= dispalyPermissionsIcons($value->CanEditUser) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteUser) ?>
                            <?= dispalyPermissionsIcons($value->CanViewRole) ?>
                            <?= dispalyPermissionsIcons($value->CanAddRole) ?>
                            <?= dispalyPermissionsIcons($value->CanEditRole) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteRole) ?>
                            <?= dispalyPermissionsIcons($value->CanViewQuotation) ?>
                            <?= dispalyPermissionsIcons($value->CanAddQuotation) ?>
                            <?= dispalyPermissionsIcons($value->CanEditQuotation) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteQuotation) ?>
                            <?= dispalyPermissionsIcons($value->CanViewClient) ?>
                            <?= dispalyPermissionsIcons($value->CanAddClient) ?>
                            <?= dispalyPermissionsIcons($value->CanEditClient) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteClient) ?>
                            <?= dispalyPermissionsIcons($value->CanViewClientType) ?>
                            <?= dispalyPermissionsIcons($value->CanAddClientType) ?>
                            <?= dispalyPermissionsIcons($value->CanEditClientType) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteClientType) ?>
                            <?= dispalyPermissionsIcons($value->CanViewProjectScope) ?>
                            <?= dispalyPermissionsIcons($value->CanAddProjectScope) ?>
                            <?= dispalyPermissionsIcons($value->CanEditProjectScope) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteProjectScope) ?>
                            <?= dispalyPermissionsIcons($value->CanViewClientProject) ?>
                            <?= dispalyPermissionsIcons($value->CanAddClientProject) ?>
                            <?= dispalyPermissionsIcons($value->CanEditClientProject) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteClientProject) ?>
                            <?= dispalyPermissionsIcons($value->CanAssignProject) ?>
                            <?= dispalyPermissionsIcons($value->CanViewInvoice) ?>
                            <?= dispalyPermissionsIcons($value->CanAddInvoice) ?>
                            <?= dispalyPermissionsIcons($value->CanEditInvoice) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteInvoice) ?>
                            <?= dispalyPermissionsIcons($value->CanViewEmployeeType) ?>
                            <?= dispalyPermissionsIcons($value->CanAddEmployeeType) ?>
                            <?= dispalyPermissionsIcons($value->CanEditEmployeeType) ?>
                            <?= dispalyPermissionsIcons($value->CanDeleteEmployeeType) ?>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= site_url("roles/edit/" . $value->id . "") ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item deleteButton <?php if ($value->id == 1 || $value->id == 2 || $value->id == 5) : ?>disabled<?php endif ?>" href="" id="<?= $value->id ?>"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item:nth-of-type(6)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(4)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(6)>.menu-sub>li.menu-item:nth-of-type(4)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        // Data Table 
        $(".datatables-basic").DataTable();

        $(document).on('click', '.deleteButton', function(e) {
            e.preventDefault();
            var role_id = $(this).attr('id');
            console.log(role_id);
            Swal.fire({
                title: 'Are you sure?',
                html: "Do you want to Delete the Role!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?= site_url('Roles/delete/') ?>',
                        type: 'get',
                        data: {
                            delete_id: role_id
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