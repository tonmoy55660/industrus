<?php
include_once("dbCon.php");
$conn =connect();
if(isset($_POST["send"])){

  $email= mysqli_real_escape_string($conn,$_POST['email']);
  $sql="SELECT * FROM user_login where email ='$email'";
  $result = $conn->query($sql);
  					//	print_r($result);
                if($result->num_rows>0){
                  header("Location:recoverymail?email=$email");
                }else{
                  echo '<script>alert("not ok");</script>';
                }

}
 ?>
<?php include'includes/header.php';?>
<?php include'includes/navbar.php';?>


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
                        <h2>Input your mail</h2>
                        <form action="" onsubmit="return nullcheck();" action="registersave.php"  method="POST">
                            <div class="group-input">
                                <label for="username">Email address *</label>
                                <input type="text" id="email"  name="email" placeholder="email">
                            </div>
                            <button type="submit" class="site-btn login-btn" name="send">Send me a recovery mail</button>
                        </form>
                        <div class="switch-login">
                            <a href="login" class="or-login">Login</a>
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

    <script>
      function nullcheck(){

        $(".error").remove();

        if($('#email').val()==''){
          $('#email').after('<span class="error">* This field is required</span>');
          return false;
        }


         if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())){

          $('#email').after('<span class="error">* Type a valid email!!</span>');
          $('#submit').attr('disabled',true);
          return false;

        }
      }

      </script>

    <!-- Partner Logo Section End -->
<?php include'includes/footer.php';?>
