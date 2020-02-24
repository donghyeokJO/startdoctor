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

    $u_specify = '미인증';
    if (!preg_match('/^[0-9A-Za-z]{6,13}$/', $u_pw) || !preg_match('/\d/', $u_pw) || !preg_match('/[a-zA-Z]/', $u_pw)) {
        msg('비밀번호는 알파벳 대소문자, 숫자 조합으로 6자이상 13자 이하만 가능합니다.');
    }
    $u_pw = password_hash($u_pw, PASSWORD_DEFAULT);

    $query = "insert into user(u_type,u_name,u_pw,u_email,u_phone,u_post,u_address,u_det,u_able,u_specify) values('$u_type','$u_name','$u_pw','$u_email','$u_phone','$u_post','$u_address','$u_det','$u_able','$u_specify')";

    $ret = mysqli_query($conn, $query);
    if (!$ret) {
        mysqli_query($conn, 'rollback');
        echo mysqli_error($conn);
        msg('잘못된 요청 입니다.');
    } else {
        mysqli_query($conn, 'commit');
        s_msg('성공적으로 회원가입 되었습니다');
        echo "<meta http-equiv='refresh' content='0;url=corp.php'>";
    }
