<?php
    header('Content-Type:application/json');

    function get_keywords($u_id)
    {
        include 'config.php';
        include 'util.php';
        $conn = dbconnect($host, $dbid, $dbpass, $dbname);
        $query = "select * from user natural join corp_info where user.u_id = corp_info.corp_id and u_id = '$u_id' ";
        if ($result = mysqli_query($conn, $query, MYSQLI_USE_RESULT)) {
            $row = mysqli_fetch_array($result);
            $temparr = [];

            $t = [];
            $t['name'] = $row['u_name'];
            $t['phone'] = $row['u_phone'];
            if ($row['u_type'] == 1) {
                $t['type'] = '인테리어';
            } elseif ($row['u_type'] == 2) {
                $t['type'] = '마케팅';
            } elseif ($row['u_type'] == 3) {
                $t['type'] = '홈페이지';
            } elseif ($row['u_type'] == 4) {
                $t['type'] = '자금대출';
            } elseif ($row['u_type'] == 5) {
                $t['type'] = '의료장비';
            } elseif ($row['u_type'] == 6) {
                $t['type'] = '의료소모품 , 세무사 및 기타';
            }

            $t['desc'] = $row['corp_desc'];
            $t['logo'] = $row['logo'];
            $t['det'] = $row['det'];
            array_push($temparr, $t);

            unset($t);
        }
        echo json_encode($temparr);
    }

    get_keywords($_POST['uid']);
