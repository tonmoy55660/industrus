<?php
include_once("dbCon.php");
$conn = connect();
if (isset($_GET['email'])) {
    $mail = $_GET['email'];
    //echo $mail;exit;
    $token = $_GET['token'];
    $sql = "SELECT * FROM user_login where email ='$mail' AND token='$token'";
    $result = $conn->query($sql);
    //echo $sql;exit;
    if ($result->num_rows > 0) {
    } else {
        header("Location:404");
    }
}
if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $sql = "UPDATE user_login SET password='$password', token='' WHERE email='$email'";
    $result = $conn->query($sql);
    header("Location:login");
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>reset Password</span>
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
                    <h2>Reset Password</h2>
                    <form action="" onsubmit="return nullcheck();" method="POST">
                        <div class="group-input">
                            <label for="username">Email address *</label>
                            <input type="text" name="email" value="<?= $_GET['email'] ?>">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input type="password" id="password" name="password" placeholder="password">
                        </div>
                        <div class="group-input">
                            <label for="pass">Confirm Password *</label>
                            <input type="password" id="cpassword" name="cpassword" placeholder="confirm password">
                        </div>
                        <button type="submit" class="site-btn login-btn" name="reset">Reset Password</button>
                    </form>
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

<script>
    function nullcheck() {

        $(".error").remove();

        if ($('#password').val() == '') {
            $('#password').after('<span class="error">* This field is required</span>');
            return false;
        }
        if ($('#cpassword').val() == '') {
            $('#cpassword').after('<span class="error">* This field is required</span>');
            return false;
        }
        if ($('#password').val() !== $('#cpassword').val()) {
            $('#cpassword').after('<span class="error">* Password does not match</span>');
            return false;
        }


    }
</script>

<!-- Partner Logo Section End -->
<?php include 'includes/footer.php'; ?>
