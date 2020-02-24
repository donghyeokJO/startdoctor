<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_GET['u_id'];

    $query = "update user set u_specify = '의사' where u_id ='$u_id'";

    $ret = mysqli_query($conn, $query);
    $query = "select * from user where u_id ='$u_id'";
    $asd = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($asd);
    $u_email = $user['u_email'];
    $u_name = $user['u_name'];
    $u_phone = $user['u_phone'];
    if (!$ret) {
        echo mysqli_error($conn);
        msg('잘못된 요청 입니다.');
    } else {
        s_msg('성공적으로 처리 되었습니다');
        $ch = curl_init();
        $url = 'https://talkapi.lgcns.com/request/kakao.json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json,charset=utf-8', 'authToken : iWW8oHIOKqveeP2XnzDmtg==', 'serverName:startdoctor', 'paymentType:P']);
        $msg = 'NO.1  병원상권분석 마케팅 기업 스타트닥터입니다. 

안녕하세요, #{고객명}님! 의사 인증이 승인 되었습니다. 

병원 개원 원스톱 솔루션으로써 저희는 개원을 쉽고 빠르게 할 수 있도록 도와드리고있습니다.
개원을 가장 잘 할 수 있는 사람은 이미 개원을 해본 의사분들입니다.
빅데이터를 통한 병원상권분석과 비교견적, 그리고 개원의사가 전하는 개원 시크릿팁을 놓치지 마세요!

의사가 만든, 의사를 위한 스타트닥터에서 성공적으로 개원하세요!
';
        $msg = str_replace('#{고객명}', $u_name, $msg);
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10013'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);
        echo "<meta http-equiv='refresh' content='0;url=../PHPMailer/welcome_granted.php?u_email=$u_email'>";
    }
