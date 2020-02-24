<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $corp_id = $_POST['corp_id'];
    $id = $_POST['id'];
    $content = $_POST['content'];

    $query = "insert into re_counsel(corp_id,id,content,date) values('$corp_id','$id','$content',NOW())";
    $ret = mysqli_query($conn, $query);

    if (!$ret) {
        msg('잘못된 요청입니다.');
    } else {
        echo '<script>location.href="business.php"</script>';
    }
