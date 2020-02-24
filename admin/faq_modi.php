<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $f_title = $_POST['f_title'];
    $f_content = $_POST['f_content'];
    $f_no = $_POST['f_no'];

    $query = "update faq set f_title='$f_title', f_content='$f_content' where f_no='$f_no'";
    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        alert_msg('Query Error : ' . mysqli_error($conn));
    } else {
        s_msg('성공적으로 수정 되었습니다');
        echo("<script>location.replace('faq_detail.php?f_no=$f_no');</script>");
    }
