<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Mail </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

    <script type="text/javascript">
        function myAlert() {
            swal({
                title: "Mail Sent Successfully",
                type: "success",
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false,
                closeOnClickOutside: false,
            }, function() {
                window.location.href = "login";
            });
        }

        function erAlert() {
            swal({
                title: "Mail cannot be sent",
                type: "error",
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false,
                closeOnClickOutside: false,
            }, function() {
                window.location.href = "forgotpassword";
            });
        }
    </script>
</head>

<body>
    <?php
    include_once 'dbCon.php';
    $conn = connect();
    if (isset($_GET['email'])) {
        function generateRandomString()
        {
            $characters = '123456789abcdefghijklmnopqrstuvwxyz';
            $length = 15;
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $token = generateRandomString();
        $usermail = $_GET['email'];
        //echo $usermail;exit;
        $mailto = $usermail;
        $mailSub   = "Account Set Up";
        $message = '<html>
                <head>
                    <title>Reset Password</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                    <style type="text/css">
                        @font-face {
                            font-family: &#x27;
                            Postmates Std&#x27;
                            ;
                            font-weight: 600;
                            font-style: normal;
                            src: local(&#x27;
                            Postmates Std Bold&#x27;
                            ),
                            url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-bold.woff) format(&#x27;
                            woff&#x27;
                            );
                        }

                        @font-face {
                            font-family: &#x27;
                            Postmates Std&#x27;
                            ;
                            font-weight: 500;
                            font-style: normal;
                            src: local(&#x27;
                            Postmates Std Medium&#x27;
                            ),
                            url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-medium.woff) format(&#x27;
                            woff&#x27;
                            );
                        }

                        @font-face {
                            font-family: &#x27;
                            Postmates Std&#x27;
                            ;
                            font-weight: 400;
                            font-style: normal;
                            src: local(&#x27;
                            Postmates Std Regular&#x27;
                            ),
                            url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-regular.woff) format(&#x27;
                            woff&#x27;
                            );
                        }
                    </style>
                    <style media="screen and (max-width: 680px)">
                        @media screen and (max-width: 680px) {
                            .page-center {
                                padding-left: 0 !important;
                                padding-right: 0 !important;
                            }
                            .footer-center {
                                padding-left: 20px !important;
                                padding-right: 20px !important;
                            }
                        }
                    </style>
                </head>

                <body style="background-color: #f4f4f5;">
                    <table cellpadding="0" cellspacing="0" style="width: 100%; height: 100%; background-color: #f4f4f5; text-align: center;">
                        <tbody>
                            <tr>
                                <td style="text-align: center;">
                                    <table align="center" cellpadding="0" cellspacing="0" id="body" style="background-color: #fff; width: 100%; max-width: 680px; height: 100%;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table align="center" cellpadding="0" cellspacing="0" class="page-center" style="text-align: left; padding-bottom: 88px; width: 100%; padding-left: 120px; padding-right: 120px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding-top: 24px;">
                                                                    <img src="https://d1pgqke3goo8l6.cloudfront.net/wRMe5oiRRqYamUFBvXEw_logo.png" style="width: 56px;">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="padding-top: 72px; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #000000; font-family: " Postmates Std ", "Helvetica ", -apple-system, BlinkMacSystemFont, "Segoe UI ", "Roboto ", "Oxygen ", "Ubuntu ", "Cantarell ", "Fira Sans ", "Droid Sans ", "Helvetica Neue ", sans-serif; font-size: 48px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: -2.6px; line-height: 52px; mso-line-height-rule: exactly; text-decoration: none;">Reset your password</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 48px; padding-bottom: 48px;">
                                                                    <table cellpadding="0" cellspacing="0" style="width: 100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 100%; height: 1px; max-height: 1px; background-color: #d9dbe0; opacity: 0.81"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="-ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: " Postmates Std ", "Helvetica ", -apple-system, BlinkMacSystemFont, "Segoe UI ", "Roboto ", "Oxygen ", "Ubuntu ", "Cantarell ", "Fira Sans ", "Droid Sans ", "Helvetica Neue ", sans-serif; font-size: 16px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: -0.18px; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%;">
                                                                    You"re receiving this e-mail because you requested a password reset for your Industrus account.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top: 24px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: " Postmates Std ", "Helvetica ", -apple-system, BlinkMacSystemFont, "Segoe UI ", "Roboto ", "Oxygen ", "Ubuntu ", "Cantarell ", "Fira Sans ", "Droid Sans ", "Helvetica Neue ", sans-serif; font-size: 16px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: -0.18px; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%;">
                                                                    Please tap the button below to choose a new password.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a data-click-track-id="37" href="http://localhost/industrus/resetpassword?email=' . $usermail . '&&token=' . $token . '" style="margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: " Postmates Std ", "Helvetica ", -apple-system, BlinkMacSystemFont, "Segoe UI ", "Roboto ", "Oxygen ", "Ubuntu ", "Cantarell ", "Fira Sans ", "Droid Sans ", "Helvetica Neue ", sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px; background-color: #00cc99; border-radius: 28px; display: block; text-align: center; text-transform: uppercase" target="_blank">
                                                      Reset Password
                                                      </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table align="center" cellpadding="0" cellspacing="0" id="footer" style="background-color: #ffe420; width: 100%; max-width: 680px; height: 100%;">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table align="center" cellpadding="0" cellspacing="0" class="footer-center" style="text-align: left; width: 100%; padding-left: 120px; padding-right: 120px;">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2" style="padding-top: 30px; padding-bottom: 12px; width: 100%;">
                                                                   Industrus
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height: 72px;"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </body>
                </html>';

        $mailMsg   = $message;
        require 'PHPMailer-master/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer'     => false,
                'verify_peer_name'   => false,
                'allow_self_signed' => true
            )
        );
        $mail->IsSmtp();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        // $mail ->Port = 465; // or 587
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "Tonmoytouhid589@gmail.com";
        $mail->Password = "TONMOY1234567890";
        $mail->setFrom('industrus', 'BD');
        $mail->FromName = 'Industrus Support Team';
        $mail->Subject = $mailSub;
        $mail->Body = $mailMsg;
        $mail->AddAddress($mailto);
        // $mail->AddAddress('tanveershuvos@gmail.com');
        if (!$mail->Send()) {
            echo '<script>erAlert()</script>';
        } else {
            $sql = "UPDATE user_login SET token = '$token' WHERE email= '$usermail'";
            $conn->query($sql);
            echo '<script>myAlert()</script>';
        }
    }
    ?>
</body>

</html>
