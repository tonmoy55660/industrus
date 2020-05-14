<?php
$title = 'Indutrus| Cost Calculator';
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
            <div class="col-sm-6">
                <h1>Cost Sheet </h1>
            </div>
            <div class="col-sm-6">
                <?php if (isset($cost['fabAmount'])) { ?>
                    <form action="controllers/orderStatusController.php" method="post">
                        <input type="hidden" name="order_id" value="<?= $_GET['order-id'] ?>">
                        <button name="movetoAllocation" class="btn btn-primary float-right">Negotiation Complete</button>
                    </form>
                <?php } ?>

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content py-1">
    <form action="controllers/costCalculateController.php" method="post" id="costForm">
        <input type="hidden" name="order_id" value="<?= $_GET['order-id'] ?>">
        <div class="card">
            <div id="pdf">
                <div class="card-header row">
                    <div class="col-md-3">
                        <h5>Total Order : <b><?= $sum['total'] ?></b> pieces</h5>
                        <input type="hidden" id="totalpiece" value="<?= $sum['total'] ?>">
                    </div>
                    <div class="col-md-3">
                        <h5>Offered Price : $<?= $row['productPrice'] ?> </h5>
                    </div>
                    <div class="col-md-2">
                        <h6>Fabric amount in kg :</h6>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="fabAmount" name="fabAmount" placeholder="fabric amount" value="<?php if (isset($cost['fabAmount'])) {
                                                                                                                                        echo $cost['fabAmount'];
                                                                                                                                    } ?>">
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-warning btn-md" target="_blank" href="costpdf?order-id=<?= $_GET['order-id'] ?>"> <i class="fas fa-download"></i> Download</a>

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
                            <td width="20%"><input type="text" class="form-control" id="fabCost" name="fabCost" placeholder="fabric cost" value="<?php if (isset($cost['fabCost'])) {
                                                                                                                                                        echo $cost['fabCost'];
                                                                                                                                                    } ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Knitting charges</td>
                            <td>Per kg</td>
                            <td><input type=" text" class="form-control" id="knitCost" name="knitCost" placeholder="Knitting cost" value="<?php if (isset($cost['knitCost'])) {
                                                                                                                                                echo $cost['knitCost'];
                                                                                                                                            } ?>"></td>
                        </tr>
                        <tr>
                            <td>Dyeing charges</td>
                            <td>Per kg</td>
                            <td><input type="text" class="form-control" id="dyeCost" name="dyeCost" placeholder="Dyeing cost" value="<?php if (isset($cost['dyeCost'])) {
                                                                                                                                            echo $cost['dyeCost'];
                                                                                                                                        } ?>"></td>
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
                            <td><input type="text" class="form-control" id="stitching" name="stitching" placeholder="stitching cost" value="<?php if (isset($cost['stitching'])) {
                                                                                                                                                echo $cost['stitching'];
                                                                                                                                            } ?>"></td>
                        </tr>
                        <tr>
                            <td>Cutting</td>
                            <td>per piece</td>
                            <td><input type="text" class="form-control" id="cutting" name="cutting" placeholder="cutting cost" value="<?php if (isset($cost['cutting'])) {
                                                                                                                                            echo $cost['cutting'];
                                                                                                                                        } ?>"></td>
                        </tr>
                        <tr>
                            <td>Packaging charges</td>
                            <td>per piece</td>
                            <td><input type="text" class="form-control" id="packaging" name="packaging" placeholder="packaging cost" value="<?php if (isset($cost['packaging'])) {
                                                                                                                                                echo $cost['packaging'];
                                                                                                                                            } ?>"></td>
                        </tr>
                        <tr class="table-secondary">
                            <td colspan="2"><b>Total Price</b></td>
                            <td><input type="text" id="total" readonly="true" name="totalPrice" value=""></td>
                        </tr>
                        <tr class="table-secondary">
                            <td colspan="2"><b>Price per piece</b></td>
                            <td><input type="text" id="perPiecePrice" readonly="true" name="perPiecePrice" value=""></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="card-footer text-center">
                <div class="row">
                    <div class="col-lg-6">
                        <button class="col-6 btn btn-info" id="calculate">Calculate</button>
                    </div>
                    <?php if (isset($cost['packaging'])) { ?>
                        <div class="col-lg-6">
                            <button class="col-6 btn btn-success" type="submit" name="editProductCost">Edit</button>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-6">
                            <button class="col-6 btn btn-success" type="submit" name="addProductCost">Save</button>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- /.card-body -->
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
    $("#calculate").click(function(e) {
        e.preventDefault;
        $('#total').val('');
        $('#perPiecePrice').val('');
        let fabAmount = parseInt($('#fabAmount').val());
        let fabCost = parseInt($('#fabCost').val());
        let knitCost = parseInt($('#knitCost').val());
        let dyeCost = parseInt($('#dyeCost').val());
        let stitching = parseFloat($('#stitching').val());
        let cutting = parseFloat($('#cutting').val());
        let packaging = parseFloat($('#packaging').val());
        let totalpieces = parseInt($('#totalpiece').val());

        let subfabCost = fabAmount * fabCost;
        let subknitCost = fabAmount * knitCost;
        let subdyeCost = fabAmount * dyeCost;
        let totfabCost = totalpieces * stitching;
        let totknitCost = totalpieces * cutting;
        let totdyeCost = totalpieces * packaging;
        let subamount = (subfabCost + subknitCost + subdyeCost);
        let subtotal = (totfabCost + totknitCost + totdyeCost);
        let total = parseInt(subamount + subtotal);
        total = parseFloat(total).toFixed(2);
        let pricePerPiece = parseInt(total) / totalpieces;
        pricePerPiece = parseFloat(pricePerPiece).toFixed(2);
        if (!isNaN(total)) {
            $('#total').val(total);
        } else {
            $('#total').val('');
        }
        if (!isNaN(pricePerPiece)) {
            $('#perPiecePrice').val(pricePerPiece);
        } else {
            $('#perPiecePrice').val('');
        }
        return false;



    });
    $(document).ready(function() {
        $('#costForm').validate({
            rules: {
                fabAmount: {
                    required: true,
                    number: true
                },
                fabCost: {
                    required: true,
                    number: true
                },
                knitCost: {
                    required: true,
                    number: true
                },
                dyeCost: {
                    required: true,
                    number: true
                },
                stitching: {
                    required: true,
                    number: true
                },
                cutting: {
                    required: true,
                    number: true
                },
                packaging: {
                    required: true,
                    number: true
                },
                totalPrice: {
                    required: true
                },
                perPiecePrice: {
                    required: true
                },
            },
            messages: {
                fabAmount: {
                    required: "this field is required",
                    number: "only numbers are allowed"
                },
                fabCost: {
                    required: "this field is required",
                    number: "only numbers are allowed"
                },
                knitCost: {
                    required: "this field is required",
                    number: "only numbers are allowed"
                },
                dyeCost: {
                    required: "this field is required",
                    number: "only numbers are allowed"
                },
                stitching: {
                    required: "this field is required",
                    number: "only numbers are allowed"
                },
                cutting: {
                    required: "this field is required",
                    number: "only numbers are allowed"
                },
                packaging: {
                    required: "this field is required",
                    number: "only numbers are allowed"
                },
                perPiecePrice: {
                    required: "this field is required",
                },
                total: {
                    required: "this field is required",
                },

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-control').after(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    <?php if (isset($_SESSION['msg'])) {
    ?>
        $(document).Toasts('create', {
            class: 'bg-<?= $_SESSION['msg']['type'] ?>',
            title: '<?= $_SESSION['msg']['title'] ?>',
            autohide: true,
            icon: 'fas fa-<?= $_SESSION['msg']['icon'] ?> fa-lg',
            delay: 5000,
            body: '<?= $_SESSION['msg']['body'] ?>',
            position: 'bottomLeft'
        })
    <?php }
    unset($_SESSION['msg']); ?>
</script>
</body>

</html>