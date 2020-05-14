<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-navy">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
                </li>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="fas fa-user"></i>
                        &nbsp; <?= $_SESSION['admin-name'] ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout"><i class="fas fa-power-off"></i>&nbsp; Sign Out</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->