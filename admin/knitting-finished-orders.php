<?php
$title = "Industrus | Sample Requests";
include 'includes/admin-header.php';
include 'check-knitting.php';
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';
include_once("../dbCon.php");
$conn = connect();
$sql = "SELECT * FROM order_details as od, order_tasks as ot WHERE od.orderId = ot.order_id AND ot.status = 2  AND ot.department_id = 1 ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($data = $result->fetch_assoc()) {
    $row[] = $data;
}
$stmt->close();
$conn->close();

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>All FInished Knitting Orders </h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content py-1">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover table-striped text-center">
                <thead>
                    <tr class="">
                        <th>Order Id</th>
                        <th>Product Name</th>
                        <th>Starting date</th>
                        <th>Finished date</th>
                        <th>View Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($row)) {
                        foreach ($row as $value) {
                    ?>
                            <tr>
                                <td><?= $value['orderId'] ?></td>
                                <td><?= $value['productName'] ?></td>
                                <td style='color:blue;'><?= $value['started_at'] ?></td>
                                <td style='color:green;'><?= $value['finished_at'] ?></td>
                                <td>
                                    <a href="knitting-finished-order-details?order-id=<?= $value['orderId'] ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Order Id</th>
                        <th>Product Name</th>
                        <th>Starting date</th>
                        <th>Finished date</th>
                        <th>View Details</th>
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
            'columns': [
                null,
                null,
                null,
                null,
                {
                    'searchable': false,
                    'orderable': false,
                },
            ]
        });
    });
</script>
</body>

</html>