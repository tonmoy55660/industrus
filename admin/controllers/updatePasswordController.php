<?php
session_start();
include_once("../dbCon.php");
$conn = connect();

if (isset($_POST['updatepass'])) {
    $sql = "SELECT * FROM admin_login where email =? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);

    $email = $_SESSION['admin-email'];
    $password = mysqli_real_escape_string($conn, sha1($_POST['current_password']));

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sql = "UPDATE `admin_login` SET `password` = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $pass, $email);
        $email = $_SESSION['admin-email'];
        $pass = mysqli_real_escape_string($conn, sha1($_POST['new_password']));
        $stmt->execute();
        $_SESSION['msg'] = ['title' => 'Pasword Updates', 'icon' => 'check-circle', 'body' => 'Your password has been updated successfully !', 'type' => 'success'];
        if ($_SESSION['admin-role'] == 1) {
            header('Location:marchant-dashboard');
        } else if ($_SESSION['admin-role'] == 2) {
            header('Location:../knitting-master-dashboard');
        } else if ($_SESSION['admin-role'] == 3) {
            header('Location:../cutting-master-dashboard');
        } else if ($_SESSION['admin-role'] == 4) {
            header('Location:../sewing-master-dashboard');
        } else if ($_SESSION['admin-role'] == 5) {
            header('Location:../package-master-dashboard');
        } else if ($_SESSION['admin-role'] == 0) {
            header('Location:../admin-dashboard');
        }
    } else {
        header('Location:update-password');
        $_SESSION['error'] = 'invalid';
    }
    $stmt->close();
    $conn->close();
}
