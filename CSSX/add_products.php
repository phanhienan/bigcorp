<?php
session_start();
include("../connect_db.php");

$email = $_SESSION['admin_name'];
$result = mysqli_fetch_array(mysqli_query($db, "select * from user_account where username='$email'"));
$factory = trim($result['Name']);
$factory_add = trim($result['Address']);

if (isset($_POST['btn_save'])) {
    $productionID = $_POST['productionID'];
    $row = mysqli_num_rows(mysqli_query($db, "select * from production where productionID = '$productionID'"));
    if ($row == 0) {
        $productLineCode = $_POST['productline'];
        $details = $_POST['details'];
        $ID_list = explode(", ", $details);
        $importedDate = $_POST['importedDate'];
        $productionDate = $_POST['productionDate'];

        // Cập nhật bảng lô sản phẩm
        $s = mysqli_fetch_array(mysqli_query($db, "select * from productline where productLineCode = '$productLineCode'"));
        $productLine = $s['productLine'];

        mysqli_query($db, "INSERT INTO production (productionID, productLineCode, facilityName, productionDate, importedDate) 
                                VALUES ('$productionID', '$productLineCode', '$factory', '$productionDate', '$importedDate')")
        or die("query $s incorrect");

        // Thêm từng sản phẩm mới
        $sql = "";
        foreach ($ID_list as $id) {
            $sql .= "INSERT INTO product (productCode, productionID, productLine, status, address) 
            VALUES ('$id','$productionID', '$productLine', 'moi', '$factory_add');";
        }
        mysqli_multi_query($db, $sql) or die("query $sql incorrect");
        echo "<script>alert('Đã nhập thành công')</script>";
    }
}
include "sidenav.php";
include "topheader.php";
?>
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Add Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Lô sản xuất</label>
                                        <input type="text" name="productionID" required
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Mã dòng sản phẩm</label>
                                        <input type="text" name="productline" required
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-group bmd-form-group">Ngày sản xuất</label>
                                    <input type="date" name="productionDate" required class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-group bmd-form-group">Ngày nhập kho</label>
                                    <input type="date" name="importedDate" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Mã sản phẩm
                                        <em>(Lưu ý: Mã sản phẩm trong lô, ngăn cách nhau bởi dấu phẩy , )</em>
                                    </label>
                                    <textarea rows="5" cols="80" id="details" required name="details"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="btn_save" name="btn_save" required
                                    class="btn btn-fill btn-primary">Add Product
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


