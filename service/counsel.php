<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/main/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/main/util.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/mailer.lib.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_POST['u_id'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    // echo "$title | $type";
    $query = "insert into counsel(u_id,type,title,content,date) values('$u_id','$type','$title','$content',NOW())";
    $ret = mysqli_query($conn, $query);

    $query = "select * from user where u_id='$u_id'";
    $usr = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($usr);
    $u_name = $user['u_name'];
    $u_phone = $user['u_phone'];

    $content2 = '
질문 : #{자격}
내용 : #{희망}';

    $content2 = str_replace('#{재직}', $type, $content2);
    $content2 = str_replace('#{자격}', $title, $content2);
    // $content = str_replace('#{시기}', $f4_date, $content);
    $content2 = str_replace('#{희망}', $content, $content2);
    if ($ret) {
        s_msg('성공적으로 접수되었습니다.');
        $ch = curl_init();
        $url = 'https://talkapi.lgcns.com/request/kakao.json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json,charset=utf-8', 'authToken : iWW8oHIOKqveeP2XnzDmtg==', 'serverName:startdoctor', 'paymentType:P']);
        $msg = 'NO.1  병원상권분석 마케팅 기업 스타트닥터입니다. 

#{고객명}님, 
상담글(#{분야})을 접수해주셔서 감사합니다. 

스타트닥터가 직접 선정한 업체들이 상담글을 검토하고 있으니. 답변이 작성되는 대로 대로 바로 안내드리도록 하겠습니다.

감사합니다. 

[접수 내용]
#{내용}';
        $msg = str_replace('#{고객명}', $u_name, $msg);
        $msg = str_replace('#{분야}', $type, $msg);
        $msg = str_replace('#{내용}', $content2, $msg);
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10007'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);
        mailer('스타트닥터 관리자', 'austin@startdoctor.net', 'support@eszett.co.kr', '상담채팅 접수 -' . $type, '상담 채팅 접수 되었습니다. 확인해주세요.', 1);
        echo '<script>location.href="../mypage/chat.php"</script>';
    } else {
        msg('접수되지 않았습니다. 오류가 반복적으로 발생할 경우 고객센터에 직접 연락해주세요');
    }
