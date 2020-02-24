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
            }
        } else {
            msg('비밀번호가 잘못 되었습니다.');
        }
    } else {
        msg('가입되지 않은 이메일입니다. 다시 확인해주세요');
    }
