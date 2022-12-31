<?php
include("../connect_db.php");


if (isset($_GET['page_layout'])) {
    switch ($_GET['page_layout']) {
        case 'factory';
            include 'statistic.php';
            break;

        case 'product_mgmt';
            include 'product_mgmt.php';
            break;
    }
}
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
                    <h3 class="card-title">
                        <?php $query = "SELECT * FROM product";
                        echo mysqli_num_rows(mysqli_query($db, $query));
                        ?>
                    </h3>
                </h3>
            </div>

        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <a href="statistic.php"><i class="material-icons">factory</i></a>
                </div>
                <p class="card-category">Total Factories</p>
                <h3 class="card-title">
                    <?php $query = "SELECT * FROM user_account where  Type = 'Cơ sở sản xuất'";
                    echo mysqli_num_rows(mysqli_query($db, $query));
                    ?>
                </h3>
            </div>

        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <a href="index.php?page_layout=store"><i class="material-icons">store</i></a>
                </div>
                <p class="card-category">Total Stores</p>
                <h3 class="card-title">
                    <?php $query = "SELECT * FROM user_account where  Type = 'Đại lý'";
                    echo mysqli_num_rows(mysqli_query($db, $query));
                    ?>
                </h3>
            </div>

        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <a href="index.php?page_layout=warranty"><i class="material-icons">construction</i></a>
                </div>
                <p class="card-category">Total Warranty Centers</p>
                <h3 class="card-title">
                    <?php $query = "SELECT * FROM user_account where  Type = 'Trung tâm bảo hành'";
                    echo mysqli_num_rows(mysqli_query($db, $query));
                    ?>
                </h3>
            </div>
        </div>
    </div>
</div>