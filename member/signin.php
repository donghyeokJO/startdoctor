<?php
    include 'config.php';
    include 'util.php';
    session_start();
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $user = mysqli_query($conn, 'select * from user');

    $u_email = $_POST['u_email'];
    $u_pw = $_POST['u_pw'];
    $admin = '관리자';

    $query = "select * from user where u_email = '$u_email'";
    $ans = mysqli_query($conn, $query);

    if ($ans->num_rows == 1) {
        $row = $ans->fetch_array(MYSQLI_ASSOC);
        if (password_verify($u_pw, $row['u_pw'])) {
            $_SESSION['u_email'] = $u_email;
            if ($row['u_specify'] == $admin) {
                echo "<meta http-equiv='refresh' content='0;url=../admin/index.php'>";
            } else {
                if (isset($_SESSION['u_email'])) {
                    if (isset($_POST['auto_login'])) {
                        $pass = $u_pw;
                        $key = 'medi180615';

                        $hash = Encrypt($pass, $secret_key, $secret_iv);
                        echo "<script>location.href='set_cookie.php?u_email=$u_email&hash=$hash';</script>";
                    } elseif ($row['u_specify'] == '미인증') {
                        msg('가입 승인 대기 상태입니다.확인 후 빠른 시일 내에 처리해드리도록 하겠습니다.');
                    } elseif ($row['u_specify'] == '의사') {
                        echo "<meta http-equiv='refresh' content='0;url=../main/index.php'>";
                    } else {
                        echo "<meta http-equiv='refresh' content='0;url=../mypage/business.php'>";
                    }
                }
            }
        } else {
            msg('비밀번호가 잘못 되었습니다.');
        }
    } else {
        msg('가입되지 않은 이메일입니다. 다시 확인해주세요');
    }
