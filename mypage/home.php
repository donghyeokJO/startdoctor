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
  $u_name = $row['u_name'];
  $percentage = $row['percentage'];
  $u_id = $row['u_id'];
  $u_rank = $row['u_rank'];
  $u_count = $row['u_count'];
  $login = true;
  $chat_query = "select * from coach where user2 = '$u_id' ";
  $chat_ret = mysqli_query($conn, $chat_query);
  $chat_num = mysqli_num_rows($chat_ret);
  while ($r = mysqli_fetch_assoc($chat_ret)) {
      $id = $r['coach_id'];
      $query = "select * from chat where coach_id = '$id'";
      $tmp = mysqli_query($conn, $query);
      $num = mysqli_num_rows($tmp);
      if ($num == 0) {
          $chat_num--;
      }
  }

  $estimate_query1 = "select * from form1 where u_id = '$u_id'";
  $estimate_ret1 = mysqli_query($conn, $estimate_query1);
  $e1 = mysqli_num_rows($estimate_ret1);

  $estimate_query2 = "select * from form2 where u_id = '$u_id'";
  $estimate_ret2 = mysqli_query($conn, $estimate_query2);
  $e2 = mysqli_num_rows($estimate_ret2);

  $estimate_query3 = "select * from form3 where u_id = '$u_id'";
  $estimate_ret3 = mysqli_query($conn, $estimate_query3);
  $e3 = mysqli_num_rows($estimate_ret3);

  $estimate_query4 = "select * from form4 where u_id = '$u_id'";
  $estimate_ret4 = mysqli_query($conn, $estimate_query4);
  $e4 = mysqli_num_rows($estimate_ret4);

  $estimate_query5 = "select * from form5 where u_id = '$u_id'";
  $estimate_ret5 = mysqli_query($conn, $estimate_query5);
  $e5 = mysqli_num_rows($estimate_ret5);

  $estimate_query6 = "select * from form6 where u_id = '$u_id'";
  $estimate_ret6 = mysqli_query($conn, $estimate_query6);
  $e6 = mysqli_num_rows($estimate_ret6);

  $estimate_num = ($e1 + $e2 + $e3 + $e4 + $e5 + $e6);

  $star_query = "select * from star where u_id = '$u_id'";
  $star_ret = mysqli_query($conn, $star_query);
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
    <meta charset="utf-8">
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
              <div class="col"><a href = "home.php" style = "color:#FFFFFF; text-decoration:none">홈</a><div class="line_b" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="profile.php" style="color:#FFFFFF; text-decoration:none">회원정보</a><div class="line_g_d" style="border-width: 5px;"></div></div>
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
        "<form method = \"POST\" name =\"analyform\" id = \"analyform\" action =\"http://commercial-env.apkxyagrzb.ap-northeast-2.elasticbeanstalk.com/user/user_login/\">
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
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="font_size_xl"><span class="font_weight_b"><?php echo $u_name?></span><span class="margin_left_m">님, 환영합니다</span></div>
              <div class="progress_bar margin_top_l">
                <div class="font_size_l font_weight_b">개원진행현황 ></div>
                <div class="percentage percentage_big margin_top_ss">
                  <div>
                    <div style="width: <?php echo $percentage?>%">
                      <div><?php echo $percentage?>%</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row margin_top_m">
            <div class="col-12 col-sm-4 margin_top_s">
              <div class="box_shadow padding_l back_w cursor_pointer" onclick ="location.href='diagnose.php'">
                <div class="font_size_l">상권분석 보고서 이용건수 ></div>
                <div class="text_align_right font_weight_b"><span class="font_size_xxl color_b"><?php echo $row['u_used']?></span><span>건</span></div>
              </div>
            </div>
            <div class="col-12 col-sm-4 margin_top_s">
              <div class="box_shadow padding_l back_w cursor_pointer" onclick="location.href='chat.php'">
                <div class="font_size_l">상담중인 채팅 건수 ></div>
                <div class="text_align_right font_weight_b"><span class="font_size_xxl color_b"><?php echo $chat_num?></span><span>건</span></div>
              </div>
            </div>
            <div class="col-12 col-sm-4 margin_top_s">
              <div class="box_shadow padding_l back_w cursor_pointer" onclick="location.href='estimate.php'">
                <div class="font_size_l">비교견적 의뢰건수 ></div>
                <div class="text_align_right font_weight_b"><span class="font_size_xxl color_b"><?php echo $estimate_num?></span><span>건</span></div>
              </div>
            </div>
            <div class="col-12">
              <div class="line margin_top_xl"></div>
            </div>
          </div>
          <div class="row margin_top_xl">
            
            <div class="col-12">
              <div class="container">
                <div class="row back_w box_shadow padding_m" >

                  <div class="col-12">
                    <div class="container">
                      <div class="row justify-content-between align-items-end">
                        <div class="font_size_ll font_weight_b">업체즐겨찾기</div>
                        <div class="col-6 col-sm-3 input-group" style="padding-right: 0">
                          <!-- <select class="select_box_ss custom-select year_area padding_s">
                            <option selected>전체</option>
                          </select> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12 margin_top_m">
                    <table>
                      <thead>
                        <tr>
                          <th scope="col" style="width: 30px;"></th>
                          <th scope="col" style="width: 60px;">번호</th>
                          <th scope="col">분야</th>
                          <th scope="col">업체명</th>
                          <th scope="col" style="width: 40px;"></th>
                        </tr>
                      </thead>
                      <tbody> 
                        <?php
                          $query = "select * from star where u_id = '$u_id'";
                          $tmp = mysqli_query($conn, $query);
                          $i = 1;
                          while ($row = mysqli_fetch_array($tmp)) {
                              $cid = $row['c_id'];
                              $query = "select * from user where u_id = '$cid'";
                              $ro = mysqli_fetch_array(mysqli_query($conn, $query));
                              $type;
                              if ($ro['u_type'] == 1) {
                                  $type = '인테리어';
                              } elseif ($ro['u_type'] == 2) {
                                  $type = '마케팅';
                              } elseif ($ro['u_type'] == 3) {
                                  $type = '홈페이지';
                              } elseif ($ro['u_type'] == 4) {
                                  $type = '자금대출';
                              } elseif ($ro['u_type'] == 5) {
                                  $type = '의료장비';
                              } elseif ($ro['u_type'] == 6) {
                                  $type = '의료 소모품,세무사 및 기타';
                              }
                              echo "
                            <tr>
                              <td>
                               
                              </td>
                              <td class=\"text_align_center\">$i</td>
                              <td class=\"text_align_center\">$type</td>
                              <td class=\"text_align_center\">$ro[u_name]</td>
                              <td>
                                <svg onclick=\"modalHomeProgress($cid)\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z\"/><path fill=\"none\" d=\"M0 0h24v24H0V0z\"/></svg>
                              </td>
                            </tr>
                            ";
                          }
                        ?>
          
                      
                      </tbody>
                    
                    </table>
                    <?php
                    if (mysqli_num_rows($tmp) == 0) {
                        echo '
                    <div class="row align-items-center justify-content-center" >
                        <div class="col-12 text_align_center color_b font_size_l"><br><br>즐겨찾기 기능은 출시예정입니다:)<br><br><br></div>
                    </div>
                    <div style="height: auto; width: 100%; border-bottom:1px solid;"></div>';
                    }
                    ?>
                  </div>

                  <!-- <div class="col-12 margin_top_m">
                    <div class="container">
                      <div class="row justify-content-between align-items-center">
                        <div class="button6">
                          선택삭제
                        </div>
                        <div>
                          <ul class="pagination">
                            <li class="page-item margin_left_ss font_size_m"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></a></li>
                            <li class="page-item margin_left_ss font_size_m"><a href="#">1</a></li>
                            <li class="page-item margin_left_ss font_size_m"><a href="#">2</a></li>
                            <li class="page-item margin_left_ss font_size_m"><a href="#">3</a></li>
                            <li class="page-item margin_left_ss font_size_m"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div> -->

                </div>
              </div>
            </div>
          </div>

          <div class="row margin_top_l">
            <div class="col-12">
              <div class="padding_l box_shadow back_w">
              <div class="font_size_ll">현재 <span class="font_weight_b"><?php echo $u_name?>님</span>의 개원상권분석 시스템 잔여 이용 횟수는 <span class="font_weight_b color_b"><?php echo $u_count?></span> 회 입니다.</div>

                <div class="margin_top_l font_size_l underline cursor_pointer"><a href = "change_pay.php" style="color:#2b2b2b; text-decoration:none">이용권 구매하기 ></a></div>
              </div>
            </div>
          </div>

        </div>
      </article>
    </section>


    <div id="mypage_home_modal" class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 1008px;width: 95%;margin: auto;">
        <div class="modal-content">
          <div class="modal-body position_relative" style="padding: 0">
            
            <div id="mypage_home_modal_result">
            </div>

            <div class="position_absolute" style="top: 20px; right: 20px;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
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