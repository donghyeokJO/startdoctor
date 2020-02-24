<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_pw = $_POST['u_pw'];
    $u_pwc = $_POST['u_pwc'];
    $u_email = $_POST['u_email'];
    $u_phone = $_POST['u_phone'];
    $u_name = $_POST['u_name'];
    $u_type = $_POST['u_type'];
    $u_post = $_POST['u_post'];
    $u_address = $_POST['u_address'];
    $u_det = $_POST['u_det'];
    $u_able = $_POST['u_able'];

    mysqli_query($conn, 'set autocommit = 0');
    mysqli_query($conn, 'set transation isolation level serializable');
    mysqli_query($conn, 'begin');
    $token = explode(',', $u_able);
    $cnt = count($token);
    $str = '';
    for ($i = 0;$i < $cnt;$i++) {
        $id = (int)$token[$i];
        $query = "select * from sidos where sidos_id = '$id'";
        $ret = mysqli_query($conn, $query);
        $sido = mysqli_fetch_assoc($ret);
        $text = $sido['juso'];
        if ($i == $cnt - 1) {
            $str = $str . $text;
        } else {
            $str = $str . $text . ',';
        }
    }
    $u_able = $str;
    if ($u_pw != $u_pwc) {
        msg('비밀번호와 비밀번호 확인이 서로 다릅니다.');
    }

    $u_specify = '미인증';
    if (!preg_match('/^[0-9A-Za-z]{6,13}$/', $u_pw) || !preg_match('/\d/', $u_pw) || !preg_match('/[a-zA-Z]/', $u_pw)) {
        msg('비밀번호는 알파벳 대소문자, 숫자 조합으로 6자이상 13자 이하만 가능합니다.');
    }
    $u_pw = password_hash($u_pw, PASSWORD_DEFAULT);

    $query = "insert into user(u_type,u_name,u_pw,u_email,u_phone,u_post,u_address,u_det,u_able,u_specify,regi_date) values('$u_type','$u_name','$u_pw','$u_email','$u_phone','$u_post','$u_address','$u_det','$u_able','$u_specify',NOW())";

    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        mysqli_query($conn, 'rollback');
        echo mysqli_error($conn);
        msg('잘못된 요청 입니다.');
    } else {
        mysqli_query($conn, 'commit');
        s_msg('성공적으로 회원가입 되었습니다');
        $ch = curl_init();
        $url = 'https://talkapi.lgcns.com/request/kakao.json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json,charset=utf-8', 'authToken : iWW8oHIOKqveeP2XnzDmtg==', 'serverName:startdoctor', 'paymentType:P']);
        $msg = '안녕하세요, #{업체명}님. 스타트닥터에 회원가입 해주셔서 진심으로 감사드립니다. 

빠른 시일 내에 처리 후 다시 안내드리도록 하겠습니다. 

감사합니다. ';
        $msg = str_replace('#{업체명}', $u_name, $msg);
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10002'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);
        echo "<meta http-equiv='refresh' content='0;url=http://startdoctor.net'>";
    }
