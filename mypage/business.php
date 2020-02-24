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
      $query = "select * from user where u_email = '$u_email'";
      $ret = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($ret);
      $u_specify = $row['u_specify'];
      $u_name = $row['u_name'];
      $type = $row['u_type'];
      $u_id = $row['u_id'];
      $query = "select * from corp_info where corp_id ='$u_id'";
      $info = mysqli_query($conn, $query);
      $infra = mysqli_fetch_row($info);
      $inum = count($infra);

      $query = 'select * from corp_info';
      $as = mysqli_query($conn, $query);
      $num = mysqli_num_fields($as);

      if (mysqli_num_rows($info) == 0) {
          echo '<script>alert("회원정보 중 미작성된 목록이 있습니다! 작성 후에 이용바랍니다");
              window.location.href="profile_corp.php"</script>';
      } else {
          for ($i = 0;$i < $inum;$i++) {
              if ($infra[$i] == '') {
                  echo '<script>alert("회원정보 중 미작성된 목록이 있습니다! 작성 후에 이용바랍니다");
          window.location.href="profile_corp.php"</script>';
              }
          }
      }

      $form;
      $tap;
      $answer;
      if ($type == 1) {
          $form = 'form1';
          $tap = '인테리어';
          $answer = 'f1_answer';
      } elseif ($type == 2) {
          $form = 'form2';
          $tap = '마케팅';
          $answer = 'f2_answer';
      } elseif ($type == 3) {
          $form = 'form3';
          $tap = '홈페이지';
          $answer = 'f3_answer';
      } elseif ($type == 4) {
          $form = 'form4';
          $tap = '자금대출';
          $answer = 'f4_answer';
      } elseif ($type == 5) {
          $form = 'form5';
          $tap = '의료장비';
          $answer = 'f5_answer';
      } else {
          $form = 'form6';
          $tap = '기타';
          $answer = 'f6_answer';
      }
      $form_query = "select * from $form natural join user";
      $form_ret = mysqli_query($conn, $form_query);
      $chat_query = "select * from counsel where type = '$tap'";
      $chat_ret = mysqli_query($conn, $chat_query);
      $chat_num = mysqli_num_rows($chat_ret);
      if (!$form_ret) {
          $form_num = 0;
      }
      $form_num = mysqli_num_rows($form_ret);
      $in_pro_chat = "select * from coach where user1 = '$u_id'";
      $in_pro_ret = mysqli_query($conn, $in_pro_chat);
      $in_pro_num = mysqli_num_rows($in_pro_ret);
      while ($r = mysqli_fetch_assoc($in_pro_ret)) {
          $id = $r['coach_id'];
          $query = "select * from chat where coach_id = '$id'";
          $tmp = mysqli_query($conn, $query);
          $num = mysqli_num_rows($tmp);
          if ($num == 0) {
              $in_pro_num--;
          }
      }
  }

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

    <nav class="text_align_center color_w" style="background-color: #242424;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 cursor_pointer">
            <div class="row justify-content-center align-items-end" style="height: 40px;">
              <div class="col"><a href = "business.php" style = "color:#FFFFFF; text-decoration:none">홈</a><div class="line_b " style="border-width: 5px;"></div></div>
              <div class="col"><a href ="profile_corp.php" style="color:#FFFFFF; text-decoration:none">회원정보</a><div class="line_g_d" style="border-width: 5px;"></div></div>
              <div class="col"><a href ="chat_list_corp.php" style="color:#FFFFFF; text-decoration:none">상담채팅</a><div class="line_g_d" style="border-width: 5px;"></div></div>
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

    <section class="back_g_l">
      <article>
        <div class="container">
          <div class="row margin_top_xl">
            <div class="col-12 font_size_xl">
              <span class="font_weight_b"><?php echo $u_name?></span>
              <span>님, 환영합니다</span>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-4 margin_top_m" onclick="scrollToId('advice_list')">
              <div class="box_shadow back_w padding_l border_radius_s">
                <div class="font_size_l">상담중인 채팅 건수 ></div>
                <div class="text_align_right"><span class="font_size_xxl font_weight_b color_b"><?php echo $in_pro_num?></span><span class="margin_left_s">건</span></div>
              </div>
            </div>
            <div class="col-12 col-sm-4 margin_top_m" onclick="scrollToId('estimate_list')">
              <div class="box_shadow back_w padding_l border_radius_s">
                <div class="font_size_l">비교견적 신청건수 ></div>
                <div class="text_align_right"><span class="font_size_xxl font_weight_b color_b"><?php echo $form_num?></span><span class="margin_left_s">건</span></div>
              </div>
            </div>
          </div>

          <div class="row margin_top_l">
            <div class="col-12"><div class="line"></div></div>
          </div>

          <div id="advice_list" class="row margin_top_l">
            <div class="col-12">
              <div class="box_shadow back_w padding_m">
                <div class="container">
                  <div class="row">
                    <div class="col-12 font_size_ll font_weight_b">
                      상담채팅문의 목록
                    </div>
                    <div class="col-12 margin_top_m">
                      <table>
                        <thead>
                          <tr>
                            <th scope="col" style="width: 40px;"></th>
                            <th scope="col" style="width: 60px;" class="tablet">번호</th>
                            <th scope="col" style="width: 120px;" class="tablet">일시</th>
                            <th scope="col">질문</th>
                            <th scope="col" style="width: 100px;" class="tablet"></th>
                            <th scope="col" style="width: 60px;"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($chat_ret)) {
                                $answerd = false;
                                $id = $row['id'];
                                $query = "select * from re_counsel where corp_id = '$u_id' and id='$id' ";
                                $ret = mysqli_query($conn, $query);
                                if (mysqli_num_rows($ret) > 0) {
                                    $answerd = true;
                                }
                                echo "<tr>
                                <td class=\"text_align_right\"></td>  
                                <td class=\"text_align_center tablet\">$i</td>  
                                <td class=\"text_align_center tablet\">$row[date]</td>  
                                <td style=\"padding-left: 15px;\"><div class=\"mobile\"><span class=\"color_g\">$row[date]</span>";
                                if (!$answerd) {
                                    echo'<span class="color_r margin_left_m">미응답';
                                } else {
                                    echo'<span class="color_b margin_left_m">응답 완료';
                                }
                                echo"</span></div><div>$row[title]</div></td>  
                              <td class=\"text_align_center tablet\">";
                                if (!$answerd) {
                                    echo'<div class="button6 color_r" style="border-color: #ff5353;">미응답</div>';
                                    echo "</td><td class=\"text_align_center\"><a href = \"advice_detail.php?id=$row[id]\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z\"></path><path fill=\"none\" d=\"M0 0h24v24H0V0z\"></path></svg></a></td></tr>";
                                } else {
                                    $query = "select * from counsel where id='$id'";
                                    $tmp = mysqli_query($conn, $query);
                                    $asd = mysqli_fetch_assoc($tmp);
                                    $doc = $asd['u_id'];
                                    $query = "select * from coach where user1 = '$u_id' and user2 = '$doc'";
                                    $temp = mysqli_query($conn, $query);
                                    $coach = mysqli_fetch_assoc($temp);
                                    $cid = $coach['coach_id'];
                                    echo'<div class="button6 color_b" style="border-color: #2f72f7;">응답 완료</div>';
                                    echo "</td><td class=\"text_align_center\"><a href = \"chat_detail_corp.php?coach_id=$cid\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path d=\"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z\"></path><path fill=\"none\" d=\"M0 0h24v24H0V0z\"></path></svg></a></td></tr>";
                                }
                                $i++;
                            }
                          ?>
                        </tbody>
                      </table>
                      <?php
                      if ($chat_num == 0) {
                          echo '  <div class="row align-items-center justify-content-center" >
                                <div class="col-12 text_align_center color_b font_size_l"><br><br>상담채팅 문의가 없습니다:)<br><br><br></div>
                            </div>
                            <div style="height: auto; width: 100%; border-bottom:1px solid;"></div>
                                ';
                      }
                      ?>
                    </div>
                    <div class="col-12 margin_top_m">
                      <div class="container">
                        <div class="row justify-content-between align-items-center">
                         
                          <div>
                            <!-- <ul id="advice_pagination" class="pagination">
                            </ul> -->
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="estimate_list" class="row margin_top_l">
            <div class="col-12">
              <div class="box_shadow back_w padding_m">
                <div class="container">
                  <div class="row">
                    <div class="col-12 font_size_ll font_weight_b">
                      견적문의 목록
                    </div>
                    <div class="col-12 margin_top_m">
                      <table>
                        <thead>
                          <tr>
                            <th scope="col" style="width: 40px;"></th>
                            <th scope="col" style="width: 60px;" class="tablet">번호</th>
                            <th scope="col" style="width: 120px;" class="tablet">일시</th>
                            <th scope="col">성함</th> 
                            <th scope="col">분야</th> 
                            <th scope="col" style="width: 100px;" class="tablet"></th>
                            <th scope="col" style="width: 60px;"></th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                              $i = 1;

                              while ($row = mysqli_fetch_assoc($form_ret)) {
                                  $answerd = false;
                                  $query = "select * from $answer where fid = '$row[fid]' and corp_id = '$u_id'";
                                  $ret = mysqli_query($conn, $query);
                                  if (mysqli_num_rows($ret) > 0) {
                                      $answerd = true;
                                      $ans = mysqli_fetch_array($ret);
                                  }
                                  echo "
                                  <tr>
                                    <td class=\"text_align_right\"></td>  
                                    <td class=\"text_align_center tablet\">$i</td>  
                                    <td class=\"text_align_center tablet\">$row[date]</td>  
                                    <td class=\"text_align_center\">$row[u_name]</td> 
                                    <td class=\"text_align_center\">$tap</td>   
                              ";
                                  if (!$answerd) {
                                      echo '<td class="text_align_center tablet"><div class="button6 color_r" style="border-color: #ff5353;">미응답</div></td> ';
                                      echo "
                                      <td class=\"text_align_center\"><a href = \"business_estimate_detail.php?id=$row[fid]\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" ><path d=\"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z\"></path><path fill=\"none\" d=\"M0 0h24v24H0V0z\"></path></svg></td>
                                      ";
                                  } else {
                                      echo '<td class="text_align_center tablet"><div class="button6 color_b" style="border-color: #2f72f7;">응답 완료</div></td>';
                                      echo " <td class=\"text_align_center\"><a href = \"form_answers/$ans[file]\" download><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" ><path d=\"M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z\"></path><path fill=\"none\" d=\"M0 0h24v24H0V0z\"></path></svg></td></tr> ";
                                  }
                                  $i++;
                              }
                              ?>
                            </tr>
                          
                        </tbody>
                      </table>
                      <?php
                      if ($form_num == 0) {
                          echo '  <div class="row align-items-center justify-content-center" >
                                <div class="col-12 text_align_center color_b font_size_l"><br><br>견적 문의가 없습니다:)<br><br><br></div>
                            </div>
                            <div style="height: auto; width: 100%; border-bottom:1px solid;"></div>
                                ';
                      }
                      ?>
                    </div>
                    <div class="col-12 margin_top_m">
                      <div class="container">
                        <div class="row justify-content-between align-items-center">
                          
                          <div>
                            <!-- <ul id="estimate_pagination" class="pagination">
                            </ul> -->
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </article>
    </section>

    <!-- alert component입니다. footer에 넣어서 사용해주세요! 사용법은 common.js > function modal을 확인하시면 됩니다. -->
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
          <div class="modal-footer">
            <button id="modal_save" type="button" class="btn btn-primary">영수증보기 ></button>
          </div>
        </div>
      </div>
    </div>
  
    <div class="background_layer display_none" id="background_layer_01" onclick="hoverNavigation()"></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../lib/moment.min.js"></script>
    <script src="../script/common.js"></script>
    <script src="../script/mypage.js"></script>
    <script>
      $(document).ready(function () {
        businessPage.updateAdviceTable(1)
        businessPage.updateEstimateTable(1)
      })
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
          <div class="col-12 col-sm-6 font_size_xl font_weight_b">STARTDOCTOR</div>
          <div class="col-12 col-sm-5" style="line-height: 1.79;">
            Tel. 050 7343 2605<br/>
            E-mail. support@eszett.co.kr<br/>
            상호 : 에스체트(eszett)<br/>
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
