<?php
session_start();
include_once("../dbCon.php");
$conn = connect();
include_once("../sendMail.php");

if (isset($_POST['finished'])) {
    $sql = "UPDATE `order_details` SET `finishedDate`= ? ,`status` = 7 WHERE orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $ddate = date('m/d/Y');
    $stmt->execute();
    $sql = "SELECT * FROM order_details as od, user_login as ul WHERE od.user_id = ul.id AND od.orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $subject = 'Order Finished';
    $high_text = 'Your Order Has been Finished!';
    $low_text = 'Shipment of your order is ready! Thanks for being with us!';
    mailSender($data['orderId'], $data['email'], $data['name'], $high_text, $low_text, $subject);
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Order Finished!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been Finished !', 'type' => 'success'];
    header("Location:../finished-orders");
}
if (isset($_POST['movetoAllocation'])) {
    $sql = "UPDATE `order_details` SET`status` = 3 WHERE orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",  $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $stmt->execute();
    $sql = "SELECT * FROM order_details as od, user_login as ul WHERE od.user_id = ul.id AND od.orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $subject = 'Order is approved';
    $high_text = 'Now, Give us detail order Information!';
    $low_text = 'Your order is approved! Please provide detail order information! Thanks for being with us!';
    mailSender($data['orderId'], $data['email'], $data['name'], $high_text, $low_text, $subject);
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Negotiation Complete!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been in Pre-order !', 'type' => 'success'];
    header("Location:../detailed-orders");
}

if (isset($_POST['knitting_done'])) {
    $sql = "UPDATE `order_tasks` SET `finished_at`= ? ,`status` = 2 WHERE order_id = ? AND department_id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $ddate = date('m/d/Y');
    $stmt->execute();
    $sql = "UPDATE `order_tasks` SET `started_at`= ? ,`status` = 1 WHERE order_id = ? AND department_id = 2";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $date = date('m/d/Y');
    $ddate = date('m/d/Y', strtotime($date . ' + 1 days'));
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Knitting Finished!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been Finished Knitting !', 'type' => 'success'];
    header("Location:../knitting-finished-orders");
}

if (isset($_POST['cutting_done'])) {
    $sql = "UPDATE `order_tasks` SET `finished_at`= ? ,`status` = 2 WHERE order_id = ? AND department_id = 2";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $ddate = date('m/d/Y');
    $stmt->execute();
    $sql = "UPDATE `order_tasks` SET `started_at`= ? ,`status` = 1 WHERE order_id = ? AND department_id = 3";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $date = date('m/d/Y');
    $ddate = date('m/d/Y', strtotime($date . ' + 1 days'));
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Cutting Finished!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been Finished Cutting !', 'type' => 'success'];
    header("Location:../cutting-finished-orders");
}
if (isset($_POST['sewing_done'])) {
    $sql = "UPDATE `order_tasks` SET `finished_at`= ? ,`status` = 2 WHERE order_id = ? AND department_id = 3";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $ddate = date('m/d/Y');
    $stmt->execute();
    $sql = "UPDATE `order_tasks` SET `started_at`= ? ,`status` = 1 WHERE order_id = ? AND department_id = 4";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $date = date('m/d/Y');
    $ddate = date('m/d/Y', strtotime($date . ' + 1 days'));
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Sewing Finished!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been Finished Sewing !', 'type' => 'success'];
    header("Location:../sewing-finished-orders");
}
if (isset($_POST['package_done'])) {
    $sql = "UPDATE `order_tasks` SET `finished_at`= ? ,`status` = 2 WHERE order_id = ? AND department_id = 4";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ddate, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $ddate = date('m/d/Y');
    $stmt->execute();
    $sql = "UPDATE `order_details` SET `status` = 8 WHERE orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Packaging Finished!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been Finished Packaging !', 'type' => 'success'];
    header("Location:../package-finished-orders");
}
