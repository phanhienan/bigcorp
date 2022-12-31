<?php
session_start();
include("../connect_db.php");

if (isset($_POST['btn_save'])) {
    $customerID = $_POST['customerID'];
    $orderNumber = $_POST['orderNumber'];
    $productCode = $_POST['productCode'];
    $servicecenter = $_POST['servicecenter'];
    $vendorName = $_POST['vendorName'];
    $facilityName = $_POST['facilityName'];   
    $warrantyDate = $_POST['warrantyDate'];
    $status = $_POST['status'];
    $address ="";

    if ($status == 'dangBaoHanh') {
        $address = $servicecenter;
    } else {
        $address = $facilityName;
    }
    
    mysqli_query($db, "UPDATE product p
    SET p.status = '$status', p.address = '$address'
    WHERE p.productCode = '$productCode'");
    mysqli_query($db, "UPDATE orderstatus
    SET servicecenter = '$servicecenter', warrantyDate = '$warrantyDate', vendorName = '$vendorName', warrantyTimes = (warrantyTimes + 1), facilityName = '$facilityName'
    WHERE customerID = '$customerID' AND productCode = '$productCode'") or die ("query incorrect");

    echo "<script>alert('Thêm sản phẩm lỗi thành công')</script>";

}

include "sidenav.php";
include "topheader.php";
?>

<?php
$sql1 = "SELECT u.Name
FROM user_account u
WHERE u.Type='Cơ sở sản xuất' ";

$facility = $db->query($sql1);

$sql2 = "SELECT u.Name
FROM user_account u
WHERE u.Type='Đại lý' ";
$vendor = $db->query($sql2);

$sql3 = "SELECT u.Name
FROM user_account u
WHERE u.Type='Trung tâm bảo hành' ";
$servicecenter = $db->query($sql3);


?>

    <div class="content">
        <div class="container-fluid">
            <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h5 class="title">Add new error product</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Warranty Date</label>
                                            <input type="date" id="warrantyDate" required name="warrantyDate"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Customer ID</label>
                                            <input type="text" id="customerID" required name="customerID"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Order Number</label>
                                            <input type="text" id="orderNumber" required name="orderNumber"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Code</label>
                                            <input type="text" id="productCode" required name="productCode"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Status</label>
                                            <select name="status" id="status" class="form-control" style="background-color: grey;"  required>
                                                <option value="dangBaoHanh">Lỗi Cần Bảo Hành</option>
                                                <option value="traLaiCSSX">Lỗi Không Thể Sửa</option>
                                                <option value="canTrieuHoi">Cần Triệu Hồi</option>
                                                <option value="banE">Không có người tiêu thụ</option>
                                                
                                                </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Service Center</label>
                                            <select name="servicecenter" id="servicecenter" class="form-control" style="background-color: grey;"  required >
                                            
                                            <?php
                                            
                                                while ($category = mysqli_fetch_array(
                                                        $servicecenter,MYSQLI_ASSOC)):;
                                            ?>
                                                <option value="<?php echo $category["Name"];
                                                    
                                                ?>">
                                                    <?php echo $category["Name"];
                                                        
                                                    ?>
                                                </option>
                                            <?php
                                                endwhile;
                                                
                                            ?>
                                               
                                    
                                            </select>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Facility</label>
                                            <select name="facilityName" id="facilityName" class="form-control" style="background-color: grey;"  required >
                                            
                                            <?php
                                            
                                                while ($category = mysqli_fetch_array(
                                                        $facility,MYSQLI_ASSOC)):;
                                            ?>
                                                <option value="<?php echo $category["Name"];
                                                    
                                                ?>">
                                                    <?php echo $category["Name"];
                                                        
                                                    ?>
                                                </option>
                                            <?php
                                                endwhile;
                                                
                                            ?>
                                               
                                    
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendorName" id="vendorName" class="form-control" style="background-color: grey;"  required >
                                            
                                            <?php
                                            
                                                while ($category = mysqli_fetch_array(
                                                        $vendor,MYSQLI_ASSOC)):;
                                            ?>
                                                <option value="<?php echo $category["Name"];
                                                    
                                                ?>">
                                                    <?php echo $category["Name"];
                                                        
                                                    ?>
                                                </option>
                                            <?php
                                                endwhile;
                                                
                                            ?>
                                               
                                    
                                            </select>
                                            
                                        </div>
                                    </div>
            

                                       
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" required
                                        class="btn btn-fill btn-primary">Update Product
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
<?php
include "footer.php";
?>


