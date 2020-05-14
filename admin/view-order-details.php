<?php
$title = 'Indutrus| Sample Details';
include 'includes/admin-header.php';
include 'check-marchant.php';
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
    $query = "SELECT * FROM measurement_pattern WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while ($data = $result2->fetch_assoc()) {
        $measurements[] = $data;
    }
    //
    $query = "SELECT * FROM yarn_description WHERE order_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    while ($data = $result2->fetch_assoc()) {
        $yarnDescriptions[] = $data;
    }

    foreach ($yarnDescriptions as $val) {
        $query = "SELECT * FROM yarn_color WHERE yarn_desc_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $val['id']);
        $stmt->execute();
        $result2 = $stmt->get_result();
        while ($data = $result2->fetch_assoc()) {
            $yarnColor[] = $data;
        }
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

    <div class="card card-primary card-outline bg-light card-outline-tabs">
        <div class="card-header p-0 pt-1 print">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Techinical File</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Measurement Pattern</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Sewing Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Packaging Description</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-3">
                                <h5> Order ID :&nbsp;<?= $row['orderId'] ?></h5>
                            </div>
                            <div class="col-sm-3">
                                <h6>Sample Order Date : <?= $row['sampleOrderDate'] ?></h6>
                            </div>
                            <div class="col-sm-3">
                                <h6>Order Date : <?= $row['detailOrderDate'] ?></h6>
                            </div>
                            <div class="col-sm-3">
                                <button class=" btn btn-outline-dark col-sm-4 float-right print" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
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
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <div class="card-subtitle">
                        <button class=" btn btn-outline-dark col-sm-2 float-right print mb-2" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                    </div>
                    <div class="card-text mt-3 mb-3">
                        <div class="row text-center">
                            <div class="col-sm-4 ">
                                <label for="examples" class="mb-3"><b>Front Measurement Sketch :</b></label>
                                <a href="../img/samples/<?= $row['frontMeasurementSketch'] ?>" data-toggle="lightbox" data-title="Front Measurement Sketch" data-gallery="gallery">
                                    <img src="../img/samples/<?= $row['frontMeasurementSketch'] ?>" class="img-fluid mb-2 border border-secondary" alt="Front Measurement Sketch" />
                                </a>
                            </div>

                            <div class="col-sm-4">
                                <label for="examples" class="mb-3"><b>Back Measurement Sketch :</b></label>
                                <a href="../img/samples/<?= $row['backMeasurementSketch'] ?>" data-toggle="lightbox" data-title="Back Measurement Sketch" data-gallery="gallery">
                                    <img src="../img/samples/<?= $row['backMeasurementSketch'] ?>" class="img-fluid mb-2 border border-secondary" alt="Back Measurement Sketch" />
                                </a>
                            </div>

                            <div class="col-sm-4">
                                <label for="examples" class="mb-3"><b>Collar Measurement Sketch :</b></label>
                                <a href="../img/samples/<?= $row['collarMeasurementSketch'] ?>" data-toggle="lightbox" data-title="Collar Measurement Sketch " data-gallery="gallery">
                                    <img src="../img/samples/<?= $row['collarMeasurementSketch'] ?>" class="img-fluid mb-2 border border-secondary" alt="Collar Measurement Sketch" />
                                </a>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3"><strong>Pattern/Chart of</strong> Measurement : </h5>
                    <table class="table table-head-fixed text-nowrap table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">Reference </th>
                                <th width="25%" scope="col">Description</th>
                                <th scope="col">Tol(-+) (in Inch)</th>
                                <th scope="col" class="s">S (in Inch)</th>
                                <th scope="col" class="m">M (in Inch)</th>
                                <th scope="col" class="l">L (in Inch)</th>
                                <th scope="col" class="xl">XL (in Inch)</th>
                                <th scope="col" class="xxl">XXL (in Inch)</th>
                                <th scope="col" class="xxxl">XXXL (in Inch)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($measurements as $measurement) { ?>
                                <tr>
                                    <td><?= $measurement['reference'] ?></td>
                                    <td><?= $measurement['description'] ?></td>
                                    <td><?= $measurement['tolerance'] ?></td>
                                    <td><?= $measurement['s_size'] ?></td>
                                    <td><?= $measurement['m_size'] ?></td>
                                    <td><?= $measurement['l_size'] ?></td>
                                    <td><?= $measurement['xl_size'] ?></td>
                                    <td><?= $measurement['xxl_size'] ?></td>
                                    <td><?= $measurement['xxl_size'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                    <div class="card-subtitle">
                        <button class=" btn btn-outline-dark col-sm-2 float-right print mb-2" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                    </div>
                    <div class="card-text mt-3 mb-3">
                        <div class="row text-center">
                            <div class="col-sm-4 ">
                                <label for="examples" class="mb-3"><b>Front Sewing Sketch :</b></label>
                                <a href="../img/samples/<?= $row['frontSewingSkecth'] ?>" data-toggle="lightbox" data-title="Front Sewing Sketch" data-gallery="gallery">
                                    <img src="../img/samples/<?= $row['frontSewingSkecth'] ?>" class="img-fluid mb-2 border border-secondary" alt="Front Sewing Sketch" />
                                </a>
                            </div>

                            <div class="col-sm-4">
                                <label for="examples" class="mb-3"><b>Front Placket Skecth :</b></label>
                                <a href="../img/samples/<?= $row['frontPlacketSkecth'] ?>" data-toggle="lightbox" data-title="Front Placket Skecth" data-gallery="gallery">
                                    <img src="../img/samples/<?= $row['frontPlacketSkecth'] ?>" class="img-fluid mb-2 border border-secondary" alt="Front Placket Skecth" />
                                </a>
                            </div>

                            <div class="col-sm-4">
                                <label for="examples" class="mb-3"><b>Slide Slit Skecth :</b></label>
                                <a href="../img/samples/<?= $row['slideSlitSkecth'] ?>" data-toggle="lightbox" data-title="Slide Slit Skecth  " data-gallery="gallery">
                                    <img src="../img/samples/<?= $row['slideSlitSkecth'] ?>" class="img-fluid mb-2 border border-secondary" alt="Slide Slit Skecth " />
                                </a>
                            </div>
                        </div>
                    </div>
                    <h5 class="mb-3"><strong>Sewing</strong> Details : </h5>
                    <table class="table table-head-fixed text-nowrap table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">Reference </th>
                                <th width="25%" scope="col">Description</th>
                                <?php foreach ($colors as $color) { ?>
                                    <th><?= $color['color'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($yarnDescriptions as $yarnDescription) { ?>
                                <tr>
                                    <td><?= $yarnDescription['reference'] ?></td>
                                    <td><?= $yarnDescription['description'] ?></td>
                                    <?php foreach ($yarnColor as $yc) {
                                        if ($yarnDescription['id'] == $yc['yarn_desc_id']) { ?>
                                            <td><?php
                                                echo $yc['yarn_color'];
                                                ?></td>
                                    <?php }
                                    } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4">
                                <h5> Shipment Date :&nbsp;<?= $row['shipmentDate'] ?></h5>
                            </div>
                            <div class="col-sm-4">
                                <h5>Pieces Per box : <?= $row['pcs_per_box'] ?></h5>
                            </div>
                            <div class="col-sm-4">
                                <button class=" btn btn-outline-dark col-sm-4  float-right print" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
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
        </div>
        <!-- /.card -->
    </div>

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

    // function demoFromHTML() {
    //     var pdf = new jsPDF('p', 'pt', 'letter');

    //     // source can be HTML-formatted string, or a reference
    //     // to an actual DOM element from which the text will be scraped.
    //     source = $('#printableArea')[0];

    //     // we support special element handlers. Register them with jQuery-style 
    //     // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    //     // There is no support for any other type of selectors 
    //     // (class, of compound) at this time.
    //     specialElementHandlers = {
    //         // element with id of "bypass" - jQuery style selector
    //         '#bypassme': function(element, renderer) {
    //             // true = "handled elsewhere, bypass text extraction"
    //             return true
    //         }
    //     };
    //     margins = {
    //         top: 50,
    //         bottom: 60,
    //         left: 40,
    //         width: 500
    //     };
    //     // all coords and widths are in jsPDF instance's declared units
    //     // 'inches' in this case
    //     pdf.fromHTML(
    //         source, // HTML string or DOM elem ref.
    //         margins.left, // x coord
    //         margins.top, { // y coord
    //             'width': margins.width, // max width of content on PDF
    //             'elementHandlers': specialElementHandlers
    //         },

    //         function(dispose) {
    //             // dispose: object with X, Y of the last line add to the PDF 
    //             //          this allow the insertion of new lines after html
    //             window.open(pdf.output('bloburl'), '_blank');
    //             // pdf.save('Test.pdf');
    //         }, margins
    //     );
    // }
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