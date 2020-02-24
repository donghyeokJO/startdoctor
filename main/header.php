<?php
include_once 'config.php';
include_once 'util.php';

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (isset($_COOKIE['u_email_cookie']) && isset($_COOKIE['u_pw_cookie'])) {
    $u_email = $_COOKIE['u_email_cookie'];
    $hash = $_COOKIE['u_pw_cookie'];

    $u_email = rtrim($u_email, '?');
    $query = "select * from user where u_email = '$u_email'";
    $ret = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($ret);
    $u_pw = $user['u_pw'];
    $hash2 = Decrypt($hash, $secret_key, $secret_iv);
    // echo $hash2;
    // echo $u_email;
    session_start();
    if (password_verify($hash2, $u_pw)) {
        $_SESSION['u_email'] = $u_email;
    }
}
