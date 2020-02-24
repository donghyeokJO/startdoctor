<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    session_start();
    $u_email = $_SESSION['u_email'];
    $query = "select * from user where u_email = '$u_email'";
    $ret = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($ret);

    $u_id = $user['u_id'];
    $c = $_GET['c'];
    $q = "select * from checklist where u_id= '$u_id'";
    $re = mysqli_query($conn, $q);
    $check = mysqli_fetch_array($re);
    if ($check['percentage'] == 98) {
        $percentage = 100;
    } else {
        $percentage = $check['percentage'] + 3;
    }
    if ($check["$c"] == 1) {
        msg('이미 완료된 항목입니다.');
    } else {
        $query = "update checklist set $c = 1, percentage = '$percentage' where u_id = '$u_id'";
        $res = mysqli_query($conn, $query);
        if (!$res) {
            mysqli_query($conn, 'rollback');
            echo mysqli_error($conn);
            msg('잘못된 요청 입니다.');
        } else {
            mysqli_query($conn, 'commit');
            echo "<meta http-equiv='refresh' content='0;url=progress.php'>";
        }
    }
