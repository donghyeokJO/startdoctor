<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $type = $_POST['type'];
    $fid = $_POST['fid'];
    $content = $_POST['content'];
    $base = './form_answers/';
    $file_name = $_POST['filename'];
    $corp_id = $_POST['corp_id'];

    $answer;
    if ($type == 1) {
        $answer = 'f1_answer';
    } elseif ($type == 2) {
        $answer = 'f2_answer';
    } elseif ($type == 3) {
        $answer = 'f3_answer';
    } elseif ($type == 4) {
        $answer = 'f4_answer';
    } elseif ($type == 5) {
        $answer = 'f5_answer';
    } else {
        $answer = 'f6_answer';
    }
    if ($_FILES['file']['error'] == 4) {
        msg('견적서를 첨부하여 주세요');
    }

    $upname = time() . $file_name;
    $upload = $base . $upname;
    //echo "$upload<br>";
    move_uploaded_file($_FILES['file']['tmp_name'], $upload);

    $query = "insert into $answer(fid,content,file,corp_id,date2) values('$fid','$content','$upname','$corp_id',NOW())";
    $ret = mysqli_query($conn, $query);
    if ($ret) {
        s_msg('입력 되었습니다. ');
        echo '<script>location.href="business.php"</script>';
    } else {
        msg('잘못된 요청입니다. 반복될 경우 고객센터에 문의하여 주세요');
    }
