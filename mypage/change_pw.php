<?php
    include 'config.php';
    include 'util.php';
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    session_start();
    $u_email = $_SESSION['u_email'];
    $query = "select * from user where u_email='$u_email'";
    $temp = mysqli_query($conn, $query);
    $user = mysqli_fetch_array($temp);
    $u_id = $user['u_id'];
    $cur_pw = $_POST['cur_pw'];
    $new_pw = $_POST['new_pw'];
    $new_pwc = $_POST['new_pwc'];
    if (!password_verify($cur_pw, $user['u_pw'])) {
        msg('현재 비밀번호가 일치하지 않습니다.');
    } else {
        if ($cur_pw == $new_pw) {
            msg('현재 비밀번호와 새로운 비밀번호가 일치합니다.');
        } else {
            if ($new_pw != $new_pwc) {
                msg('새로운 비밀번호화 비밀번호 확인이 일치하지 않습니다.');
            } else {
                if (!preg_match('/^[0-9A-Za-z]{6,13}$/', $new_pw) || !preg_match('/\d/', $new_pw) || !preg_match('/[a-zA-Z]/', $new_pw)) {
                    msg('비밀번호는 알파벳 대소문자, 숫자 조합으로 6자이상 13자 이하만 가능합니다.');
                } else {
                    $u_pw = password_hash($new_pw, PASSWORD_DEFAULT);
                }
            }
        }
    }

    $query = "update user set u_pw = '$u_pw' where u_id ='$u_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        msg('변경되었습니다.');
        echo '<script>location.href="profile.php"</script>';
    } else {
        msg('잘못된 요청입니다. ');
    }
