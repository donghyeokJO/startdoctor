<?php
    header('Content-Type:application/json');

    function get_email($u_license)
    {
        include 'config.php';
        include 'util.php';
        $conn = dbconnect($host, $dbid, $dbpass, $dbname);
        $query = "select * from user where u_license = '$u_license'";

        if ($result = mysqli_query($conn, $query)) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $temp_arr['email'] = $row['u_email'] . '로 확인됩니다.';
            } else {
                $temp_arr['email'] = '해당 의사 면허번호로 회원가입된 이메일이 조회되지 않습니다.';
            }
        } else {
            $temp_arr['email'] = '해당 의사 면허번호로 회원가입된 이메일이 조회되지 않습니다.';
        }
        echo json_encode($temp_arr);
    }

    get_email($_POST['license']);
