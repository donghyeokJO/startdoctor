<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $f_title = $_POST['f_title'];
    $f_content = $_POST['f_content'];

    $query = "insert into faq(f_title,f_content,f_date) values('$f_title','$f_content',NOW())";
    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        alert_msg('Query Error : ' . mysqli_error($conn));
    } else {
        s_msg('성공적으로 입력 되었습니다');
        echo "<meta http-equiv='refresh' content='0;url=faq.php'>";
    }
