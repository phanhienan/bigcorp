<?php
session_start();
error_reporting(0);
$con = new mysqli('localhost', 'root', '', 'cms');

//export query
if (isset($_POST['export'])) {
    $all_id = $_POST['checkbox'];
    $extract_id = implode(",", $all_id);
//    echo $extract_id;
//    mysqli_query($db, "delete from user_account where `username`='$username'") or die("query is incorrect...");
//    $result = mysqli_query($db, "select Name, Address, username, password from user_account where Type ='Đại lý'") or die ("Query incorrect.......");
}


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
            <div class="row">
                <div class="col-md-9">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <div class="row">
                                <h4 class="card-title">New products List&nbsp;&nbsp;</h4>
                                <a href="add_products.php"><i class="material-icons">add_circle</i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive ps">
                                <table class="table tablesorter " id="page1">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th><i class="material-icons" onclick="export()">ios_share</i></th>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = mysqli_query($con, "select product_id,product_image, product_title,product_price from products  where  product_cat=2 or product_cat=3 or product_cat=4 Limit $page1,12") or die ("query 1 incorrect.....");
                                    $id = 1;
                                    while (list($product_id, $image, $product_name, $price) = mysqli_fetch_array($result)) {
                                        echo "<tr>
                                                <td style='width: 10px; text-align: center;'>
                                                <input type='checkbox' name='checkbox[]' value=" . $id . ">
                                                </td>
                                                <td>$id</td>
                                                <td><img src='../product_images/$image' style='width:50px; height:50px; border:groove #000'></td>
                                                <td>$product_name</td>
                                                <td>$price</td>
                                                </tr>";
                                        $id++;
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
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php
                            //counting paging

                            $paging = mysqli_query($con, "select product_id,product_image, product_title,product_price from products");
                            $count = mysqli_num_rows($paging);

                            $a = $count / 10;
                            $a = ceil($a);

                            for ($b = 1; $b <= $a; $b++) {
                                ?>
                                <li class="page-item"><a class="page-link"
                                                         href="productlist.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title"> Statistic</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>