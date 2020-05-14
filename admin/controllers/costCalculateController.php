
<?php
session_start();
include_once("../dbCon.php");
$conn = connect();

if (isset($_POST['addProductCost'])) {
    $sql = "INSERT INTO `product_costing`(`order_id`, `fabAmount`, `fabCost`, `knitCost`, `dyeCost`, `stitching`, `cutting`, `packaging`, `totalPrice`, `perPiecePrice`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $orderId, $fabAmount, $fabCost, $knitCost, $dyeCost, $stitching, $cutting, $packaging, $totalPrice, $perPiecePrice);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $fabAmount = mysqli_real_escape_string($conn, $_POST['fabAmount']);
    $fabCost = mysqli_real_escape_string($conn, $_POST['fabCost']);
    $knitCost = mysqli_real_escape_string($conn, $_POST['knitCost']);
    $dyeCost = mysqli_real_escape_string($conn, $_POST['dyeCost']);
    $stitching = mysqli_real_escape_string($conn, $_POST['stitching']);
    $cutting = mysqli_real_escape_string($conn, $_POST['cutting']);
    $packaging = mysqli_real_escape_string($conn, $_POST['packaging']);
    $totalPrice = mysqli_real_escape_string($conn, $_POST['totalPrice']);
    $perPiecePrice = mysqli_real_escape_string($conn, $_POST['perPiecePrice']);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Cost Saved Successfully!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been Finished cost calculating !', 'type' => 'success'];
    header("Location:../calculate-cost?order-id=" . $orderId . "");
}


if (isset($_POST['editProductCost'])) {
    $sql = "UPDATE `product_costing` SET `fabAmount`=?,`fabCost`=?,`knitCost`=?,`dyeCost`=?,`stitching`=?,`cutting`=?,`packaging`=?,`totalPrice`=?,`perPiecePrice`=? WHERE `order_id`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss",  $fabAmount, $fabCost, $knitCost, $dyeCost, $stitching, $cutting, $packaging, $totalPrice, $perPiecePrice, $orderId);
    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $fabAmount = mysqli_real_escape_string($conn, $_POST['fabAmount']);
    $fabCost = mysqli_real_escape_string($conn, $_POST['fabCost']);
    $knitCost = mysqli_real_escape_string($conn, $_POST['knitCost']);
    $dyeCost = mysqli_real_escape_string($conn, $_POST['dyeCost']);
    $stitching = mysqli_real_escape_string($conn, $_POST['stitching']);
    $cutting = mysqli_real_escape_string($conn, $_POST['cutting']);
    $packaging = mysqli_real_escape_string($conn, $_POST['packaging']);
    $totalPrice = mysqli_real_escape_string($conn, $_POST['totalPrice']);
    $perPiecePrice = mysqli_real_escape_string($conn, $_POST['perPiecePrice']);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION['msg'] = ['title' => 'Cost Edited Successfully!', 'icon' => 'check-circle', 'body' => 'Order id ' . $orderId . ' has been edited cost calculating !', 'type' => 'warning'];
    header("Location:../calculate-cost?order-id=" . $orderId . "");
}

?>