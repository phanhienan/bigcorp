<?php
session_start();
//include("../../db.php");
include "sidenav.php";
include "topheader.php";
if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $username = $_POST['email'];
    $user_password = $_POST['password'];
    $address = $_POST['address'];

//mysqli_query($con,"insert into user_info(first_name, last_name,email,password,mobile,address1,address2) values ('$first_name','$last_name','$email','$user_password','$mobile','$address1','$address2')")
//			or die ("Query 1 is inncorrect........");
//mysqli_close($con);
}


?>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add Account</h4>
                        <p class="card-category">profile</p>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" name="form" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Address</label>
                                        <input type="text" name="address" id="address" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">User Name</label>
                                        <input type="email" name="email" id="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Password</label>
                                        <input type="password" id="password" name="password" class="form-control"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group bmd-form-group">
                                        <label class="bmd-label-floating">Title</label>
                                        <select name="title" id="title" class="form-control" required>
                                            <option value="Cơ sở sản xuất" style="background-color: dimgrey" >Cơ sở sản xuất</option>
                                            <option value="Đại lý" style="background-color: dimgrey">Đại lý</option>
                                            <option value="Trung tâm bảo hành" style="background-color: dimgrey">Trung tâm bảo hành</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include "footer.php";
?>