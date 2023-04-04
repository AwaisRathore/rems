<?= $this->extend('Layouts/default') ?>
<?= $this->section('title') ?> Remote Estimation | Users <?= $this->endSection() ?>
<?= $this->section('PageCss') ?>
<!-- Datatable css -->
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css") ?>">
<link rel="stylesheet" href="<?= site_url("public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <h5 class="card-header">Users Detail</h5>
    <div class="card-body">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table border-top">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User name</th>
                        <th>Profile Image</th>
                        <th>Email</th>
                        <th>role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach ($users as $value) : ?>
                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><?= $value['username'] ?></td>
                            <td>
                                <div style="width : 40px; height : 40px; overflow : hidden;border-radius : 50%">
                                <img src="<?= site_url($value['profile_image']) ?>" style="width :40px;" alt="">
                                </div>
</td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $value['name'] ?></td>
                            <!-- <td></td> -->
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= site_url("users/edit/" . $value['id'] . "") ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item deleteButton" id="<?= $value['id'] ?>" href=""><i class="bx bx-trash me-1"></i> Delete</a>
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
            var user_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                html: "Do you want to Delete the Users!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?= site_url('Users/delete/') ?>',
                        type: 'get',
                        data: {
                            delete_id: user_id
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