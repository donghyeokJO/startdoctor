<?php
include_once 'mailer.lib.php';

// mailer("보내는 사람 이름", "보내는 사람 메일주소", "받는 사람 메일주소", "제목", "내용", "1");
mailer('스타트닥터', 'austin@startdoctor.net', 'support@eszett.co.kr', '회원가입접수', '회원가입이 접수되었습니다. 확인해보세요', 1);

echo "<script>location.replace('../main/index.php')</script>";
