<?php
session_start();
include("../connect_db.php");

if (isset($_POST['btn_save'])) {
    $productionID = $_POST['productionID'];
    $productCode = $_POST['productCode'];
    $facilityName = $_POST['$facilityName'];
    $vendorName =$_POST['vendorName'];
    $importedDate = $_POST['importedDate'];
    
    //Cập nhật các sản phẩm được nhập về
       
    mysqli_query($db, "UPDATE production p
    SET p.vendorName = '$vendorName', p.importedDate = '$importedDate'
    WHERE p.productCode = '$productCode'") or die("query $sql die");
    mysqli_query($db, "UPDATE product p 
    SET p.status='khoDaiLy', p.address = '$vendorName'
    WHERE p.productCode = '$productCode'") or die("query $query2 die");
    
    echo "<script>alert('Thêm sản phẩm thành công')</script>";

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

?>

    <div class="content">
        <div class="container-fluid">
            <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h5 class="title">Add new imported product</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Imported Date</label>
                                            <input type="date" id="importedDate" required name="importedDate"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Production ID</label>
                                            <input type="text" id="productionID" required name="productionID"
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


