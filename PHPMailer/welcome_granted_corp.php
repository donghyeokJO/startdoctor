<?php
include_once 'mailer.lib_admin.php';
include 'config.php';
include 'util.php';

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mail = $_GET['u_email'];
$query = "select * from user where u_email = '$mail'";
$ret = mysqli_query($conn, $query);
$u_name = mysqli_fetch_array($ret)['u_name'];

// mailer("보내는 사람 이름", "보내는 사람 메일주소", "받는 사람 메일주소", "제목", "내용", "1");
$content = '<!DOCTYPE html><html><head><meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"><meta charset="UTF-8"><style>
@media only screen and (max-width:640px){
	.stb-left-cell,
	.stb-right-cell {max-width:100%!important;width:100%!important;}
	.stb-left-cell img,
	.stb-right-cell img {width: 100%;height: auto;}
	.stb-left-cell > div {padding: 5px 10px!important;box-sizing: border-box;}
	.stb-right-cell > div {padding: 5px 10px!important;box-sizing: border-box;}
	.stb-cell-wrap {padding:0 0 0 0!important;}
	.stb-cell-wrap > tr > td {padding:0 0!important;}
	.stb-cell-wrap > tbody > tr > td {padding:0 0!important;}
	.stb-cell-wrap > tbody > tr > td.stb-text-box {padding:0 10px!important;}
	.stb-left-cell > div.stb-text-box {padding:5px 10px!important;}
  .stb-right-cell > div.stb-text-box {padding:5px 10px!important;}
	.stb-container {width: 100%!important}
	.stb-container * {line-height: 1.8!important;}
	.stb-container a {text-decoration: underline;}
	.stb-cta-only-wrap {padding: 10px 0!important;}
}
</style></head><body><table class="stb-container" cellpadding="0" cellspacing="0" align="center" style="margin: 0px auto; width: 94%; max-width: 640px; background: rgb(255, 255, 255); border: 0px;"><tbody><tr style="margin: 0;padding:0;"><td style="width: 100%; max-width: 630px; margin: 0 auto; position: relative; border-spacing: 0; clear: both; border-collapse: separate;padding:0;overflow:hidden;_width:620px;"><div style="height: 0px; max-height: 0px; border-width: 0px; border-color: initial; border-image: initial; visibility: hidden; line-height: 0px; font-size: 0px; overflow: hidden;display:none;">
				스타트닥터에 오신 것을 환영합니다.
			</div><table class="stb-block" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px; width:100%;max-width: 630px; clear: both; background: none;border:0;" width="100%"><tbody><tr><td style="padding: 15px 0 15px 0; line-height: 1.8; border-width: 0px;font-size: 14px;"><table class="stb-cell-wrap" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 5px;" width="100%"><tbody><tr><td class="stb-text-box" style="padding: 0px 15px;mso-line-height-rule: exactly;line-height:1.8;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-size: 14px;font-family: AppleSDGothic, apple sd gothic neo, noto sans korean, noto sans korean regular, noto sans cjk kr, noto sans cjk, nanum gothic, malgun gothic, dotum, arial, helvetica, MS Gothic, sans-serif!important; color: #333333" width="100%"><div style="text-align: left;"><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; font-size: 26px;"><b>스타트닥터&nbsp;</b></span></div><div style="text-align: left;"><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; font-size: 26px;"><span style="font-weight: bold; color: rgb(58, 121, 227);">회원가입</span>을</span><b style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; font-size: 26px;">&nbsp;</b></div><div style="text-align: left;"><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; font-size: 26px;">축하드립니다!</span></div></td></tr></tbody></table></td></tr></tbody></table><table class="stb-block" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px; width:100%;max-width: 630px; clear: both; background: none;border:0;" width="100%"><tbody><tr><td style="padding: 15px 0 5px 0; line-height: 1.8; border-width: 0px;font-size: 14px;"><table class="stb-cell-wrap" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 5px;" width="100%"><tbody><tr><td class="stb-text-box" style="padding: 0px 15px;mso-line-height-rule: exactly;line-height:1.8;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-size: 14px;font-family: AppleSDGothic, apple sd gothic neo, noto sans korean, noto sans korean regular, noto sans cjk kr, noto sans cjk, nanum gothic, malgun gothic, dotum, arial, helvetica, MS Gothic, sans-serif!important; color: #333333" width="100%"><div style="text-align: left;"><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; text-decoration: underline;">개똥업체</span><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal;">님,&nbsp;</span></div><div style="text-align: left;"><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal;">스타트닥터에 오신 것을 환영합니다.</span></div></td></tr></tbody></table></td></tr></tbody></table><table class="stb-block" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px; width:100%;max-width: 630px; clear: both; background: none;border:0;" width="100%"><tbody><tr><td style="padding: 5px 0 20px 0; line-height: 1.8; border-width: 0px;font-size: 14px;"><table class="stb-cell-wrap" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 5px;" width="100%"><tbody><tr><td class="stb-text-box" style="padding: 0px 15px;mso-line-height-rule: exactly;line-height:1.8;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-size: 14px;font-family: AppleSDGothic, apple sd gothic neo, noto sans korean, noto sans korean regular, noto sans cjk kr, noto sans cjk, nanum gothic, malgun gothic, dotum, arial, helvetica, MS Gothic, sans-serif!important; color: #333333" width="100%"><div>확실한 타겟팅이 성공적인 홍보의 비결입니다.</div><div>지금 바로 로그인 후 회원정보 작성하시고 서비스이용해보세요!</div></td></tr></tbody></table></td></tr></tbody></table><table class="stb-block" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px; width:100%;max-width: 630px; clear: both; background: #ffffff;border:1px solid #999999;" width="100%"><tbody><tr><td style="padding: 15px 0 15px 0; line-height: 1.8; border-width: 0px;font-size: 14px;"><table class="stb-cell-wrap" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 5px;" width="100%"><tbody><tr><td class="stb-text-box" style="padding: 0px 15px;mso-line-height-rule: exactly;line-height:1.8;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-size: 14px;font-family: AppleSDGothic, apple sd gothic neo, noto sans korean, noto sans korean regular, noto sans cjk kr, noto sans cjk, nanum gothic, malgun gothic, dotum, arial, helvetica, MS Gothic, sans-serif!important; color: #333333" width="100%"><div style="text-align: left;"><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; font-weight: bold;">아이디</span><span style="color: rgb(51, 51, 51); font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal;">&nbsp; &nbsp; </span><span style="font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; font-weight: bold; color: rgb(0, 0, 255);">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;말똥업체이메일</span></div></td></tr></tbody></table></td></tr></tbody></table><table class="stb-block stb-cta-only" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px 10px; max-width: 630px; clear: both;background: none;border:0;" width="100%"><tbody><tr><td style="padding: 15px 0 5px 0; text-align: center; line-height: 1.8; border: 0px;" width="100%"><div class="stb-cta-only-wrap" style="padding: 10px 10px"><table class="stb-cell-wrap-cta" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: separate !important;background: #3A79E3;border-radius: 50px; border:0; mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0 auto;table-layout:fixed" align="center"><tbody><tr><td style="padding: 14px 20px 11px;" align="center"><a href="http://startdoctor.net" style="font-size: 16px; display: inline; color: rgb(255, 255, 255); background: rgb(58, 121, 227); border-radius: 50px; text-decoration: none; outline: 0px; font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; text-align: center;" target="_blank">
								스타트닥터 바로가기&nbsp; &gt;
							</a></td></tr></tbody></table></div></td></tr></tbody></table><table class="stb-block stb-cta-only" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px 10px; max-width: 630px; clear: both;background: none;border:0;" width="100%"><tbody><tr><td style="padding: 5px 0 15px 0; text-align: center; line-height: 1.8; border: 0px;" width="100%"><div class="stb-cta-only-wrap" style="padding: 10px 10px"><table class="stb-cell-wrap-cta" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: separate !important;background: #777777;border-radius: 50px; border:0; mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0 auto;table-layout:fixed" align="center"><tbody><tr><td style="padding: 14px 20px 11px;" align="center"><a href="http://startdoctor.net/startdoctor_guide.pdf" download style="font-size: 16px; display: inline; color: rgb(255, 255, 255); background: rgb(119, 119, 119); border-radius: 50px; text-decoration: none; outline: 0px; font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; text-align: center;" target="_blank">
								스타트닥터 사용법 보기 &gt;
							</a></td></tr></tbody></table></div></td></tr></tbody></table><table class="stb-block" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px; width:100%;max-width: 630px; clear: both; background: none;border:0;" width="100%"><tbody><tr><td style="padding: 15px 0 15px 0;line-height: 1.8; border-width: 0px;"><table class="stb-cell-wrap" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 0;" width="100%"><tbody><tr><td style="padding: 0 5;"><div style="height: 1px; background: none; padding: 0px; border-top-width:1px;border-top-style:dotted;border-top-color:#999;margin:0 10px"></div></td></tr></tbody></table></td></tr></tbody></table><table class="stb-block" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px; width:100%;max-width: 630px; clear: both; background: none;border:0;" width="100%"><tbody><tr><td style="padding: 15px 0 15px 0; line-height: 1.8; border-width: 0px;font-size: 14px;"><table class="stb-cell-wrap" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 5px;" width="100%"><tbody><tr><td class="stb-text-box" style="padding: 0px 15px;mso-line-height-rule: exactly;line-height:1.8;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-size: 14px;font-family: AppleSDGothic, apple sd gothic neo, noto sans korean, noto sans korean regular, noto sans cjk kr, noto sans cjk, nanum gothic, malgun gothic, dotum, arial, helvetica, MS Gothic, sans-serif!important; color: #333333" width="100%"><div style="text-align: center;"><span style="font-family: AppleSDGothic, &quot;apple sd gothic neo&quot;, &quot;noto sans korean&quot;, &quot;noto sans korean regular&quot;, &quot;noto sans cjk kr&quot;, &quot;noto sans cjk&quot;, &quot;nanum gothic&quot;, &quot;malgun gothic&quot;, dotum, arial, helvetica, MS Gothic, sans-serif; font-style: normal; font-size: 12px; color: rgb(0, 0, 0);">본 메일은 발신전용으로 회신되지 않습니다.</span></div></td></tr></tbody></table></td></tr></tbody></table><table class="stb-block" border="0" cellpadding="0" cellspacing="0" style="overflow: hidden; margin: 0px auto; padding: 0px; width:100%;max-width: 630px; clear: both; background: none;border:0;" width="100%"><tbody><tr><td style="padding: 15px 0 15px 0; border-width: 0px;"><table class="stb-cell-wrap" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 5px;" width="100%"><tbody><tr><td class="stb-text-box" width="100%" style="padding: 0px 10px;mso-line-height-rule: exactly;line-height:1.8;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-size: 12px;font-family: AppleSDGothic, apple sd gothic neo, noto sans korean, noto sans korean regular, noto sans cjk kr, noto sans cjk, nanum gothic, malgun gothic, dotum, arial, helvetica, MS Gothic, sans-serif!important;text-align: center; color: #606060"><span style="color: rgb(198, 193, 193);">스타트닥터<br>support@eszett.co.kr<br>서울 강남구 강남대로 364 미왕빌딩 1611호<br><a href="$%unsubscribe%$" style="text-decoration: underline; color: rgb(198, 193, 193); display: inline;" class=" link-edited" target="_blank">수신거부</a>&nbsp;<a href="$%unsubscribe%$" style="text-decoration: underline; color: rgb(198, 193, 193); display: inline;" class=" link-edited" target="_blank">Unsubscribe</a></span><b></b></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>';
$content = str_replace('개똥업체', $u_name, $content);
$content = str_replace('말똥업체이메일', $mail, $content);
$title = '스타트닥터에 오신 것을 환영합니다😊';
    mailer('스타트닥터', 'support@eszett.co.kr', $mail, $title, $content, 1);
    mailer('스타트닥터', 'support@eszett.co.kr', 'j_3827@daum.net', $title, $content, 1);

echo "<script>location.replace('../admin/corp.php')</script>";