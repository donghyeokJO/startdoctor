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
  $u_id = $row['u_id'];
}

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-150475018-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-150475018-1');
  </script>
  <script type="text/javascript">
    (function(w, d, a) {
      w.__beusablerumclient__ = {
        load: function(src) {
          var b = d.createElement("script");
          b.src = src;
          b.async = true;
          b.type = "text/javascript";
          d.getElementsByTagName("head")[0].appendChild(b);
        }
      };
      w.__beusablerumclient__.load(a);
    })(window, document, '//rum.beusable.net/script/b190305e183506u693/504b7eefd4');
  </script>
  <meta charset="utf-8">
  <title>병원상권분석시스템</title>

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
  <style>
    .go_system {
      margin-top: 60px;
      width: 330px;
      height: 53px;
      border-radius: 27px;
      box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16);
      background-color: #2f7cf7;
      font-family: 'Noto Sans', sans-serif;
      font-size: 18px;
      font-weight: bold;
      font-stretch: normal;
      font-style: normal;
      line-height: 53px;
      letter-spacing: normal;
      text-align: center;
      color: #ffffff;
      cursor: pointer;
    }
    .go_system:hover {
      text-decoration: underline;
    }
    .go_tutorial {
      margin-top: -50px
    }
    @media(max-width: 800px) {
      .go_tutorial {
        margin-top: 20px
      }
    }
  </style>

</head>

<body>
  <header>
    <?php
    if (!$login) {
      echo '
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
        <div class="col text_align_center"><a href="../company/aboutus.php" style="color:#2B2B2B">스타트닥터</a></div>
        <div class="col text_align_center border_left"><a href="../company/system.php" style="color:#2B2B2B">개원상권분석시스템</a></div>
        <div class="col text_align_center border_left"><a href="../service/chat.php" style="color:#2B2B2B">상담채팅</a></div>
        <div class="col text_align_center border_left"><a href="../service/estimate.php" style="color:#2B2B2B">비교견적</a></div>
        <div class="col text_align_center border_left"><a href="../service/seminar.php" style="color:#2B2B2B">개원세미나</a></div>
      </div>
    </div>
  </nav>
  <nav id="nav_small">
    <div>
      <div class="title"><a href="/main/index.php" style="color:#2b2b2b; text-decoration:none">STARTDOCTOR</a></div>
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
        echo '        
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
        <div class="link"><a href="../company/opinion.php" style="color:#2B2B2B">의견남기기</a></div>
        <div class="link"><a href="../company/notice.php" style="color:#2B2B2B">공지사항</a></div>
        <div class="link"><a href="../company/faq.php" style="color:#2B2B2B">FAQ</a></div>
      </div>
      <div class="close" onclick="hoverNavigation()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
          <path d="M0 0h24v24H0z" fill="none" /></svg>
      </div>
    </div>
  </nav>

  <section class="image" style="background-image: url(../assets/section_back.png);background-repeat: repeat;">
    <article>
      <div class="container">
        <div class="row align-items-center header_title_height">
          <div class="col-12 text_align_center color_w font_size_xl font_weight_b">개원상권분석시스템</div>
        </div>
      </div>
    </article>
  </section>
  <section class="back_g_l" style="min-height: 100vh;">
    <article>
      <div class="container margin_top_xl">
        <div class="row justify-content-center">
          <div class="col-12"><a href="../main/index.php" style="text-decoration: none; color: #2b2b2b;">HOME</a> > <a href="system.php" style="text-decoration: none; color: #2b2b2b;">개원상권분석시스템</a></div>

          <div class="col-12 margin_top_m text_align_center font_size_ll font_weight_b margin_top_xl">
            알아보고 계신 개원자리, 과연 좋을까요?
          </div>
          <div class="col-12 col-sm-7 margin_top_l">
            <div class="image border_g" style="background-image: url(../assets/0_main_system.png); height: 100%;"></div>
          </div>
          <div class="col-12 col-sm-5 margin_top_l">
            스타트닥터의 개원상권분석시스템은 포괄적인 산업 및 업종을 타겟팅한 기존의 상권분석의 틀에서 벗어나, 최초로 의료계에 특화된 빅데이터 기술을 활용한 상권분석 시스템입니다.<br />
            최대 광역시 단위에서 최소 500m 단위까지, 지역별 특성과 인구-환자 데이터를 다각도로 분석한 병의원 특화 시스템을 통해, 해당 장소가 나에게 맞는 곳인지, 해당 장소의 인구력, 경쟁력, 접근성의 수준은 어느 정도인지 직관적으로 파악하실 수 있습니다.
          </div>

          <div class="col-12 line margin_top_l"></div>

          <div class="col-12 margin_top_l text_align_center font_weight_b font_size_ll">스타트닥터만의 인공지능 시스템이 제공하는 <span class="color_b">DATA</span></div>
          <div class="col-12 col-sm-4 margin_top_l">
            <div class="box_shadow text_align_center back_w padding_m">
              <div class="color_g font_size_s">지역, 시간대별로 존재하는</div>
              <div class="color_b font_size_l font_weight_b margin_top_s">생활 인구수</div>
              <div class="image margin_top_m" style="background-image: url(../assets/analytics_1.png); background-size: cover; background-repeat: no-repeat; width: 100%; height: 220px;"></div>
            </div>
          </div>
          <div class="col-12 col-sm-4 margin_top_l">
            <div class="box_shadow text_align_center back_w padding_m">
              <div class="color_g font_size_s">의료계의 특화된 빅데이터로 분석한</div>
              <div class="color_b font_size_l font_weight_b margin_top_s">인구-환자분석 시스템</div>
              <div class="image margin_top_m" style="background-image: url(../assets/analytics_2.png); background-size: cover; background-repeat: no-repeat;width: 100%; height: 220px;"></div>
            </div>
          </div>
          <div class="col-12 col-sm-4 margin_top_l">
            <div class="box_shadow text_align_center back_w padding_m">
              <div class="color_g font_size_s">각종 알고리즘을 기반으로 한</div>
              <div class="color_b font_size_l font_weight_b margin_top_s">최적의 개원 프로세스 제공</div>
              <div class="image margin_top_m" style="background-image: url(../assets/analytics_3.png); background-size: cover; background-repeat: no-repeat; width: 100%; height: 220px;"></div>
            </div>
          </div>
          <?php
          if (!$login) {
            echo "<div class=\"go_system\" onclick=\"location.href='../member/signin.html'\">상권분석시스템 이용하러가기 ></div>";
            echo "<div class=\"go_tutorial\" onclick=\"location.href='../member/signin.html'\">사용법 보러가기 ></div>";
          } else {
            echo "<div class=\"go_system\" onclick=\"gotoanal();\">상권분석시스템 이용하러가기 ></div>";
            echo "<div class=\"go_tutorial\" onclick=\"location.href='../member/tutorial.php'\">사용법 보러가기 ></div>";
          }
          ?>
        </div>
      </div>
    </article>
  </section>



  <?php
  if (!$login) {
    echo '
        <div class="text_align_center font_weight_b font_size_l padding_v_l cursor_pointer" style="width: 100%; position: fixed;bottom:0; background-color: rgba(0,0,0,0.75); color:#fff;z-index: 11;" onclick="alert(\'로그인이 필요합니다\'); window.open(\'../service/signin.html\',\'sign_in\',\'width=400,height=600,left=100,top=50\')">
        개원상권분석시스템 사용하러가기 >
      </div>';
  } else {
    echo "
        <form method = \"POST\" name =\"analyform\" id = \"analyform\" action =\"http://commercial-env.apkxyagrzb.ap-northeast-2.elasticbeanstalk.com/user/user_login/\">
          <input type = \"hidden\" name=\"u_id\" value = \"$u_id\"/>
          </form>
          <div class=\"text_align_center font_weight_b font_size_l padding_v_l cursor_pointer\" style=\"width: 100%; position: fixed;bottom:0; background-color: rgba(0,0,0,0.75); color:#fff;z-index: 11;\" onclick=\"gotoanal()\">
          개원상권분석시스템 사용하러가기 >
        </div>";
  }
  ?>
  <?php
  //   if($login){
  //     echo "
  //   <div class=\"text_align_center font_weight_b font_size_l padding_v_l cursor_pointer\" style=\"width: 100%; position: fixed;bottom:0; background-color: rgba(0,0,0,0.5); color:#fff;\" onclick =\"gotoanal()\">
  //     개원상권분석시스템 사용하러가기 >
  //   </div>";
  //   }
  //   else {
  //     echo " <div class=\"text_align_center font_weight_b font_size_l padding_v_l cursor_pointer\" style=\"width: 100%; position: fixed;bottom:0; background-color: rgba(0,0,0,0.5); color:#fff;\" onclick =\" alert('로그인 해주세요!'); location.href='../member/signin.html';\">
  //   개원상권분석시스템 사용하러가기 >
  // </div>"
  ?>


  <footer id="footer">
    <div id="footer_01" class="tablet">
      <div class="row align-items-center" style="height: 40px;">
        <div class="col text_align_center"><a href="../company/aboutus.php" style="color:#FFFFFF">스타트닥터</a></div>
        <div class="col text_align_center border_left"><a href="../company/system.php" style="color:#FFFFFF">개원상권분석시스템</a></div>
        <div class="col text_align_center border_left"><a href="../service/chat.php" style="color:#FFFFFF">상담채팅</a></div>
        <div class="col text_align_center border_left"><a href="../service/estimate.php" style="color:#FFFFFF">비교견적</a></div>
        <div class="col text_align_center border_left"><a href="../service/seminar.php" style="color:#FFFFFF">개원세미나</a></div>
      </div>
    </div>
    <div id="footer_02">
      <div class="row justify-content-start align-items-between">
        <div class="col-12 col-sm-6 font_size_xl font_weight_b"><a href="/main/index.php" style="text-decoration:none; color:#FFFFFF">STARTDOCTOR</a></div>
        <div class="col-12 col-sm-5" style="line-height: 1.79;">
          Tel. 050 7343 2605<br />
          E-mail. support@eszett.co.kr<br />
          상호 : 에스체트(eszett)<br />
          대표 : 이승준 <br />
          소재지 : 서울특별시 강남구 강남대로 364 미왕빌딩 16층<br />
          사업자등록번호 : 308-13-51102
        </div>
        <div class="col-12 col-sm-1 tablet" onclick="positionToTop()">
          <svg class="cursor_pointer" style="fill: #fff;transform: rotate(270deg);width: 50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" /></svg>
        </div>
        <div class="col-12 col-sm-5 margin_top_l mobile">
          <span><a href="../member/privacy.html" style="color:#FFFFFF">개인정보취급방침</a></span><span style="padding: 0 10px">|</span><span><a href="../member/terms.html" style="color:#FFFFFF">이용약관</a></span>
        </div>
        <div class="col-12 col-sm-6 margin_top_l">
          Copyright ⓒ 2019 eszett All Rights Reserved
        </div>
        <div class="col-12 col-sm-5 margin_top_l tablet">
          <span><a href="../member/privacy.html" style="color:#FFFFFF">개인정보취급방침</a></span><span style="padding: 0 10px">|</span><span><a href="../member/terms.html" style="color:#FFFFFF">이용약관</a></span>
        </div>
      </div>
      <div class="col-12 col-sm-1 mobile" onclick="positionToTop()" style="position: absolute;top: 32px;text-align: right;">
        <svg class="cursor_pointer" style="fill: #fff;transform: rotate(270deg);width: 50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z" /></svg>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="../script/common.js"></script>
  <script src="../script/company.js"></script>
  <script>
    function gotoanal() {

      $('#analyform').submit();
    }
  </script>
</body>

</html>