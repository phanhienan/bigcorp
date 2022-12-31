<?php
//include("../../db.php");

?>

<div class="row" style="padding-top: 10vh;">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">pallet</i>
                </div>
                <p class="card-category">Sản phẩm cần triệu hồi</p>
                <h3 class="card-title">
                    <?php 
                    $result=mysqli_query($db,"SELECT o.productCode, o.customerID, c.address, o.facilityName
                    FROM customer c INNER JOIN orderstatus o INNER JOIN product p 
                    ON c.customerID = o.customerID AND p.productCode = o.productCode
                    WHERE p.status = 'canTrieuHoi'") or die ("query 1 incorrect.....");
                    if ($result)
                    {
                        // it return number of rows in the table.
                        $row = mysqli_num_rows($result);

                        printf(" " . $row);

                        // close the result.
                    }  ?>
                </h3>
            </div>

        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">factory</i>
                </div>
                <p class="card-category">Sản phẩm đang bảo hành</p>
               <h3 class="card-title"><?php 
                $result=mysqli_query($db,"SELECT p.productCode, o.warrantyDate, o.servicecenter, o.warrantyTimes
                FROM product p INNER JOIN orderstatus o 
                ON p.productCode = o.productCode
                WHERE p.status = 'dangBaoHanh'") or die ("query 1 incorrect.....");
                   if ($result) {
                       // it return number of rows in the table.
                       $row = mysqli_num_rows($result);

                       printf(" " . $row);

                       // close the result.
                   } ?>
                   </h3>
            </div>

        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">store</i>
                </div>
                <p class="card-category">Sản phẩm đã bán</p>
               <h3 class="card-title"><?php 
                $result=mysqli_query($db,"SELECT p.productCode, c.customerID, c.address, o.warrantyTimes 
                FROM product p INNER JOIN orderstatus o INNER JOIN customer c 
                ON p.productCode = o.productCode AND c.customerID = o.customerID
                WHERE p.orderStatus ='paid'")or die ("query 1 incorrect.....");
                   if ($result) {
                       // it return number of rows in the table.
                       $row = mysqli_num_rows($result);

                       printf(" " . $row);

                       // close the result.
                   } ?>
                   </h3>
            </div>

        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">construction</i>
                </div>
                <p class="card-category">Sản phẩm lỗi không thể sửa</p>
               <h3 class="card-title"><?php 
               $query = "SELECT productCode
               FROM product
               WHERE status = 'traLaiCSSX'";
                   $result = mysqli_query($db, $query);
                   if ($result) {
                       // it return number of rows in the table.
                       $row = mysqli_num_rows($result);

                       printf(" " . $row);

                       // close the result.
                   } ?>
                   </h3>
            </div>

        </div>
    </div>
</div>