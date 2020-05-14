<?php
$title = "Industrus | Order & Tasks";
include 'includes/admin-header.php';
include 'check-marchant.php';
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';
include_once("../dbCon.php");
$conn = connect();
$sql = "SELECT * FROM order_details WHERE status IN (6,8)";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($data = $result->fetch_assoc()) {
    $row[] = $data;
}


?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Production Status </h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content py-1">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <table id="example2" class="table table-bordered text-center">
                <thead>
                    <tr class="">
                        <th>Order Id</th>
                        <th>Company Name</th>
                        <th>Product Name</th>
                        <th>Order date</th>
                        <th>Shipment Date</th>
                        <th>Production status</th>
                        <th>Finished Production Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($row)) {
                        foreach ($row as $value) {

                            $sql = "SELECT * FROM order_tasks as od , deaprtments as d WHERE od.department_id = d.id AND order_id = ? AND od.status = 1 ";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $orderId);
                            $orderId = $value['orderId'];
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($order = $result->fetch_assoc()) {
                                $data[] = $order;
                            }
                            $stmt->close();
                            $conn->close();


                    ?>
                            <tr>
                                <td><?= $value['orderId'] ?></td>
                                <td><?= $value['companyName'] ?></td>
                                <td><?= $value['productName'] ?></td>
                                <td><?= $value['detailOrderDate'] ?></td>
                                <td><?= $value['shipmentDate'] ?></td>
                                <?php
                                if ($value['status'] != 8) {

                                    foreach ($data as $val) {
                                        if ($val['department_id'] == 1) {
                                ?>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-volumenow="20" aria-volumemin="20" aria-volumemax="100" style="width: 20% ">
                                                    </div>
                                                </div>
                                                <small>
                                                    20% Complete
                                                </small>
                                            </td>
                                            <td class="project-state">
                                                <span class="badge badge-primary"><?= $val['department_name'] ?> </span>
                                            </td>
                                        <?php
                                        } else if ($val['department_id'] == 2) { ?>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-volumenow="40" aria-volumemin="40" aria-volumemax="100" style="width: 40% ">
                                                    </div>
                                                </div>
                                                <small>
                                                    40% Complete
                                                </small>
                                            </td>
                                            <td class="project-state">
                                                <span class="badge badge-primary"><?= $val['department_name'] ?></span>
                                            </td>

                                        <?php
                                        } else if ($val['department_id'] == 3) { ?>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-volumenow="60" aria-volumemin="60" aria-volumemax="100" style="width: 60% ">
                                                    </div>
                                                </div>
                                                <small>
                                                    60% Complete
                                                </small>
                                            </td>
                                            <td class="project-state">
                                                <span class="badge badge-primary"><?= $val['department_name'] ?></span>
                                            </td>

                                        <?php
                                        } else if ($val['department_id'] == 4) { ?>
                                            <td>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-volumenow="80" aria-volumemin="80" aria-volumemax="100" style="width: 80% ">
                                                    </div>
                                                </div>
                                                <small>
                                                    80% Complete
                                                </small>
                                            </td>
                                            <td class="project-state">
                                                <span class="badge badge-primary"><?= $val['department_name'] ?></span>
                                            </td>
                                    <?php
                                        }
                                    }
                                } else { ?>
                                    <td>
                                        <form action="controllers/orderStatusController.php" method="post">
                                            <input type="hidden" name="order_id" value="<?= $value['orderId'] ?>">
                                            <button class="btn btn-success btn-block btn-sm" type="submit" name="finished">Move to Finished</button>
                                        </form>
                                    </td>
                                    <td class="project-state">
                                        <span class="badge badge-success">Production finished</span>
                                    </td>

                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</section>
<?php include 'includes/admin-footer.php'; ?>
</body>

</html>