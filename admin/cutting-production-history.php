<?php
$title = "Industrus | Sewing History";
include 'includes/admin-header.php';
include 'check-cutting.php';
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';
include_once("../dbCon.php");
$conn = connect();
if (isset($_GET['order-id'])) {
    $sql = "SELECT * FROM production_track WHERE department_id = 2 AND order_id = ?  ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $orderId = mysqli_real_escape_string($conn, $_GET['order-id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($data = $result->fetch_assoc()) {
        $row[] = $data;
    }
} else {
    return;
}
$sql = "SELECT * FROM production_track WHERE department_id = 2 AND production_date = ?  ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$date = date('m/d/Y');
$stmt->execute();
$re = $stmt->num_rows;
$r = $stmt->get_result();
$d = $r->fetch_assoc();
$stmt->close();

$sql = "SELECT SUM(total) as total FROM `order_colors_quantity` WHERE order_id=? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $orderId);
$stmt->execute();
$result = $stmt->get_result();
$sum = $result->fetch_assoc();

$sql = "SELECT SUM(production_amount) as total FROM `production_track` WHERE order_id=? AND department_id = 2";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $orderId);
$orderId = mysqli_real_escape_string($conn, $_GET['order-id']);
$stmt->execute();
$result = $stmt->get_result();
$productSum = $result->fetch_assoc();

$left_production = $sum['total'] - $productSum['total'];
$stmt->close();
$conn->close();

?>
<?php if ($r->num_rows < 1) { ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add todays Production</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="controllers/ordertrackController.php" method="post">
                    <input type="hidden" name="department_id" value="2">
                    <input type="hidden" id="left_production" name="production_left" value="<?= $left_production ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 row">
                                <div class="col-md-2">
                                    <label class="control-label">Order-ID :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="order_id" value="<?= $_GET['order-id'] ?>" readonly="true">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Date :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="date" value="<?php echo date('m/d/Y'); ?>" readonly="true">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <div class="col-md-4">
                                    <label class="control-label">Production in pcs :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="amount" placeholder="ex: 1200">
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-success btn-sm col-md-2" name="add_production"><i class="far fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<?php } ?>
<?php if ((isset($_GET['date'])) || (isset($_GET['amount']))) { ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit order <?= $_GET['order-id'] ?> Production</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="controllers/ordertrackController.php" method="post">
                    <input type="hidden" name="department_id" value="2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 row">
                                <div class="col-md-2">
                                    <label class="control-label">Order-ID :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="order_id" value="<?= $_GET['order-id'] ?>" readonly="true">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Date :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="date" value="<?= $_GET['date'] ?>" readonly="true">
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <div class="col-md-4">
                                    <label class="control-label">Production in pcs :</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="amount" value="<?= $_GET['amount'] ?>" placeholder="ex: 1200">
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary btn-sm col-md-2" name="edit_production"><i class="far fa-edit"></i> Edit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
<?php } ?>
<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-3">
                    <h5> Order ID :&nbsp;<?= $_GET['order-id'] ?></h5>
                </div>
                <div class="col-sm-3">
                    <h5>Total Order : <?= $sum['total'] ?> pcs</h5>
                </div>
                <div class="col-sm-3">
                    <h5>Production Done : <?= $productSum['total'] ?> pcs</h5>
                </div>
                <div class="col-sm-3">
                    <button class=" btn btn-outline-dark col-sm-4  float-right print" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover table-striped text-center">
                <thead>
                    <tr class="">
                        <th>#</th>
                        <th>Production date</th>
                        <th>Production Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($row)) {
                        foreach ($row as $key => $value) {
                    ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value['production_date'] ?></td>
                                <td><?= $value['production_amount'] ?> pcs</td>
                                <td><a href="cutting-production-history?order-id=<?= $_GET['order-id'] ?>&&date=<?= $value['production_date'] ?>&&amount=<?= $value['production_amount'] ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>Edit</a></td>
                            </tr>

                    <?php }
                    } ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Production date</th>
                        <th>Production Amount</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</section>
<?php include 'includes/admin-footer.php'; ?>
<script>
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
    $(function() {

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            'columns': [{
                    'searchable': false,
                    'orderable': false,
                },
                null,
                null, {
                    'searchable': false,
                    'orderable': false,
                },
            ]
        });
    });

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
</body>

</html>