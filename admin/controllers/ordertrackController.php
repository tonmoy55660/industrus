<?php
session_start();
include_once("../dbCon.php");
$conn = connect();

if (isset($_POST['add_production'])) {
    $sql = "INSERT INTO `production_track`(`order_id`, `production_date`, `production_amount`,`department_id`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $orderId, $date, $amount, $department_id);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $production_left = mysqli_real_escape_string($conn, $_POST['production_left']);
    $department_id = mysqli_real_escape_string($conn, $_POST['department_id']);
    if ($stmt->execute()) {
        if ($amount == $production_left) {
            $sql = "UPDATE `order_tasks` SET `flag`= 1 WHERE order_id = ? AND department_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $orderId, $department_id);
            $stmt->execute();
        }
        $stmt->close();
        $conn->close();
        $_SESSION['msg'] = ['title' => 'Added successful', 'icon' => 'check-circle', 'body' => 'Toadys production amount inserted successfully!', 'type' => 'success'];
        if ($department_id == 2) {
            header('Location:../cutting-production-history?order-id=' . $orderId . '');
        } else if ($department_id == 3) {
            header('Location:../sewing-production-history?order-id=' . $orderId . '');
        } else if ($department_id == 4) {
            header('Location:../package-production-history?order-id=' . $orderId . '');
        }
    }
} else if (isset($_POST['edit_production'])) {
    $sql = "UPDATE `production_track` SET `production_amount`=? WHERE `order_id` = ? AND `production_date`=? AND `department_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $amount, $orderId, $date, $department_id);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $department_id = mysqli_real_escape_string($conn, $_POST['department_id']);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        $_SESSION['msg'] = ['title' => 'Edited successful', 'icon' => 'check-circle', 'body' => 'Production amount edited successfully!', 'type' => 'warning'];
        if ($department_id == 2) {
            header('Location:../cutting-production-history?order-id=' . $orderId . '');
        } else if ($department_id == 3) {
            header('Location:../sewing-production-history?order-id=' . $orderId . '');
        } else if ($department_id == 4) {
            header('Location:../package-production-history?order-id=' . $orderId . '');
        }
    }
}
