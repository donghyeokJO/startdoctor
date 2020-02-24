<?php
    session_start();
    // $u_email = $_COOKIE['u_email_cookie'];
    // $u_pw = $_COOKIE['u_pw_cookie'];
    setcookie('u_email_cookie', '', time() - 3600 * 24 * 10, '/', 'startdoctor.net');
    setcookie('u_pw_cookie', '', time() - 3600 * 24 * 10, '/', 'startdoctor.net');
    $res = session_destroy();

    if ($res) {
        echo '<script>location.href="../main/index.php"</script>';
    }
