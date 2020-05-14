<?php session_start(); ?>
</head>

<body>
    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        industrus@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        +880-1234567899
                    </div>
                </div>
                <div class="ht-right">
                    <?php if (isset($_SESSION['isLoggedIn'])) { ?>
                        <a class="login-panel"><i class="fa fa-user"></i><?= $_SESSION['name'] ?></a>
                    <?php } else { ?>
                        <a class="login-panel" href="login"><i class="fa fa-user"></i>Login</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li><a href="index">Women’s Clothing</a></li>
                            <li><a href="index">Men’s Clothing</a></li>
                            <li><a href="index">Underwear</a></li>
                            <li><a href="index">Kid's Clothing</a></li>
                            <li><a href="index">Brand Fashion</a></li>
                            <li><a href="index">Accessories/Shoes</a></li>
                            <li><a href="index">Luxury Brands</a></li>
                            <li><a href="index">Brand Outdoor Apparel</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li><a href="index">Home</a></li>
                        <li><a href="sample-request">Order</a></li>
                        <li><a href="blog">Blog</a></li>
                        <li><a href="contact">Contact</a></li>
                        <?php if (isset($_SESSION['isLoggedIn'])) { ?>

                            <li><a href="logout">Log Out</a></li>
                        <?php } else { ?>
                            <li><a href="login">Log In</a></li>
                        <?php } ?>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>