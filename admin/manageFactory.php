<?php
session_start();
include "sidenav.php";
include "topheader.php";
include("../connect_db.php");

$result = mysqli_query($db, "select Name, Address, username, password from user_account where Type ='Cơ sở sản xuất'") or die ("Query incorrect.......");

//delete query
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $username = $_GET['username'];
    mysqli_query($db, "delete from user_account where `username`='$username'") or die("query is incorrect...");
}

// sort query
$columns = array('Name', 'Address', 'username');
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
    $query = "SELECT * FROM user_account WHERE Type ='Cơ sở sản xuất' and CONCAT(Name,Address,Type,username) LIKE '%$filtervalues%' ";
    $result = mysqli_query($db, $query);
}
// clear filter search
if (isset($_GET['clear'])) {
    $result = mysqli_query($db, "select Name, Address, username, password from user_account where Type ='Cơ sở sản xuất'") or die ("Query incorrect.......");
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
                                <input type="text" name="search" placeholder="Search data...">
                                <?php
                                if (isset($_GET['search'])) {
                                    $filtervalues = $_GET['search'];
                                    echo "<span>
                                        Filter: " . $filtervalues . "  <a href='manageFactory.php?clear=" . $filtervalues . "'><i class='material-icons'>cancel</i></a>
                                        </span>";
                                }
                                ?>
                            </form>
                            <table class="table tablesorter table-hover">
                                <thead class=" text-primary">
                                <tr>
                                    <th>
                                        <a href='manageFactory.php?column=Name&action=sort&order=<?php echo $asc_or_desc; ?>'>Name
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'Name' ? '-' . $up_or_down : ''; ?>"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="manageFactory.php?column=Address&action=sort&order=<?php echo $asc_or_desc; ?>">Address
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'Address' ? '-' . $up_or_down : ''; ?>"></i></a>
                                    </th>
                                    <th>
                                        <a href="manageFactory.php?column=username&action=sort&order=<?php echo $asc_or_desc; ?>">Username
                                            <i
                                                    class="fas fa-sort<?php echo $column == 'username' ? '-' . $up_or_down : ''; ?>"></i></a>
                                    </th>
                                    <th>User Password</th>
                                    <th><a href="addAccount.php" class="btn btn-success">Add New</a></th>
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
                                        <td><?php echo $row['Name']; ?></td>
                                        <td><?php echo $row['Address']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['password']; ?></td>
                                        <td><a class='btn btn-danger'
                                               href='manageFactory.php?username=$username&action=delete'>Delete
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