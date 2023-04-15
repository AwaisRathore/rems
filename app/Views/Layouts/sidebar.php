<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo justify-content-center">
        <a href="<?= site_url("Home/index") ?>" class="app-brand-link">
            <span>
                <img height="75%" width="75%" src="<?= site_url("public/assets/img/favicon/favicon.png") ?>" alt="brand-logo">
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item">
            <a href="<?= site_url("Home/index") ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>
        <!-- Manage Project -->
        <?php if (current_userRole()->name == 'Admin' ) : ?>
            <?php if (current_userRole()->CanViewClientProject || current_userRole()->CanAddClientProject || current_userRole()->CanEditClientProject || current_userRole()->CanDeleteClientProject) : ?>

                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-category"></i>
                        <div>
                            <?php if (current_userRole()->name == 'Admin' || current_userRole()->name == 'Employee') {
                                echo "Manage Project";
                            }
                            ?>

                        </div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?= site_url("ClientProject/index") ?>" class="menu-link">
                                <div>View All</div>
                            </a>
                        </li>
                        <?php if (current_userRole()->CanAddClientProject) : ?>
                            <li class="menu-item">
                                <a href="<?= site_url("ClientProject/new") ?>" class="menu-link">
                                    <div>Add New</div>
                                </a>
                            </li>
                        <?php endif ?>

                    </ul>
                </li>
            <?php endif ?>
        <?php endif ?>

        <?php if (current_userRole()->name == "Client") : ?>
            <li class="menu-item">
                <a href="<?= site_url("ClientProject/index") ?>" class="menu-link">
                    <i class='menu-icon bx bx-task'></i>
                    <div>Project Dashboard</div>
                </a>
            </li>
        <?php endif ?>
        <?php if (current_userRole()->name == "Employee") : ?>
            <li class="menu-item">
                <a href="<?= site_url("ClientProject/index") ?>" class="menu-link">
                    <i class='menu-icon bx bx-task'></i>
                    <div>Project Dashboard</div>
                </a>
            </li>
        <?php endif ?>
        <?php if (current_userRole()->name == "Client") : ?>
            <li class="menu-item">
                <a href="<?= site_url("ClientProject/new") ?>" class="menu-link">
                    <i class='menu-icon bx bx-clipboard'></i>
                    <div>Request Qoutation</div>
                </a>
            </li>
        <?php endif ?>
        <?php if (current_userRole()->name == "Client") : ?>
            <li class="menu-item">
                <a href="<?= site_url("Quotation/index") ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-badge-dollar"></i>
                    <div>View Qoutation</div>
                </a>
            </li>
        <?php endif ?>
        <!-- Manage Clients -->
        <?php if (current_userRole()->CanViewClient || current_userRole()->CanAddClient || current_userRole()->CanEditClient || current_userRole()->CanDeleteClient) : ?>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                    <div>Manage Clients</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="<?= site_url("Client/index") ?>" class="menu-link">
                            <div>View All</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= site_url("Client/new") ?>" class="menu-link">
                            <div>Add New</div>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif ?>
        <!-- Manage Quotation -->
        <?php if (current_userRole()->CanViewQuotation || current_userRole()->CanAddQuotation || current_userRole()->CanEditQuotation || current_userRole()->CanDeleteQuotation) : ?>
            <?php if (current_userRole()->id == 1) : ?>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-badge-dollar"></i>
                        <div>Manage Quotation <?php if (noOfNotqouted() > 0) : ?><span class="badge bg-warning"><?= noOfNotqouted(); ?></span> <?php endif ?></div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?= site_url("Quotation/index") ?>" class="menu-link ">
                                <div>View All</div>
                            </a>
                        </li>
                        <?php if (current_userRole()->CanAddQuotation) : ?>
                            <li class="menu-item">
                                <a href="<?= site_url("Quotation/new") ?>" class="menu-link">
                                    <div>Add New</div>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </li>
            <?php endif ?>
        <?php endif ?>
        
        <?php if (current_userRole()->CanViewInvoice || current_userRole()->CanAddInvoice || current_userRole()->CanEditInvoice || current_userRole()->CanDeleteInvoice) : ?>
            <?php if (current_userRole()->id == 1) : ?>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-badge-dollar"></i>
                        <div>Manage Invoices</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?= site_url("Invoices/index") ?>" class="menu-link ">
                                <div>View All</div>
                            </a>
                        </li>
                       
                    </ul>
                </li>
            <?php endif ?>
        <?php endif ?>

        <!-- Adminitration -->
        <?php if (current_userRole()->name == 'Admin') : ?>
            <li class="menu-item adminstration">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div>Adminitration</div>
                </a>
                <ul class="menu-sub">

                    <?php if (current_userRole()->CanViewClientType || current_userRole()->CanAddClientType || current_userRole()->CanEditClientType || current_userRole()->CanDeleteClientType) : ?>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bxs-category"></i>
                                <div>Manage Client Type</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= site_url("ClientType/index") ?>" class="menu-link">
                                        <div>View All</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= site_url("ClientType/new") ?>" class="menu-link">
                                        <div>Add New</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>
                    <?php if (current_userRole()->CanViewEmployeeType || current_userRole()->CanAddEmployeeType || current_userRole()->CanEditEmployeeType || current_userRole()->CanDeleteEmployeeType) : ?>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bxs-category"></i>
                                <div>Manage Employee Type</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= site_url("EmployeeType/index") ?>" class="menu-link">
                                        <div>View All</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= site_url("EmployeeType/new") ?>" class="menu-link">
                                        <div>Add New</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>

                    <?php if (current_userRole()->CanViewProjectScope || current_userRole()->CanAddProjectScope || current_userRole()->CanEditProjectScope || current_userRole()->CanDeleteProjectScope) : ?>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bxs-category"></i>
                                <div>Manage Project Scopes</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= site_url("ProjectScopeType/index") ?>" class="menu-link">
                                        <div>View All</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="<?= site_url("ProjectScopeType/new") ?>" class="menu-link">
                                        <div>Add New</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    <?php endif ?>
                    <!-- Manage Roles -->

                    <?php if (current_userRole()->CanViewRole || current_userRole()->CanAddRole || current_userRole()->CanEditRole || current_userRole()->CanDeleteRole) : ?>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bxs-category"></i>
                                <div>Manage Roles</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= site_url("Roles/index") ?>" class="menu-link">
                                        <div>View All</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= site_url("Roles/new") ?>" class="menu-link">
                                        <div>Add New</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>
                    <!-- Manage Users -->
                    <?php if (current_userRole()->CanViewUser || current_userRole()->CanAddUser || current_userRole()->CanEditUser || current_userRole()->CanDeleteUser) : ?>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                                <div>Manage Users</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="<?= site_url("Users/index") ?>" class="menu-link">
                                        <div>View All</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="<?= site_url("Users/new") ?>" class="menu-link">
                                        <div>Add New</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
                <!-- Manage Client Type -->

            </li>
        <?php endif ?>



    </ul>
</aside>