<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/main/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/main/util.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/mailer.lib.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $type = $_POST['type'];
    $content = $_POST['content'];
    $u_id = $_POST['u_id'];
    $date = date('Y-m-d H:i:s', time());
    $query = "insert into ask(a_type,a_content,a_time,u_id) values ('$type','$content','$date','$u_id')";
    if (mysqli_query($conn, $query)) {
        echo '<script>window.alert("소중한 의견 감사드립니다.")</script>';
        mailer('스타트닥터 관리자', 'austin@startdoctor.net', 'support@eszett.co.kr', '문의사항 접수', '문의사항 접수 되었습니다. 확인해주세요.', 1);
        echo "<script>window.location.href='../main/index.php';</script>";
    } else {
        echo mysqli_error($conn);
    }
