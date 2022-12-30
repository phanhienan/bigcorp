<?php
session_start();
error_reporting(0);
include("../connect_db.php");

///pagination
$page = $_GET['page'];

if ($page == "" || $page == "1") {
    $page1 = 0;
} else {
    $page1 = ($page * 10) - 10;
}
include "sidenav.php";
include "topheader.php";
?>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-14">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"> Selled products List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <table class="table tablesorter " id="page1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Dòng sản phẩm</th>
                                    <th>Lô sản phẩm</th>
                                    <th>Đại lý</th>
                                    <th>Ngày xuất</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // lấy tên của cơ sở sản xuất
                                $email = $_SESSION['admin_name'];
                                $query = mysqli_fetch_array(mysqli_query($db, "select * from user_account where username='$email'"));
                                $factory = $query['Name'];
                                //truy vấn lấy những lô của cssx đã chuyển cho đại lý
                                $sql = "SELECT * FROM product WHERE productCode IN
                                (SELECT productCode from import where facilityName = '$factory')
                                Limit $page1,12";
                                $result = mysqli_query($db, $sql) or die ("query $sql incorrect.....");
                                if (mysqli_num_rows($result) == 0) {
                                    echo "
                                    <tr>
                                        <td colspan='4'>No Record Found</td>
                                    </tr>";
                                }
                                while (list($productCode, $productionID, $productLine) = mysqli_fetch_array($result)) {
                                    $rs = mysqli_fetch_array(mysqli_query($db, "select * from import  where productCode = '$productCode'"));
                                    $vendor = $rs['vendorName'];
                                    $date = $rs['importedDate'];
                                    echo "<tr>
                                                <td>$productCode</td>
                                                <td>$productLine</td>
                                                <td>$productionID</td>
                                                <td>$vendor</td>
                                                <td>$date</td>
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
                            <a class="page-link" href="selledProduct.php?page=<?php echo $page == 1 ? 1 : $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php
                        //counting paging
                        $ $sql = "SELECT * FROM product WHERE productCode IN
                                (SELECT productCode from import where facilityName = '$factory')";
                        $paging = mysqli_query($db, $sql);
                        $count = mysqli_num_rows($paging);
                        $a = $count / 10;
                        $a = ceil($a);

                        for ($b = 1; $b <= $a; $b++) {
                            ?>
                            <li class="page-item"><a class="page-link"
                                                     href="selledProduct.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="selledProduct.php?page=<?php echo $page == $a ? $a : $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>