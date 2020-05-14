<?php
session_start();
include_once("../dbCon.php");
$conn = connect();

if (isset($_POST['save'])) {

    $department_id = $_POST['dep_id'];
    $department_idArr = sizeof($department_id);

    for ($i = 0; $i < $department_idArr; $i++) {
        $sql = "INSERT INTO `order_tasks`(`order_id`, `department_id`, `assign_days`) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $orderId, $dep_id, $assigned_days);
        $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
        $dep_id = mysqli_real_escape_string($conn, $_POST['dep_id'][$i]);
        $assigned_days = mysqli_real_escape_string($conn, $_POST['assigned_days'][$i]);
        $stmt->execute();
    }
    $sql = "UPDATE `order_details` SET `status` = 5 WHERE orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Tasks assigned', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been assigned !', 'type' => 'success'];
    header("Location:../task-allocate");
}
if (isset($_POST['edit'])) {

    $department_id = $_POST['dep_id'];
    $department_idArr = sizeof($department_id);

    for ($i = 0; $i < $department_idArr; $i++) {
        $sql = "Update `order_tasks` SET `assign_days`= ? WHERE order_id = ? AND `department_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $assigned_days, $orderId, $dep_id);
        $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
        $dep_id = mysqli_real_escape_string($conn, $_POST['dep_id'][$i]);
        $assigned_days = mysqli_real_escape_string($conn, $_POST['assigned_days'][$i]);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Tasks Edited', 'icon' => 'check-circle', 'body' => 'Tasks of Order id ' . $orderId . ' has been Edited !', 'type' => 'success'];
    header("Location:../task-allocate");
}

if (isset($_POST['production_start'])) {

    $sql = "Update `order_details` SET `status`= 6 WHERE orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",  $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $stmt->execute();
    $sql = "Update `order_tasks` SET `started_at` = ? ,`status`= 1 WHERE department_id = 1 AND order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",  $startDate, $orderId);
    $startDate = date('m/d/Y');
    $stmt->execute();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Tasks Edited', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been moved to production !', 'type' => 'success'];
    header("Location:../task-allocate");
}
