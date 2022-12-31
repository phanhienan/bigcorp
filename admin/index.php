<?php
session_start();
include("../connect_db.php");
include "sidenav.php";
include "topheader.php";
include "activitity.php";

?>
    <div class="content">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"> Statistic Product</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter ">
                                <thead class=" text-primary">
                                <th>Trạng thái</th>
                                <th>Số lượng SP</th>
                                <th>Tỉ lệ</th>
                                </thead>
                                <tbody>
                                <?php
                                $total = mysqli_num_rows(mysqli_query($db, "select * from product"));
                                $rs = mysqli_query($db, "SELECT status, COUNT(*)as num FROM product GROUP BY status");
                                while (list($st, $num) = mysqli_fetch_array($rs)) {
                                    echo "<tr><td>$st</td><td>$num</td><td>$num/$total</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter ">
                                <thead class=" text-primary">
                                <th>CSSX</th>
                                <th>Số lượng SP</th>
                                </thead>
                                <tbody>
                                <?php
                                $rs = mysqli_query($db, "SELECT Name FROM user_account where Type ='Đại lý'");
                                while (list($name) = mysqli_fetch_array($rs)) {
                                    $num = mysqli_num_rows(mysqli_query($db, "SELECT * FROM product WHERE productionID IN (SELECT productionID FROM production WHERE facilityName = '$name')"));
                                    echo "<tr><td>$name</td><td>$num</td><td></td></tr>";
                                }
                                ?>
                                <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter ">
                                <thead class=" text-primary">
                                <th>CSSX</th>
                                <th>Số lượng SP</th>
                                </thead>
                                <tbody>
                                <?php
                                $rs = mysqli_query($db, "SELECT Name FROM user_account where Type ='Cơ sở sản xuất'");
                                while (list($name) = mysqli_fetch_array($rs)) {
                                    $num = mysqli_num_rows(mysqli_query($db, "SELECT * FROM product WHERE productionID IN (SELECT productionID FROM production WHERE facilityName = '$name')"));
                                    echo "<tr><td>$name</td><td>$num</td><td></td></tr>";
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
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"> Factories List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = mysqli_query($db, "select * from user_account where Type = 'Cơ sở sản xuất'") or die ("query incorrect.....");
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row['Name']; ?></td>
                                        <td><?php echo $row['Address']; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Stores List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = mysqli_query($db, "select * from user_account where Type = 'Đại lý'") or die ("query incorrect.....");
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $row['Name']; ?></td>
                                        <td><?php echo $row['Address']; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Warranty Centers Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table table-hover tablesorter " id="">
                            <thead class=" text-primary">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = mysqli_query($db, "select * from user_account where Type = 'Trung tâm bảo hành'") or die ("query incorrect.....");
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $row['Name']; ?></td>
                                    <td><?php echo $row['Address']; ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
include "footer.php";
?>