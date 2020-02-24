<?php
    include 'config.php';
    include 'util.php';
    header('Content-Type:text/html;charset=utf-8');

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $writer = $_POST['writer'];
    $b_title = $_POST['b_title'];
    $u_id = $_POST['u_id'];
    $b_content = $_POST['b_content'];
    $w_pw = $_POST['w_pw'];
    $b_id = $_POST['b_id'];

    mysqli_query($conn, 'set autocommit = 0');
    mysqli_query($conn, 'set transation isolation level serializable');
    mysqli_query($conn, 'begin');

    $query = "update board set b_title='$b_title',writer='$writer',u_id='$u_id',b_content='$b_content',w_pw='$w_pw' where b_id='$b_id' ";
    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        mysqli_query($conn, 'rollback');
        alert_msg('Query Error : ' . mysqli_error($conn));
    } else {
        mysqli_query($conn, 'commit');
        s_msg('성공적으로 입력 되었습니다');
        echo("<script>location.replace('./board_view.php?b_id=$b_id');</script>");
    }
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">