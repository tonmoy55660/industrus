<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Login</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Login</h2>
                    <?php if (isset($_SESSION['amsg'])) { ?>
                        <div class="alert alert-<?= $_SESSION['amsg']['type'] ?>" role="alert">
                            <?= $_SESSION['amsg']['msg'] ?>
                        </div>
                    <?php unset($_SESSION['amsg']);
                    } ?>
                    <form action="loginsave.php" method="POST">
                        <div class="group-input">
                            <label for="email">Email address *</label>
                            <input type="text" id="email" name="email" placeholder="email" autocomplete="on">
                        </div>
                        <div class="group-input">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" placeholder="password">
                        </div>
                        <div class="group-input gi-check">
                            <div class="gi-more">
                                <a href="forgotpassword" class="forget-pass">Forget your Password</a>
                            </div>
                        </div>
                        <button type="submit" id="submit" class="site-btn login-btn" name="login">Sign In</button>
                    </form>
                    <div class="switch-login">
                        <a href="./register.php" class="or-login">Or Create An Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<!-- Partner Logo Section Begin -->
<div class="partner-logo">
    <div class="container">
        <div class="logo-carousel owl-carousel">
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-1.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-2.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-3.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-4.png" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="img/logo-carousel/logo-5.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Partner Logo Section End -->
<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function() {
        $("form").submit(function() {
            $(".error").remove();
            $("input").removeClass("validateBorder");
            if ($('#email').val() == '') {
                $('#email').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
            if ($('#password').val() == '') {
                $('#password').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
        });
    });

    $('#email').on('input', function() {
        $(".error").remove();
        $(".validateBorder").removeClass();
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())) {
            $('#email').after('<span class="error">* Type a valid email!!</span>').addClass("validateBorder").focus();
        }
    });
</script>