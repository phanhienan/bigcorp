<?php
session_start();
include("../connect_db.php");
include "sidenav.php";
include "topheader.php";
include "activitity.php";

// lấy tên của cơ sở sản xuất
$email = $_SESSION['admin_name'];
$query = mysqli_fetch_array(mysqli_query($db, "select * from user_account where username='$email'"));
$factory = $query['Name'];

?>
    <div class="content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-success">
                    <h4 class="card-title"> Thống kê sản phẩm đã bán</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header card-header-text">
                                <h4 class="card-title">Theo tháng</h4>
                            </div>
                            <div class="table-responsive ps">
                                <table class="table table-hover tablesorter ">
                                    <thead class=" text-primary">
                                    <th>Tháng</th>
                                    <th>Số lượng SP</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for ($i = 1; $i <= 12; $i++) {
                                        $num = mysqli_num_rows(mysqli_query($db, "select * from import 
                                                        where facilityName = '$factory' and month(importedDate) = $i"));
                                        echo "<tr><td>$i</td><td>$num</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-header card-header-text">
                                <h4 class="card-title"> Theo năm</h4>
                            </div>
                            <div class="table-responsive ps">
                                <table class="table table-hover tablesorter ">
                                    <thead class=" text-primary">
                                    <th>Năm</th>
                                    <th>Số lượng SP</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $rs =mysqli_query($db, "SELECT Year(importedDate) as year FROM `production` ");
                                    while (list($year) = mysqli_fetch_array($rs)) {
                                        $num = mysqli_num_rows(mysqli_query($db, "select * from import 
                                                        where facilityName = '$factory' and year(importedDate) = $year"));
                                        echo "<tr><td>$year</td><td>$num</td><td></td></tr>";
                                    }
                                    ?>
                                    <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>