<?php
$title = 'Indutrus| Finished Order Details';
include 'includes/admin-header.php';
include 'check-knitting.php';
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
                <div class="col-sm-4">
                    <h5> Order ID :&nbsp;<?= $row['orderId'] ?></h5>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <button class=" btn btn-outline-dark col-sm-4  float-right print" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="card-body mt-3">
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="buyerName" class="control-label"><b>Buyer Name :</b></label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="buyerName" name="buyerName" value="<?= $row['buyerName'] ?>" disabled>
                    </div>

                    <div class="col-sm-2">
                        <label for="companyName" class="control-label"><b>Company Name :</b></label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?= $row['companyName'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="productName" class="control-label"><b>Product Name :</b></label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?= $row['productName'] ?>" disabled>
                    </div>
                    <div class="col-sm-3">
                        <label for="productName" class="control-label"><b>Product Price Per Peice <span class="error">*</span> :</b></label>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control num" aria-label="Amount (to the nearest dollar)" value="<?= $row['productPrice'] ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <label for="composition" class="control-label"><b>Composition :</b></label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?= $row['composition'] ?>" disabled>
                    </div>
                    <div class="col-sm-2">
                        <label for="fabricsWeight" class="control-label"><b>Fabrics weight
                                :</b></label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="<?= $row['fabricsWeight'] ?>" disabled>
                    </div>
                </div>
                <?php
                foreach ($colors as $key => $value) {
                    //print_r($value['color']);
                ?>
                    <div class="card border-success">
                        <div class="card-body text-success">
                            <div class="mb-2 row">
                                <div class="col-sm-2">
                                    <label for="colors" class="control-label"><b>Colors :</b></label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" value="<?= $value['color'] ?>" disabled>
                                </div>
                            </div>
                            <hr>
                            <div class="card-subtitle mb-1 text-muted"><b>Quantity in pieces by Size & Color :</b></div>
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="mQuantity" class="control-label">M :</label>
                                    <input type="text" class="form-control" value="<?= $value['mQuantity'] ?>" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="sQuantity" class="">S :</label>

                                    <input type="text" class="form-control" value="<?= $value['sQuantity'] ?>" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="lQuantity" class="">L :</label>
                                    <input type="text" class="form-control" value="<?= $value['lQuantity'] ?>" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="xlQuantity" class="control-label">XL :</label>
                                    <input type="text" class="form-control" value="<?= $value['xlQuantity'] ?>" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="xxlQuantity" class="">XXL :</label>
                                    <input type="text" class="form-control" value="<?= $value['xxlQuantity'] ?>" disabled>
                                </div>
                                <div class="col-sm-2">
                                    <label for="xxxlQuantity" class="">XXXL :</label>
                                    <input type="text" class="form-control" value="<?= $value['xxxlQuantity'] ?>" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
                </br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="febricDescription"><b>Fabrics Description <span class="error">*</span> :</b></label>
                            <textarea class="form-control" rows="2" disabled><?= $row['febricDescription'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fabricConstruction" class="control-label"><b>Main Fabric Construction <span class="error">*</span> :</b></label>
                            <textarea class="form-control" rows="2" disabled><?= $row['fabricConstruction'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="yarnDescription" class="control-label"><b>Yarn Construction <span class="error">*</span> :</b></label>
                            <textarea class="form-control" rows="2" disabled><?= $row['yarnDescription'] ?></textarea>
                        </div>
                    </div>
                    <div class="row col-sm-6">
                        <div class="col-sm-4">
                            <label for="myImg" class="control-label"><b>Product Sketch:</b></label>
                        </div>
                        <div class="col-sm-8">
                            <a href="../img/samples/<?= $row['productSketch'] ?>" data-toggle="lightbox" data-title="product Sketch" data-gallery="gallery">
                                <img src="../img/samples/<?= $row['productSketch'] ?>" class="img-fluid mb-2 border border-secondary" alt="product Sketch" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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