<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_GET['u_id'];
    $query = "select * from user where u_id = '$u_id'";
    $tmp = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($tmp);
    $u_email = $user['u_email'];
    $u_phone = $user['u_phone'];
    $query = "delete from user where u_id ='$u_id'";
    mysqli_query($conn, $query);

    $query = "insert into rejected_user(u_email) values('$u_email')";
    $ret = mysqli_query($conn, $query);

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

안녕하세요. 스타트닥터를 이용해 주셔서 감사합니다. 

회원가입시 회원정보가 정확하지 않아 회원인증이 반려되었습니다. 

정확히 등록해주시면 빠르게 인증 처리해드리겠습니다. 

감사합니다.';
        $u_phone = $user['u_phone'];
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10016'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);
        echo "<meta http-equiv='refresh' content='0;url=user.php'>";
    }
