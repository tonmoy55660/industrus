<?php
$title = "Industrus | Sample Requests";
include 'includes/admin-header.php';
include 'check-knitting.php';
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';
include_once("../dbCon.php");
$conn = connect();
$sql = "SELECT * FROM order_details as od, order_tasks as ot WHERE od.orderId = ot.order_id AND ot.status = 1 AND ot.department_id = 1 ";
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
                <h1>All Knitting Orders </h1>
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
                        <th>Finishing Days</th>
                        <th>Finish within</th>
                        <th>Status</th>
                        <th>Order Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($row)) {
                        foreach ($row as $value) {
                            $start = $value['started_at'];
                            $finish = date('m/d/Y', strtotime($start . ' + ' . $value['assign_days'] . ' days'));
                            $today = date('m/d/Y');
                            $time1 = strtotime($finish);
                            $time2 = strtotime($today);
                            $daysLeftInt = $time1 - $time2;
                            $daysLeft = round($daysLeftInt / (60 * 60 * 24));
                            $finishing_date =  date('d/m/Y', strtotime($start . ' + ' . $value['assign_days'] . ' days'));

                    ?>
                            <tr>
                                <td><?= $value['orderId'] ?></td>
                                <td><?= $value['productName'] ?></td>
                                <td style='color:blue;'><?= $value['started_at'] ?></td>
                                <?php if ($daysLeft >= 0) { ?>
                                    <td style='color:green;'>
                                        <?= $daysLeft . ' days left'; ?>
                                    </td>
                                <?php } else if ($daysLeft < 0) { ?>
                                    <td style='color:red;'>
                                        <?php $daysLeft = abs($daysLeft);
                                        echo  $daysLeft . ' days over'; ?>
                                    </td>
                                <?php } ?>
                                <td><?= $finishing_date ?></td>
                                <td>
                                    <form action="controllers/orderStatusController" id="form" method="POST">
                                        <input type="hidden" name="order_id" value="<?= $value['orderId'] ?>">
                                        <button id="knittingDone" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i> Knitting Done</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="knitting-order-details?order-id=<?= $value['orderId'] ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
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
                        <th>Finishing Days</th>
                        <th>Finish within</th>
                        <th>Status</th>
                        <th>Order Details</th>
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
                null,
                null,
                {
                    'searchable': false,
                    'orderable': false,
                },
            ]
        });
    });
    $('#knittingDone').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Knitting Done!'
        }).then((result) => {
            if (result.value == true) {
                var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "knitting_done");
                $('#form').append(input);
                $('#form').submit();
            }
        })
        return false;
    });
</script>
</body>

</html>