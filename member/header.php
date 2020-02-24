<?php
include_once 'config.php';
include_once 'util.php';

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (isset($_COOKIE['u_email_cookie']) && isset($_COOKIE['u_pw_cookie'])) {
    $u_email = $_COOKIE['u_email_cookie'];
    $hash = $_COOKIE['u_pw_cookie'];
    $master_key = 'medi180615';
    $query = "select * from user where u_email = '$u_email'";
    $ret = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($ret);
    $u_pw = $user['u_pw'];
    $hash2 = md5($master_key, $u_pw);
    session_start();
    if ($hash == $hash2) {
        $_SESSION['u_email'] = $u_email;
    }
}
