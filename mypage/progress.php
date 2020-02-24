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
              <div class="col"><a href ="profile.php" style="color:#FFFFFF; text-decoration:none">회원정보</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="progress.php" style="color:#FFFFFF; text-decoration:none">개원노트</a><div class="line_b" style="border-width: 5px;"></div></div>
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
      <article>
        <div class="container margin_top_xl">
          <div class="row">
            <div class="col-12 font_size_xl font_weight_b">현재 진행도</div>
            <div class="col-12">
              <div class="progress_bar margin_top_l">
                <div class="percentage margin_top_ss">
                  <div>
                    <div style="width: 0%" id="progress_percentage">
                      <div></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 margin_top_xl">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="hover_view_finished" onchange="hoverViewFinished()">
                <label class="custom-control-label font_size_m" for="hover_view_finished">완료된 항목 숨기기</label>
              </div>
            </div>
          
          </div>
          <div class="row margin_top_m">
            <div class="container">
              <div class="row">

                <!-- <div class="progress_step margin_top_s col-12 cursor_pointer">
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                      <div style="width: 30px;"><svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
                      <div class="col-9 line_through color_g font_size_l font_weight_b">현재 의료시장 파악하기</div>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div> -->
                <!-- <div class="progress_step_detail col-12" style="display: none;">
                  <div class="container">
                    <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                      <div class="col-10 back_g_n padding_v_m">
                        상권분석을 바탕으로 가용자금, 본인 성향, 특기, 상황에 따라 병원 컨셉을 잡아보세요.  정해진 컨셉에 따라 단독개원을 할지 공동개원을 할지 정하고 네트워크, 신규, 인수 등 다양한 개원루트를 연구해보세요. 네트워크는 마케팅에 유리하지만 수가가 낮고 수수료비용이 들어갑니다. 신규는 수수료가 안들지만 마케팅을 잘해야한다는 점은 꼭 고려하세요. 
                      </div>
                    </div>
                    <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                      <div class="col-10 back_g_n padding_v_m">
                        상권분석을 바탕으로 가용자금, 본인 성향, 특기, 상황에 따라 병원 컨셉을 잡아보세요.  정해진 컨셉에 따라 단독개원을 할지 공동개원을 할지 정하고 네트워크, 신규, 인수 등 다양한 개원루트를 연구해보세요. 네트워크는 마케팅에 유리하지만 수가가 낮고 수수료비용이 들어갑니다. 신규는 수수료가 안들지만 마케팅을 잘해야한다는 점은 꼭 고려하세요. 
                      </div>
                    </div>
                    <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                      <div class="col-10 back_g_n padding_v_m">
                        상권분석을 바탕으로 가용자금, 본인 성향, 특기, 상황에 따라 병원 컨셉을 잡아보세요.  정해진 컨셉에 따라 단독개원을 할지 공동개원을 할지 정하고 네트워크, 신규, 인수 등 다양한 개원루트를 연구해보세요. 네트워크는 마케팅에 유리하지만 수가가 낮고 수수료비용이 들어갑니다. 신규는 수수료가 안들지만 마케팅을 잘해야한다는 점은 꼭 고려하세요. 
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s">더 궁금한 점이 있다면 스타트닥터와 상담채팅을 진행하세요.   ></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><div class="button color_w small" style="background-color: #000;;">완료</div></div>
                    </div>
                  </div>
                </div> -->
                
                <div class="progress_step margin_top_s col-12 cursor_pointer progress_finished">
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                      <div style="width: 30px;"><svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
                      <div class="col-9 line_through color_g font_size_l font_weight_b">스타트닥터 회원가입하기</div>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                <div class="progress_step_detail col-12" style="display: none;">
                  <div class="container">
                    <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                      <div class="col-10 back_g_n padding_v_m">
                        스타트 닥터 회원가입만으로 이미 당신은 개원의 위대한 첫걸음을 내딛은 거에요 
                      </div>
                    </div>
                    <div class="row margin_top_s">
                      <!-- <div class="col-12 color_b underline cursor_pointer">더 궁금한 점이 있다면 스타트닥터와 상담채팅을 진행하세요.   ></div> -->
                    </div>
                  </div>
                </div>

                <?php
                  if ($row['c1'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                      <div style="width: 30px;">
                        <?php
                            if ($row['c1'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c1'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">현재 의료시장 파악하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">현재 의료시장 파악하기</div>';
                      }
                      ?>
                     
                      <div style="width: 30px;">
                      
                        <svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                        <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                          상권분석을 바탕으로 가용자금, 본인 성향, 특기, 상황에 따라 병원 컨셉을 잡아보세요.  정해진 컨셉에 따라 단독개원을 할지 공동개원을 할지 정하고 네트워크, 신규, 인수 등 다양한 개원루트를 연구해보세요. 네트워크는 마케팅에 유리하지만 수가가 낮고 수수료비용이 들어갑니다. 신규는 수수료가 안들지만 마케팅을 잘해야한다는 점은 꼭 고려하세요. 
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c1"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c2'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c2'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c2'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">관심지역 상권분석 하러가기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">관심지역 상권분석 하러가기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../company/system.php">상권분석 하러가기 ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c2"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c3'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c3'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c3'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">병원 브랜딩 및 계획 수립하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">병원 브랜딩 및 계획 수립하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                          상권분석을 바탕으로 가용자금, 본인 성향, 특기, 상황에 따라 병원 컨셉을 잡아보세요.  정해진 컨셉에 따라 단독개원을 할지 공동개원을 할지 정하고 네트워크, 신규, 인수 등 다양한 개원루트를 연구해보세요. 네트워크는 마케팅에 유리하지만 수가가 낮고 수수료비용이 들어갑니다. 신규는 수수료가 안들지만 마케팅을 잘해야한다는 점은 꼭 고려하세요.  
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                          컨셉과 개원 루트를 정했다면 이젠 그 컨셉에 맞는 병원 이름을  지어야합니다. 여러가지 이름을 틈틈히 생각해보고 주변 많은 사람들에게 조언을 구하세요. 이름이 정해졌다면 상표권 등록은 필수! 
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip3</div>
                        <div class="col-10 back_g_n padding_v_m">
                         컨셉에 맞게 개원 규모와 인력 계획을 수립하세요. 베드를 몇 개를 할 것인지, 고급스러운 인테리어를 할 것인지, 작지만 실속있게 할 것인지에 따라 개원 평수와 인테리어 비용은 다르게 산정됩니다.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip4</div>
                        <div class="col-10 back_g_n padding_v_m">
                         규모가 정해졌다면 그 규모에 따라  인테리어, 장비, 가전가구등 필요한 개원 예산 리스트를 작성해보세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip5</div>
                        <div class="col-10 back_g_n padding_v_m">
                          마지막으로 위 사항들을 모두고려하여 개원 일정표 작성해보세요.
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/chat.php">더 궁금한 점이 있다면 상담채팅을 이용하세요     ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c3"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c4'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c4'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c4'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">사전 교육 받기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">사전 교육 받기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                        일반, 영유아 검진한다면 영유아검진교육은 미리 수료하세요.  
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                        한해에 들어야할 연수평점 8점도 미리 수료해두시면 좋습니다. ^^(개원후는 매우 바쁩니다.)
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/chat.php">더 궁금한 점이 있다면 상담채팅을 이용하세요     ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c4"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>
                
                <?php
                  if ($row['c5'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c5'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c5'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">자금대출하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">자금대출하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">비교견적 하러가기    ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c5"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c6'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c6'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c6'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">상가분석 하러가기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">상가분석 하러가기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../company/system.php">상권분석 하러가기    ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c6"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>
                
                <?php
                  if ($row['c7'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c7'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c7'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">상가 계약하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">상가 계약하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                         계약전 꼭 건축물 관리 대장을 뽑아보고 부동산 등기부등본을 체크하세요. 
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                         부동산업자와 함께 상가를 보실 떈 계약 조건, 특약 조건, 부동산 중개수수료, 간판, 주차장, 관리비, 평면도 확보까지 꼼꼼하게 봐야해요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip3</div>
                        <div class="col-10 back_g_n padding_v_m">
                         그리고 건축물 용도는 미리 확인하지 않으면 문제가 생길수 있어요. 건축물 용도가 근생 1종인지 꼭 확인하세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip4</div>
                        <div class="col-10 back_g_n padding_v_m">
                         소방법도 중요합니다. 비상구가 있는지, 스프링쿨러, 유도등 문제 여부를 미리 파악해야합니다.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip5</div>
                        <div class="col-10 back_g_n padding_v_m">
                         임대차 건물에 큰규모의 저당이 잡혀있지 않는지, 문제가없는지 꼭 알아보고 계약하세요.
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../assets/상가건물 임대차 표준 계약서.hwp">계약서 다운로드 받기     ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c7"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>
                

                <?php
                  if ($row['c8'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c8'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c8'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">인테리어 업체 선정하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">인테리어 업체 선정하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      <div style = "background-color: rgba(47,124,247,0.8); position:relative ; width:100% ; padding-right:15px; padding-left:15px; color:#FFFFFF; text-align:center; border: 1px; margin-bottom:15px; padding-top:10px ; padding-bottom:10px; ">인테리어 도면 제작 시 꼭 확인해야할 점검 사항 (안하면 인테리어 공사 다시 해야해요..)</div>
                    
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                         직원 수 , 직원 별 담담을 미리 확정해두고 모집 공고를 내서 각 부서 실장 및 팀장을 우선 선발하세요. 채용된 실장 및 팀장은 미리 출근해서 인테리어시 업무 동선을 같이 짜도록 하면 업무 효율성을 높일 수 있어요! 
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                         보안시설도 챙겨야겠죠. 보안업체(cctv)를 선정하고 현장 점검 및 기본 배선 도면 제작시 함께 상의하세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip3</div>
                        <div class="col-10 back_g_n padding_v_m">
                         미처 생각하지 못하는 부분! 통신 (인터넷/전화) 업체를 선정하고 회선수량 작성, 현장 점검하여 도면에 적용해보세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip4</div>
                        <div class="col-10 back_g_n padding_v_m">
                         이제는 큰 의료장비들을 어디에 놓을지 결정해야해요. 관리 장비 / X-Ray / CT / MRI / 오토클래이브 업체와 우선 계약하고 현장 점검하여 도면에 적용하세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip5</div>
                        <div class="col-10 back_g_n padding_v_m">
                         요새는 클라우드 서버를 많이 사용하긴 하는데 로컬서버를 사용할 경우 공간을 생각보다 많이 차지하여 당황하는 경우가 있어요. 전산 시스템 계획 을 수립하고 업체 선정(서버 세팅)하여 도면에 적용에 적용해보세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip6</div>
                        <div class="col-10 back_g_n padding_v_m">
                         위 사항들을 모두 적용한후에는 전체적으로 한번 봐야합니다. 면도, 3D 조감도 등 / 색채 / 심볼 / 평면 / 자제 / 공정 / 가설 계획을 상의하고 확정후 최종 평면도 및 조감도 확보하세요.
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">인테리어 비교견적 하러가기     ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c8"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                
                <?php
                  if ($row['c9'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c9'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c9'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">인테리어 중간 점검</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">인테리어 중간 점검</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      
                    
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                         중간 점검시에는 먹작업 후 실 사용 공간 규모와 넓이를 체크합니다.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                         주 2회 정도는 공사현장에 가서 평면 계획 또는 조감 계획 공정에 따라 잘 진행되고 있는지 점검하세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip3</div>
                        <div class="col-10 back_g_n padding_v_m">
                         여기까지 진행되었으면 공사에는 많은 공정이 있다는 걸 알게 되실 거에요. 목 공사, 설비 공사, 창호 공사, 소방 공사, 시트 공사, 철거 공사, 전기 공사, 도장 공사, 타일 공사, 데코 타일, 싱크 공사 등의 공정이 있다는 건 알아두시면 도움이 됩니다.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip4</div>
                        <div class="col-10 back_g_n padding_v_m">
                         샘플링 작업 후 조명 발주, 금속 공사, 싸인 공사, 가구, 잔손보기, 준공청소, 네트워크 순으로 진행됩니다.
                        </div>
                      </div>
                     
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c9"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                
                <?php
                  if ($row['c10'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c10'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c10'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">세무사 선정하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">세무사 선정하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">세무사 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c10"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c11'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c11'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c11'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">간판 및 옥외 설치물 설치하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">간판 및 옥외 설치물 설치하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">간판 및 옥외 설치물 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c11"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c12'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c12'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c12'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">홈페이지 업체 선정하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">홈페이지 업체 선정하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">홈페이지 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c12"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c13'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c13'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c13'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">로고 및 명함 선정하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">로고 및 명함 선정하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">로고 및 명함 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c13"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c14'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c14'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c14'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">마케팅 업체 선정하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">마케팅 업체 선정하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">마케팅 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c14"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c15'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c15'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c15'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">노무사 선정하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">노무사 선정하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">노무사 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c15"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c16'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                      <div style="width: 30px;">
                        <?php
                            if ($row['c16'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c16'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">인테리어 완료 및 하자보수</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">인테리어 완료 및 하자보수</div>';
                      }
                      ?>
                     
                      <div style="width: 30px;">
                      
                        <svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                        <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                          손상 및 마감을 확인하세요. 문닫는 소리 크기, 인테리어 설비 작동여부, 누전여부, 수도 누수 등 세부사항 확인까지 꼼꼼히 확인해서 추후에 재공사를 하지 않도록 해야 해요.  
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c16"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c17'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c17'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c17'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">의료장비 발주하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">의료장비 발주하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">의료장비 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c17"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c18'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c18'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c18'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">의료 소모품 / 약품 발주하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">의료 소모품 / 약품 발주하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">의료 소모품 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c18"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>


                
                <?php
                  if ($row['c19'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                      <div style="width: 30px;">
                        <?php
                            if ($row['c19'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c19'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">집기 구입하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">집기 구입하기</div>';
                      }
                      ?>
                     
                      <div style="width: 30px;">
                      
                        <svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                        <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                         집기 비품들를 새제품으로 할지 중고로 구매할지 컨셉 및 사용성에 따라 결정해보세요. 기본적으로 TV, 가구, 정수기, 기타 소품 등의 목록을 준비해서 업체 2~3곳 컨택 후 견적을 비교해보세요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                        <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                         집기 비품 리스트를 작성해보세요. ( 품명, 제조사, 업체명, 담당자, 연락처, 제조년월일, 가격 등을 꼼꼼히 비교한 후 계약을 체결합니다.
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c19"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                
                <?php
                  if ($row['c20'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c20'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c20'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">전화,인터넷,팩스 등 네트워크 설비 계약하기 </div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">전화,인터넷,팩스 등 네트워크 설비 계약하기 </div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">네트워크 설비 비교견적 하러가기</a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c20"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c21'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c21'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c21'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">각종 인/허가 신고하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">각종 인/허가 신고하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      <div style = "background-color: rgba(47,124,247,0.8); position:relative ; width:100% ; padding-right:15px; padding-left:15px; color:#FFFFFF; text-align:center; border: 1px; margin-bottom:15px; padding-top:10px ; padding-bottom:10px; ">아래 10가지를 꼼꼼하게 챙기세요.</div>
                    
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                         의료기관개설신고 (보건소) 
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                         사업자등록신고 (세무서)
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip3</div>
                        <div class="col-10 back_g_n padding_v_m">
                        요양기관현황통보
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip4</div>
                        <div class="col-10 back_g_n padding_v_m">
                        건강보험 청구용 인증서 발급
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip5</div>
                        <div class="col-10 back_g_n padding_v_m">
                         통합 4대 사회보험 신고
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip6</div>
                        <div class="col-10 back_g_n padding_v_m">
                         전화 / 팩스 / 인터넷 신청
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip7</div>
                        <div class="col-10 back_g_n padding_v_m">
                         보안업체 신청
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip8</div>
                        <div class="col-10 back_g_n padding_v_m">
                         사업용 계좌 개설 및 신고
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip9</div>
                        <div class="col-10 back_g_n padding_v_m">
                         신용카드 단말기 신쳥 및 설치
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip10</div>
                        <div class="col-10 back_g_n padding_v_m">
                         의료 폐기물 신고
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">인테리어 비교견적 하러가기     ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c21"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                
                <?php
                  if ($row['c22'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c22'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c22'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">홍보성 인쇄물 주문하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">홍보성 인쇄물 주문하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c22"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c23'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c23'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c23'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">개원 리허설하기</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">개원 리허설하기</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      
                    
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                         환자가 왔을때의 진료 동선과 프로세스를 미리 리허설 해봅니다.	
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                         환자 접수시 – 초진 접수 카드, 초진 접수 관리 대장이 있어야 합니다.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip3</div>
                        <div class="col-10 back_g_n padding_v_m">
                         검사할 땐 –검사 매뉴얼, 문진표, 설문지, 검사지, 검사 종류 안내가 이루어져야 할거구요.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip4</div>
                        <div class="col-10 back_g_n padding_v_m">
                         예약시 – 예약 관리 프로세스를 정립해보세요. (예약 매뉴얼과 예약 관리 대장도 꼼꼼히 챙깁니다.)
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip5</div>
                        <div class="col-10 back_g_n padding_v_m">
                         상담시 – 상담 매뉴얼 및 임상자료를 미리 만들어 둡니다.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip6</div>
                        <div class="col-10 back_g_n padding_v_m">
                         고객관리프로그램인 CRM 프로그램을 이용하여 고객 관리 프로세스를 정립해보세요. (서비스 매뉴얼, CRM 관리방안(해피콜), 컴플레인 관리방안을 챙겨야겠죠?)
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip7</div>
                        <div class="col-10 back_g_n padding_v_m">
                         기타 주의사항 – 환불 관리도 미리 생각해두어야합니다. (환불 보고서, 환불 규정을 만들어 둡시다.)
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip8</div>
                        <div class="col-10 back_g_n padding_v_m">
                         경영 전반에 대한 리허설 – 근처 병원의 진료 통계를 분석하고 진단해보는 것도 중요해요. ( 초진 환자 수, 재진 환자 수, 내원 경로, 거주지, 교통 접근성, 질환별 통계)
                        </div>
                      </div>
                      <!-- <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip9</div>
                        <div class="col-10 back_g_n padding_v_m">
                         제증명서류 발급시 – 기타 양식도 미리 준비해둡니다. (요새는 전자차트에 다 있긴 하지만 컴퓨터가 먹통이 될 경우를 대비해서 진료 의뢰서, 진단서, 진료 소견서, 진료 확인 서 등 증명서 발급대장을 만들어 둡니다.) 
                        </div>
                      </div> -->
   
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../company/system.php">개원상권분석 하러가기     ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c23"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c24'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c24'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c24'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">수술 기구 및 장비 입고</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">수술 기구 및 장비 입고</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c24"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c25'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c25'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c25'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">병원 환경 개선</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">병원 환경 개선</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">
                      <div class="row margin_top_s">
                      
                    
                      <div class="col-2 back_p color_w display_inline_block">Tip1</div>
                        <div class="col-10 back_g_n padding_v_m">
                         병원을 오픈하기 전에 세세한 부분까지 챙겨야해요  신문 / 잡지 등 배달은 미리 신청하구요.	
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip2</div>
                        <div class="col-10 back_g_n padding_v_m">
                         공기 청정기 / 정수기 / 가습기 / 음료대 / 커피메이커 / 종이컵 회수대 / 제품 전시대 / 신문 잡지 전시대 / 방향제 / 티슈 설치 등도 미리 준비해두고 환자분들이 좋은 병원으로 인식할 수 있도록 환경을 개선합니다.
                        </div>
                      </div>
                      <div class="row margin_top_s">
                      <div class="col-2 back_p color_w display_inline_block">Tip3</div>
                        <div class="col-10 back_g_n padding_v_m">
                         또한 처음 온 환자들도 병원에 신뢰감을 느낄 수 있도록 각종 컬럼북 / 치료 전 후 사진 / 치료 후기북 / 언론 보도 자료북 / 이벤트 모음집 / 대기실 동영상을 준비하여 비치하세요.
                        </div>
                      </div>
                     
   
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "https://pf.kakao.com/_xeIrFj">대기실 동영상 문의하기    ></a></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c25"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c26'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c26'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c26'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">추가 인원 고용</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">추가 인원 고용</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"></div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c26"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>

                <?php
                  if ($row['c27'] == null) {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer">';
                  } else {
                      echo '<div class="progress_step margin_top_s col-12 cursor_pointer progress_finished complete">';
                  }
                ?>
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                    <div style="width: 30px;">
                        <?php
                            if ($row['c27'] == null) {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>';
                            } else {
                                echo ' <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>';
                            }
                        ?>
                      </div>
                      <?php
                      if ($row['c27'] == null) {
                          echo ' <div class="col-9 font_size_l font_weight_b">근무복 입고</div>';
                      } else {
                          echo ' <div class ="col-9 line_through color_g font_size_l font_weight_b">근무복 입고</div>';
                      }
                      ?>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                </div>
                  <div class="progress_step_detail col-12" style="display: none;">
                    <div class="container">        
                      <div class="row margin_top_s">
                        
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 col-sm-9 color_b underline cursor_pointer margin_top_s"><a href = "../service/estimate.php">근무복 비교견적 하러가기</div>
                      <div class="col-8 col-sm-3 color_b underline cursor_pointer margin_top_s"><a href = "checklist.php?c=c27"><div class="button color_w small" style="background-color: #000;">완료</div></div></a>
                    </div>
                </div>


               







                <!-- <div class="progress_step complete margin_top_s col-12 position_relative">
                  <div class="container" onclick="hoverProgress(this)">
                    <div class="row align-items-center justify-content-between box_shadow back_w padding_l">
                        <div style="width: 30px;"><svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/><path d="M0 0h24v24H0z" fill="none"/></svg></div>
                      <div class="col-9 font_size_l font_weight_b">아직 안 끝난 항목</div>
                      <div style="width: 30px;"><svg class="arrow fill_b" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></div>
                    </div>
                  </div>
                  <div class="container back_g_l position_absolute" style="opacity: 0.8; top:0;left:0;width: 100%; height: 100%;">
                    <div class="row align-items-center justify-content-between padding_l" style="height: 100%;">
                      <div class="col-12 text_align_center">
                        <svg class="fill_g" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                      </div>
                    </div>
                  </div>
                </div> -->


              </div>
            </div>

          </div>
        </div>
      </article>
    </section>
    <div style = "height:40px; background-color:#F5F5F5"></div>
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
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../script/common.js"></script>
    <script src="../script/mypage.js"></script>
    <script>
      $(document).ready(function () {
        var stepElements = progressPage.stepElements
        progressPage.distance = 100 / stepElements.length;
        var completeCount = 0
        for (var i=0; i<stepElements.length; i++) {
          if (stepElements.eq(i).hasClass('complete')) {
            completeCount++;
          }
        }
        
        progressPage.newPercentage = 20+(3*completeCount);
        if(progressPage.newPercentage >100){
          progressPage.newPercentage = 100;
        }
        progressPage.setProgressBar()
      })
    </script>

  </body>
</html>
