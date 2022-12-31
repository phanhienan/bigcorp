<?php
session_start();
include "sidenav.php";
include "topheader.php";
include("../connect_db.php");

$result = mysqli_query($db, "SELECT * FROM orderstatus") or die ("Query incorrect.......");

//delete query
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $orderNumber = $_GET['orderNumber'];
    mysqli_query($db, "DELETE
    FROM orderstatus
    WHERE orderNumber = '$orderNumber'") or die("query is incorrect...");
    echo "<script>alert('Xóa sản phẩm lỗi thành công')</script>";
    $result = mysqli_query($db, "SELECT *
    FROM orderstatus") or die ("Query incorrect.......");
}

// sort query
$columns = array('orderNumber', 'customerID', 'productCode', 'warrantyTimes');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
$up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'sort') {
    $result = $db->query('SELECT *
    FROM
    orderstatus c ORDER BY ' . $column . ' ' . $sort_order);
}
// search query
if (isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
    $query = "SELECT *
    FROM orderstatus 
    WHERE customerID LIKE '%$filtervalues%'";
    $result = mysqli_query($db, $query);
}
// clear filter search
if (isset($_GET['clear'])) {
    $result = mysqli_query($db, "SELECT *
    FROM orderstatus") or die ("Query incorrect.......");
}
?>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-14">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Manage Factory</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <form action="" method="GET">
                                <input type="text" name="search" placeholder="Search customerID...">
                                <?php
                                if (isset($_GET['search'])) {
                                    $filtervalues = $_GET['search'];
                                    echo "<span>
                                        Filter: " . $filtervalues . "  <a href='manageErrorProduct.php?clear=" . $filtervalues . "'><i class='material-icons'>cancel</i></a>
                                        </span>";
                                }
                                ?>
                            </form>
                            <table class="table tablesorter table-hover">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        <a href='manageErrorProduct.php?column=orderNumber&action=sort&order=<?php echo $asc_or_desc; ?>'>Order Number
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'orderNumber' ? '-' . $up_or_down : ''; ?>"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="manageErrorProduct.php?column=customerID&action=sort&order=<?php echo $asc_or_desc; ?>">Customer ID
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'customerID' ? '-' . $up_or_down : ''; ?>"></i></a>
                                    </th>
                                    
                                    <th>
                                        <a href="manageErrorProduct.php?column=productCode&action=sort&order=<?php echo $asc_or_desc; ?>">Product Code
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'productCode' ? '-' . $up_or_down : ''; ?>"></i></a>
                                    </th>
                                    <th>
                                        <a href="manageErrorProduct.php?column=warrantyTimes&action=sort&order=<?php echo $asc_or_desc; ?>">Warranty Times
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'warrantyTimes' ? '-' . $up_or_down : ''; ?>"></i></a>
                                    </th>
                                    <th>Warranty Date</th>
                                    <th>Facility</th>
                                    <th>Service Center</th>
                                    
                                    <th><a href="addNewErrorProduct.php" class="btn btn-success">Add New</a></th>
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
                                while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['orderNumber']; ?></td>
                                        <td><?php echo $row['customerID']; ?></td>
                                        <td><?php echo $row['productCode']; ?></td>
                                        <td><?php echo $row['warrantyTimes']; ?></td>
                                        <td><?php echo $row['warrantyDate']; ?></td>
                                        <td><?php echo $row['facilityName']; ?></td>
                                        <td><?php echo $row['servicecenter']; ?></td>
                                        <td><a class='btn btn-danger'
                                               href='manageErrorProduct.php?orderNumber=$orderNumber&action=delete'>Delete
                                                <div class='ripple-container'></div>
                                            </a></td>
                                        
                                    </tr>
                                <?php endwhile; ?>
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
$result->free();
include "footer.php";
?>