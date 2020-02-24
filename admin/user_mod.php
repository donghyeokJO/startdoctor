<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_POST['u_id'];
    $u_email = $_POST['u_email'];
    $u_phone = $_POST['u_phone'];
    $u_name = $_POST['u_name'];
    $u_birth = $_POST['u_birth'];

    $query = "update user set u_name='$u_name', u_phone='$u_phone', u_email='$u_email', u_birth='$u_birth'  where u_id='$u_id'";
    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        alert_msg('Query Error : ' . mysqli_error($conn));
    } else {
        s_msg('성공적으로 수정 되었습니다');
        echo("<script>location.replace('user_detail.php?u_id=$u_id');</script>");
    }
