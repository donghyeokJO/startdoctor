<?php
    include 'config.php';
    include 'util.php';
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    session_start();
    $u_email = $_SESSION['u_email'];
    $query = "select * from user where u_email='$u_email'";
    $temp = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($temp);
    $u_id = $user['u_id'];
    $u_email = $_POST['new_email'];
    $query = "update user set u_email = '$u_email' where u_id ='$u_id'";
    $result = mysqli_query($conn, $query);
    $_SESSION['u_email'] = $u_email;
    if ($result) {
        echo '<script>location.href="profile.php"</script>';
    } else {
        msg('이미 존재하는 이메일이거나, 잘못된 요청입니다. ');
    }
