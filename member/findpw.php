<?php
    include 'config.php';
    include 'util.php';
    function GenerateString($length)
    {
        $characters = '0123456789';
        $characters .= 'abcdefghijklmnopqrstuvwxyz';

        $string_generated = '';

        $nmr_loops = $length;
        while ($nmr_loops--) {
            $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string_generated;
    }

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $u_email = $_POST['u_email'];
    $u_license = $_POST['u_license'];
    // echo $u_email;
    // echo $u_license;
    $query = "select * from user where u_email = '$u_email' and u_license = '$u_license'";
    $ret = mysqli_query($conn, $query);
    $msg = '';
    if (!$ret || mysqli_num_rows($ret) == 0) {
        $msg = '일치하는 회원정보가 없습니다. 다시 확인해주세요.';
        msg($msg);
    } else {
        $temp_pw = GenerateString(8);
        $change_pw = password_hash($temp_pw, PASSWORD_DEFAULT);
        $query = "update user set u_pw = '$change_pw' where u_email = '$u_email'";
        $res = mysqli_query($conn, $query);
        $msg = '이메일로 임시 비밀번호가 발송되었습니다. 임시 비밀번호로 로그인 하신후 비밀번호를 변경해주세요.';
        if ($res) {
            s_msg($msg);
            echo "<script>location.href='../PHPMailer/pwchange.php?u_email=$u_email&pw=$temp_pw'</script>";
        } else {
            msg('데이터베이스 오류입니다. 다시 시도해주세요.');
        }
    }
