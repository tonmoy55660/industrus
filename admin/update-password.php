<?php
$title = "Industrus | Update Password";
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

                <form action="controllers/updatePasswordController.php" id="updatePass" method="post">

                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <i class="fas fa-exclamation-triangle"></i> Password Incorrect!
                        </div>
                    <?php unset($_SESSION['error']);
                    }
                    ?>

                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" id="password" name="new_password" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="input-group mb-3">
                        <button type="submit" name="updatepass" class="btn btn-outline-success btn-block">Update Password</button>
                    </div>

                </form>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <?php include 'includes/admin-footer.php'; ?>
        <script type="text/javascript">
            $(document).ready(function() {

                $('#updatePass').validate({
                    rules: {
                        new_password: {
                            required: true,
                            minlength: 6
                        },
                        current_password: {
                            required: true,
                            minlength: 6
                        },
                        confirm_password: {
                            required: true,
                            minlength: 6,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        current_password: {
                            required: "Please provide your current password",
                            minlength: "Your password must be at least 6 characters long"
                        },
                        new_password: {
                            required: "Please provide a new password",
                            minlength: "Your password must be at least 6 characters long"
                        },
                        confirm_password: {
                            required: "Please confirm new password",
                            minlength: "Your password must be at least 6 characters long"
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