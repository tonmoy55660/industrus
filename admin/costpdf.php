<?php
$title = 'Indutrus| Cost PDF';
include 'includes/admin-header.php';
include 'check-marchant.php';
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
    $sql = "SELECT SUM(total) as total FROM `order_colors_quantity` WHERE order_id= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $sum = $result->fetch_assoc();
    //
    $sql = "SELECT * FROM `product_costing` WHERE order_id= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cost = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
} else {
    return;
}

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1>Cost Sheet </h1>
            </div>
            <div class="col-sm-4 row">
                <div class="col-6">
                    <button class="btn btn-warning float-right" onclick="printDiv('pdf')"><i class="fas fa-print"></i> Print</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-dark float-right" onclick="demoFromHTML();"> <i class="fas fa-file-pdf"></i> Downlaod PDF</button>
                </div>

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content py-1" id="pdf">
    <div class="card">
        <div class="card-header row">
            <div class="col-md-3">
                <h5>Order ID : <b><?= $_GET['order-id'] ?></b></h5>
            </div>
            <div class="col-md-3">
                <h5>Total Order : <b><?= $sum['total'] ?></b> pieces</h5>
            </div>
            <div class="col-md-3">
                <h5>Offered Price : $<?= $row['productPrice'] ?> </h5>
            </div>
            <div class="col-md-3">
                <h5>Fabric amount in kg : <?= $cost['fabAmount']; ?></h5>
            </div>

        </div>
        <table id="example2" class="table table-bordered text-center">
            <thead class="thead-light">
                <tr class="">
                    <th>Particular Costing</th>
                    <th>Details</th>
                    <th>Price in $</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="40%">Fabric Cost</td>
                    <td width="40%">Per kg</td>
                    <td width="20%">$<?= $cost['fabCost']; ?></td>
                </tr>
                <tr>
                    <td>Knitting charges</td>
                    <td>Per kg</td>
                    <td>$<?= $cost['knitCost']; ?></td>
                </tr>
                <tr>
                    <td>Dyeing charges</td>
                    <td>Per kg</td>
                    <td>$<?= $cost['dyeCost'] ?></td>
                </tr>
            </tbody>
        </table>
        <table id="example2" class="table table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th width="40%">CMTP Charges</th>
                    <th width="40%">Details</th>
                    <th width="20%">Rate in $</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Stitching</td>
                    <td>per piece</td>
                    <td>$<?= $cost['stitching']; ?></td>
                </tr>
                <tr>
                    <td>Cutting</td>
                    <td>per piece</td>
                    <td>$<?= $cost['cutting']; ?></td>
                </tr>
                <tr>
                    <td>Packaging charges</td>
                    <td>per piece</td>
                    <td>$<?= $cost['packaging']; ?></td>
                </tr>
                <tr class="table-secondary">
                    <td></td>
                    <td><b>Total Price</b></td>
                    <td>$<?= $cost['totalPrice']; ?></td>
                </tr>
                <tr class="table-secondary">
                    <td></td>
                    <td><b>Price per piece</b></td>
                    <td>$<?= $cost['perPiecePrice']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    </form>
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
<script type="text/javascript">
    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#pdf')[0];
        specialElementHandlers = {
            '#bypassme': function(element, renderer) {
                return true
            }
        };
        margins = {
            top: 50,
            bottom: 60,
            left: 40,
            width: 500
        };
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function(dispose) {
                window.open(pdf.output('bloburl'), '_blank');
                pdf.save('ORDER - <?= $_GET['order-id'] ?>- COST SHEET.pdf');
            }, margins
        );
    }
</script>
</body>

</html>