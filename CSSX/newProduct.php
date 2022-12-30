<?php
session_start();
error_reporting(0);
include("../connect_db.php");

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
                                    <h3 class="card-title">New products List</h3></div>
                                <a class="btn btn-success" href="add_products.php">Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps">
                                <table class="table tablesorter " id="page1">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Lô sản phẩm</th>
                                        <th>Ngày sản xuất</th>
                                        <th>Ngày nhập</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = mysqli_query($db, "select productCode, productionID, productLine from product
                                              where status = 'moi' Limit $page1,12")
                                    or die ("query 1 incorrect.....");
                                    if (mysqli_num_rows($result) == 0) {
                                        echo "
                                    <tr>
                                        <td colspan='4'>No Record Found</td>
                                    </tr>";
                                    }
                                    while (list($productCode, $productionID, $productLine) = mysqli_fetch_array($result)) {
                                        $rs = mysqli_fetch_array(mysqli_query($db, "select * from production  where productionID = '$productionID'"));
                                        $importedDate = $rs['importedDate'];
                                        $productionDate = $rs['productionDate'];
                                        echo "<tr>
                                                <td>$productCode</td>
                                                <td>$productLine</td>
                                                <td>$productionID</td>
                                                <td>$productionDate</td>
                                                <td>$importedDate</td>
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
                                   href="newProduct.php?page=<?php echo $page == 1 ? 1 : $page - 1; ?>"
                                   aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php

                            //counting paging
                            $paging = mysqli_query($db, "select * from products where status = 'moi'");
                            $count = mysqli_num_rows($paging);

                            $a = $count / 10;
                            $a = ceil($a);

                            for ($b = 1; $b <= $a; $b++) {
                                ?>
                                <li class="page-item"><a class="page-link"
                                                         href="newProduct.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link"
                                   href="newProduct.php?page=<?php echo $page == $a ? $a : $page + 1; ?>"
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