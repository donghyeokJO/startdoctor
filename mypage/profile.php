<?php
  include 'config.php';
  include 'util.php';
  session_start();
  if (!isset($_SESSION['u_email'])) {
      s_msg('로그인 해주세요');
      echo "<meta http-equiv='refresh' content='0;url=../member/signin.html'>";
  }
  $u_email = $_SESSION['u_email'];
  $conn = dbconnect($host, $dbid, $dbpass, $dbname);
  $user = mysqli_query($conn, "select * from user natural join checklist where u_email='$u_email'");
  $row = mysqli_fetch_assoc($user);
  $login = true;
  $u_name = $row['u_name'];
  $percentage = $row['percentage'];
  $u_id = $row['u_id'];
  $u_rank = $row['u_rank'];
  $date = date_format($row['u_birth'], 'Y/m/d');
  $year = date_format($row['u_birth'], 'y');
  $month = date_format($row['u_birth'], 'm');
  $day = date_format($row['u_birth'], 'd');
?>


<!DOCTYPE html>
<html>
  <head>
     <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-150475018-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-150475018-1');
  </script>
  <script type="text/javascript">
(function(w, d, a){
	w.__beusablerumclient__ = {
		load : function(src){
			var b = d.createElement("script");
			b.src = src; b.async=true; b.type = "text/javascript";
			d.getElementsByTagName("head")[0].appendChild(b);
		}
	};w.__beusablerumclient__.load(a);
})(window, document, '//rum.beusable.net/script/b190305e183506u693/504b7eefd4');
</script>
    <meta charset="utf-8">
    <title>스타트닥터</title>
    
    <meta name="author" content="스타트닥터">
    <meta name="description" content="스타트닥터">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:image" content="../assets/ogimage.png">
    <meta property="og:description" content="스타트닥터">
    <meta property="og:title" content="스타트닥터">
    <meta name="twitter:title" content="스타트닥터">

    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../lib/owlCarousel2/owl.carousel.min.css" />
    <link rel="stylesheet" href="../lib/owlCarousel2/owl.theme.default.min.css" />
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/member.css">

  </head>
  <body>
  <header>
      <div class="container position_relative">
        <div class="row align-items-center" style="height: 86px;">
          <div class="col-4">
            <svg class="cursor_pointer" onClick="hoverNavigation()" style="width:36px;height:36px;fill: #fff;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
          </div>
          <div class="col-4 text_align_center color_w font_weight_b font_size_l">
          <a href = "home.php" style ="color:#fff; text-decoration:none"> 마이페이지</a>
          </div>
          <div class="col-4 text_align_right">
            <div class="color_w">
              <svg onclick="hoverAlarm()" class="fill_w cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/></svg>
              <svg onclick="hoverMemberDesc()" class="fill_w margin_left_s cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
              <div onclick="hoverMemberDesc()" class="display_inline_block margin_left_s cursor_pointer tablet">
                <div class="display_inline_block"><?php echo $u_name?> 님</div>
                <svg xmlns="http://www.w3.org/2000/svg" class="fill_w" width="24" height="24" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
              </div>
            </div>
          </div>
        </div>
        
        <div id="member_desc" class="display_none"> 
          <div class="container">
            <div class="row justify-content-between align-items-center">
              <div class="col-6"><div class="tag3"><?php echo $u_rank?></div></div>
              <div class="col-3 text_align_right" onclick="hoverMemberDesc()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>
              </div>
              <div class="col-12 font_size_xxl"><?php echo $u_name?>님</div>
              <div class="col-12 margin_top_l">
                나의 개원진행률
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
              </div>
              <div class="col-12 margin_top_s">
                <div class="percentage margin_top_ss">
                  <div>
                    <div style="width: <?php echo $percentage?>%">
                      <div><?php echo $percentage?>%</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-6 button9"><a href="../mypage/home.php" style="color:#2B2B2B">마이페이지</div>
              <div class="col-6 button9"><a href="../member/logout.php" style="color:#2B2B2B">로그아웃</a></div>
            </div>
          </div>
        </div>
        
        <div id="pop_alarm" class="display_none position_absolute back_w box_shadow" style="right: 7px;z-index: 71;width: 360px;">
          <div class="container">
            <div class="row">
              <div class="col-12 border_bottom_g">
                <div class="row align-items-center">
                  <div class="col-10 padding_m">
                    <span class="font_size_ll">전체 알림</span>
                    <div class="button6 display_inline_block font_size_s margin_left_m" style="vertical-align: bottom;">모두 삭제</div>
                  </div>
                  <div class="col-2">
                    <svg onclick="hoverAlarm()" class="cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                  </div>
                </div>
              </div>
              <div class="col-12" style="height: 280px;">
                <div class="row align-items-center justify-content-center" style="height: 100%;">
                  <div class="col-12 text_align_center color_b font_size_l">알림이 없습니다:)</div>
                </div>
              </div>
              <!-- <div class="col-12" style="height: 280px; overflow-y:auto;">
                <div class="row">
                  <div class="col-12 border_bottom_g">
                    <div class="row align-items-center">
                      <div class="col-10 padding_m">
                        <div class="color_b cursor_pointer">개원상권분석시스템</div>
                        <div class="ellipsis font_size_s cursor_pointer">회원님의 남은 이용권이 3회 남았습니다:)  지금바로 상권 ㅁㄴㅇㄹㅁ ㅁㅇㄴㄹ ㅁㄴㅇㄹ</div>
                      </div>
                      <div class="col-2">
                        <svg class="cursor_pointer" style="fill: #a8a8a8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 border_bottom_g">
                    <div class="row align-items-center">
                      <div class="col-10 padding_m">
                        <div class="color_b cursor_pointer">개원상권분석시스템</div>
                        <div class="ellipsis font_size_s cursor_pointer">회원님의 남은 이용권이 3회 남았습니다:)  지금바로 상권 ㅁㄴㅇㄹㅁ ㅁㅇㄴㄹ ㅁㄴㅇㄹ</div>
                      </div>
                      <div class="col-2">
                        <svg class="cursor_pointer" style="fill: #a8a8a8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 border_bottom_g">
                    <div class="row align-items-center">
                      <div class="col-10 padding_m">
                        <div class="color_b cursor_pointer">개원상권분석시스템</div>
                        <div class="ellipsis font_size_s cursor_pointer">회원님의 남은 이용권이 3회 남았습니다:)  지금바로 상권 ㅁㄴㅇㄹㅁ ㅁㅇㄴㄹ ㅁㄴㅇㄹ</div>
                      </div>
                      <div class="col-2">
                        <svg class="cursor_pointer" style="fill: #a8a8a8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 border_bottom_g">
                    <div class="row align-items-center">
                      <div class="col-10 padding_m">
                        <div class="color_b cursor_pointer">개원상권분석시스템</div>
                        <div class="ellipsis font_size_s cursor_pointer">회원님의 남은 이용권이 3회 남았습니다:)  지금바로 상권 ㅁㄴㅇㄹㅁ ㅁㅇㄴㄹ ㅁㄴㅇㄹ</div>
                      </div>
                      <div class="col-2">
                        <svg class="cursor_pointer" style="fill: #a8a8a8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 border_bottom_g">
                    <div class="row align-items-center">
                      <div class="col-10 padding_m">
                        <div class="color_b cursor_pointer">개원상권분석시스템</div>
                        <div class="ellipsis font_size_s cursor_pointer">회원님의 남은 이용권이 3회 남았습니다:)  지금바로 상권 ㅁㄴㅇㄹㅁ ㅁㅇㄴㄹ ㅁㄴㅇㄹ</div>
                      </div> -->
                      <!-- <div class="col-2">
                        <svg class="cursor_pointer" style="fill: #a8a8a8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </header>
  <div class="ploting_banner" onclick="location.href='https://pf.kakao.com/_xeIrFj'">
    <img src="../assets/kakao_banner.png" width="60px" height="60px">
  </div>
    
    <nav class="text_align_center color_w" style="background-color: #242424;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 cursor_pointer">
            <div class="row justify-content-center align-items-end" style="height: 40px;">
              <div class="col"><a href = "home.php" style = "color:#FFFFFF; text-decoration:none">홈</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="profile.php" style="color:#FFFFFF; text-decoration:none">회원정보</a><div class="line_b" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="progress.php" style="color:#FFFFFF; text-decoration:none">개원노트</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="service.php" style="color:#FFFFFF; text-decoration:none">서비스</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="pay.php" style="color:#FFFFFF; text-decoration:none">결제정보</a><div class="line_g_d" style="border-width: 5px;"></div></div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <nav id="nav_small">
      <div>
        <div class="title"><a href = "/main/index.php" style = "color:#2b2b2b; text-decoration:none">STARTDOCTOR</a></div>
        <div class="progress_bar">
          <div class="category">개원진행률</div>
          <?php
          if (!$login) {
              echo '<div class="link">진행률 확인하러가기 ></div>';
          } else {
              echo '<div class="link"><a href = "../mypage/progress.php" style = "color:#2B2B2B"> 진행률 확인하러가기 > </a></div>';
          }
          ?>
          <div class="percentage margin_top_ss">
            <div>
            <?php
            if (!$login) {
                echo ' 
              <div style="width: 20%">
                <div>20%</div>
              </div>';
            } else {
                echo "
              <div style=\"width:$percentage%\">
              <div>$percentage%</div>
              ";
            }
            ?>
            </div>
          </div>
        </div>
        <?php
        if (!$login) {
            echo '
        <div class="member">
          <div>
            <div class="image" style="background-image: url(../assets/0_side_0.png);height:100px;cursor:pointer" onclick="location.href=\'../member/signin.html\'"></div>
            
          </div>

          <div>
            <div class="image" style="background-image: url(../assets/0_side_2.png);height:100px;cursor:pointer" onclick="location.href=\'../company/system.php\'"></div>  
          </div>

          <div>
            <div class="image" style="background-image: url(../assets/0_side_3.png);height:100px"></div>
          </div>
        </div>';
        } else {
            echo'        
          <div class="member">
          
            
            ';
            if ($row['u_specify'] == '의사') {
                echo '<div><div class="image" style="background-image: url(../assets/0_side_1.png);height:100px;cursor:pointer" onclick="location.href=\'../mypage/home.php\'"></div></div>';
            } else {
                echo '<div><div class="image" style="background-image: url(../assets/0_side_1.png);height:100px;cursor:pointer" onclick="location.href=\'../mypage/business.php\'"></div></div>';
            }
            echo '
           
            
          
          
          <div>
            <div class="image" style="background-image: url(../assets/0_side_2.png);height:100px;cursor:pointer" onclick="gotoanal()"></div>
          </div>
          <div>
            <div class="image" style="background-image: url(../assets/0_side_3.png);height:100px;cursor:pointer" onclick="location.href=\'../service/chat.php\'"></div>
          </div>
        </div>';
            echo
        "<form method = \"POST\" name =\"analyform\" id = \"analyform\" action =\"http://commercial-env.apkxyagrzb.ap-northeast-2.elasticbeanstalk.com/main/\">
          <input type = \"hidden\" name=\"u_id\" value = \"$u_id\"/>";
        }
        ?>
          <script>
    function gotoanal(){
      $('#analyform').submit();
    }
    </script>
        <hr class="line" />
        <div class="category_area">
        <div class="category"><a href="../main/index.php" style="color:#2B2B2B">스타트닥터</a></div>
        <div class="category"><a href="../company/aboutus.php" style="color:#2B2B2B">스타트닥터 소개</a></div>
        <?php
        if (!$login) {
            echo '
            <div class="category"><a href="#" style = "color:#2B2B2B" onclick="alert(\'로그인이 필요합니다\'); location.href=\'../service/signin.html\';">개원상권분석시스템</a></div>
            ';
        } else {
            echo '
            <div class="category"><a href="#" style = "color:#2B2B2B" onclick="gotoanal();">개원상권분석시스템</a></div>
            ';
        }
        ?>
        <div class="category"><a href="../service/chat.php" style="color:#2B2B2B">상담채팅</a></div>
        <div class="category"><a href="../service/estimate.php" style="color:#2B2B2B">비교견적</a></div>
        <div class="category"><a href="../service/seminar.php" style="color:#2B2B2B">개원세미나</a></div>
      </div>
        <hr class="line" />
        <div class="margin_top_m">
          <div class="link"><a href = "../company/opinion.php" style = "color:#2B2B2B">의견남기기</a></div>
          <div class="link"><a href = "../company/notice.php" style = "color:#2B2B2B">공지사항</a></div>
          <div class="link"><a href = "../company/faq.php" style = "color:#2B2B2B">FAQ</a></div>
        </div>
        <div class="close" onclick="hoverNavigation()">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
        </div>
      </div>
    </nav>

    <section class="back_g_l">
      <article class="padding_m">
        <div class="font_size_xl font_weight_b padding_v_l">회원정보</div>
        <div class="back_w box_shadow" style="padding: 36px 30px;">
          <div class="container">
            <div class="row">
              <div class="col-12 font_size_xl">프로필</div>
              <div class="col-12 margin_top_l font_size_l font_weight_b">회원유형</div>
              <div class="col-12 margin_top_m">
                <div class="form-check display_inline_block">
                  <input class="form-check-input" type="radio" name="name" id="radio1" value="0" checked disabled>
                  <label class="form-check-label" for="radio1">
                    의사
                  </label>
                </div>
                <div class="form-check display_inline_block margin_left_s">
                  <input class="form-check-input" type="radio" name="name" id="radio2" value="1" disabled>
                  <label class="form-check-label" for="radio2">
                    기업
                  </label>
                </div>
              </div>

              <div class="col-12 margin_top_l">이름</div>
              <div class="col-12 col-sm-6 margin_top_s">
                <input type="email" name="" value="<?php echo $u_name?>" disabled />
              </div>

              <div class="col-12 margin_top_l">생년월일</div>
              <div class="col-4 col-sm-2 input-group margin_top_s">
                <input type="text" name="" value="<?php echo substr($row['u_birth'], 0, 4)?> 년"  disabled />
              </div>
              <div class="col-4 col-sm-2 input-group margin_top_s">
                <input type="text" name="" value="<?php echo substr($row['u_birth'], 5, 2)?> 월"  disabled />
              </div>
              <div class="col-4 col-sm-2 input-group margin_top_s">
                <input type="text" name="" value="<?php echo substr($row['u_birth'], 8, 2)?> 일"  disabled />
              </div>

              <div class="col-12 margin_top_l">의사면허번호</div>
              <div class="col-12 col-sm-6 margin_top_s">
                <input type="text" name="" value="<?php echo $row['u_license']?>" disabled />
              </div>

            </div>
          </div>
        </div>

        <div class="back_w box_shadow margin_top_l" style="padding: 36px 30px;">
          <div class="container">
            <div class="row">
              <div class="col-12 font_size_xl">프로필</div>

              <div class="col-12 margin_top_l">이메일</div>
              <div class="col-12 col-sm-6 margin_top_s position_relative">
                <input type="text" name="" placeholder="이메일" value="<?php echo $row['u_email']?>" disabled/>
                <!-- <div class="button10 position_absolute" style="right: 25px; top: 15px" onclick="modalEmail()">수정</div> -->
              </div>
            </div>

            <div class="row">
              <div class="col-12 margin_top_l">연락처</div>
              <div class="col-12 col-sm-6 margin_top_s position_relative">
                <input type="text" name="" placeholder="연락처" value="<?php echo $row['u_phone']?>" disabled/>
                <!-- <div class="button10 position_absolute" style="right: 25px; top: 15px" onclick="alert('준비중인 기능입니다')">수정</div> -->
              </div>

            </div>
          </div>
        </div>

        <div class="margin_top_l">
          <span class="underline font_weight_b cursor_pointer" onclick ="modalPW()">비밀번호 변경 ></span>
          <span class="underline font_weight_b margin_left_m cursor_pointer" onclick ="alert('고객 센터에 문의하여 주세요')">회원 탈퇴 ></span>
        </div>

      </article>
    </section>


    <div id="modal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div id="modal_title" class="modal-title font_size_l font_weight_b"></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modal_body" class="modal-body">

          </div>
          <!-- <div class="modal-footer">
            <button id="modal_save" type="button" class="btn btn-primary"></button>
          </div> -->
        </div>
      </div>
    </div>
    
    <footer id="footer">
      <div id="footer_01" class="tablet">
         <div class="row align-items-center" style="height: 40px;">
          <div class="col text_align_center"><a href = "../company/aboutus.php" style = "color:#FFFFFF">스타트닥터</a></div>
          <div class="col text_align_center border_left"><a href = "../company/system.php" style = "color:#FFFFFF">개원상권분석시스템</a></div>
          <div class="col text_align_center border_left"><a href = "../service/chat.php" style = "color:#FFFFFF">상담채팅</a></div>
          <div class="col text_align_center border_left"><a href = "../service/estimate.php" style = "color:#FFFFFF">비교견적</a></div>
          <div class="col text_align_center border_left"><a href = "../service/seminar.php" style = "color:#FFFFFF">개원세미나</a></div>
        </div>
      </div>
      <div id="footer_02">
        <div class="row justify-content-start align-items-between">
          <div class="col-12 col-sm-6 font_size_xl font_weight_b"><a href = "/main/index.php" style = "text-decoration:none; color:#FFFFFF">STARTDOCTOR</a></div>
          <div class="col-12 col-sm-5" style="line-height: 1.79;">
          Tel. 050 7343 2605<br/>
            E-mail. support@eszett.co.kr<br/>
            상호 : 에스체트(eszett)<br/>
            대표 : 이승준 <br/>
            소재지 : 서울특별시 강남구 강남대로 364 미왕빌딩 16층<br/>
            사업자등록번호 : 308-13-51102
          </div>
          <div class="col-12 col-sm-1 tablet" onclick="positionToTop()" >
            <svg class="cursor_pointer" style="fill: #fff;transform: rotate(270deg);width: 50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
          </div>
          <div class="col-12 col-sm-5 margin_top_l mobile">
            <span><a href = "../member/privacy.html" style = "color:#FFFFFF">개인정보취급방침</a></span><span style="padding: 0 10px">|</span><span><a href = "../member/terms.html" style = "color:#FFFFFF">이용약관</a></span> 
          </div>
          <div class="col-12 col-sm-6 margin_top_l">
            Copyright ⓒ 2019 eszett All Rights Reserved
          </div>
          <div class="col-12 col-sm-5 margin_top_l tablet">
            <span><a href = "../member/privacy.html" style = "color:#FFFFFF">개인정보취급방침</a></span><span style="padding: 0 10px">|</span><span><a href = "../member/terms.html" style = "color:#FFFFFF">이용약관</a></span>
          </div>
        </div>
        <div class="col-12 col-sm-1 mobile" onclick="positionToTop()" style="position: absolute;top: 32px;text-align: right;">
          <svg class="cursor_pointer" style="fill: #fff;transform: rotate(270deg);width: 50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
        </div>
      </div>
    </footer>
    <div class="background_layer display_none" id="background_layer_01" onclick="hoverNavigation()"></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../script/common.js"></script>
    <script src="../script/mypage.js"></script>
  </body>
</html>