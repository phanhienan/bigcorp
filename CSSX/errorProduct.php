<?php
session_start();
error_reporting(0);
include("../connect_db.php");
$email = $_SESSION['admin_name'];
$result = mysqli_fetch_array(mysqli_query($db, "select * from user_account where username='$email'"));
$factory = trim($result['Name']);
$factory_add = trim($result['Address']);

//nhập sản phẩm sản phẩm lỗi
if (isset($_GET['productCode'])) {
    $ID = $_GET['productCode'];
    $row = mysqli_num_rows(mysqli_query($db, "select * from product where productCode = '$ID'"));
    if ($row == 0) {
        echo "<script>alert('Mã sản phẩm không tồn tại')</script>";
    } else {
        mysqli_query($db, "UPDATE product set status='traLaiCSSX', address = '$factory_add' WHERE productCode = '$ID'")
        or die("query select * from product where productCode = '$ID' incorrect...");
        echo "<script>alert('Đã thêm thành công')</script>";
    }
}

///pagination
$page = $_GET['page'];
if ($page == "" || $page == "1") {
    $page1 = 0;
} else {
    $page1 = ($page - 1) * 12;
}
include "sidenav.php";
include "topheader.php";
?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">Error products List</h3></div>
                                <a class="btn btn-success"
                                   href="errorProduct.php?action=addproduct">Add New
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps">
                                <?php
                                if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'addproduct') {
                                    echo "<span>
                                        Mã sản phẩm: <form action='' method='get'><input type='text' name = 'productCode'></form>
                                        </span>";
                                }
                                ?>
                                <table class="table tablesorter " id="page1">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Dòng sản phẩm</th>
                                        <th>Cơ sở sản xuất</th>
                                        <th>Đại lý</th>
                                        <th>Trung tâm bảo hành</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = mysqli_query($db, "select productCode, productLine from product
                                              where status = 'traLaiCSSX' and address = '$factory_add'
                                              Limit $page1,12")
                                    or die ("query 1 incorrect.....");
                                    if (mysqli_num_rows($result) == 0) {
                                        echo "
                                    <tr>
                                        <td colspan='4'>No Record Found</td>
                                    </tr>";
                                    }
                                    while (list($productCode, $productLine) = mysqli_fetch_array($result)) {
                                        $rs = mysqli_fetch_array(mysqli_query($db, "select * from orderstatus where productCode = '$productCode'"))
                                        or die("query incorect");
                                        $factory = $rs['facilityname'];
                                        $vendor = $rs['vendorName'];
                                        $warranty = $rs['servicecenter'];
                                        echo "<tr>
                                                <td>$productCode</td>
                                                <td>$productLine</td>
                                                <td>$factory</td>
                                                <td>$vendor</td>
                                                <td>$warranty</td>
                                                </tr>";
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
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link"
                                   href="errorProduct.php?page=<?php echo $page == 1 ? 1 : $page - 1; ?>"
                                   aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php

                            //counting paging
                            $paging = mysqli_query($db, "select productCode, productLine from product
                                              where status = 'traLaiCSSX' and address = '$factory_add'");
                            $count = mysqli_num_rows($paging);

                            $a = $count / 10;
                            $a = ceil($a);

                            for ($b = 1; $b <= $a; $b++) {
                                ?>
                                <li class="page-item"><a class="page-link"
                                                         href="errorProduct.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link"
                                   href="errorProduct.php?page=<?php echo $page == $a ? $a : $page + 1; ?>"
                                   aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>