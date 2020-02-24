
<?php
  include 'header.php';
    // include 'config.php';
    // include 'util.php';

  session_start();
  $login = false;
  if (!isset($_SESSION['u_email'])) {
      // s_msg('로그인 해주세요');
        // echo "<meta http-equiv='refresh' content='0;url=../../member/signin.html'>";
  } else {
      $login = true;
      $u_email = $_SESSION['u_email'];
      $conn = dbconnect($host, $dbid, $dbpass, $dbname);
      $user = mysqli_query($conn, "select * from user natural join checklist where u_email='$u_email'");
      $row = mysqli_fetch_assoc($user);
      $u_name = $row['u_name'];
      $u_specify = $row['u_specify'];
      $percentage = $row['percentage'];
      $u_rank = $row['u_rank'];
  }

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
    <?php
    if (!$login) {
        echo'
      <div class="container">
        <div class="row align-items-center" style="height: 86px;">
          <div class="col-4">
            <svg class="cursor_pointer" onClick="hoverNavigation()" style="width:36px;height:36px;fill: #fff;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
          </div>
          
          <div class="col-4 text_align_center">
          <a href = "/main/index.php" >
            <img style="width: 120px;" src="../assets/logo.png" title="스타트닥터 로고" />
            </a>
          </div>
          
          <div class="col-4 text_align_right">
            <div class="tablet color_w">
              <span class="cursor_pointer"><a href = "../member/signin.html" style = "color:#FFFFFF">로그인</a></span>
              <span class="margin_left_s">|</span>
              <span class="cursor_pointer margin_left_s"><a href = "../member/signup.html" style = "color:#FFFFFF">회원가입</a></span>
            </div>
            <div class="mobile">
              <a href = "../member/signin.html">
              <svg xmlns="http://www.w3.org/2000/svg" style="fill:#fff; width: 30px;" viewBox="0 0 24 24"><path d="M12 5.9c1.16 0 2.1.94 2.1 2.1s-.94 2.1-2.1 2.1S9.9 9.16 9.9 8s.94-2.1 2.1-2.1m0 9c2.97 0 6.1 1.46 6.1 2.1v1.1H5.9V17c0-.64 3.13-2.1 6.1-2.1M12 4C9.79 4 8 5.79 8 8s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 9c-2.67 0-8 1.34-8 4v3h16v-3c0-2.66-5.33-4-8-4z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>';
    } else {
        echo "
      <div class=\"container position_relative\">
      <div class=\"row align-items-center\" style=\"height: 86px;\">
        <div class=\"col-4\">
          <svg class=\"cursor_pointer\" onClick=\"hoverNavigation()\" style=\"width:36px;height:36px;fill: #fff;\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z\"/></svg>
        </div>
        <div class=\"col-4 text_align_center\">
        <a href = \"/main/index.php\" >
        <img style=\"width: 120px;\" src=\"../assets/logo.png\" title=\"스타트닥터 로고\" />
        </a>
        </div>
        <div class=\"col-4 text_align_right\">
          <div class=\"color_w\">
            <svg onclick=\"hoverAlarm()\" class=\"fill_w cursor_pointer\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M0 0h24v24H0z\" fill=\"none\"/><path d=\"M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z\"/></svg>
            <svg onclick=\"hoverMemberDesc()\" class=\"fill_w margin_left_s cursor_pointer\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z\"/><path d=\"M0 0h24v24H0z\" fill=\"none\"/></svg>
            <div onclick=\"hoverMemberDesc()\" class=\"display_inline_block margin_left_s cursor_pointer tablet\">
              <div class=\"display_inline_block\">$u_name 님</div>
              <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"fill_w\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z\"/><path fill=\"none\" d=\"M0 0h24v24H0V0z\"/></svg>
            </div>
          </div>
        </div>
      </div>
      
      <div id=\"member_desc\" class=\"display_none\"> 
        <div class=\"container\">
          <div class=\"row justify-content-between align-items-center\">
            <div class=\"col-6\"><div class=\"tag3\">$u_rank</div></div>
            <div class=\"col-3 text_align_right\" onclick=\"hoverMemberDesc()\">
              <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z\"></path><path d=\"M0 0h24v24H0z\" fill=\"none\"></path></svg>
            </div>
            <div class=\"col-12 font_size_xxl\">$u_name 님</div>
            <div class=\"col-12 margin_top_l\">
              나의 개원진행률
              <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z\"/><path fill=\"none\" d=\"M0 0h24v24H0V0z\"/></svg>
            </div>
            <div class=\"col-12 margin_top_s\">
              <div class=\"percentage margin_top_ss\">
                <div>
                  <div style=\"width: $percentage%\">
                    <div>$percentage%</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=\"container\">
          <div class=\"row\">";
        if ($u_specify == '의사') {
            echo '<div class="col-6 button9"><a href="../mypage/home.php" style="color:#2B2B2B">마이페이지</div>';
        } else {
            echo '<div class="col-6 button9"><a href="../mypage/business.php" style="color:#2B2B2B">마이페이지</div>';
        }
        echo '
            <div class="col-6 button9"><a href="../member/logout.php" style="color:#2B2B2B">로그아웃</a></div>
          </div>
        </div>
      </div>
      
      <div id="pop_alarm" class="display_none position_absolute back_w box_shadow" style="right: 80px;z-index: 71;width: 360px;">
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
       
          </div>
        </div>
      </div>

    </div>
      ';
    }
    ?>
    </header>
  <div class="ploting_banner" onclick="location.href='https://pf.kakao.com/_xeIrFj'">
    <img src="../assets/kakao_banner.png" width="60px" height="60px">
  </div>
    <nav id="nav_wide" class="back_g_l tablet">
      <div class="container">
        <div class="row align-items-center" style="height: 40px;">
          <div class="col text_align_center"><a href = "../company/aboutus.php" style = "color:#2B2B2B">스타트닥터</a></div>
          <div class="col text_align_center border_left"><a href = "../company/system.php" style = "color:#2B2B2B">개원상권분석시스템</a></div>
          <div class="col text_align_center border_left"><a href = "../service/chat.php" style = "color:#2B2B2B">상담채팅</a></div>
          <div class="col text_align_center border_left"><a href = "../service/estimate.php" style = "color:#2B2B2B">비교견적</a></div>
          <div class="col text_align_center border_left"><a href = "../service/seminar.php" style = "color:#2B2B2B">개원세미나</a></div>
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
            if ($u_specify == '의사') {
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
   
    
    <section class="image" style="background-image: url(../assets/section_back.png);background-repeat: repeat;">
      <article>
        <div class="container">
          <div class="row align-items-center header_title_height">
            <div class="col-12 text_align_center color_w font_size_xl font_weight_b">스타트닥터</div>
          </div>
        </div>
      </article>
    </section>

    <section class="back_g_l" style="min-height: 100vh;">
      <article>
        <div class="container margin_top_xl">
          <div class="row justify-content-end">
            <div class="col-12"><a href="../main/index.php" style="text-decoration: none; color: #2b2b2b;">HOME</a> > <a href="aboutus.php" style="text-decoration: none; color: #2b2b2b;">스타트닥터</a></div>
          </div>
        </div>
      </article>

      <article>
        <!-- <div class="container margin_top_xl">
          <div class="row">
            <div class="col-12 text_align_center">
              <span class="color_w back_p padding_m font_size_xl font_weight_b">#슬로건</span>
            </div>
            <div class="col-12 text_align_center margin_top_l">
              <span class="color_b font_size_ll font_weight_b">WE CARE YOU</span>
            </div>
            <div class="col-12 text_align_center margin_top_m">
              <span>케어하는 의사는 많지만, 케어받는 의사는 없습니다. 우리는 성공적인 병원 개원을 돕는 리얼 플랫폼입니다.</span>
            </div>
            <div class="col-12 text_align_center margin_top_m">
              <div class="image mr-auto ml-auto" style="background-image: url(../assets/section_back.png); height: 222px; width: 95%;"></div>
            </div>
            <div class="col-12 margin_top_l line"></div>
          </div> -->

          <div class="row margin_top_xxl">
            <div class="col-12 text_align_center">
              <span class="color_w back_p padding_m font_size_xl font_weight_b">BRAND VISION</span>
            </div>
            <div class="col-12 text_align_center margin_top_l">
              <span class="color_b font_size_ll font_weight_b">복잡한 일은 쉽고 빠르게</span>
            </div>
            <div class="col-12 text_align_center margin_top_m">
              <span>병원을 개원할때 고려해야 하는 사항들은 수도없이 많습니다. 스타트닥터는 복잡한 개원 절차를 편리하고 쉽게 만드는 원스톱 솔루션을 제공합니다.</span>
            </div>
            <div class="col-12 margin_top_xxl line"></div>
          </div>

          <div class="row margin_top_xxl">
            <div class="col-12 text_align_center">
              <span class="color_w back_p padding_m font_size_xl font_weight_b">기업 문화</span>
            </div>
            <div class="col-12 text_align_center margin_top_l">
              <span class="color_b font_size_ll font_weight_b">pursue bravery, avoid temerity!</span>
            </div>
            <div class="col-12 text_align_center margin_top_m">
              <span>스타트닥터는 무모함을 피하고, 용감함을 추구합니다. 용감함과 무모함의 차이는 ‘논리’에 있습니다. 우리는 ‘논리’에 따라 행동하고, 앞으로 나아갑니다.</span>
            </div>
            <div class="col-12 margin_top_m">
              <div class="image mr-auto ml-auto" style="background-image: url(../assets/1.company_about.jpg); height: 222px; width: 100%;"></div>
            </div>
            
            <div class="col-12 margin_top_xxl line"></div>
          </div>

          <div class="row margin_top_xxl">
            <div class="col-12 text_align_center">
              <span class="color_w back_p padding_m font_size_xl font_weight_b">#서비스의 가치</span>
            </div>
          </div>
          <div class="row margin_top_xl">
            <div class="col-12 col-sm-4 margin_top_m">
              <div class="back_w box_shadow padding_m text_align_center" style="min-height: 130px;">
                <div class="color_b font_size_ll font_weight_b">Technical support</div>
                <div class="font_size_s margin_top_m">스타트닥터만의 차별화된 기술로 성공적인 개원을 돕습니다.
                  </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 margin_top_m">
              <div class="back_w box_shadow padding_m text_align_center" style="min-height: 130px;">
                <div class="color_b font_size_ll font_weight_b">One shot, one cue</div>
                <div class="font_size_s margin_top_m">복잡한 개원 절차를, 스타트닥터로 한 번에 해결합니다.
                  </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 margin_top_m">
              <div class="back_w box_shadow padding_m text_align_center" style="min-height: 130px;">
                <div class="color_b font_size_ll font_weight_b">Detailed customizing </div>
                <div class="font_size_s margin_top_m">고객에게 최적화된 정보를 제공합니다.
                  </div>
              </div>
            </div>
            <div class="col-12 margin_top_xxl line"></div>
          </div>
          <!-- <div class="row margin_top_xxl justify-content-center">
            <div class="col-12 text_align_center">
              <span class="color_w back_p padding_m font_size_xl font_weight_b">#브랜드 로고, 컬러</span>
            </div>
            <div class="col-6 text_align_center margin_top_xl">
              다른 모든 색을 뛰어넘는 빛나고 아름답고 완벽한 색.<br/>
              어느 누구도 이 색에 대해 말할 수 없고, 이것으로 아무것도 할 수 없다.<br/>
              이 색의 질은 여전히 독보적으로 뛰어나다.<br/>
              ―첸니노 첸니니, 『예술의 서Il libro dell’arte』 中, 1400년경
            </div>
            <div class="col-12 text_align_center margin_top_l margin_bottom_xl">
              <div class="image mr-auto ml-auto" style="background-image: url(../assets/section_back.png); height: 222px; width: 100%;"></div>
            </div>
          </div> -->
        </div>
      </article>
    </section>
    <!-- <section class="back_p">
      <article>
        <div class="container">
          <div class="row">
            <div class="col-12 color_w font_weight_b font_size_ll padding_v_xxl text_align_center">스타트닥터는 개원 분야에서 독보적인 기술력으로 최상의 결과를 창출합니다.</div>
          </div>
        </div>
      </article>
    </section> -->
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
    <div class="background_layer display_none" onclick="hoverNavigation()"></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../lib/owlCarousel2/owl.carousel.min.js"></script>
    <script src="../script/map.js"></script>
    <script src="../script/dashboard.js"></script>
    <script src="../script/common.js"></script>
    <script src="../script/main.js"></script>
  </body>
</html>