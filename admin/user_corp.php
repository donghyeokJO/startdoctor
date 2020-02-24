<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_GET['u_id'];

    $query = "update user set u_specify = '업체' where u_id ='$u_id'";

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
        $msg = '스타트닥터 업체 인증을 축하드립니다. 

#{업체명}님, 
스타트닥터에 오신 것을 환영합니다.

확실한 타겟팅이 성공적인 홍보의 비결입니다.
지금 바로 로그인 후 회원정보 작성하시고 서비스이용해보세요!';
        $msg = str_replace('#{업체명}', $u_name, $msg);
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10004'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);
        echo "<meta http-equiv='refresh' content='0;url=../PHPMailer/welcome_granted_corp.php?u_email=$u_email'>";
    }
