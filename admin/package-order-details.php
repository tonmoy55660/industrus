<?php
$title = 'Indutrus| Order Details';
include 'includes/admin-header.php';
include 'check-package.php';
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';
include_once("../dbCon.php");
$conn = connect();
if (isset($_GET['order-id'])) {
    $sql = "SELECT * FROM order_details WHERE orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $id = $_GET['order-id'];
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    //
    $query = "SELECT * FROM order_colors_quantity WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while ($data = $result2->fetch_assoc()) {
        $colors[] = $data;
    }
    //
    $query = "SELECT * FROM package_box_details WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while ($data = $result2->fetch_assoc()) {
        $packageBoxes[] = $data;
    }
    //
    $query = "SELECT * FROM package_description WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while ($data = $result2->fetch_assoc()) {
        $packageDescriptions[] = $data;
    }

    $stmt->close();
    //
    $conn->close();
} else {
    return;
}

?>

<!-- Main content -->
<section class="content py-3" id="printableArea">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-3">
                    <h5> Order ID :&nbsp;<?= $row['orderId'] ?></h5>
                </div>
                <div class="col-sm-3">
                    <h5> Shipment Date :&nbsp;<?= $row['shipmentDate'] ?></h5>
                </div>
                <div class="col-sm-3">
                    <h5>Pieces Per box : <?= $row['pcs_per_box'] ?></h5>
                </div>
                <div class="col-sm-3">
                    <button class=" btn btn-outline-dark col-sm-4  float-right print" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="mb-3 mt-2"><strong>Packaging</strong> details : </h5>
            <table class="table table-head-fixed text-nowrap table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">Size </th>
                        <th scope="col">Length (in Inch)</th>
                        <th scope="col">Width (in Inch)</th>
                        <th scope="col">Height (in Inch)</th>
                        <th scope="col">Gross Weight (in KG)</th>
                        <th scope="col">Net Weight (in KG)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packageBoxes as $packageBox) { ?>
                        <tr>
                            <td><?= $packageBox['size'] ?></td>
                            <td><?= $packageBox['length'] ?></td>
                            <td><?= $packageBox['width'] ?></td>
                            <td><?= $packageBox['height'] ?></td>
                            <td><?= $packageBox['grossWeight'] ?></td>
                            <td><?= $packageBox['nertWeight'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (isset($packageDescriptions)) { ?>
                <h5 class="mb-3"><strong>Other</strong> packaging details : </h5>
                <table class="table table-head-fixed text-nowrap table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">Reference </th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($packageDescriptions as $packageDescription) { ?>
                            <tr>
                                <td><?= $packageDescription['reference'] ?></td>
                                <td><?= $packageDescription['description'] ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>

    <!-- /.card -->


</section>
<?php include 'includes/admin-footer.php'; ?>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    })
</script>
</body>

</html>