<?php
$title = "Industrus | Login";
include 'includes/admin-header.php';
?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index"><b>Admin</b></br> Industrus</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">

        <form action="controllers/loginController.php" id="loginForm" method="post" autocomplete="on">

          <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger text-center" role="alert">
              <i class="fas fa-exclamation-triangle"></i> Invalid Login!
            </div>
          <?php unset($_SESSION['error']);
          }
          ?>

          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="on">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-4">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="input-group mb-3">
            <button type="submit" name="login" class="btn btn-outline-success btn-block">Sign In</button>
          </div>

        </form>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

  </div>
  <?php
  include 'includes/admin-footer.php';
  ?>

  <script type="text/javascript">
    $(document).ready(function() {

      $('#loginForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 5
          }
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>
</body>

</html>