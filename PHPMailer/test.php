<?php
include_once 'mailer.lib.php';

// mailer("보내는 사람 이름", "보내는 사람 메일주소", "받는 사람 메일주소", "제목", "내용", "1");
mailer('Austin', 'austin@startdoctor.net', 'jodo0811@naver.com', '회원가입접수', '회원가입이 접수되었습니다. 확인해보세요', 1);
