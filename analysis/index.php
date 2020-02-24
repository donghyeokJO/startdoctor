<?php
    include 'config.php';
    include 'util.php';

    $u_email = $_POST['u_email'];
    session_start();
    $_SESSION['u_email'] = $u_email;

    $page_type = $_POST['page_type'];

    // "startdoctor"-> 홈페이지
    // "chat"->상담채팅
    // "compare"->비교견적
    // "semina"->세미나
    // "mypage"->마이페이지
    // "progress"->프로그뤠스
    if ($page_type == 'startdoctor') {
        echo '<script>location.href="../main/index.php"</script>';
    } elseif ($page_type == 'chat') {
        echo '<script>location.href="../service/chat.php"</script>';
    } elseif ($page_type == 'compare') {
        echo '<script>location.href="../service/estimate.php"</script>';
    } elseif ($page_type == 'semina') {
        echo '<script>location.href="../service/seminar.php"</script>';
    } elseif ($page_type == 'mypage') {
        echo '<script>location.href="../mypage/home.php"</script>';
    } elseif ($page_type == 'progress') {
        echo '<script>location.href="../mypage/progress.php"</script>';
    } elseif ($page_type == 'list') {
        echo '<script>location.href="../mypage/diagnose.php"</script>';
    } elseif ($page_type == 'opinion') {
        echo '<script>location.href="../company/opinion.php"</script>';
    } elseif ($page_type == 'notice') {
        echo '<script>location.href="../company/notice.php"</script>';
    } elseif ($page_type == 'faq') {
        echo '<script>location.href="../company/faq.php"</script>';
    } elseif ($page_type == 'pay') {
        echo '<script>location.href="../mypage/change_pay.php"</script>';
    } else {
        msg('잘못된 페이지 접근입니다.');
    }
