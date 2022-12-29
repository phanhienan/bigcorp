<?php
session_start();
$con = new mysqli('localhost', 'root', '', 'cms');
error_reporting(0);

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
            <div class="col-md-14">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"> Products List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="products_list.php?page=<?php echo $page==1? 1:$page-1;?>" aria-label="Previous">
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
                                        <li class="page-item-<?php echo $b;?>"><a class="page-link"
                                                                 href="products_list.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="products_list.php?page=<?php echo $page==$a? $a:$page+1;?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>

                            <table class="table tablesorter " id="page1">
                                <thead class=" text-primary">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $result = mysqli_query($con, "select product_image, product_title,product_price from products Limit $page1,12") or die ("query 1 incorrect.....");

                                while (list($image, $product_name, $price) = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><img src='<?php echo "../product_images/" . $image; ?>'
                                                 style='width:50px; height:50px; border:groove #000'>
                                        </td>
                                        <td><?php echo $product_name; ?></td>
                                        <td><?php echo $price; ?></td>
                                    </tr>
                                    <?php
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
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>