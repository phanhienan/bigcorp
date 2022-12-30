<?php
session_start();
include("../connect_db.php");

if (isset($_POST['re_password'])) {
    $email = $_SESSION['admin_name'];
    $old_pass = $_POST['old_pass'];
    $op = md5($old_pass);
    $new_pass = $_POST['new_pass'];
    $re_pass = $_POST['re_pass'];
    $password_query = mysqli_query($db, "select * from user_account where username='$email'");
    $password_row = mysqli_fetch_array($password_query);
    $database_password = $password_row['password'];
    if ($database_password == $op) {
        if ($new_pass == $re_pass) {
            $pass = md5($re_pass);
            $update_pwd = mysqli_query($db, "UPDATE user_account set password='$pass' where username = '$email'");
            echo "<script>alert('Đã đổi mật khẩu thành công'); </script>";
        } else {
            echo "<script>alert('Mật khẩu nhập lại không khớp'); </script>";
        }
    } else {
        echo "<script>alert('Mật khẩu cũ không đúng'); </script>";
    }
}

include "sidenav.php";
include "topheader.php";

?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Edit Profile</h4>
                            <p class="card-category">Complete your profile</p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="profile.php">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">
                                                <?php if (isset($_SESSION['admin_name'])) : ?><?php echo $_SESSION['admin_name']; ?>
                                                <?php endif ?>

                                            </label>
                                            <input type="text" class="form-control" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">enter old password</label>
                                            <input type="password" class="form-control" name="old_pass" id="npwd">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Change Password Here</label>
                                            <input type="password" class="form-control" name="new_pass" id="npwd">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">confirm Password Here</label>
                                            <input type="password" class="form-control" name="re_pass" id="npwd">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary pull-right" type="submit" name="re_password">Update
                                        Profile
                                    </button>

                                    <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php
include "footer.php";
?>