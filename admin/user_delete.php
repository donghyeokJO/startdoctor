<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_GET['u_id'];
    $query = "select * from user where u_id = '$u_id'";
    $tmp = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($tmp);
    $u_email = $user['u_email'];

    $query = "delete from user where u_id ='$u_id'";
    mysqli_query($conn, $query);

    $query = "insert into deleted_user(u_email) values('$u_email')";
    $ret = mysqli_query($conn, $query);

    if (!$ret) {
        echo mysqli_error($conn);
        msg('잘못된 요청 입니다.');
    } else {
        s_msg('성공적으로 처리 되었습니다');
        echo "<meta http-equiv='refresh' content='0;url=user.php'>";
    }
