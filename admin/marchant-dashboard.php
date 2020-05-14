<?php
$title = "Industrus | Cutting Master Dasboard";
include 'includes/admin-header.php';
include 'check-marchant.php';
include_once("../dbCon.php");
$conn = connect();
$sql = "SELECT productPrice,orderId,totalprice, (SELECT SUM(total) FROM order_colors_quantity as ocq , order_details as od WHERE ocq.order_id = od.orderId ) as 'total_quantity' FROM order_details as od, product_costing as pc WHERE od.orderId = pc.order_id AND od.status = 7";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($data = $result->fetch_assoc()) {
    $statusDatas[] = $data;
}


$sql = "SELECT SUM(CASE WHEN status = 6 THEN 1 ELSE 0 END) AS `in-progress`, 
                SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS `rejected`, 
                SUM(CASE WHEN status = 8 THEN 1 ELSE 0 END) AS `finished` ,
                SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS `shipped` 
                FROM order_details";
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
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Order ID', 'Payed', 'Cost', 'Benefit'],
            <?php foreach ($statusDatas as $statusData) {
                $totalPayed = ($statusData['total_quantity'] * $statusData['productPrice']);
                $benefit = ($totalPayed - $statusData['totalprice']);
                echo "['Order Id - " . $statusData["orderId"] . "'," . $totalPayed . "," . $statusData['totalprice'] . "," . $benefit . "],";
            } ?>
        ]);

        var options = {
            vAxis: {
                title: 'In dollar'
            },
            hAxis: {
                title: 'Orders'
            },
            seriesType: 'bars',
            series: {
                3: {
                    type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        imgData = chart.getImageURI();
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
            <div class="col-3 col-sm-3 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-spinner"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Order In Progress</span>
                        <span class="info-box-number">
                            <?= intval($data['in-progress']) ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-3 col-sm-3 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-check-double"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Order Rejected</span>
                        <span class="info-box-number"><?= intval($data['rejected']) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-3 col-sm-3 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-check-double"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Production Finished</span>
                        <span class="info-box-number"><?= intval($data['finished']) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-3 col-sm-3 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-double"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Shipment Done</span>
                        <span class="info-box-number"><?= intval($data['shipped']) ?></span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>

        </div>
        <!-- /.row -->
        <div class="card card-secondary card-outline">
            <div class="card-header row">
                <div class="col-8">
                    <h3 class="card-title">
                        <i class="fas fa-chart-area"></i>
                        Cost Benefit Analysis Chart
                    </h3>

                </div>
                <div class="col-4">
                    <button class="btn btn-default btn-sm float-right" id="statuspdf"><i class="fas fa-download"></i> Save as PDF</button>
                </div>
            </div>
            <div class="card-body">
                <div id="chart_div" style="height: 380px" class="full-width-chart"></div>
            </div>
            <div class="card-footer">

            </div>
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

    function generateStatusPDF() {
        var doc = new jsPDF();
        doc.setFontSize(30);
        doc.setFillColor(135, 124, 45, 0);
        doc.addImage(imgData, 'png', 10, 10, 200, 120);
        doc.save('Cost benefit Analysis.pdf');
    }
    $('#statuspdf').click(generateStatusPDF);
</script>
</body>

</html>