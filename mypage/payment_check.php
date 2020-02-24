<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_id = $_GET['u_id'];
    $amount = $_GET['amount'];

    $query = "select * from user where u_id='$u_id'";
    $ret = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($ret);
    $point = $user['u_count'];
    $point = $point + $amount;
    $u_name = $user['u_name'];

    $query = "update user set u_count='$point' where u_id='$u_id'";
    $price;
    if ($amount = 1) {
        $price = '79,000원';
    } elseif ($amount = 3) {
        $price = '198,000원';
    } else {
        $price = '298,000원';
    }
    $res = mysqli_query($conn, $query);
    $date = date('Y-m-d H:i:s', time());
    $content = '스타트 닥터 ' . $amount . '회 이용권';
    $query = "insert into payment(u_id, date, number,content,price) values('$u_id','$date','$amount','$content','$price')";
    mysqli_query($conn, $query);
    function add_months($months, DateTime $dateObject)
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +' . $months . ' month');

        if ($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P' . $months . 'M');
        }
    }

    function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add(add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D'));

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d');

        return $dateReturned;
    }
    $dateString = date('Y-m-d', time());
    $enddate = endCycle($dateString, 1);
    if (!$res) {
        msg('시간 만료로 세션이 종료되었습니다. 고객센테에 문의해주세요');
    } else {
        $ch = curl_init();
        $url = 'https://talkapi.lgcns.com/request/kakao.json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json,charset=utf-8', 'authToken : iWW8oHIOKqveeP2XnzDmtg==', 'serverName:startdoctor', 'paymentType:P']);
        $msg = 'NO.1  병원상권분석 마케팅 기업 스타트닥터입니다. 

#{고객명}님, 스타트닥터 상권분석시스템 이용권을 구매해주셔서 감사합니다. 

[구매내역]
상품명 : #{상품명}
결제 금액 : #{금액}
이용가능기간 : #{결제일} ~ #{한달후}

#이용기간 내에 이용하지 않으실 경우 이용권은 자동으로 소멸됩니다. 

스타트닥터는 병원의 성공을 위해 뜁니다. 

국내 최초 병원특화 상권분석을 통해 개원성공확률을 높여보세요.  

감사합니다.';

        $mer = '스타트닥터 상권분석 1회권';
        $mon = $price;
        $u_phone = $user['u_phone'];
        $msg = str_replace('#{고객명}', $u_name, $msg);
        $msg = str_replace('#{상품명}', $mer, $msg);
        $msg = str_replace('#{금액}', $mon, $msg);
        $msg = str_replace('#{결제일}', $dateString, $msg);
        $msg = str_replace('#{한달후}', $enddate, $msg);
        $data = ['service' => 2010038795, 'message' => $msg, 'mobile' => $u_phone, 'template' => '10015'];
        $data = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        echo "<script>console.log($res)</script>";
        curl_close($ch);

        echo("<script>location.replace('pay.php');</script>");
    }
