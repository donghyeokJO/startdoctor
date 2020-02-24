<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_pw = $_POST['u_pw'];
    $u_pwc = $_POST['u_pwc'];
    $u_email = $_POST['u_email'];
    $u_phone = $_POST['u_phone'];
    $u_name = $_POST['u_name'];
    $u_license = $_POST['u_license'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $doctype = $_POST['doctype'];
    $dateString = date('Y-m-d', time());
    // echo $year;

    mysqli_query($conn, 'set autocommit = 0');
    mysqli_query($conn, 'set transation isolation level serializable');
    mysqli_query($conn, 'begin');
    if ($u_pw == '' || $u_email == '' || $u_phone == '' || $u_name == '' || $u_license == '' || $year == '년' || $month == '월' || $day == '일') {
        msg('모든 항목을 입력해주세요');
    }
    if ($u_pw != $u_pwc) {
        msg('비밀번호와 비밀번호 확인이 서로 다릅니다.');
    }

    $u_specify = '미인증';

    $u_birth = $year . '-' . $month . '-' . $day;
    if (!preg_match('/^[0-9A-Za-z]{6,13}$/', $u_pw) || !preg_match('/\d/', $u_pw) || !preg_match('/[a-zA-Z]/', $u_pw)) {
        msg('비밀번호는 알파벳 대소문자, 숫자 조합으로 6자이상 13자 이하만 가능합니다.');
    }
    $u_pw = password_hash($u_pw, PASSWORD_DEFAULT);

    $query = "insert into user(u_pw,u_email,u_phone,u_name,u_license,u_birth,u_specify,regi_date,u_rank) values('$u_pw','$u_email','$u_phone','$u_name','$u_license','$u_birth','$u_specify',NOW(),'$doctype')";

    $ret = mysqli_query($conn, $query);

    $u_id = mysqli_insert_id($conn);
    $query = "insert into checklist(u_id) values('$u_id')";

    mysqli_query($conn, $query);
    if (!$ret) {
        mysqli_query($conn, 'rollback');
        // echo 'a';
        echo mysqli_error($conn);
    // msg('잘못된 요청 입니다.');
    } else {
        mysqli_query($conn, 'commit');
        s_msg('성공적으로 회원가입 되었습니다');

        $ch = curl_init();
        $url = 'https://talkapi.lgcns.com/request/kakao.json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json,charset=utf-8', 'authToken : iWW8oHIOKqveeP2XnzDmtg==', 'serverName:startdoctor', 'paymentType:P']);
        $msg = 'NO.1  병원상권분석 마케팅 기업 스타트닥터입니다. 

안녕하세요, #{고객명}님! 스타트닥터에 회원가입 해주셔서 진심으로 감사드리며, 정상적으로 접수되었습니다.

인증 과정을 거쳐 5거래일 이내로 승인됩니다. 승인완료 후 빠르게 안내드리도록 하겠습니다.  

감사합니다. ';
        $msg = str_replace('#{고객명}', $u_name, $msg);
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10014'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);
        echo "<script>location.href='../PHPMailer/plzcheck.php'</script>";
    }
