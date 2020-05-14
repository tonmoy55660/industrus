<?php
$title = "Industrus | Cutting Master Dasboard";
include 'includes/admin-header.php';
include 'check-cutting.php';
include_once("../dbCon.php");
$conn = connect();
$sql = "SELECT * FROM order_tasks WHERE department_id = 2";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($data = $result->fetch_assoc()) {
    $statusDatas[] = $data;
}
foreach ($statusDatas as $statusData) {
    if ($statusData['finished_at'] !== '') {

        $time2 = strtotime($statusData['started_at']);
        $time1 = strtotime($statusData['finished_at']);
        $daysLeftInt = $time1 - $time2;
        $daysLeft = round($daysLeftInt / (60 * 60 * 24));
    } else {
        $daysLeft = 0;
    }
}

$sql = "SELECT SUM(CASE WHEN Status = 2 THEN 1 ELSE 0 END) AS `Finished`, SUM(CASE WHEN Status = 1 THEN 1 ELSE 0 END) AS `In-progress` FROM order_tasks WHERE department_id = 2";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$stmt->close();
$conn->close();

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Order Id', 'Assigned Days', 'Finishing Days'],
            <?php
            foreach ($statusDatas as $statusData) {
                if ($statusData['finished_at'] !== '') {

                    $time2 = strtotime($statusData['started_at']);
                    $time1 = strtotime($statusData['finished_at']);
                    $daysLeftInt = $time1 - $time2;
                    $daysLeft = round($daysLeftInt / (60 * 60 * 24));
                } else {
                    $daysLeft = 0;
                }
                echo "['Order Id -" . $statusData["order_id"] . "'," . $statusData["assign_days"] . "," . $daysLeft . "],";
            }
            ?>
        ]);

        var options = {
            curveType: 'function',
            legend: {
                position: 'top'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        imgData = chart.getImageURI();
    }
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(pieChart);

    function pieChart() {

        var data = google.visualization.arrayToDataTable([
            ['Orders In knitting', 'Total'],
            ['In Progress', <?= intval($data['In-progress']) ?>],
            ['Finished', <?= intval($data['Finished']) ?>]
        ]);

        var options = {
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
        img1Data = chart.getImageURI();
    }
</script>
<?php
include 'includes/admin-navbar.php';
include 'includes/admin-sidebar.php';

?>
<!-- Main content -->
<section class="content py-2">

    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-spinner"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Order In Progress</span>
                        <span class="info-box-number">
                            <?= intval($data['In-progress']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-double"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Order Finished</span>
                        <span class="info-box-number"><?= intval($data['Finished']) ?></span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="card card-secondary card-outline">
                    <div class="card-header row">
                        <div class="col-8">
                            <h3 class="card-title">
                                <i class="fas fa-chart-area"></i>
                                Order Assigned & Finishing days Chart
                            </h3>

                        </div>
                        <div class="col-4">
                            <button class="btn btn-default btn-sm float-right" id="daypdf"><i class="fas fa-download"></i> Save as PDF</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="curve_chart" style="height: 380px" class="full-width-chart"></div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-secondary card-outline">
                    <div class="card-header row">
                        <div class="col-8">
                            <h3 class="card-title">
                                <i class="fas fa-chart-area"></i>
                                Order Status Chart
                            </h3>

                        </div>
                        <div class="col-4">
                            <button class="btn btn-default btn-sm float-right" id="statuspdf"><i class="fas fa-download"></i> Save as PDF</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="piechart" style="height: 380px;" class="full-width-chart"></div>
                    </div>
                    <!-- /.card-body-->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
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
    <?php } ?>

    function generateDayPDF() {
        var doc = new jsPDF();
        doc.setFontSize(33);
        doc.setFillColor(135, 124, 45, 0);
        doc.addImage(imgData, 'png', 10, 10, 150, 100);
        doc.save('Cutting order days comparison.pdf');
    }

    function generateStatusPDF() {
        var doc = new jsPDF();
        doc.setFontSize(33);
        doc.setFillColor(135, 124, 45, 0);
        doc.addImage(img1Data, 'png', 10, 10, 150, 100);
        doc.save('Cutting order status.pdf');
    }

    $('#daypdf').click(generateDayPDF);
    $('#statuspdf').click(generateStatusPDF);
</script>
</body>

</html>