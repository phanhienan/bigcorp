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
                <p class="card-category">Total products</p>
                <h3 class="card-title">
                    <!--                    --><?php //$query = "SELECT * FROM user_account where  Type = 'Cơ sở sản xuất'";
                    //                    $result = mysqli_query($db, $query);
                    //                    $row = mysqli_num_rows($result);
                    //                    echo $row;
                    //                    ?>
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
                <p class="card-category">Total Factories</p>
                <h3 class="card-title">
                    <?php $query = "SELECT * FROM user_account where  Type = 'Cơ sở sản xuất'";
                    $result = mysqli_query($db, $query);
                    $row = mysqli_num_rows($result);
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
                <p class="card-category">Total Stores</p>
                <h3 class="card-title">
                    <?php $query = "SELECT * FROM user_account where  Type = 'Đại lý'";
                    $result = mysqli_query($db, $query);
                    $row = mysqli_num_rows($result);
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
                <p class="card-category">Total Warranty Centers</p>
                <h3 class="card-title">
                    <?php $query = "SELECT * FROM user_account where  Type = 'Trung tâm bảo hành'";
                    $result = mysqli_query($db, $query);
                    $row = mysqli_num_rows($result);
                    echo $row;
                    ?>
                </h3>
            </div>

        </div>
    </div>
</div>