<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_GET['u_id'];
    $key = $_GET['key'];

    if ($key != 'medi180615') {
        msg('관리 비밀번호가 일치하지 않습니다. ');
    } else {
        $query = "update user set u_specify='미인증' where u_id= '$u_id'";
        $ret = mysqli_query($conn, $query);
        if (!$ret) {
            alert_msg('Query Error : ' . mysqli_error($conn));
        } else {
            s_msg('성공적으로 수정 되었습니다');
            echo("<script>location.replace('user_detail.php?u_id=$u_id');</script>");
        }
    }
