<?php
include_once('../backend/Order.php');

$order = new Order();
$NumOfOrders = $order->countOrders();

$NumOfUnconfirmedOrder = $order->countOrdersByStatus(0);
$NumOfSuccessOrder = $order->countOrdersByStatus(1);
$NumOfCancelOrder = $order->countOrdersByStatus(2);

// get date now
$now = date('Y-m-d');
$currentMonth = date('m');
$numberday = cal_days_in_month(CAL_GREGORIAN, $currentMonth, date('Y'));

?>
<?php include('layouts/header.php') ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="media-body text-white text-start">
                                    <h3>
                                        <?php echo ($NumOfOrders) ?>
                                    </h3>
                                    <span class="small">Orders</span>

                                </div>
                                <div class="align-self-center">
                                    <i class="fa-solid fa-cart-shopping text-white float-start display-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="media-body text-white text-start">
                                    <h3>
                                        <?php echo ($NumOfUnconfirmedOrder) ?>
                                    </h3>
                                    <span class="small">Unconfirmed order</span>

                                </div>
                                <div class="align-self-center">
                                    <i class="fa-solid fa-circle-exclamation text-white float-start display-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="media-body text-white text-start">
                                    <h3>
                                        <?php echo ($NumOfSuccessOrder) ?>
                                    </h3>
                                    <span class="small">
                                        Successful order</span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-regular fa-circle-check text-white float-start display-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="media-body text-white text-start">
                                    <h3>
                                        <?php echo ($NumOfCancelOrder) ?>
                                    </h3>
                                    <span class="small">
                                        Canceled order</span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-solid fa-ban text-white float-start display-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-12">
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                so luong don hang trong thang
                                <?php echo ($currentMonth) ?>
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            <div class="card-footer small text-muted">Updated
                                <?php echo ($now) ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie me-1"></i>
                                Bieu do thanh phan san pham da ban
                            </div>
                            <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                            <div class="card-footer small text-muted">Updated
                                <?php echo ($now) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie me-1"></i>
                            san pham da ban
                        </div>
                        <div class="card-body"><canvas id="myPieChart2" width="100%" height="50"></canvas></div>
                        <div class="card-footer small text-muted">Updated
                            <?php echo ($now) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie me-1"></i>
                            doanh thu theo thang
                            <?php echo ($currentMonth) ?>
                        </div>
                        <div class="card-body"><canvas id="myAreaChart4" width="100%" height="50"></canvas></div>
                        <div class="card-footer small text-muted">Updated
                            <?php echo ($now) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Don hang gan day
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>IDdonhang</th>
                                <th>IDuser</th>
                                <!-- <th>IDgiohang</th> -->
                                <th>tongtien</th>
                                <th>ngaydat</th>
                                <th>ngaynhan</th>
                                <th>trangthai</th>
                                <!-- <th>Edit</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>IDdonhang</th>
                                <th>IDuser</th>
                                <!-- <th>IDgiohang</th> -->
                                <th>tongtien</th>
                                <th>ngaydat</th>
                                <th>ngaynhan</th>
                                <th>trangthai</th>
                                <!-- <th>Edit</th> -->
                                <!-- <th>Delete</th> -->
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $order = new Order();
                            $order->loadDataOnTable();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2022</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>
<?php
$list = $order->getCategoryIdInOrderDetail();
// process array to string
$list_category = implode("', '", $list['category']);
// process list amount to the % of each category
$list_amount = $list['amount'];
$total = array_sum($list_amount);
$percent = array();
foreach ($list_amount as $value) {
    $percent[] = round($value / $total * 100, 2);
}
$list_percent = implode(", ", $percent);

?>
<!-- <script src="https://kit.fontawesome.com/96a820946a.js" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<?php
$currentMonth = date('m');
$numberday = cal_days_in_month(CAL_GREGORIAN, $currentMonth, date('Y'));
$list1 = $order->getNumberOfOneDayByMonth($currentMonth);
// create string form 1 to $currentDay
$day = range(1, $numberday);
// convert array to string
$dayOfmounth = implode(", ", $list1);

$list4 = $order->getTotalAmountInOrderOfOneDay($currentMonth);
$dayOfmounth2 = implode(", ", $list4);
?>
<script>
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($day) ?>,
        datasets: [{
            label: "Products",
            borderWidth: 1,
            backgroundColor: "#ff6384",
            borderColor: "rgba(2,117,216,1)",
            data: [<?php echo $dayOfmounth ?>],
        }],
    },
        options: {
        scales: {
            xAxes: [{
                gridLines: {
                    display: true
                },
                ticks: {
                    maxTicksLimit: <?php echo $numberday?>
        }
      }],
        yAxes: [{
            ticks: {
                min: 0,
                max: <?php echo(int) max($list1) + 3 ?>,
            stepSize: 1
        },
            gridLines: {
            display: true
        }
      }],
    },
    legend: {
        display: true,
            position: 'right'
    }
  }
});

    var ctx4 = document.getElementById("myAreaChart4");
    var myLineChart4 = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($day) ?>,
        datasets: [{
            label: "Sessions",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: [<?php echo $dayOfmounth2 ?>],
        }],
    },
        options: {
        scales: {
            xAxes: [{
                gridLines: {
                    display: true
                },
                ticks: {
                    stepSize: 1
                }
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                        // get max value of array and round up to 200
                        <?php $max = (int) max($list4) + 200 ?>
            max : <?php echo (round($max, -2)) ?>,
                stepSize: 100
                    },
        gridLines: {
            color: "rgba(0, 0, 0, .125)",
            display: true
        }
    }],
            },
    legend: {
        display: false
    }
        }
    });

</script>

<?php
$list3 = $order->getAmountOfEachProductInOrderDetail();
$product_name = implode("', '", $list3['name']);

// process list amount to the % of each category
$amount = implode(", ", $list3['amount']);



?>

<script>

    var ctx1 = document.getElementById("myPieChart");
    var myPieChart1 = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['<?php echo $list_category ?>'],
            datasets: [{
                data: [<?php echo $list_percent ?>],
                backgroundColor: ['#36a2eb', '#ff6384', '#4bc0c0', '#ff9f40', '#9966ff', '#ffcd56', '#c9cbcf'],
            }],
        },
    });

    var ctx2 = document.getElementById("myPieChart2");
    var myPieChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['<?php echo $product_name ?>'],
            datasets: [{
                data: [<?php echo $amount ?>],
                backgroundColor: ['#36a2eb', '#ff6384', '#4bc0c0', '#ff9f40', '#9966ff', '#ffcd56', '#c9cbcf'],
            }],
        },
        options: {
            legend: {
                display: true,
                position: 'right'
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>