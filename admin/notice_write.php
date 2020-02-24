<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $n_title = $_POST['n_title'];
    $n_content = $_POST['n_content'];

    $query = "insert into notice(n_title,n_content,n_date) values('$n_title','$n_content',NOW())";
    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        alert_msg('Query Error : ' . mysqli_error($conn));
    } else {
        s_msg('성공적으로 입력 되었습니다');
        echo "<meta http-equiv='refresh' content='0;url=notice.php'>";
    }
