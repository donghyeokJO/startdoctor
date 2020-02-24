<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/main/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/main/util.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/mailer.lib.php';
    // include '../PHPMailer/mailer.lib.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_POST['u_id'];
    $f1_address = $_POST['f1_address'];
    $f1_det = $_POST['f1_det'];
    $f1_budget = $_POST['f1_budget'];
    $f1_concept = $_POST['f1_budget'];
    $f1_date = $_POST['f1_date'];
    $f1_extra = $_POST['f1_extra'];

    $query = "insert into form1(u_id,f1_address,f1_det,f1_budget,f1_concept,f1_date,f1_extra,date) values ('$u_id','$f1_address','$f1_det','$f1_budget','$f1_concept','$f1_date','$f1_extra',NOW())";

    $ret = mysqli_query($conn, $query);
    $fid = mysqli_insert_id($conn);
    $query = "insert into usr_form(fid,u_id,type) values('$fid','$u_id','인테리어')";
    mysqli_query($conn, $query);
    $query = "select * from user where u_id='$u_id'";
    $usr = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($usr);
    $u_name = $user['u_name'];
    $u_phone = $user['u_phone'];
    $content = '주소 : #{주소}
공사면적 : #{상세주소}
예산 : #{예산}
컨셉 : #{컨셉}
시공예정일 : #{예정}
희망사항 : #{희망}';
    $content = str_replace('#{주소}', $f1_address, $content);
    $content = str_replace('#{상세주소}', $f1_det, $content);
    $content = str_replace('#{예산}', $f1_budget, $content);
    $content = str_replace('#{컨셉}', $f1_concept, $content);
    $content = str_replace('#{예정}', $f1_date, $content);
    $content = str_replace('#{희망}', $f1_extra, $content);
    if (!$ret) {
        echo mysqli_error($conn);
        msg('잘못된 요청 입니다.');
    } else {
        s_msg('접수 되었습니다');
        $ch = curl_init();
        $url = 'https://talkapi.lgcns.com/request/kakao.json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json,charset=utf-8', 'authToken : iWW8oHIOKqveeP2XnzDmtg==', 'serverName:startdoctor', 'paymentType:P']);
        $msg = 'NO.1  병원상권분석 마케팅 기업 스타트닥터입니다. 

#{고객명}님, 
비교견적(#{카테고리})을 접수해주셔서 감사합니다. 

스타트닥터가 직접 선정한 업체들이 견적서를 검토하고 있으니. 처리되는 대로 바로 안내드리도록 하겠습니다.

감사합니다. 

[접수 내용]
#{내용}';
        $msg = str_replace('#{고객명}', $u_name, $msg);
        $msg = str_replace('#{카테고리}', '인테리어', $msg);
        $msg = str_replace('#{내용}', $content, $msg);
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10005'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);
        mailer('스타트닥터 관리자', 'austin@startdoctor.net', 'support@eszett.co.kr', '비교견적 - 인테리어 접수', '비교 견적 - 인테리어 접수 되었습니다. 확인해주세요.', 1);
        echo "<meta http-equiv='refresh' content='0;url=../../mypage/estimate.php'>";
    }
