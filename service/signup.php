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

    mysqli_query($conn, 'set autocommit = 0');
    mysqli_query($conn, 'set transation isolation level serializable');
    mysqli_query($conn, 'begin');

    if ($u_pw != $u_pwc) {
        msg('비밀번호와 비밀번호 확인이 서로 다릅니다.');
    }

    $u_specify = '의사';

    $u_birth = $year . '-' . $month . '-' . $day;

    $query = "insert into user(u_pw,u_email,u_phone,u_name,u_license,u_birth,u_specify) values('$u_pw','$u_email','$u_phone','$u_name','$u_license','$u_birth','$u_specify')";

    $ret = mysqli_query($conn, $query);

    if (!$ret) {
        mysqli_query($conn, 'rollback');
        echo mysqli_error($conn);
        msg('잘못된 요청 입니다.');
    } else {
        mysqli_query($conn, 'commit');
        s_msg('성공적으로 회원가입 되었습니다');
        echo
        '
         <script language="javascript" type="text/javascript">
             setTimeout(function() {
             opener.location.reload(); 
             self.close(); 
             }, 1000); 
         </script>
        ';
    }
