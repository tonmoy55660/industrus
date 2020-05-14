<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Register</span>
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
                <div class="register-form">
                    <h2>Register</h2>
                    <?php if (isset($_SESSION['amsg'])) { ?>
                        <div class="alert alert-<?= $_SESSION['amsg']['type'] ?>" role="alert">
                            <?= $_SESSION['amsg']['msg'] ?>
                        </div>
                    <?php unset($_SESSION['amsg']);
                    } ?>
                    <form class="form-horizontal" action="registersave.php" method="POST">
                        <div class="group-input">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="name">
                        </div>
                        <div class="group-input">
                            <label for="company_name">Company Name</label>
                            <input type="text" id="company_name" name="company_name" placeholder="company_name">
                        </div>
                        <div class="group-input">
                            <label for="email">E-mail</label>
                            <input type="text" id="email" name="email" placeholder="email">
                        </div>
                        <div class="group-input">
                            <label for="phone">Contact No:</label>
                            <input type="text" id="phone" name="phone" placeholder="phone">
                        </div>

                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="password">
                        </div>
                        <div class="group-input">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" id="cpassword" placeholder="confirm password">
                        </div>
                        <button type="submit" class="site-btn register-btn" name="register" id="register">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="./login.php" class="or-login">Or Login</a>
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
            if ($('#name').val() == '') {
                $('#name').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
            if ($('#email').val() == '') {
                $('#email').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
            if ($('#password').val() == '') {
                $('#password').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
            if ($('#cpassword').val() == '') {
                $('#cpassword').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
            if ($('#cpassword').val() != $('#password').val()) {
                $('#cpassword').after('<span class="error">* Password Not Matched !</span>').addClass("validateBorder").focus();
                return false;
            }
            if ($('#company_name').val() == '') {
                $('#company_name').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
            if ($('#phone').val() == '') {
                $('#phone').after('<span class="error">* This field is required</span>').addClass("validateBorder").focus();
                return false;
            }
            if (isNaN($("#phone").val())) {
                $('#phone').after('<span class="error">* Phone Number is numeric!!</span>').addClass("validateBorder").focus();
                return false;
            }
        });
    });

    $('#email').on('input', function() {
        $(".error").remove();
        $(".validateBorder").removeClass();
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())) {
            $('#email').after('<span class="error">* Type a valid email!!</span>').addClass("validateBorder").focus();
            return false;
        }
    });
</script>