<?php
  include 'config.php';
  include 'util.php';

  session_start();
  if (!isset($_SESSION['u_email'])) {
      s_msg('로그인 해주세요');
      echo "<meta http-equiv='refresh' content='0;url=../member/signin.html'>";
  }
  $conn = dbconnect($host, $dbid, $dbpass, $dbname);
  $u_email = $_SESSION['u_email'];
  $query = "select * from user where u_email = '$u_email'";
  $ret = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($ret);
  $u_specify = $row['u_specify'];
  $u_name = $row['u_name'];
  $type = $row['u_type'];
  $u_id = $row['u_id'];
  $coach_id = $_GET['coach_id'];
  $query = "select * from coach where coach_id = '$coach_id'";
  $ret = mysqli_query($conn, $query);
  $coach = mysqli_fetch_assoc($ret);
  $doc_id = $coach['user2'];
  $login = true;
  $u_id1 = $u_id;
  $u_id2 = $doc_id;
?>




<!DOCTYPE html>
<html>
  <head>
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
  <body onload ="scroll()">

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
            <img style="width: 120px;" src="../assets/logo.png" title="스타트닥터 로고" />
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
            <img style=\"width: 120px;\" src=\"../assets/logo.png\" title=\"스타트닥터 로고\" />
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
    $login = false;
    ?>
    </header>
  <div class="ploting_banner" onclick="location.href='https://pf.kakao.com/_xeIrFj'">
    <img src="../assets/kakao_banner.png" width="60px" height="60px">
  </div>

    <nav class="text_align_center color_w" style="background-color: #242424;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 cursor_pointer">
            <div class="row justify-content-center align-items-end" style="height: 40px;">
              <div class="col"><a href = "business.php" style = "color:#FFFFFF; text-decoration:none">홈</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="profile_corp.php" style="color:#FFFFFF; text-decoration:none">회원정보</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="chat_list_corp.php" style="color:#FFFFFF; text-decoration:none">상담채팅</a><div class="line_b" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="service_corp.php" style="color:#FFFFFF; text-decoration:none">비교견적</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="#" style="color:#FFFFFF; text-decoration:none" onclick ="alert('준비중인 서비스입니다!')">결제정보</a><div class="line_g_d" style="border-width: 5px;"></div></div>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <nav id="nav_small">
      <div>
        <div class="title"><a href = "/mypage/business.php" style = "color:#2b2b2b; text-decoration:none">STARTDOCTOR</a></div>
        <div class="progress_bar">
          <!-- <div class="category">개원진행률</div> -->
          <?php
          if (!$login) {
              // echo '<div class="link">진행률 확인하러가기 ></div>';
          } else {
              echo '<div class="link"><a href = "../mypage/progress.php" style = "color:#2B2B2B"> 진행률 확인하러가기 > </a></div>';
          }
          ?>
          <!-- <div class="percentage margin_top_ss">
            <div> -->
            <?php
            if (!$login) {
            } else {
                echo "
              <div style=\"width:$percentage%\">
              <div>$percentage%</div>
              ";
            }
            ?>
            <!-- </div>
          </div> -->
        <!-- </div> -->
        <?php
        if (!$login) {
            echo '
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
            <div class="image" style="background-image: url(../assets/0_side_3.png);height:100px;cursor:pointer" onclick="location.href=\'chat_list_corp.php\'"></div>
          </div>
        </div>';
        } else {
            echo'        
          <div class="member">
          <div>
            <div class="image"></div>
            ';
            if ($u_specify == '의사') {
                echo '<div><a href ="../mypage/home.php" style = "color:#2B2B2B"> 마이페이지</a></div>';
            } else {
                echo '<div><a href ="../mypage/business.php" style = "color:#2B2B2B"> 마이페이지</a></div>';
            }
            echo '
            </div>
            
          
          <div>
            <div class="image"></div>
            <div><a href = "../company/system.php" style = "color:#2B2B2B">개원상권분석</a></div>
          </div>
          <div>
            <div class="image"></div>
            <div><a href = "../service/chat.php" style = "color:#2B2B2B">업체상담채팅</a></div>
          </div>
        </div>';
        }
        ?>
        <hr class="line" />
        <div class="category_area">
          <div class="category"><a href = "../company/aboutus.php" style = "color:#2B2B2B">스타트닥터</a></div>
          <div class="category"><a href = "../company/system.php" style = "color:#2B2B2B">개원상권분석시스템</a></div>
          <div class="category"><a href = "../service/chat.php" style = "color:#2B2B2B">상담채팅</a></div>
          <div class="category"><a href = "../service/estimate.php" style = "color:#2B2B2B">비교견적</a></div>
          <div class="category"><a href = "../service/seminar.php" style = "color:#2B2B2B">개원세미나</a></div>
        </div>
        <hr class="line" />
        <div class="margin_top_m">
          <div class="link"><a href = "../company/notice.php" style = "color:#2B2B2B">공지사항</a></div>
          <div class="link"><a href = "../company/faq.php" style = "color:#2B2B2B">FAQ</a></div>
        </div>
        <div class="close" onclick="hoverNavigation()">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
        </div>
      </div>
    </nav>
    <section class="back_w position_relative" style="height: calc(100% - 126px);">
            
        <div id="chat_list" class="opened">
          <div class="wrap padding_v_s">
            <div class="col-12 font_size_xl font_weight_b">상담 채팅</div>
            <div class="col-12 position_relative margin_top_s">
              <input class="input_03" type="text" name="" value="" onkeyup="chatListPage.searchChat(this)" placeholder="대화상대 검색하기" />
              <svg class="position_absolute fill_g" style="right: 25px; top: 8px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
            </div>
            <?php
               $query = "select * from coach where user1 = '$u_id' order by last desc";
               $ret = mysqli_query($conn, $query);

              while ($coaches = mysqli_fetch_assoc($ret)) {
                  $id = $coaches['user2'];
                  $query = "select * from user where u_id = '$id' ";
                  $temp = mysqli_query($conn, $query);
                  $doc = mysqli_fetch_assoc($temp);
                  $cid = $coaches['coach_id'];
                  $query = "select * from chat where coach_id = '$cid' order by date desc";
                  $tem = mysqli_query($conn, $query);
                  $chat = mysqli_fetch_assoc($tem);
                  $date = substr($coaches['last'], 0, 10);
                  $msg = substr($chat['msg'], 0, 20);

                  if ($coach_id != $coaches['coach_id']) {
                      echo "
                      <a href = \"chat_detail_corp.php?coach_id=$coaches[coach_id]\" style =\"color:#2b2b2b; text-decoration:none\">
                      <div class=\"col-12\" style=\"overflow-x: auto;\">
                      <div class=\"row\" id=\"chat_list_area\"><div class=\"col-12 margin_top_m\"><div class=\"line\"></div></div><div class=\"col-12 margin_top_m cursor_pointer\" onclick=\"location.href='chat_detail_corp.php?coach_id=$coach_id'\">
                        <div class=\"container\">    
                          <div class=\"row align-items-center\">      
                            <div class=\"col profile\" style=\"-ms-flex: 0 0 50px;flex: 0 0 50px;background-image: url(../assets/default_profile_company.svg)\"></div>      
                            <div class=\"col\">        
                              <div class=\"font_weight_b\">$doc[u_name]</div>        
                            <div class=\"row\">          
                              <div class=\"col ellipsis color_g font_size_s\">$msg</div>          
                              <div class=\"col color_g font_size_s\" style=\"-ms-flex: 0 0 85px;flex: 0 0 85px;padding: 0;\">$date</div>        
                              </div>      
                              </div>    
                              </div>  
                            </div>
                        </div>
                        </div>
                    </div>
                    </a>
                      ";
                  } else {
                      echo "
                    <div class=\"col-12\" style=\"overflow-x: auto; \">
                    <div class=\"row\" id=\"chat_list_area\"><div class=\"col-12 margin_top_m\"><div class=\"line\"></div></div><div class=\"col-12 margin_top_m cursor_pointer\" style =\"background-color:#b0e0e6\" onclick=\"location.href='chat_detail_corp.php?coach_id=$coach_id'\">
                      <div class=\"container\">    
                        <div class=\"row align-items-center\">      
                          <div class=\"col profile\" style=\"-ms-flex: 0 0 50px;flex: 0 0 50px;background-image: url(../assets/default_profile_company.svg)\"></div>      
                          <div class=\"col\">        
                            <div class=\"font_weight_b\">$doc[u_name]</div>        
                          <div class=\"row\">          
                            <div class=\"col ellipsis color_g font_size_s\">$msg</div>          
                            <div class=\"col color_g font_size_s\" style=\"-ms-flex: 0 0 85px;flex: 0 0 85px;padding: 0;\">$date</div>        
                            </div>      
                            </div>    
                            </div>  
                          </div>
                      </div>
                      </div>
                  </div>
                    ";
                      $doc_name = $doc['u_name'];
                  }
              }
            ?>
            
            <div class="col-12" style="overflow-x: auto;">
              <div class="row" id="chat_list_area">
                
              </div>
            </div>
          </div>
        </div>

        <div id="chat_detail">
          <div class="box_shadow">
            <div class="row" style="margin: 0">
              <div class="col-12 padding_v_s">
                <div class="containter">
                  <div class="row">
                    <div class="col-8">
                      <div class="container">
                        <div class="row align-items-center">
                          <div class="col" style="-ms-flex: 0 0 20px;flex: 0 0 20px;padding-left: 0;">
                            <svg onclick="chatListPage.hoverChatList()" class="fill_g display_inline_block" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/><path fill="none" d="M0 0h24v24H0V0z"/></svg>
                          </div>
                          <div class="col profile" style="-ms-flex: 0 0 50px;flex: 0 0 50px;background-image: url('../assets/default_profile_company.svg')"></div>
                          <div class="margin_left_s" style="max-width: 50%;">
                            <div class="font_weight_b margin_right_s display_inline_block ellipsis" id="chat_detail_name" style="width: 100%;"><?php echo $doc_name?></div>
                            <!-- <div class="cursor_pointer font_size_s color_g display_inline_block" onclick="chatListPage.openCompanyDetailModal()">업체소개보기 ❯</div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 text_align_right">
                      <div class="display_inline_block" onclick="chatListPage.hoverLike(this)">
                        <!-- <svg class="fill_g cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/><path d="M0 0h24v24H0z" fill="none"/></svg> -->
                        <svg class="fill_y display_none cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
                      </div>
                      <svg onclick="chatListPage.callCompany()" class="display_inline_block fill_b cursor_pointer margin_left_s" xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div style="overflow-y: auto;height: calc(100% - 130px);" id="reloaded">
            <div id = "chat_pos">
            <div class="row" style="margin: 0;" id="chat_area">
            <?php
                  $query = "select * from chat where coach_id = '$coach_id' order by no";
                  $temp = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($temp)) {
                      $msg = nl2br($row['msg']);
                      $time = substr($row['date'], 10, 6);
                      if ($u_name != $row['name']) {
                          echo "<div class=\"col-12\">  
                            <div class=\"left_message\">    
                              <div>$msg</div>    
                              <div class=\"font_size_s color_g\">$row[date]</div>  
                            </div>
                          </div>";
                      } else {
                          echo "<div class=\"col-12\">  
                        <div class=\"right_message\">    
                        <div class=\"font_size_s color_g\">$row[date]</div>
                          <div>$msg</div>    
                            
                        </div>
                      </div>";
                      }
                  }
                ?>
            </div>
            </div>
          </div>

          
          <div class="padding_top_m border_top">
            <div class="row align-items-center" style="margin: 0;">
              <div class="col-1">
                <!-- <button type = "button" class ="btn btn-primary">견적받기</button> -->
                <!-- <input type="file" name="" id="chat_file" onchange="chatListPage.sendFile(this)"/>
                <svg onclick="chatListPage.openSelectFile()" class="fill_b cursor_pointer" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/><path d="M0 0h24v24H0z" fill="none"/></svg> -->
              </div>
              <div class="col-11">
              <iframe name="iframe1" style="display:none;"></iframe>
              
                <form id = "chatform" name ="chatform" method="POST" onsubmit = "writethis(this);refreshDiv();scroll()" target="iframe1" >
                  <input type="hidden" name ="u_id1" id = "u_id1" value = "<?=$u_id1?>"/>
                  <input type="hidden"  name ="u_id2" id = "u_id2" value = "<?=$u_id2?>"/>
                  <input type="hidden" name ="coach_id"  id = "coach_id" value = "<?=$coach_id?>">
                  <input type="hidden"  name ="u_name"  id = "u_name" value = "<?=$u_name?>">
                  
                  <input class="input_03" type="text" name="msg" id="msg" value="" placeholder="메세지를 입력하세요…"/>
                  
                </form>
                
              </div>
            </div>
          </div>

        </div> 
    </section>

    <div id="chat_company_detail_modal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
      </div>
    </div>

    <div class="background_layer display_none" id="background_layer_01" onclick="hoverNavigation()"></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../lib/moment.min.js"></script>
    <script src="../script/common.js"></script>
    <script src="../script/mypage.js"></script>
    <!-- <script>
      $(document).ready(function () {
        chatListPage.chatList.push({
          chatId: idx,
          contact: ay['phone'],
          image: null, // null 일 경우 default icon
          name: ay['name'],
          updatedAt: 1571714050613, // timestamp로 넣어주세요!!
          lastText: ay['msg'],
          selected: false,
          searched: true
        })
      
        chatListPage.setChatList()
        // default로 첫번째 업체와의 채팅으로 셋팅합니다.
        // > mobile 일 경우
        if (window.innerWidth > 800) {
          chatListPage.loadChat(chatListPage.chatList[0].chatId) // php에서 첫번째 채팅 아이디를 로드해서 셋팅해주세요.
        }
      })
    </script> -->
    <script langauge="javascript">
        var counter = 0;
        window.setInterval("refreshDiv()", 5000);
        function refreshDiv(){
          $('#chat_pos').load(document.URL +  ' #chat_pos');
        }
       
      
    </script>
    <script>
        function scroll() {
          document.getElementById('reloaded').scrollTop = 9999999;

        }
    </script>
  
    
  </body>

</html>
