<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_POST['u_id'];
    $u_pw = $_POST['u_pw'];
    $u_pw = password_hash($u_pw, PASSWORD_DEFAULT);
    $query = "update user set u_pw='$u_pw' where u_id = '$u_id'";

    if (mysqli_query($conn, $query)) {
        msg('변경 되었습니다.');
        echo "<script>location.replace='corp_detail.php?u_id=$u_id'</script>";
    } else {
        echo mysqli_error($conn);
    }
