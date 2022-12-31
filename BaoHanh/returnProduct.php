<?php
session_start();
include("../connect_db.php");




if (isset($_POST['btn_save'])) {
    $productCode = $_POST['productCode'];
    $status = $_POST['status'];
    $servicecenter = $_POST['servicecenter'];
    $vendorName = $_POST['vendorName'];
    
    mysqli_query($db, "UPDATE product p
    SET p.status = '$status', p.address = '$vendorName'
    WHERE p.productCode = '$productCode'");
    
    echo "<script>alert('Cập nhật trạng thái sản phẩm thành công')</script>";

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
                                <h5 class="title">Return Product To Vendor</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">

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
                                                <option value="baoHanhXong">Đã bảo hành xong</option>
                                                <option value="traLaiCSSX">Lỗi Không Thể Sửa</option>
                                               
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
                                        class="btn btn-fill btn-primary">Update Warranty Status
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


