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
    <h5 class="card-header">Notification</h5>
    <div class="card-body">
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

                    use App\Controllers\Quotation;

                    $i = 1;
                    foreach ($notification as $value) :
                    ?>

                        <tr class="<?php
                                    if ($value['status'] == 0) {
                                        echo "light-info-bg";
                                    }
                                    ?>">
                            <td><?= $i ?></td>

                            <td class="d-flex"> <a href="<?php if ($value['qoutation_id'] == ' ' || $value['qoutation_id'] != null) : ?><?= site_url('Quotation/view/' . $value['qoutation_id'] . '') ?> <?php endif ?>
                                    <?php if ($value['project_id'] == ' ' || $value['project_id'] != null) : ?><?= site_url('ClientProject/view/' . $value['project_id'] . '') ?> <?php endif ?>" class="nav-link" style="padding: 0px !important"><?= $value['message'] ?></a>
                                <?php if($value['status'] == 0): ?>
                                <div class="blink">
                                    <span class="badge badge-sm bg-danger">New</span>
                                </div>
                                <?php endif ?>
                            </td>
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
        // Data Table 
        $(".datatables-basic").DataTable();
    })
</script>
<?= $this->endSection() ?>