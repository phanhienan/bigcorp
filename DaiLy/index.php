<?php
session_start();
include("../connect_db.php");

include "sidenav.php";
include "topheader.php";
include "activitity.php";

?>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-14">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"> Sản phẩm cần triệu hồi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <table class="table table-hover tablesorter " id="">
                                <thead class=" text-primary">
                                <tr>
                                    <th>Product Code</th>
                                    <th>Customer ID</th>
                                    <th>Customer Address</th>
                                    <th>Facility</th>
                                    
                                
                                </tr>
                                </thead>
                                <tbody>
                                     <?php 
                                    $result=mysqli_query($db,"SELECT o.productCode, o.customerID, c.address, o.facilityName
                                    FROM customer c INNER JOIN orderstatus o INNER JOIN product p 
                                    ON c.customerID = o.customerID AND p.productCode = o.productCode
                                    WHERE p.status = 'canTrieuHoi'") or die ("query 1 incorrect.....");
                                    if($result) {
                                        while(list($productCode,$customerID,$customerAddress,$facilityName)=mysqli_fetch_array($result))
                                        {
                                        echo "<tr>
                                        <td>$productCode</td>
                                        <td>$customerID</td>
                                        <td>$customerAddress</td>
                                        <td>$facilityName</td>
                
                                        </tr>";
                                        }
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
            
                <div class="col-md-14">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Sản phẩm đang bảo hành</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps">
                                <table class="table table-hover tablesorter " id="">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>Product Code</th>
                                        <th>Warranty Date</th>
                                        <th>Service Center</th>
                                        <th>Warranty Times</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $result=mysqli_query($db,"SELECT p.productCode, o.warrantyDate, o.servicecenter, o.warrantyTimes
                                        FROM product p INNER JOIN orderstatus o 
                                        ON p.productCode = o.productCode
                                        WHERE p.status = 'dangBaoHanh'") or die ("query 1 incorrect.....");
                                        if($result) {
                                            while(list($productCode,$warrantyDate,$servicecenter,$warantyTimes)=mysqli_fetch_array($result))
                                            {
                                            echo "<tr>
                                            <td>$productCode</td>
                                            <td>$warrantyDate</td>
                                            <td>$servicecenter</td>
                                            <td>$warantyTimes</td>
                    
                                            </tr>";
                                            }
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
                <div class="col-md-14">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Sản phẩm đã bán</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps">
                                <table class="table table-hover tablesorter " id="">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>Product Code</th>
                                        <th>Customer ID</th>
                                        <th>Customer Address</th>
                                        <th>Warranty Times</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $result=mysqli_query($db,"SELECT p.productCode, c.customerID, c.address, o.warrantyTimes 
                                            FROM product p INNER JOIN orderstatus o INNER JOIN customer c 
                                            ON p.productCode = o.productCode AND c.customerID = o.customerID
                                            WHERE p.orderStatus ='paid'")or die ("query 1 incorrect.....");
                                            if($result) {
                                                while(list($productCode,$customerID,$customerAddress,$warantyTimes)=mysqli_fetch_array($result))
                                                {
                                                echo "<tr>
                                                <td>$productCode</td>
                                                <td>$customerID</td>
                                                <td>$customerAddress</td>
                                                <td>$warantyTimes</td>
                        
                                                </tr>";
                                                }
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
            
            <!-- <div class="col-md-14">
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
                                    <th>facilityName</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--                      --><?php //
                                //                        $result=mysqli_query($con,"select * from facilityName_info")or die ("query 1 incorrect.....");
                                //
                                //                        while(list($brand_id,$brand_title)=mysqli_fetch_array($result))
                                //                        {
                                //                        echo "<tr><td>$brand_id</td><td>$brand_title</td>
                                //
                                //                        </tr>";
                                //                        }
                                //                        ?>
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
            </div> -->


        </div>
    </div>
<?php
include "footer.php";
?>