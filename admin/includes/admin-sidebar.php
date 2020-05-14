<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-navy">
    <!-- Brand Logo -->
    <a class="brand-link text-center">
        <span class="brand-text font-weight-dark"><b>INDUSTRUS</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php if ((isset($_SESSION['isLoggedIn'])) && ($_SESSION['admin-role'] == 0)) { ?>
                    <label class="text-secondary mb-3 text-center text-sm">NAVIGATION</label>
                    <li class="nav-item has-treeview ">
                        <a href="admin-dashboard" class="nav-link <?= ($activePage == 'admin-dashboard') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <!-- Marchant Menu -->
                <?php if ((isset($_SESSION['isLoggedIn'])) && ($_SESSION['admin-role'] == 1 || $_SESSION['admin-role'] == 0)) { ?>
                    <label class="text-secondary mb-3 text-center text-sm">MARCHANT NAVIGATION</label>
                    <li class="nav-item has-treeview ">
                        <a href="marchant-dashboard" class="nav-link <?= ($activePage == 'marchant-dashboard') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Marchant Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="sample-requests" class="nav-link <?= ($activePage == 'sample-requests' || $activePage == 'view-sample-details') ? 'active' : ''; ?> ">
                            <i class="nav-icon fab fa-buromobelexperte"></i>
                            <p>
                                All Sample Requests
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="detailed-orders" class="nav-link <?= ($activePage == 'detailed-orders' || $activePage == 'view-order-details' || $activePage == 'calculate-cost') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Detailed orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="task-allocate" class="nav-link <?= ($activePage == 'task-allocate' || $activePage == 'order-task') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>
                                Allocate Tasks
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="production-status" class="nav-link <?= ($activePage == 'production-status') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-industry"></i>
                            <p>
                                Production Status
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="finished-orders" class="nav-link <?= ($activePage == 'finished-orders' || $activePage == 'finished-order-details') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>
                                Finished Orders
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <?php if ((isset($_SESSION['isLoggedIn'])) && ($_SESSION['admin-role'] == 2 || $_SESSION['admin-role'] == 0)) { ?>
                    <label class="text-secondary mb-3 text-center text-sm">KNITTING MASTER NAVIGATION</label>
                    <li class="nav-item has-treeview ">
                        <a href="knitting-master-dashboard" class="nav-link <?= ($activePage == 'knitting-master-dashboard') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="knitting-orders" class="nav-link <?= ($activePage == 'knitting-orders') || $activePage == 'knitting-order-details' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Knitting Orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="knitting-finished-orders" class="nav-link <?= ($activePage == 'knitting-finished-orders') || $activePage == 'knitting-finished-order-details' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                knitting Finished Orders
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <?php if ((isset($_SESSION['isLoggedIn'])) && ($_SESSION['admin-role'] == 3 || $_SESSION['admin-role'] == 0)) { ?>
                    <label class="text-secondary mb-3 text-center text-sm">CUTTING MASTER NAVIGATION</label>
                    <li class="nav-item has-treeview ">
                        <a href="cutting-master-dashboard" class="nav-link <?= ($activePage == 'cutting-master-dashboard') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="cutting-orders" class="nav-link <?= ($activePage == 'cutting-orders') || $activePage == 'cutting-order-details' || $activePage == 'cutting-production-history' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Cutting Orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="cutting-finished-orders" class="nav-link <?= ($activePage == 'cutting-finished-orders') || $activePage == 'cutting-finished-order-details' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Cutting Finished Orders
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <?php if ((isset($_SESSION['isLoggedIn'])) && ($_SESSION['admin-role'] == 4 || $_SESSION['admin-role'] == 0)) { ?>
                    <label class="text-secondary mb-3 text-center text-sm">SEWING MASTER NAVIGATION</label>
                    <li class="nav-item has-treeview ">
                        <a href="sewing-master-dashboard" class="nav-link <?= ($activePage == 'sewing-master-dashboard') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="sewing-orders" class="nav-link <?= ($activePage == 'sewing-orders') || $activePage == 'sewing-order-details' || $activePage == 'sewing-production-history' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Sewing Orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="sewing-finished-orders" class="nav-link <?= ($activePage == 'sewing-finished-orders') || $activePage == 'sewing-finished-order-details' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Sewing Finished Orders
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <?php if ((isset($_SESSION['isLoggedIn'])) && ($_SESSION['admin-role'] == 5 || $_SESSION['admin-role'] == 0)) { ?>
                    <label class="text-secondary mb-3 text-center text-sm">PACKAGE MASTER NAVIGATION</label>
                    <li class="nav-item has-treeview ">
                        <a href="package-master-dashboard" class="nav-link <?= ($activePage == 'package-master-dashboard') ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="package-orders" class="nav-link <?= ($activePage == 'package-orders') || $activePage == 'package-order-details' || $activePage == 'package-production-history' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Package Orders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview ">
                        <a href="package-finished-orders" class="nav-link <?= ($activePage == 'package-finished-orders') || $activePage == 'package-finished-order-details' ? 'active' : ''; ?> ">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Package Finished Orders
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item has-treeview ">
                    <a href="update-password" class="nav-link <?= ($activePage == 'update-password') ? 'active' : ''; ?> ">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            Update Password
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">