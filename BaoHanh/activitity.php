<?php
include("../connect_db.php");

?>

<div class="row" style="padding-top: 10vh;">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">pallet</i>
                </div>
                <p class="card-category">Total Warranting Products</p>
                <h3 class="card-title">
                   <?php 
                    $query = "SELECT productCode
                    FROM product
                    WHERE status = 'dangBaoHanh'";
                        $result = mysqli_query($db, $query);
                        if ($result)
                        {
                            // it return number of rows in the table.
                            $row = mysqli_num_rows($result);

                            printf(" " . $row);

                            // close the result.
                        }
                 ?>
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
                <p class="card-category">Total Warranted Products</p>
               <h3 class="card-title">
                <?php 
                $query = "SELECT productCode
                FROM product
                WHERE status = 'baoHanhXong'";
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
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">store</i>
                </div>
                <p class="card-category">Total Cannot Fix Product</p>
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