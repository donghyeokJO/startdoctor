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
    $u_email = $_SESSION['u_email'];
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from user where u_email = '$u_email'";
    $ret = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ret);
    $u_specify = $row['u_specify'];
    $u_name = $row['u_name'];
    if ($u_specify == '의사') {
        $user = mysqli_query($conn, "select * from user natural join checklist where u_email='$u_email'");
        $row = mysqli_fetch_assoc($user);
        $percentage = $row['percentage'];
        $u_rank = $row['u_rank'];
        $u_specify = $row['u_specify'];
        $login = true;
        $u_id = $row['u_id'];
    } elseif ($u_specify == '업체') {
        echo '<script>location.href="../mypage/business.php";</script>';
    }
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
  <meta charset="utf-8">
  <title>스타트닥터 | No.1 병원상권분석 마케팅 기업</title>

  <meta name="author" content="스타트닥터">
  <meta name="description" content="스타트닥터는 병원에 특화된 상권분석부터 상담채팅 비교견적 마케팅서비스를 제공합니다.">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:image" content="http://startdoctor.net/assets/ogimage.png">
  <meta property="og:type" content="website">
  <meta property="og:description" content="스타트닥터는 병원에 특화된 상권분석부터 상담채팅 비교견적 마케팅서비스를 제공합니다.">
  <meta property="og:url" content="https://www.startdoctor.net">
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
  <link rel="stylesheet" href="../css/index_service.css">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">

</head>

<body onload="popup()">
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
    <img src="../assets/kakao_banner.png" width="85" height="69" style="position: absolute; top: 38px; left: 32px; width: 160%; height: auto;">
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

  <?php
  if (!$login) {
      echo '
    
    <section id="first_section" style="background-color:#fcfcfc">
      <article id="article_01">
        <div class="row align-items-center" style="width: 100%;">
          <div class="col-12 col-md-5">
            <div class="title">
              <b>스타트닥터</b>와 함께라면,
              개원은 어렵지않습니다.
            </div>
            <div class="desc">
              상권분석부터 전문업체와의 상담과 비교견적까지.
              이제 스타트닥터에서 쉽게 개원하세요.
            </div>
          </div>
          <img src ="../assets/0_main_1.gif" alt ="Startdoc Progress Bar" class ="col-12 col-md-5" />
        </div>
      </article>
    </section>';
  } else {
      echo " 
      <section id=\"first_section\">
        <article id=\"article_12\" class=\"padding_m padding_v_xxl\">
          <div class=\"row align-items-center\">
            <div class=\"col-12 font_size_xxl\">
              안녕하세요, $u_name 님
            </div>
            <div class=\"col-12 font_size_xxl\">
              <b>AI 개원노트</b>가 회원님의 개원 진행상황을 알려드립니다. 
            </div>
  
            <div class=\"col-12 margin_top_l font_size_l\" onclick =\"location.href='../mypage/progress.php';\" style=\"cursor:pointer\">
              $u_name 님의 현재 진행률
              <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z\"/><path fill=\"none\" d=\"M0 0h24v24H0V0z\"/></svg>
            </div>
            <div class=\"col-12 margin_top_s\">
              <div class=\"percentage percentage_big margin_top_ss\">
                <div>
                  <div style=\"width: $percentage%\">
                    <div>$percentage%</div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </article>
      </section>";
  }
  ?>

  <section id="second_section">
    <article id="article_02">
      <div>
        <div class="font_size_xl">어떤 서비스가 궁금하신가요?</div>
        <div>
          <div class="tag" onclick="moveto('05')">#개원상권분석</div>
          <div class="tag" onclick="moveto('06')">#상담채팅</div>
          <div class="tag" onclick="moveto('07')">#업체매칭</div>
          <div class="tag">#AI개원노트</div>
          <div class="tag" onclick="moveto('10')">#카톡_플러스친구</div>
          <div class="tag" onclick="moveto('07')">#마케팅</div>
          <div class="tag" onclick="moveto('07')">#의료장비</div>
          <div class="tag" onclick="moveto('07')">#자금대출</div>
          <div class="tag" onclick="moveto('08')">#기타</div>
        </div>
        <div class="desc">원하는 서비스가 없으신가요? 궁금하신 점을 바로 문의해주세요!</div>
        <div class="link">문의하기 ></div>
      </div>
    </article>
  </section>

  <section id="third_section" class="margin_top_m">
    <article id="article_03">
      <div>
        <div class="font_size_m"><b class="font_size_xl">병원 개원 연구소</b></div>
        <div class="subtitle">공공 데이터를 분석하여 개원에 필요한 인사이트를 얻습니다.</div>

        <div id="slider" class="owl-carousel owl-theme margin_top_l">
          <div class="item"><img src="../assets/article_03_01.png" /></div>
          <div class="item"><img src="../assets/article_03_02.png" /></div>
          <div class="item"><img src="../assets/article_03_03.png" /></div>
          <div class="item"><img src="../assets/article_03_04.png" /></div>
          <div class="item"><img src="../assets/article_03_05.png" /></div>
          <div class="item"><img src="../assets/article_03_06.png" /></div>
          <div class="item"><img src="../assets/article_03_07.png" /></div>
          <div class="item"><img src="../assets/article_03_08.png" /></div>
        </div>
      </div>

    </article>
  </section>

  <section id="forth_section">
    <article id="article_04">
      <div>
        <div class="font_size_xl"><b>개원,</b> 어디까지 준비하셨나요?</div>
        <div class="desc">이제 스타트닥터에서 원스톱으로 개원하세요!</div>
        <div class="step_area row">
          <div class="step col-12 col-md-3" style="cursor: pointer;" onclick="location.href='../company/system.php'">
            <div class="image" style="background-image: url(../assets/step_01.png)"></div>
            <div class="text_area">
              <div class="title">STEP 1</div>
              <div class="desc">개원상권분석으로내 병원 자리 찾기</div>
              <hr />
            </div>
          </div>
          <div class="step col-12 col-md-3" style="cursor: pointer;" onclick="location.href='../service/chat.php'">
            <div class="image" style="background-image: url(../assets/step_02.png)"></div>
            <div class="text_area">
              <div class="title">STEP 2</div>
              <div class="desc">상담채팅으로 전문가에게 바로 문의</div>
              <hr />
            </div>
          </div>
          <div class="step col-12 col-md-3" style="cursor: pointer;" onclick="location.href='../service/estimate.php'">
            <div class="image" style="background-image: url(../assets/step_03.png)"></div>
            <div class="text_area">
              <div class="title">STEP 3</div>
              <div class="desc">업체비교견적으로 한번에 업체비교</div>
              <hr />
            </div>
          </div>
          <div class="step col-12 col-md-3">
            <div class="image" style="background-image: url(../assets/step_plus.png)"></div>
            <div class="text_area">
              <div class="title">PLUS</div>
              <div class="desc">마케팅, 직원관리도 빅데이터 기술로!</div>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </article>
  </section>

  <!-- <section id="fifth_section" class="image_repeat" style="background-image: url('../assets/background-repeat.png'); background-size: 300px;"> -->
  <section id="fifth_section" class="image_repeat" style="background-image: url(''); background-size: 300px; background-color:#ffffff">
    <article id="article_05" class="slideUp">
      <div class="step_big">STEP 1</div>
      <div class="title"><b>내가 알아본 개원 자리, 과연 좋을까?</b><br />오로지 병원개원에 특화된 상권분석으로 내게 맞는 개원 자리를 찾아보세요!</div>
      <div class="desc">스타트닥터는 병・의원 개원 시, 최적화된 경영 환경을 제공해주는 개원 토탈 서비스 입니다. <br />에스체트 자체의 빅데이터 수집 자동화 알고리즘, 머신러닝 분석 알고리즘 기반으로 고객에게 최적의 개원 환경을 제공하고 있습니다.</div>
      <!-- <div id="map"></div> -->
      <div class="image" style="background-image: url(../assets/0_main_system.png)"></div>
      <div class="margin_top_l">
        <?php
        if (!$login) {
            echo '
         <div class="button">
            <svg xmlns="http://www.w3.org/2000/svg" style="fill:#fff;margin-right: 20px;" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
            <a href="#" style="color:#FFFFFF" onclick="window.alert(\'로그인 해주세요\');location.href=\'../member/signin.html\';">무료 개원상권분석 시스템 바로가기 ></a>
          </div>
        </div>';
        } else {
            echo
            "<form method = \"POST\" name =\"analyform\" id = \"analyform\" action =\"http://commercial-env.apkxyagrzb.ap-northeast-2.elasticbeanstalk.com/user/user_login/\">
            <input type = \"hidden\" name=\"u_id\" value = \"$u_id\"/>";
            echo
            '<a href="#" style="color:#FFFFFF; text-decoration:none" onclick = "gotoanal()">
          <div class="button">
            <svg xmlns="http://www.w3.org/2000/svg" style="fill:#fff;margin-right: 20px;" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
            무료 개원상권분석 시스템 바로가기 >
          </div>
          </a>';
        }
        ?>
    </article>
    <article id="article_06" class="slideUp">
      <div class="step_big">STEP 2</div>
      <div class="title"><b>상담채팅</b>으로 전문가에게 바로 질문하세요!</div>
      <div class="image" style="background-image: url(../assets/article_06_01.png)"></div>
      <div class="desc">
        각 분야의 병원전문업체들의 다양한 답변을 받아보실 수 있습니다. 마케팅부터 인테리어, 홈페이지, 자금대출, 의료장비 그리고 그 외에 개원과 관련된 내용이라면 무엇이든 질문하실 수 있습니다. 지금 바로 스타트닥터에 회원가입하시고 무료상담 받아보세요!
      </div>
      <div class="margin_top_l">
        <?php
        if (!$login) {
            echo '
            <a href="../member/signup.html" style="color:#FFFFFF;text-decoration:none"> 
            <div class="button" style="background-color: #000;">
           무료 회원가입 하고 바로 문의하기 >
          </div>
          </a>';
        } else {
            echo '
            <a href="../service/chat_info.php" style="color:#FFFFFF;text-decoration:none">
            <div class="button" style="background-color: #000;">
          바로 문의하기 >
        </div>
        </a>';
        }
        ?>
      </div>
    </article>

    <article id="article_07" class="slideUp">
      <div id="comp" class="step_big">STEP 3</div>
      <div class="title">지금 바로 <b>업체비교견적</b> 받으세요!</div>
      <div class="desc">
        업체 선택, 고민이 많으셨죠? 이제 스타트닥터에서 견적서를 쉽게 받아보세요!<br />
        찾으시려는 분야를 선택해주시고, 간단한 정보만 입력하면 끝! 견적서가 오는대로 말씀드리겠습니다!
      </div>

      <?php
      if (!$login) {
          echo '
              <div class="button_area row justify-content-between">
         
          <div class="button2 col-12 col-sm-6 row align-items-center justify-content-between margin_top_s">
            <div class="col-10">
              <a href = "#" style ="color:#2b2b2b; text-decoration:none"onclick ="window.alert(\'로그인 해주세요\');;location.href=\'../member/signin.html\';">
              <div class="title">상담부터 진행하기</div>
              <div class="font_size_m">궁금하신 점에 대해 친절하게 상담해드립니다.
              편하게 질문해주세요.</div>
              </a>
            </div>
            <svg class="col-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
          </div>
         
          <div class="button2 col-12 col-sm-6 row align-items-center justify-content-between margin_top_s">
            <div class="col-10">
              <a href = "#" style ="color:#2b2b2b; text-decoration:none"onclick ="window.alert(\'로그인 해주세요\');;location.href=\'../member/signin.html\';">
              <div class="title">바로 견적서 받기</div>
              <div class="font_size_m">진행하시려는 분야를 선택해주세요. 최대 6곳의 견적서를 보내드립니다:)</div>
              </a>
            </div>
            <svg class="col-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
          </div>
          </div>';
      } else {
          echo '
            <div class="button_area row justify-content-between">
       
            <div class="button2 col-12 col-sm-6 row align-items-center justify-content-between margin_top_s">
              <div class="col-10">
                <a href = "../service/chat.php" style ="color:#2b2b2b; text-decoration:none">
                <div class="title">상담부터 진행하기</div>
                <div class="font_size_m">궁금하신 점에 대해 친절하게 상담해드립니다.
                편하게 질문해주세요.</div>
                </a>
              </div>
              <svg class="col-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
            </div>
          
            <div class="button2 col-12 col-sm-6 row align-items-center justify-content-between margin_top_s">
              <div class="col-10">
                <a href = "../service/estimate.php" style ="color:#2b2b2b; text-decoration:none">
                <div class="title">바로 견적서 받기</div>
                <div class="font_size_m">진행하시려는 분야를 선택해주세요. 최대 6곳의 견적서를 보내드립니다:)</div>
                </a>
              </div>
              <svg class="col-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
            </div>
            </div>';
      }
      ?>

    </article>
    <article id="article_08" class="slideUp">
      <div class="row justify-content-between">
        <div class="step_big col-12 col-sm-2 margin_top_m" style="background-color: #fff; color: inherit;left: 0;padding-left: 0;">+ PLUS</div>
        <div class="col-12 col-sm-5">
          <div class="title">개원 중에도, 개원 후에도 <b>스타트닥터</b>와 함께하세요</div>
        </div>
        <div class="col-12 col-sm-5">
          <div class="desc">
            개원 후 마케팅, 직원관리도 빅데이터 기술로!<br />
            스타트닥터와 함께라면, 개원 후에도 든든합니다.
            <a href="https://pf.kakao.com/_xeIrFj" style="color:#2B2B2B; text-decoration:none">
              <div class="button3"> 문의 하러가기 > </div>
            </a>
          </div>
        </div>
      </div>
      <div class="row justify-content-between" style="margin-top: 74px;">
        <div class="col-12 col-md-4 item">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" /></svg>
          <div>
            <div class="title">빅데이터 기반정보</div>
            <div class="desc">개원 후에도 스타트닥터 상권분석시스템으로 개원자리의 정보를 계속 받아보실 수 있습니다.</div>
            <hr />
          </div>
        </div>
        <div class="col-12 col-md-4 item">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
            <g id="Bounding_Box">
              <rect fill="none" width="24" height="24" />
            </g>
            <g id="Flat">
              <g id="ui_x5F_spec_x5F_header_copy_2"></g>
              <path d="M11.99,2C6.47,2,2,6.48,2,12c0,5.52,4.47,10,9.99,10C17.52,22,22,17.52,22,12C22,6.48,17.52,2,11.99,2z M8.5,8   C9.33,8,10,8.67,10,9.5S9.33,11,8.5,11S7,10.33,7,9.5S7.67,8,8.5,8z M12,18c-2.28,0-4.22-1.66-5-4h10C16.22,16.34,14.28,18,12,18z    M15.5,11c-0.83,0-1.5-0.67-1.5-1.5S14.67,8,15.5,8S17,8.67,17,9.5S16.33,11,15.5,11z" />
            </g>
          </svg>
          <div>
            <div class="title">마케팅</div>
            <div class="desc">병원운영시 문제가 있으신가요? 스타트닥터의 전문 컨설턴트가 진단해드립니다.</div>
            <hr />
          </div>
        </div>
        <div class="col-12 col-md-4 item">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heartbeat" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-heartbeat fa-w-16 fa-3x">
            <path d="M320.2 243.8l-49.7 99.4c-6 12.1-23.4 11.7-28.9-.6l-56.9-126.3-30 71.7H60.6l182.5 186.5c7.1 7.3 18.6 7.3 25.7 0L451.4 288H342.3l-22.1-44.2zM473.7 73.9l-2.4-2.5c-51.5-52.6-135.8-52.6-187.4 0L256 100l-27.9-28.5c-51.5-52.7-135.9-52.7-187.4 0l-2.4 2.4C-10.4 123.7-12.5 203 31 256h102.4l35.9-86.2c5.4-12.9 23.6-13.2 29.4-.4l58.2 129.3 49-97.9c5.9-11.8 22.7-11.8 28.6 0l27.6 55.2H481c43.5-53 41.4-132.3-7.3-182.1z" class=""></path>
          </svg>
          <div>
            <div class="title">직원관리<span class="font_size_m color_g">(출시예정)</span></div>
            <div class="desc">직원모집에 어려움을 겪고 계신다면, 스타트닥터에서 찾아보세요!</div>
            <hr />
          </div>
        </div>
      </div>
    </article>
  </section>

  <section id="fifth_section" style="background-color: #f2f2f2;">
    <article id="article_09" style="position: relative;">
      <div class="system_title">시스템 비교분석</div>
      <div class="system_title_bar"></div>
      <div class="system_main">
        <div class="startdoctor">
          <div class="system_main_title bg_b">스타트닥터 상권분석시스템</div>
          <div class="system_main_content">병원 관련 모든 데이터 <span class="fw_b">종합분석</span></div>
          <div class="system_main_content">진료과별 <span class="fw_b">상권분석</span> 제공</div>
          <div class="system_main_content"><span class="fw_b">행정동단위</span> 진료과별 매출 분석</div>
          <div class="system_main_content"><span class="fw_b">고급</span> 시각화 정보 제공</div>
          <div class="system_main_content ment1">진료과별 <span class="fw_b">인기키워드 조회 및 분석 / 챗봇분석조회서비스</span> 제공</div>
          <div class="system_main_content">편리한 인터페이스</div>
          <div class="system_main_content"><span class="fw_b">PC, 모바일</span> 모두 이용가능</div>
          <div class="system_main_content ment2"><span class="fw_b">원클릭 실시간 분석정보</span> (빠른 속도)</div>
        </div>
        <div class="system_main_title bg_g m_1" style="width: 175px; top: 171px; left: 22px;">구분</div>
        <div class="system_main_title m_2" style="width: 400px; top: 171px; left: 201px;">소상공인상권분석 등 기존 분석시스템</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 214px; left: 22px;">정보</div>
        <div class="system_main_content m_2" style="width: 400px; top: 214px; left: 201px;">병원특화되지않은 통계정보 제공 (병원 정보는 일부만 제공)</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 259px; left: 22px;">진료과별 분석정보</div>
        <div class="system_main_content m_2" style="width: 400px; top: 259px; left: 201px;">제공 안함</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 304px; left: 22px;">단위</div>
        <div class="system_main_content m_2" style="width: 400px; top: 304px; left: 201px;">일반 산업군별 매출 정보만 제공 (병원 선택 불가)</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 349px; left: 22px;">시각화</div>
        <div class="system_main_content m_2" style="width: 400px; top: 349px; left: 201px;">기본 시각화</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 394px; left: 22px;">마케팅 정보</div>
        <div class="system_main_content m_2" style="width: 400px; top: 394px; left: 201px;">제공 안함</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 439px; left: 22px;">인터페이스</div>
        <div class="system_main_content m_2" style="width: 400px; top: 439px; left: 201px;">불편한 인터페이스</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 484px; left: 22px;">디바이스</div>
        <div class="system_main_content m_2" style="width: 400px; top: 484px; left: 201px;">PC만 이용가능</div>
        <div class="system_main_content bg_g m_1" style="width: 175px; top: 529px; left: 22px;">속도</div>
        <div class="system_main_content m_2" style="width: 400px; top: 529px; left: 201px;">보고서 다운로드 이용가능 (느린 속도)</div>
      </div>
      <div class="service_title_ment">
        일단 시작해보고 결정하세요 <br>
        회원가입만으로 기본 분석을 이용할 수 있습니다.
      </div>
      <div class="service_title_ment_bar1"></div>
      <div class="service_title_ment_bar2"></div>
      <div class="system_service" style="top: 829px; left: 22px;">
        <div class="service_title">
          기본분석
        </div>
        <div class="service_bar" style="background-color: rgba(0, 98, 255, 0.3);"> </div>
        <div class="service_content">
          <div><i class="fas fa-dot-circle"></i>의사 회원가입시 무료</div>
          <div><i class="fas fa-dot-circle"></i>병원 관련 모든 데이터 종합분석</div>
          <div><i class="fas fa-dot-circle"></i>국내 최초 행정동단위 진료과별 상권분석</div>
        </div>
        <div class="service_btn" style="text-decoration:none" onclick="gotoanal()">
          개별상권분석 바로가기 >
        </div>
      </div>
      <div class="system_service" style="top: 829px; left: 356px;">
        <div class="service_title">
          고급분석
        </div>
        <div class="service_bar" style="background-color: rgba(0, 98, 255, 0.6);"> </div>
        <div class="service_sub_title" style="left: 125px;">
          (이용권 구입시 이용가능)
        </div>
        <div class="service_content">
          <div><i class="fas fa-dot-circle"></i>국내 최초 행정동단위 진료과별 <asd class="fw_b">매출분석</asd>
          </div>
          <div><i class="fas fa-dot-circle"></i>다양한 시각화 정보 제공</div>
          <div><i class="fas fa-dot-circle"></i>진료과별 <asd class="fw_b">인기키워드 조회 및 분석</asd>
          </div>
          <div><i class="fas fa-dot-circle"></i>챗봇분석조회서비스 제공</div>
        </div>
        <div class="plus">
          + 기본분석 모든 기능 가능
        </div>
        <div class="service_btn" style="text-decoration:none" onclick="gotoanal()">
          개별상권분석 바로가기 >
        </div>
      </div>
      <div class="system_service" style="top: 829px; left: 693px;">
        <div class="service_title">
          프로서비스
        </div>
        <div class="service_bar" style="background-color: #0062ff;"> </div>
        <div class="service_sub_title" style="left: 150px;">
          (가격 별도 문의)
        </div>
        <div class="service_content">
          <div><i class="fas fa-dot-circle"></i>
            1:1 상담을 진행 후 개별 병원에 특화된 <br>
            <asd class="fw_b">커스터마이징 상권분석</asd> 제공
          </div>
        </div>
        <div class="plus">
          + 고급분석 모든 기능 가능
        </div>
        <div class="service_btn" style="text-decoration:none" onclick="gotoanal()">
          개별상권분석 바로가기 >
        </div>
      </div>
      <div class="service_pay">
        서비스 이용 요금
      </div>
      <div class="service_pay_bar"></div>
      <div class="service_pay_sub">
        해당 이용권은 구매일로 부터 한 달 이내로 사용이 가능합니다. <br>
        한 달이 경과된 후에는 미사용한 이용권의 기간이 만료되오니 유의하시길 바랍니다.
      </div>
      <div class="ticket_title_ment">
        개원상권분석시스템 이용권
      </div>
      <div class="ticket t1">
        <div class="ticket_title">
          1회 이용권
        </div>
        <div class="ticket_price">
          79,000원
        </div>
        <div class="ticket_btn" style="text-decoration:none" id="starter">
          구매하기 >
        </div>
      </div>
      <div class="ticket t2">
        <div class="ticket_title">
          3회 이용권
        </div>
        <div class="ticket_sub_title">
          (약 16% 할인)
        </div>
        <div class="ticket_price">
          198,000원
        </div>
        <div class="ticket_btn" style="text-decoration:none" id="basic">
          구매하기 >
        </div>
      </div>
      <div class="ticket t3">
        <div class="ticket_title">
          5회 이용권
        </div>
        <div class="ticket_sub_title">
          (약 25% 할인)
        </div>
        <div class="ticket_price">
          298,000원
        </div>
        <div class="ticket_btn" style="text-decoration:none" id="pro">
          구매하기 >
        </div>
      </div>
      <div class="ticket_pro_ment">
        개원상권분석시스템 프로서비스
      </div>
      <div class="ticket pro">
        <div class="ticket_title">
          프로서비스
        </div>
        <div class="ticket_price" style="color: #4265f7;">
          가격 별도 문의
        </div>
        <div class="ticket_btn" onclick="location.href='https://pf.kakao.com/_xeIrFj'">
          문의하기 >
        </div>
      </div>
    </article>
  </section>

  <section id="sixth_section">
    <article id="article_10">
      <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-6">
          <div class="title"><b>카카오톡 플러스친구</b>로 쉽고 간편한 상담이 가능합니다.</div>
          <div class="desc">스타트닥터 카카오톡 플러스 친구를 추가하시고, 궁금하신 점을 문의해주세요.
            빅데이터를 기반으로한 인공지능 상담사가 답변을 빠르게 도와드립니다.

            혹시 원하시는 답변을 받지 못하셨을 경우에는 ‘상담원과 연결하기’를 선택해주세요. 실제 상담원과의 연결을 도와드립니다.</div>

          <div class="col-12 mobile">
            <div id="slider2" class="owl-carousel owl-theme">
              <div class="item"><img src="../assets/article_10_01.png" style="width: 100%;" /></div>
              <div class="item"><img src="../assets/article_10_02.png" style="width: 100%;" /></div>
              <div class="item"><img src="../assets/article_10_03.png" style="width: 100%;" /></div>
              <div class="item"><img src="../assets/article_10_04.png" style="width: 100%;" /></div>
            </div>
          </div>

          <a href="javascript:void addchannel()" style="color:#3A211E; text-decoration:none">
            <div class="button4 margin_top_l yellow_btn" style="background-color: #f8eb00; width: 170px;">
              <img src="../assets/kakao.png" style="width: 32px;" />
              <span style="margin-left: 12px;">채널추가</span>
            </div>
          </a>
          <a href="javascript:void chatchannel()" style="color:#3A211E; text-decoration:none">
            <div class="button4 margin_top_l yellow_btn y_btn_r" style="background-color: #f8eb00; width: 170px; margin-left: 10px;">
              <img src="../assets/kakao.png" style="width: 32px;" />
              <span style="margin-left: 12px;">1:1상담</span>
            </div>
          </a>
          <a href="https://pf.kakao.com/_xbwtxmj" style="color:#3A211E; text-decoration:none">
            <div class="button4">
              <img src="../assets/kakao.png" style="width: 32px;" />
              <span style="margin-left: 12px;">[업체용] 카톡플친에서 제휴문의 ></span>
            </div>
          </a>

        </div>
        <div class="col-12 col-md-5 tablet">
          <div id="slider3" class="owl-carousel owl-theme">
            <div class="item"><img src="../assets/article_10_01.png" style="width: 100%;" /></div>
            <div class="item"><img src="../assets/article_10_02.png" style="width: 100%;" /></div>
            <div class="item"><img src="../assets/article_10_03.png" style="width: 100%;" /></div>
            <div class="item"><img src="../assets/article_10_04.png" style="width: 100%;" /></div>
          </div>
        </div>
      </div>
    </article>
  </section>

  <section id="seventh_section">
    <article id="article_11">
      <div class="row justify-content-between align-items-center">
        <div class="col-12 col-md-7">
          <div class="title"><b>스타트닥터</b>와 함께 할 업체를 찾습니다.</div>
          <div class="desc margin_top_s">개원할 의사분들을 찾고 계신가요? 지금 바로 업체회원 등록하고 개원예정의분들을 만나보세요.</div>
          <a href="https://pf.kakao.com/_xbwtxmj" style=" text-decoration:none">
            <div class="link fs18 color_b margin_top_l font_weight_b">업체 회원 등록하기 ></div>
          </a>
        </div>

        <div class="col-12 col-md-4">

          <div class="box" style="background-color:transparent; border:none; background-image : url(../assets/0_main_city.png); background-size: cover"></div>
        </div>
      </div>
    </article>
  </section>

  <section id="eighth_section">
    <article id="article_12">
      <img src="../assets/sponsor.png" style="width: 100%;" />
    </article>
  </section>

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

  <div class="background_layer display_none" id="background_layer_01" onclick="hoverNavigation()"></div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="../lib/owlCarousel2/owl.carousel.min.js"></script>
  <script src="../script/map.js"></script>
  <script src="../script/dashboard.js"></script>
  <script src="../script/common.js"></script>
  <script src="../script/main.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtqYpCJDxESmb5Vc2tHrp2vlYcMmo_tO4&callback=isMapCalled" async defer></script>
  <script src="https://kit.fontawesome.com/c3089a3225.js" crossorigin="anonymous"></script>
  <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
  <script type='text/javascript'>
    Kakao.init('a1267079d7c89af94cb8d9e79a8ed946');

    function addchannel() {
      Kakao.Channel.addChannel({
        channelPublicId: '_xeIrFj'
      });
    }

    function chatchannel() {
      Kakao.Channel.chat({
        channelPublicId: '_xeIrFj'
      });
    }
  </script>
  <script>
    function gotoanal() {
      $('#analyform').submit();
    }
  </script>
  <script>
    function moveto(sec_id) {
      var section = $('#article_' + sec_id).offset();
      $('html,body').animate({
        scrollTop: section.top - 120
      }, 600);
    }
  </script>

  <script>
    function getCookie(name) {
      var Found = false
      var start, end
      var i = 0

      // cookie 문자열 전체를 검색
      while (i <= document.cookie.length) {
        start = i
        end = start + name.length
        // name과 동일한 문자가 있다면
        if (document.cookie.substring(start, end) == name) {
          Found = true
          break
        }
        i++
      }

      // name 문자열을 cookie에서 찾았다면
      if (Found == true) {
        start = end + 1
        end = document.cookie.indexOf(";", start)
        // 마지막 부분이라는 것을 의미(마지막에는 ";"가 없다)
        if (end < start)
          end = document.cookie.length
        // name에 해당하는 value값을 추출하여 리턴한다.
        return document.cookie.substring(start, end)
      }
      // 찾지 못했다면
      return ""
    }
  </script>
  <script>
    $(window).scroll(function(event) {
      if ($(window).scrollTop() > $("#ban").offset().top) {
        $("#kakao-add-channel-button").css("position", "fixed");
      } else if (($(window).scrollTop() < $("#ban").offset().top)) {
        $("#kakao-add-channel-button").css("position", "static");
      }
    });
  </script>
  <script>
    function popup() {

      // var eventCookie=getCookie("memo");

      // var u_email = <?php echo $login ?>;
      // if (u_email && eventCookie !='no') {
      //     window . open('popup.html', '_blank', 'top=0,left=1580,width=420,height=748,toolbar=0,status=0,scrollbars=1,resizable=0');
      // }

    }
  </script>
  <script>
    // var way
    // function findway(){
    //   way = $("#pay_way option:selected").val()

    // }
    $("#starter").click(function() {
      var IMP = window.IMP;
      var u_id = "<?php echo "$u_id" ?>";
      if (!u_id) {
        alert('로그인 해주세요');
        window.location.href = "../member/signin.html";
      }
      IMP.init('imp78205218');
      IMP.request_pay({
        pg: 'inicis',
        buyer_name: "<?php echo "$u_name" ?>",
        buyer_email: "<?php echo "$u_email" ?>",
        pay_method: 'card',
        merchant_uid: 'merchant_' + new Date().getTime(),
        name: '스타트 닥터 - 1회권 충전',



        amount: 79000,

        m_redirect_url: 'https://www.startdoctor.net/payment_check.php'
      }, function(rsp) {
        console.log(rsp);
        if (rsp.success) {
          var msg = '결제가 완료되었습니다.' + "\n";
          msg += '결제 금액 : ' + rsp.paid_amount;
          window.location = "payment_check.php?u_id=" + u_id + "&amount=1";
        } else {
          var msg = '결제에 실패하였습니다.' + "\n";
          msg += rsp.error_msg;
        }
        alert(msg);
      });
    });

    $("#basic").click(function() {
      var IMP = window.IMP;
      var u_id = "<?php echo "$u_id" ?>";
      if (!u_id) {
        alert('로그인 해주세요');
        window.location.href = "../member/signin.html";
      }
      IMP.init('imp78205218');
      IMP.request_pay({
        pg: 'inicis',
        buyer_name: "<?php echo "$u_name" ?>",
        buyer_email: "<?php echo "$u_email" ?>",
        pay_method: 'card',
        merchant_uid: 'merchant_' + new Date().getTime(),
        name: '스타트 닥터 - 3회권 충전',



        amount: 198000,

        m_redirect_url: 'https://www.startdoctor.net/payment_check.php'
      }, function(rsp) {
        console.log(rsp);
        if (rsp.success) {
          var msg = '결제가 완료되었습니다.' + "\n";
          msg += '결제 금액 : ' + rsp.paid_amount;
          window.location = "payment_check.php?u_id=" + u_id + "&amount=3";
        } else {
          var msg = '결제에 실패하였습니다.' + "\n";
          msg += rsp.error_msg;
        }
        alert(msg);
      });
    });

    $("#pro").click(function() {
      var IMP = window.IMP;
      var u_id = "<?php echo "$u_id" ?>";
      if (!u_id) {
        alert('로그인 해주세요');
        window.location.href = "../member/signin.html";
      }
      IMP.init('imp78205218');
      IMP.request_pay({
        pg: 'inicis',
        pay_method: 'card',
        buyer_name: "<?php echo "$u_name" ?>",
        buyer_email: "<?php echo "$u_email" ?>",
        merchant_uid: 'merchant_' + new Date().getTime(),
        name: '스타트 닥터 - 5회권 충전',



        amount: 298000,

        m_redirect_url: 'https://www.startdoctor.net/payment_check.php'
      }, function(rsp) {
        console.log(rsp);
        if (rsp.success) {
          var msg = '결제가 완료되었습니다.' + "\n";
          msg += '결제 금액 : ' + rsp.paid_amount;
          window.location = "payment_check.php?u_id=" + u_id + "&amount=5";
        } else {
          var msg = '결제에 실패하였습니다.' + "\n";
          msg += rsp.error_msg;
        }
        alert(msg);
      });
    });
  </script>
  <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
</body>

</html>