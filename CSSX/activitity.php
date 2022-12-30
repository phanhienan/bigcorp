<?php
include("../connect_db.php");
// lấy tên của cơ sở sản xuất
$email = $_SESSION['admin_name'];
$query = mysqli_fetch_array(mysqli_query($db, "select * from user_account where username='$email'"));
$factory = $query['Name'];
$factory_add = $query['Address'];

?>

<div class="row" style="padding-top: 10vh;">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">pallet</i>
                </div>
                <p class="card-category">Total products</p>
                <h3 class="card-title">
                    <?php
                    $query = "SELECT * FROM product WHERE productionID IN (SELECT productionID FROM production WHERE facilityName = '$factory')";
                    $row = mysqli_num_rows(mysqli_query($db, $query));
                    echo $row;
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
                <p class="card-category">Total new products</p>
                <h3 class="card-title">
                    <?php
                    $query = "SELECT * FROM product WHERE 'status' = 'moi' and productionID IN (SELECT productionID FROM production WHERE facilityName = '$factory')";
                    $row = mysqli_num_rows(mysqli_query($db, $query));
                    echo $row;
                    ?>
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
                <p class="card-category">Total selled products</p>
                <h3 class="card-title">
                    <?php
                    $query = "SELECT * FROM product WHERE productCode IN
                                (SELECT productCode from import where facilityName = '$factory')";
                    $row = mysqli_num_rows(mysqli_query($db, $query));
                    echo $row;
                    ?>
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
                <p class="card-category">Total error product</p>
                <h3 class="card-title">
                    <?php
                    $query = "SELECT * FROM product WHERE status ='traLaiCSSX' and address ='$factory_add'";
                    $row = mysqli_num_rows(mysqli_query($db, $query));
                    echo $row;
                    ?>
                </h3>            </div>

        </div>
    </div>
</div>