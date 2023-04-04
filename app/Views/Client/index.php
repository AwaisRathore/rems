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
    <h5 class="card-header">Client Detail</h5>
    <div class="card-body">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Client Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($clientsData as $value) : ?>
                        <tr>
                            <td><?= $value["Id"] ?></td>
                            
                            <td><?= $value["Name"] ?></td>
                            <td><?= $value["Email_Address"] ?></td>
                            <td><?= $value["Phone_Number"] ?></td>
                            <td><?= $value["Type"] ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php if($value["user_id"] == null): ?>
                                            <a class="dropdown-item" href="<?= site_url("Client/Makeuser/" . $value["Id"] . "") ?>"><i class='bx bx-user'></i> Make client a User</a>
                                        <?php endif ?>
                                        <a class="dropdown-item" href="<?= site_url("Client/edit/" . $value["Id"] . "") ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="<?= site_url("Client/delete/" . $value["Id"] . "") ?>"><i class="bx bx-trash me-1"></i> Delete</a>
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
<script>
    $(document).ready(function() {
        // Sidebar active show
        $("li.menu-item").removeClass("active");
        $(".menu-inner>li.menu-item:nth-of-type(3)").addClass("open active");
        $(".menu-inner>li.menu-item:nth-of-type(3)>.menu-sub>li.menu-item:nth-of-type(1)").addClass("active");
        // Data Table 
        $(".datatables-basic").DataTable();
    })
</script>
<?= $this->endSection() ?>