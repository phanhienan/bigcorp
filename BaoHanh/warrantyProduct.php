<?php
session_start();
include("../connect_db.php");

include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">List Warranty Products</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter table-hover" id="">
                            <thead class=" text-primary">
                            <tr>
                                <th>Product Code</th>
                                <th>Warranty Date</th>
                                <th>Status</th>
                                <th>Vendor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                    $result=mysqli_query($db,"SELECT p.productCode, o.warrantyDate, p.status, o.vendorName
                                    FROM product p INNER JOIN orderstatus o
                                    ON p.productCode = o.productCode
                                    WHERE p.status = 'dangBaoHanh' OR status ='baoHanhXong' OR status='traLaiCSSX'")or die ("query 2 incorrect.......");
                                    
                                    if($result) {
                                        while(list($productCode,$warrantyDate,$status,$vendorName)=mysqli_fetch_array($result))
                                        {
                                            $state="";
                                            if($status == 'dangBaoHanh') {
                                                $state = "Đang bảo hành";
                                            } else if ($status == 'baoHanhXong') {
                                                $state = "Bảo Hành Xong";
                                            } else {
                                                $state = "Lỗi không thể sửa";
                                            }
                                        echo "<tr>
                                        <td>$productCode</td>
                                        <td>$warrantyDate</td>
                                        <td>$state</td>
                                        <td>$vendorName</td>
                
                                        </tr>";
                                        }
                                
                                    }
                                    mysqli_close($db);
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
</div>
<?php
include "footer.php";
?>