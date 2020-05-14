<?php
session_start();
include_once("../dbCon.php");
$conn = connect();
include_once("../sendMail.php");

if (isset($_POST['accept-sample'])) {
    $sql = "UPDATE `order_details` SET status=1 WHERE orderId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['orderId']);
    if ($stmt->execute()) {
        $sql = "SELECT * FROM order_details as od, user_login as ul WHERE od.user_id = ul.id AND od.orderId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $subject = 'Order Accepted';
        $high_text = 'Your Order Has been Accepted!';
        $low_text = 'Please wait till negotiation complete!';
        mailSender($data['orderId'], $data['email'], $data['name'], $high_text, $low_text, $subject);
        $stmt->close();
        $conn->close();
        $_SESSION['msg'] = ['title' => 'Sample request accepted', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been accepted !', 'type' => 'success'];
        header('Location:../sample-requests');
    }
} else if (isset($_POST['decline-sample'])) {
    $sql = "UPDATE `order_details` SET status=2 WHERE orderId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['orderId']);
    if ($stmt->execute()) {
        $sql = "SELECT * FROM order_details as od, user_login as ul WHERE od.user_id = ul.id AND od.orderId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $subject = 'Order Rejected';
        $high_text = 'Your Order Has been Rejected!';
        $low_text = 'This is not a play!';
        mailSender($data['orderId'], $data['email'], $data['name'], $high_text, $low_text, $subject);
        $stmt->close();
        $conn->close();
        $_SESSION['msg'] = ['title' => 'Sample request declined', 'icon' => 'exclamation-triangle',  'body' => 'Order id ' . $orderId . ' has been declined !', 'type' => 'warning'];
        header('Location:../sample-requests');
    }
}
