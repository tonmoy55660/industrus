<?php
$title = "Industrus | Allocate task";
include 'includes/admin-header.php';
include 'check-marchant.php';
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';
include_once("../dbCon.php");
$conn = connect();
$sql = "SELECT * FROM order_details WHERE status = 4 OR status = 5 OR status = 6 ";
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
                <h1>Allocate Tasks </h1>
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
                        <th>Buyer Name</th>
                        <th>Company Name</th>
                        <th>Product Name</th>
                        <th>Order date</th>
                        <th>Shipment Date</th>
                        <th>Production status</th>
                        <th>Allocate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($row)) {
                        foreach ($row as $value) { ?>
                            <tr>
                                <td><?= $value['orderId'] ?></td>
                                <td><?= $value['buyerName'] ?></td>
                                <td><?= $value['companyName'] ?></td>
                                <td><?= $value['productName'] ?></td>
                                <td><?= $value['detailOrderDate'] ?></td>
                                <td><?= $value['shipmentDate'] ?></td>
                                <td style='color:green;'>
                                    <?php if ($value['status'] == 5) { ?>
                                        <form action="controllers/tasksController" method="POST">
                                            <input type="hidden" value="<?= $value['orderId'] ?>" name="order_id">
                                            <button class="btn btn-success btn-sm" name="production_start" type="submit"><i class="fas fa-play"></i> Start</button>
                                        </form>
                                    <?php } else if ($value['status'] == 6) {
                                        echo 'In Production';
                                    } else {
                                        echo 'Allocate First';
                                    } ?>
                                </td>
                                <td style='color:green;'>
                                    <?php if ($value['status'] == 4) { ?>
                                        <a href="order-task?order-id=<?= $value['orderId'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Allocate</a>
                                    <?php } else { ?>
                                        <a href="order-task?editable&&order-id=<?= $value['orderId'] ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit tasks</a>
                                    <?php } ?>
                                </td>

                            </tr>
                    <?php }
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Order Id</th>
                        <th>Buyer Name</th>
                        <th>Company Name</th>
                        <th>Product Name</th>
                        <th>Order date</th>
                        <th>Shipment Date</th>
                        <th>Production status</th>
                        <th>Sample Details</th>
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
                null,
                {
                    'searchable': false,
                    'orderable': false,
                },
            ]
        });
    });
    $('#decline').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, decline it!'
        }).then((result) => {
            if (result.value == true) {
                var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "decline-order");
                $('#form').append(input);
                $('#form').submit();
            }
        })
        return false;
    });
</script>
</body>

</html>