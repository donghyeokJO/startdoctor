<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $n_title = $_POST['n_title'];
    $n_content = $_POST['n_content'];
    $n_no = $_POST['n_no'];

    $query = "update notice set n_title='$n_title', n_content='$n_content' where n_no='$n_no'";
    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        alert_msg('Query Error : ' . mysqli_error($conn));
    } else {
        s_msg('성공적으로 수정 되었습니다');
        echo("<script>location.replace('notice_detail.php?n_no=$n_no');</script>");
    }
