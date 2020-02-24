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
      $u_id = $row['u_id'];
      $u_name = $row['u_name'];
      $u_specify = $row['u_specify'];
      $percentage = $row['percentage'];
      $u_rank = $row['u_rank'];
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
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/member.css">

    <link rel="stylesheet" href="../lib/onepage-scroll.css">

  </head>
  <body>

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
            echo
        "<form method = \"POST\" name =\"analyform\" id = \"analyform\" action =\"http://commercial-env.apkxyagrzb.ap-northeast-2.elasticbeanstalk.com/main/\"></form>
          <input type = \"hidden\" name=\"u_id\" value = \"$u_id\"/>";
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
    
    <div id="estimate_nav_btn">
      <div class="menu" onClick="hoverNavigation()">
        <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px;" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
      </div>
    </div>

    <div id="estimate">
    
      <section>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
    
            <div class="container">
              <div class="row">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">1 ></span>견적받으실 분야를 선택해주세요.<div class="circle"></div>
                </div>
              </div>
              <div class="row margin_top_m margin_left_l">
                <div class="col-12 margin_top_s">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="" 
                            onchange="formtype('form1'); estimateSlideTo(2);">
                    <label class="form-check-label font_size_l" for="exampleRadios1">
                      인테리어
                    </label>
                  </div>
                </div>
                <div class="col-12 margin_top_s">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="" 
                            onchange="formtype('form2'); estimateSlideTo(8);">
                    <label class="form-check-label font_size_l" for="exampleRadios2">
                      마케팅
                    </label>
                  </div>
                </div>
                <div class="col-12 margin_top_s">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="" 
                            onchange="formtype('form3'); estimateSlideTo(12)">
                    <label class="form-check-label font_size_l" for="exampleRadios3">
                      홈페이지
                    </label>
                  </div>
                </div>
                <div class="col-12 margin_top_s">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value=""
                            onchange="formtype('form4'); estimateSlideTo(14)">
                    <label class="form-check-label font_size_l" for="exampleRadios4">
                      자금대출
                    </label>
                  </div>
                </div>
                <div class="col-12 margin_top_s">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="" 
                            onchange="formtype('form5'); estimateSlideTo(18)">
                    <label class="form-check-label font_size_l" for="exampleRadios5">
                      의료장비
                    </label>
                  </div>
                </div>
                <div class="col-12 margin_top_s">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios6" value="" 
                            onchange="formtype('form6'); estimateSlideTo(20)">
                    <label class="form-check-label font_size_l" for="exampleRadios6">
                      의료소모품, 세무사 및 기타
                    </label>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </section>
  
      <form id = "form1" name = "form1" method = "POST" action = "form/form1.php">
      <section>

        <input type = "hidden" name = "u_id" value = "<?=$u_id?>"/>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
  
            <div class="container">
              <div class="row">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">2 ></span>인테리어 받을 곳의 주소를 알려주세요.<div class="circle"></div>
                </div>
                <div class="col-12 font_size_l margin_top_m">(시/군/구/지/동 정확히 입력해주세요)</div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f1_address" name = "f1_address" placeholder="주소를 입력해주세요" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(3)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </section>


      <section>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">

            <div class="container">
              <div class="row">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">3 ></span>공사 면적을 알려주세요.<div class="circle"></div>
                </div>
                <div class="col-12 font_size_l margin_top_m">(평수/층수 모두 작성해주세요)</div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f1_det" name = "f1_det" placeholder="공사 면적을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(4)">다음 ❯</div>
                </div>
              </div>
            </div>  
          
          </div>
        </div>

      </section>


      <section>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">

            <div class="container">
              <div class="row">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">4 ></span>공사 예산을 알려주세요.<div class="circle"></div>
                </div>
                
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f1_budget" name = "f1_budget" placeholder="공사 예산을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(5)">다음 ❯</div>
                </div>
              </div>
            </div>
          
          </div>
        </div>

      </section>
  

      <section>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">

            <div class="container">
              <div class="row">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">5 ></span>원하시는 컨셉을 알려주세요.<div class="circle"></div>
                </div>
                <div class="col-12 font_size_l margin_top_m">(고급 프리미엄/저가 등)</div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f1_concept" name = "f1_concept" placeholder="컨셉을 말씀해주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(6)">다음 ❯</div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
            
      </section>


      <section id>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">

            <div class="container">
              <div class="row">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">6 ></span>시공 예정일을 알려주세요.<div class="circle"></div>
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f1_date" name = "f1_date" placeholder="년/월/일" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(7)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
        
      </section>


      <section id>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
            
            <div class="container">
              <div class="row">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">7 ></span>희망 사항을 알려주세요.
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f1_extra" name = "f1_extra" placeholder="희망 사항을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" ><input type = "submit" value="제출하기" style="border: none; background-color:transparent; color:#FFFFFF" onclick="return submit1()"/></button>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </section>
      </form>

      <form id = "form2" name = "form2" method = "POST" action = "form/form2.php">
      <section>

        <input type = "hidden" name = "u_id" value = "<?=$u_id?>"/>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
  
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">2 ></span>마케팅 시작 예정일을 알려주세요.<div class="circle"></div>
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f2_date" name="f2_date" placeholder="년/월/일" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(9)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </section>


      <section>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">

            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">3 ></span>마케팅 예산을 입력해주세요<div class="circle"></div>
                </div>
              
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f2_money" name="f2_money" placeholder="마케팅 예산을 입력해주세요" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(10)">다음 ❯</div>
                </div>
              </div>
            </div>  
          
          </div>
        </div>

      </section>


      <section>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">

            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">4 ></span>원하는 공고 종류를 선택해주세요<div class="circle"></div>
                </div>
                <div class="col-12 font_size_l margin_top_m">-온라인 마케팅 / 오프라인 마케팅 / 모두</div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f2_type" name="f2_type" placeholder="원하는 공고 종류를 입력해주세요" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(11)">다음 ❯</div>
                </div>
              </div>
            </div>
          
          </div>
        </div>

      </section>
  
      <section>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
            
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">5 ></span>희망 사항을 알려주세요.
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f2_extra" name="f2_extra" placeholder="희망 사항을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" ><input type = "submit" value="제출하기" style="border: none; background-color:transparent; color:#FFFFFF" onclick="return submit2()"/></div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </section>
      </form>

      <form id = "form3" name = "form3" method = "POST" action = "form/form3.php">
      <section>
        <input type = "hidden" name = "u_id" value = "<?=$u_id?>"/>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
  
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">2 ></span>원하는 컨셉이나 예시 사이트를 입력해주세요.<div class="circle"></div>
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f3_concept" name="f3_concept" placeholder="원하는 컨셉이나 예시 사이트를 입력해주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(13)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </section>
  
      <section>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
            
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">3 ></span>희망 사항을 알려주세요.
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f3_extra" name="f2_extra" placeholder="희망 사항을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" ><input type = "submit" value="제출하기" style="border: none; background-color:transparent; color:#FFFFFF" onclick="return submit3()"/></div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </section>
      </form>

      <form id = "form4" name = "form4" method = "POST" action = "form/form4.php">
      <section>
        <input type = "hidden" name = "u_id" value = "<?=$u_id?>"/>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
  
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">2 ></span>재직 형태를 선택해주세요.<div class="circle"></div>
                </div>
                <div class="col-12 font_size_l margin_top_m">-개원의사 / 개원예정의사 / 봉직의사 / 기타(직접 입력)</div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f4_type" name="f4_type" placeholder="재직 형태를 입력해주세요" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(15)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </section>

      <section>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">

            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">3 ></span>자격 취득 년도를 입력해주세요.<div class="circle"></div>
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f4_year" name="f4_year" placeholder="자격 취득 년도를 입력해주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(16)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>

        </section>

        <section>

            <div class="container">
              <div class="row align-items-center" style="height: 100vh;">

                <div class="container">
                  <div class="row ">
                    <div class="col-12 font_size_ll font_weight_b">
                      <span class="color_b margin_right_m">4 ></span>대출이 필요한 시기를 입력해주세요<div class="circle"></div>
                    </div>
                    <div class="col-12 margin_top_l">
                      <input type="text" class="input_02 form-control" id = "f4_date" name="f4_date" placeholder="YYYY-MM-DD" onfocus="this.style.opacity = 1"/>
                    </div>
                    <div class="col-4 col-sm-3 margin_top_l">
                      <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(17)">다음 ❯</div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            </section>
      <section>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
            
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">5 ></span>희망 사항을 알려주세요.
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f4_extra" name="f4_extra" placeholder="희망 사항을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" ><input type = "submit" value="제출하기" style="border: none; background-color:transparent; color:#FFFFFF" onclick="return submit4()"/></div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </section>
      </form>

      <form id = "form5" name = "form5" method = "POST" action = "form/form5.php">
      <section>
        <input type = "hidden" name = "u_id" value = "<?=$u_id?>"/>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
  
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">2 ></span>필요한 의료장비 이름을 입력해주세요.<div class="circle"></div>
                </div>
                <div class="col-12 font_size_l margin_top_m">여러개일 경우 모델명과 장비명을 모두 적어주세요</div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f5_all" name="f5_all" placeholder="필요한 의료장비 이름을 입력해주세요" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(19)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </section>

      <section>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
            
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">3 ></span>희망 사항을 알려주세요.
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f5_extra" name="f5_extra" placeholder="희망 사항을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" ><input type = "submit" value="제출하기" style="border: none; background-color:transparent; color:#FFFFFF" onclick="return submit5()"/></div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </section>
      </form>

      <form id = "form6" name = "form6" method = "POST" action = "form/form6.php">
      <section>
        <input type = "hidden" name = "u_id" value = "<?=$u_id?>"/>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
  
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">2 ></span>원하시는 서비스/상품의 종류를 선택해주세요.<div class="circle"></div>
                </div>
                <div class="col-12 font_size_l margin_top_m">-의약품/소모품 , 배상책임보험, 간판, 전자차트, 보안시설, 로고제작, 세무사, 부동산, 기타 (직접입력)</div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control"  id = "f6_type" name="f6_type" placeholder="원하시는 서비스/상품의 종류를 선택해주세요" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(21)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </section>

      <section>

        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
  
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">3 ></span>구체적인 서비스 / 상품의 내용을 입력해주세요<div class="circle"></div>
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f6_detail" name="f6_detail" placeholder="구체적인 서비스 / 상품의 내용을 입력해주세요" onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" onclick="estimateSlideTo(22)">다음 ❯</div>
                </div>
              </div>
            </div>

          </div>
        </div>
  
      </section>

      <section>
        <div class="container">
          <div class="row align-items-center" style="height: 100vh;">
            
            <div class="container">
              <div class="row ">
                <div class="col-12 font_size_ll font_weight_b">
                  <span class="color_b margin_right_m">4 ></span>희망 사항을 알려주세요.
                </div>
                <div class="col-12 margin_top_l">
                  <input type="text" class="input_02 form-control" id = "f6_extra" name="f6_extra" placeholder="희망 사항을 알려주세요." onfocus="this.style.opacity = 1"/>
                </div>
                <div class="col-4 col-sm-3 margin_top_l">
                  <div class="button" style="height: 33px;font-size: 18px;" ><input type = "submit" value="제출하기" style="border: none; background-color:transparent; color:#FFFFFF" onclick="return submit6()"/></div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </section>
      </form>


    </div>
    <div class="background_layer display_none" id="background_layer_01" onclick="hoverNavigation()"></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../lib/jquery.onepage-scroll.min.js"></script>
    <script src="../script/common.js"></script>
    <script src="../script/service.js"></script>
    <script>
    function gotoanal(){
      $('#analyform').submit();
    }
    </script>
  </body>
</html>