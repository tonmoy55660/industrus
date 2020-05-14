<?php
$title = 'Indutrus| Order Details';
include 'includes/admin-header.php';
include 'check-sewing.php';
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