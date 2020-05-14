<?php
session_start();
include_once("../dbCon.php");
include_once("../imageUpload.php");
$conn = connect();
if (isset($_POST['submit'])) {

    print_r($_POST);

    $query = "UPDATE `order_details` SET `frontMeasurementSketch`=?,
    `backMeasurementSketch`=?,`collarMeasurementSketch`=?,`frontSewingSkecth`=?,`frontPlacketSkecth`=?,`slideSlitSkecth`=?,`pcs_per_box`=? ,`shipmentDate`=? , `detailOrderDate`=? ,`status` = 4 WHERE orderId = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssss", $frontMeasurementSketch, $backMeasurementSketch, $collarMeasurementSketch, $frontSewingSkecth, $frontPlacketSkecth, $slideSlitSkecth, $pcsPerBox, $shipmentDate, $orderDate, $orderId);

    $orderId = mysqli_real_escape_string($conn, $_POST['order_id']);
    $pcsPerBox = mysqli_real_escape_string($conn, $_POST['peicePerBox']);
    $shipmentDate = mysqli_real_escape_string($conn, $_POST['shipmentDate']);
    $orderDate = date('m/d/Y');
    $frontMeasurementSketch = uploadImageChosen($_FILES['frontMeasurementSketch']);
    $backMeasurementSketch = uploadImageChosen($_FILES['backMeasurementSketch']);
    $collarMeasurementSketch = uploadImageChosen($_FILES['collarMeasurementSketch']);
    $frontSewingSkecth = uploadImageChosen($_FILES['frontSewingSkecth']);
    $frontPlacketSkecth = uploadImageChosen($_FILES['frontPlacketSkecth']);
    $slideSlitSkecth = uploadImageChosen($_FILES['slideSlitSkecth']);

    $stmt->execute();

    $measurementReference = $_POST['measurementReference'];
    $measurementArr = sizeof($measurementReference);

    for ($i = 0; $i < $measurementArr; $i++) {

        $query = "INSERT INTO `measurement_pattern`(`order_id`, `reference`, `description`, `tolerance`, `s_size`, `m_size`, `l_size`, `xl_size`, `xxl_size`, `xxxl_size`) VALUES (?, ?, ?,?,?,?,?,?,?,?)";
        $clmt = $conn->prepare($query);
        $clmt->bind_param("ssssssssss", $orderId,  $measurementReference, $measurementDescription, $tolerance, $s_size, $m_size, $l_size, $xl_size, $xxl_size, $xxxl_size);

        $measurementReference = mysqli_real_escape_string($conn, $_POST['measurementReference'][$i]);
        $measurementDescription = mysqli_real_escape_string($conn, $_POST['measurementDescription'][$i]);
        $tolerance = mysqli_real_escape_string($conn, $_POST['tolerance'][$i]);
        $s_size = mysqli_real_escape_string($conn, $_POST['s_size'][$i]);
        $m_size = mysqli_real_escape_string($conn, $_POST['m_size'][$i]);
        $l_size = mysqli_real_escape_string($conn, $_POST['l_size'][$i]);
        $xl_size = mysqli_real_escape_string($conn, $_POST['xl_size'][$i]);
        $xxl_size = mysqli_real_escape_string($conn, $_POST['xxl_size'][$i]);
        $xxxl_size = mysqli_real_escape_string($conn, $_POST['xxxl_size'][$i]);
        $clmt->execute();
    }

    $sewingReference = $_POST['sewingReference'];
    $sewingReferenceArr = sizeof($sewingReference);

    $query = "SELECT * FROM order_colors_quantity WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($data = $result->fetch_assoc()) {
        $colors[] = $data;
    }

    for ($i = 0; $i < $sewingReferenceArr; $i++) {

        $query = "INSERT INTO `yarn_description`(`id`, `order_id`, `reference`, `description`) VALUES (?, ?, ?,?)";
        $ydmt = $conn->prepare($query);
        $ydmt->bind_param("ssss", $yarn_desc_id, $orderId, $sewingReference, $sewingDescription);
        $yarn_desc_id = uniqid();
        $sewingReference = mysqli_real_escape_string($conn, $_POST['sewingReference'][$i]);
        $sewingDescription = mysqli_real_escape_string($conn, $_POST['sewingDescription'][$i]);
        $ydmt->execute();

        foreach ($colors as $key => $value) {

            $query = "INSERT INTO `yarn_color`(`yarn_desc_id`, `color`, `yarn_color`) VALUES (?, ?,?)";
            $ycmt = $conn->prepare($query);
            $ycmt->bind_param("sss", $yarn_desc_id, $value['color'], $yarn_color);
            $color = preg_replace('/\s+/', '', $value['color']);
            $yarn_color = mysqli_real_escape_string($conn, $_POST[$color . '_yarn'][$i]);
            $ycmt->execute();
        }
    }

    $size = $_POST['size'];
    $sizeArr = sizeof($size);

    for ($i = 0; $i < $sizeArr; $i++) {

        $query = "INSERT INTO `package_box_details`(`order_id`, `size`, `length`, `width`, `height`, `grossWeight`, `nertWeight`)VALUES (?, ?, ?, ?, ?, ?, ?)";
        $clmt = $conn->prepare($query);
        $clmt->bind_param("sssssss", $orderId, $size, $Length, $Width, $Height, $grossWeigh, $netWeight);

        $size = mysqli_real_escape_string($conn, $_POST['size'][$i]);
        $Length = mysqli_real_escape_string($conn, $_POST['length'][$i]);
        $Width = mysqli_real_escape_string($conn, $_POST['width'][$i]);
        $Height = mysqli_real_escape_string($conn, $_POST['height'][$i]);
        $grossWeigh = mysqli_real_escape_string($conn, $_POST['grossWeight'][$i]);
        $netWeight = mysqli_real_escape_string($conn, $_POST['netWeight'][$i]);
        $clmt->execute();
    }

    if (isset($_POST['packageReference'])) {
        $packageReference = $_POST['packageReference'];
        $packageReferenceArr = sizeof($packageReference);

        for ($i = 0; $i < $packageReferenceArr; $i++) {

            $query = "INSERT INTO `package_description`(`order_id`, `reference`, `description`)VALUES (?, ?, ?)";
            $clmt = $conn->prepare($query);
            $clmt->bind_param("sss", $orderId, $packageReference, $packageDescription);
            $packageReference = mysqli_real_escape_string($conn, $_POST['packageReference'][$i]);
            $packageDescription = mysqli_real_escape_string($conn, $_POST['packageDescription'][$i]);

            $clmt->execute();
        }
    }
    //exit();
    $stmt->close();
    $clmt->close();
    $ycmt->close();
    $conn->close();
    header('Location:../sample-request');
}
