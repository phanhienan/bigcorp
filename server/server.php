<?php
session_start();
// initializing variables
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'web');

if (isset($_POST['login_admin'])) {
    $admin_username = mysqli_real_escape_string($db, $_POST['admin_username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($admin_username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user_account WHERE `username`='$admin_username' AND `password`='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['admin_name'] = $admin_username;
            $_SESSION['success'] = "You are now logged in";
            $account = mysqli_fetch_array($results);
            switch ($account['Type']) {
                case 'Quản lý';
                    header('location: ./admin/');
                    break;

                case 'Cơ sở sản xuất';
                    header('location:./CSSX/');
                    break;

                case 'Đại lý';
                    header('location:./DaiLy');
                    break;

                case 'Trung tâm bảo hành';
                    header('location:./BaoHanh');
                    break;
            }

        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>