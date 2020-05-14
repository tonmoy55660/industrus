<?php
$title = "Industrus | Allocate Tasks orders";
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
    $row = $result->fetch_assoc();
    $sql = "SELECT SUM(total) as 'total' FROM `order_colors_quantity` WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $sum = $result->fetch_assoc();
    $stmt->close();
}
if (isset($_GET['editable'])) {
    $sql = "SELECT * FROM order_tasks WHERE order_id = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $orderId);
    $orderId = $_GET['order-id'];
    $stmt->execute();
    $result = $stmt->get_result();
    while ($data = $result->fetch_assoc()) {
        $tasks[] = $data;
    }
}
$sql = "SELECT * FROM deaprtments";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();;
while ($data = $result->fetch_assoc()) {
    $depts[] = $data;
}
$stmt->close();
$conn->close();
?>

<!-- Main content -->
<section class="content py-2">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-mitten"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= $depts[0]['department_name'] ?></span>
                        <span class="info-box-number">
                            <?= $depts[0]['production_per_day'] ?>
                            <small>kg per day</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cut"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= $depts[1]['department_name'] ?></span>
                        <span class="info-box-number">
                            <?= $depts[1]['production_per_day'] ?>
                            <small>pcs per day</small>
                        </span>
                    </div>
                </div>
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-align-justify"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= $depts[2]['department_name'] ?></span>
                        <span class="info-box-number">
                            <?= $depts[2]['production_per_day'] ?>
                            <small>pcs per day</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?= $depts[3]['department_name'] ?></span>
                        <span class="info-box-number">
                            <?= $depts[3]['production_per_day'] ?>
                            <small>pcs per day</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>

<section class="content py-1">
    <div class="card card-primary card-outline">
        <div class="card-header row" style="font-weight:bold;">
            <div class="col-4">
                Order Date : <?= $row['detailOrderDate'] ?>
            </div>
            <div class="col-4">
                Shipment Date : <?= $row['shipmentDate'] ?>
            </div>
            <div class="col-4">
                <?php
                $date = date('m/d/Y');
                $startTimeStamp = strtotime($date);
                $endTimeStamp = strtotime($row['shipmentDate']);
                $timeDiff = abs($endTimeStamp - $startTimeStamp);
                $numberDays = $timeDiff / 86400;
                $numberDays = intval($numberDays);
                echo $numberDays;
                ?> days left before shipment
            </div>
            <input type="hidden" id="numberDays" value="<?= $numberDays ?>">
        </div>
        <form id="form" action="controllers/tasksController" method="POST">
            <input type="hidden" name="order_id" value="<?= $_GET['order-id'] ?>">
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr class="">
                            <th width="33%">Department</th>
                            <th width="33%">Amount</th>
                            <th width="33%">Time to complete(In days)</th>
                        </tr>
                    </thead>
                    <tbody style="font-weight:bold;font-size:15px;">
                        <tr>
                            <td><?= $depts[0]['department_name'] ?></td>
                            <td>Total fabric : Kg</td>
                            <td>
                                <input type="hidden" name="dep_id[]" value="<?= $depts[0]['id'] ?>">
                                <input type="text" class="form-control" id="knit_id" name="assigned_days[0]" value="<?php
                                                                                                                    if (isset($tasks)) {
                                                                                                                        if (($depts[0]['id'] == $tasks[0]['department_id'])) {
                                                                                                                            echo $tasks[0]['assign_days'];
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Cutting</td>
                            <td>Total pcs : <?= $sum['total'] ?></td>
                            <td>
                                <input type="hidden" name="dep_id[]" value="<?= $depts[1]['id'] ?>">
                                <input type="text" class="form-control" id="cut_id" name="assigned_days[1]" value="<?php
                                                                                                                    if (isset($tasks)) {
                                                                                                                        if (($depts[1]['id'] == $tasks[1]['department_id'])) {
                                                                                                                            echo $tasks[1]['assign_days'];
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sewing</td>
                            <td>Total pcs : <?= $sum['total'] ?></td>
                            <td><input type="hidden" name="dep_id[]" value="<?= $depts[2]['id'] ?>">
                                <input type="text" class="form-control" id="sew_id" name="assigned_days[2]" value="<?php
                                                                                                                    if (isset($tasks)) {
                                                                                                                        if (($depts[2]['id'] == $tasks[2]['department_id'])) {
                                                                                                                            echo $tasks[2]['assign_days'];
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>"></td>
                        </tr>
                        <tr>
                            <td>Packaging
                            </td>
                            <td>Total packages : <?php $package = $sum['total'] / $row['pcs_per_box'];
                                                    $package = intval($package);
                                                    echo $package; ?></td>
                            <td><input type="hidden" name="dep_id[]" value="<?= $depts[3]['id'] ?>">
                                <input type="text" class="form-control" id="package_id" name="assigned_days[3]" value="<?php if (isset($tasks)) {
                                                                                                                            if (($depts[3]['id'] == $tasks[3]['department_id'])) {
                                                                                                                                echo $tasks[3]['assign_days'];
                                                                                                                            }
                                                                                                                        }
                                                                                                                        ?>"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
                <?php if (isset($tasks)) { ?>
                    <button class="btn btn-info col-sm-4 submit" type="submit" name="edit"> Edit Allocate</button>
                <?php } else { ?>
                    <button class="btn btn-primary col-sm-4 submit" type="submit" name="save"> Save Allocate</button>
                <?php } ?>
            </div>
        </form>

    </div>
</section>
<!-- /.content -->

<?php include 'includes/admin-footer.php'; ?>
<script type="text/javascript">
    function validation() {
        let result = true;
        $(".invalid-feedback").remove();
        $("input").removeClass("is-invalid");
        $("#form input").each(
            function(index) {
                let inputText = $(this);
                if ((inputText.val() == "")) {
                    let inputID = inputText.attr('id');
                    $("#" + inputID).after('<span class="invalid-feedback">* ' +
                        'this field is required</span>').addClass("is-invalid").focus();
                    result = false;
                    return false;
                }
                if ((inputText.val() < 0)) {
                    let inputID = inputText.attr('id');
                    $("#" + inputID).after('<span class="invalid-feedback">* ' +
                        'days must be a positive value</span>').addClass("is-invalid").focus();
                    result = false;
                    return false;
                }
            }
        )
        return result;
    }

    $(".submit").on('click', function() {
        if (validation() == false) {
            return false;
        };
        let numberDays = parseInt($('#numberDays').val());

        let knit_id = parseInt($('#knit_id').val());
        let cut_id = parseInt($('#cut_id').val());
        let sew_id = parseInt($('#sew_id').val());
        let package_id = parseInt($('#package_id').val());
        let sum = (knit_id + cut_id + sew_id + package_id);
        if (numberDays < sum) {
            $(document).Toasts('create', {
                class: 'bg-danger',
                title: 'Check Again!',
                autohide: true,
                icon: 'fas fa-warning fa-lg',
                delay: 5000,
                body: 'Total assigned days is greater than due days',
                position: 'bottomLeft'
            })
            return false;
        } else {
            return true;
        }

    });
</script>
</body>

</html>