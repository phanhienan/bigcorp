<?php
session_start();
include "sidenav.php";
include "topheader.php";
include("../connect_db.php");

$result = mysqli_query($db, "SELECT*
FROM production
WHERE importedDate is NOT null") or die ("Query incorrect.......");

//delete query
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $producCode = $_GET['productCode'];
    mysqli_query($db, "DELETE
    FROM production
    WHERE productCode = $producCode'") or die("query is incorrect...");
    echo "<script>alert('Xóa sản phẩm thành công')</script>";
    $result = mysqli_query($db, "SELECT*
    FROM production
    WHERE importedDate is NOT null") or die ("Query incorrect.......");
}

// sort query
$columns = array('productionID', 'productCode', 'importedDate');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
$up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'sort') {
    $result = $db->query('SELECT * FROM user_account where Type="Cơ sở sản xuất" ORDER BY ' . $column . ' ' . $sort_order);
}
// search query
if (isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
    $query = "SELECT *
    FROM production
    WHERE productCode LIKE '%$filtervalues%' ";
    $result = mysqli_query($db, $query);
}
// clear filter search
if (isset($_GET['clear'])) {
    $result = mysqli_query($db, "SELECT*
    FROM production
    WHERE importedDate is NOT null") or die ("Query incorrect.......");
}
?>
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-14">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Manage Imported Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive ps">
                            <form action="" method="GET">
                                <input type="text" productionID="search" placeholder="Search product code...">
                                <?php
                                if (isset($_GET['search'])) {
                                    $filtervalues = $_GET['search'];
                                    echo "<span>
                                        Filter: " . $filtervalues . "  <a href='manageImportedProduct.php?clear=" . $filtervalues . "'><i class='material-icons'>cancel</i></a>
                                        </span>";
                                }
                                ?>
                            </form>
                            <table class="table tablesorter table-hover">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        <a href='manageImportedProduct.php?column=productionID&action=sort&order=<?php echo $asc_or_desc; ?>'>Production ID
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'productionID' ? '-' . $up_or_down : ''; ?>"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="manageImportedProduct.php?column=productCode&action=sort&order=<?php echo $asc_or_desc; ?>">Product Code
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'productCode' ? '-' . $up_or_down : ''; ?>"></i></a>
                                    </th>
                                    <th>
                                        <a href="manageImportedProduct.php?column=importedDate&action=sort&order=<?php echo $asc_or_desc; ?>">Imported Date
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'importedDate' ? '-' . $up_or_down : ''; ?>"></i></a>
                                    </th>
                                    <th>Facility</th>
                                    <th>Producted Date </th>
                                    <th><a href="addProduct.php" class="btn btn-success">Add New</a></th>
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
                                        <td><?php echo $row['productionID']; ?></td>
                                        <td><?php echo $row['productCode']; ?></td>
                                        <td><?php echo $row['importedDate']; ?></td>
                                        <td><?php echo $row['facilityName']; ?></td>
                                        <td><?php echo $row['productionDate']; ?></td>
                                        <td><a class='btn btn-danger'
                                               href='manageImportedProduct.php?importedDate=$importedDate&action=delete'>Delete
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