<?php
$title = "Industrus | Sample Requests";
include 'includes/admin-header.php';
include 'check-marchant.php';
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';
include_once("../dbCon.php");
$conn = connect();
$sql = "SELECT * FROM order_details WHERE status = 0 OR status=1";
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
                <h1>All Sample Orders </h1>
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
                        <th>Action</th>
                        <th>Calculate</th>
                        <th>Sample Details</th>
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
                                <td><?= $value['sampleOrderDate'] ?></td>
                                <td style='white-space: nowrap;color:green;'>
                                    <?php if ($value['status'] == 0) { ?>
                                        <form id="form" action="controllers/orderController" method="post">
                                            <input type="hidden" name="orderId" value="<?= $value['orderId'] ?>">
                                            <button class="btn btn-outline-success btn-sm pull-right" name="accept-sample" type="submit"><i class=" fas fa-plus-circle"></i>Accept</button>
                                            <button class="btn btn-outline-danger btn-sm pull-left" id="decline" type="submit"><i class="fas fa-trash"></i>Decline</button>
                                        </form>
                                    <?php } else if (($value['status'] == 1)) {
                                        echo 'Accepted';
                                    } ?>
                                </td>
                                <td>
                                    <?php if (($value['status'] == 1)) { ?>
                                        <a href="calculate-cost?order-id=<?= $value['orderId'] ?>" class="btn btn-outline-success btn-sm print"><i class="fas fa-calculator"></i> Calculate Cost</a>
                                    <?php } else {
                                        echo 'Accept First';
                                    } ?>
                                </td>
                                <td><a href="view-sample-details?order-id=<?= $value['orderId'] ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a></td>
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
                        <th>Action</th>
                        <th>Calculate</th>
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
                {
                    'search': false,
                    'orderable': false,
                }, {
                    'searchable': false,
                    'orderable': false,
                }, {
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
                    .attr("name", "decline-sample");
                $('#form').append(input);
                $('#form').submit();
            }
        })
        return false;
    });
</script>
</body>

</html>