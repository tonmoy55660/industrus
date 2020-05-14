<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php';
include_once("dbCon.php");
$conn = connect();
if (isset($_SESSION['isLoggedIn'])) {
  $sql = "SELECT * FROM order_details WHERE user_id =? AND status = 3";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $id);
  $id = $_SESSION['id'];
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  $row = $result->fetch_assoc();
  //
  if (!isset($row)) {
    return;
  }
  $query = "SELECT * FROM order_colors_quantity WHERE order_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $order_id);
  $order_id = $row['orderId'];
  $stmt->execute();
  $result2 = $stmt->get_result();
  while ($data = $result2->fetch_assoc()) {
    $colors[] = $data;
  }
  $stmt->close();
  //
  $conn->close();
} else {
  return;
}

?>
<section id="tabs" class="project-tab">
  <form id="form" action="controller/DetailOrderController" method="post" enctype="multipart/form-data">
    <div id="smartwizard">
      <ul>
        <li><a href="#step-1">First Step <br /><small> Technical File</small></a></li>
        <li><a href="#step-2">Second Step<br /><small>Measurement Point Sketch</small></a></li>
        <li><a href="#step-3">Third Step<br /><small>Sewing Details</small></a></li>
        <li><a href="#step-4">Final Step<br /><small>Packaging description</small></a></li>
      </ul>
      <div class="container">
        <?php include 'technical-file.php'; ?>
        <?php include 'measurement-sketch.php'; ?>
        <?php include 'sewing-measurement.php'; ?>
        <?php include 'packaging-description.php'; ?>
      </div>
    </div>
  </form>
</section>
<?php include 'includes/footer.php'; ?>