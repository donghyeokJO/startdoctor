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
  $login = true;

  if ($_GET['type']) {
      $formtype = $_GET['type'];
  }
  if ($formtype == '인테리어') {
      $form = 'f1_answer';
  } elseif ($formtype == '마케팅') {
      $form = 'f2_answer';
  } elseif ($formtype == '홈페이지') {
      $form = 'f3_answer';
  } elseif ($formtype == '자금대출') {
      $form = 'f4_answer';
  } elseif ($formtype == '의료장비') {
      $form = 'f5_answer';
  } elseif ($formtype == '의료소모품,세무사 및 기타') {
      $form = 'f6_answer';
  }
  $id = $_GET['id'];
  $query = "select * from $form where id='$id'";
  $ret = mysqli_query($conn, $query);
  $answer = mysqli_fetch_array($ret);
  $corp_id = $answer['corp_id'];
  $query = "select * from user where u_id ='$corp_id'";
  $tp = mysqli_query($conn, $query);
  $corp = mysqli_fetch_array($tp);
  $query = "select * from corp_info where corp_id ='$corp_id'";
  $tmp = mysqli_query($conn, $query);
  $corp_info = mysqli_fetch_array($tmp);
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
              <div class="col"><a href ="progress.php" style="color:#FFFFFF; text-decoration:none">개원노트</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="service.php" style="color:#FFFFFF; text-decoration:none">서비스</a><div class="line_b" style="border-width: 5px;"></div></div>
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
        }
        ?>
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
        <div class="container margin_top_l">
          <div class="row">
            <div class="col-12">
             <a href="service.php" style="text-decoration: none; color:#2b2b2b;">서비스</a> > <a href="estimate.php" style="text-decoration: none; color:#2b2b2b;">비교견적</a> > <a href="estimate_detail.php" style="text-decoration: none; color:#2b2b2b;">받은 견적</a>  <?php echo $formtype?>
            </div>
            <div class="col-12 font_size_xl font_weight_b margin_top_ss">
              <?php echo $formtype?>
            </div>
          </div>
        </div>

        <div class="container margin_top_l">
          <div class="row">
            <div class="col-12">
              <div class="back_w padding_m box_shadow">
                <div class="row">
                  <div class="col-8">
                    <div class="font_size_ll font_weight_b"><?php echo $corp['u_name']?></div>
                    <div class="margin_top_s color_g"><?php echo $corp_info['corp_desc']?></div>
                  </div>
                  <div class="col-4 text_align_right">
                    <div class="cursor_pointer">
                      <!-- <svg onclick="hoverLike(1, this)" class="fill_g" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                      <svg onclick="hoverLike(1, this)" class="fill_y display_none" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/><path d="M0 0h24v24H0z" fill="none"/></svg> -->
                    </div>
                    <div class="margin_top_s color_g"><?php echo $answer['date2']?></div>
                  </div>
                </div>
              </div>
              <div class="line"></div>
              <div class="back_w padding_m box_shadow">
                <div class="row">
                  <div class="col-12 font_weight_b">
                    <?php
                      echo nl2br($answer['content']);
                    ?>
                  </div>
                  <div class="col-12 margin_top_xl">
                    <?php
                      $link = './form_answers/' . $answer['file'];
                    ?>
                    <a href ="<?php echo $link?>" download>
                    <div class="display_inline_block color_b font_size_ll font_weight_b cursor_pointer" style="border-bottom: 2px solid #2f7cf7;">
                      견적서 다운받기
                      <svg class="fill_b" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg>
                    </div>
                    </a>
                  </div>
                  <div class="col-12 font_size_l margin_top_m">
                    <span class="cursor_pointer" onclick ="location.href='prepare_chat.php?u_id=<?php echo $u_id?>&corp_id=<?php echo $corp_id?>'">채팅으로 상담진행하기  ></span>
                    <span class="cursor_pointer margin_left_s" onclick ="alert('준비중인 서비스 입니다')">전화로 상담진행하기  ></span>
                  </div>
                  <div class="col-12 margin_top_l">
                    <div class="container back_g_l padding_m">
                      <div class="row">
                        <div class="col-12">
                          <?php
                            $img_src = './corp_images/' . $corp_info['logo'];
                          ?>
                          <img src=<?php echo $img_src?> style="width:287px;max-width: 100%;"/>
                        </div>
                        <div class="col-12 font_weight_b margin_top_m">
                          <?php echo $corp['u_name']?>
                        </div>
                        <div class="col-12 font_size_s color_g margin_top_m">
                          <?php echo $corp_info['det']?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container ">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="container">
                <div class="row padding_v_m border_bottom_g">
                  <div class="col-6">
                    <!-- <svg class="cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
                    <div class="display_inline_block cursor_pointer">이전</div>
                    <div class="display_inline_block cursor_pointer font_weight_b margin_left_m ellipsis" style="width: 50%">없음</div> -->
                  </div>
                  <div class="col-6 text_align_right">
                    <!-- <div class="display_inline_block cursor_pointer font_weight_b ellipsis" style="width: 50%">업체명2</div>
                    <div class="display_inline_block cursor_pointer margin_left_m">다음</div>
                    <svg class="cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 col-sm-3 margin_top_m">
              <div class="button" onclick ="location.href='estimate.php'">목록</div>
            </div>
          </div>
        </div>


      </article>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../script/common.js"></script>
    <script src="../script/mypage.js"></script>
    <script>
    </script>

  </body>
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
            대표 : 이승준<br/>
            소재지 :  서울특별시 강남구 강남대로 364 미왕빌딩 16층<br/>
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
</html>
