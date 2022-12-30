<?php
session_start();
error_reporting(0);
include("../connect_db.php");
include "sidenav.php";
include "topheader.php";

///pagination
$page = $_GET['page'];

if ($page == "" || $page == "1") {
    $page1 = 0;
} else {
    $page1 = ($page - 1) * 12;
}
$sql = "select productCode, productName, productionID, status, address from product";
$result = mysqli_query($db, $sql) or die ("query 1 incorrect.....");
// search query
if (isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
    $query = $sql." where CONCAT(productCode, productName, productionID, status, address) LIKE '%".$filtervalues."%' ";
    $result = mysqli_query($db, $query);
}
// clear filter search
if (isset($_GET['clear'])) {
    $result = mysqli_query($db, $sql) or die ("Query incorrect.......");
}
?>

?>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-14">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"> Products List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <form action="" method="GET">
                                <input type="text" name="search" placeholder="Search data...">
                                <?php
                                if (isset($_GET['search'])) {
                                    $filtervalues = $_GET['search'];
                                    echo "<span>
                                        Filter: " . $filtervalues . "  <a href='products_list.php?clear=" . $filtervalues . "'>
                                        <i class='material-icons'>cancel</i></a>
                                        </span>";
                                }
                                ?>
                            </form>
                            <table class="table tablesorter " id="page1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Lô sản xuất</th>
                                    <th>Ngày sản xuất</th>
                                    <th>Trạng thái</th>
                                    <th>Địa chỉ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (mysqli_num_rows($result) == 0) {
                                    echo "
                                    <tr>
                                        <td colspan='4'>No Record Found</td>
                                    </tr>";
                                }
                                while (list($productCode, $productName, $productionID, $status, $address) = mysqli_fetch_array($result)) {
                                    $rs = mysqli_fetch_array(mysqli_query($db, "select * from production  where productionID = '$productionID'"));
                                    $productionDate = $rs['productionDate'];
                                    ?>
                                    <tr>
                                        <td><?php echo $productCode; ?></td>
                                        <td><?php echo $productName; ?></td>
                                        <td><?php echo $productionID; ?></td>
                                        <td><?php echo $productionDate ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $address; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="products_list.php?page=<?php echo $page == 1 ? 1 : $page - 1; ?>"
                                           aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <?php
                                    //counting paging
                                    $paging = mysqli_query($db, "select * from product");
                                    $count = mysqli_num_rows($paging);

                                    $a = $count / 10;
                                    $a = ceil($a);

                                    for ($b = 1; $b <= $a; $b++) {
                                        ?>
                                        <li class="page-item-<?php echo $b; ?>"><a class="page-link"
                                                                                   href="products_list.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                           href="products_list.php?page=<?php echo $page == $a ? $a : $page + 1; ?>"
                                           aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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