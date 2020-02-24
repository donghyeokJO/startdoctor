<?php
  include 'config.php';
  include 'util.php';

  $conn = dbconnect($host, $dbid, $dbpass, $dbname);

  $user_query = 'select * from user where u_specify = "의사" or (u_specify = "미인증" and u_type is NULL) order by regi_date desc';
  $user_ret = mysqli_query($conn, $user_query);
  $user_num = mysqli_num_rows($user_ret);
  session_start();
  $u_email = $_SESSION['u_email'];
  $query = "select * from user where u_email='$u_email'";
  $ret = mysqli_query($conn, $query);
  $apap = mysqli_fetch_assoc($ret);
  $isbest = false;
  if ($apap['u_id'] == 35) {
      $isbest = true;
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
  <title>스타트닥터 | 관리자페이지 </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM 
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="image/favicon.ico" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">STARTDOCTOR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/austin.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Austin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                대시보드
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>메인</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                사용자 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>사용자 목록 - 의사</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="corp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>사용자 목록 - 업체 </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="admin.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>운영진 관리</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-notes-medical"></i>
              <p>
                개원 세미나
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="question.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>질문 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="reception.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>접수자 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="give_one.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>1회권 지급</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                사이트 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="notice.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>공지사항 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="faq.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FAQ 관리</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ask.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>문의사항 관리</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                컨텐츠 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="estimate.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>비교견적</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="analysis.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>개원상권분석</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="chat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>상담채팅</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                통계
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="stat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>개요</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="visitor.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>방문자통계</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fvp.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>많이 방문한 페이지</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="traffic.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>트래픽</p>
                </a>
              </li>
            </ul>
          </li>
         
              
    
         
              
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
     
      <div class="card">
            <div class="card-header">
              <h3 class="card-title">스타트 닥터 회원목록</h3>
              <button type="button" class="btn btn-block btn-primary btn-sm" style ="width:20%; margin-left:80%"  onclick = "location.href='add_doctor.html'">회원 추가</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th> 회원가입 일시 </th>
                    <th>사용자 이름</th>
                  <th>회원 구분</th>
                  <th>이메일</th>
                  <th>면허번호</th>
                  <th>생년월일</th>
                  <th>전화번호</th>
                 
                  <th>비고</th>
                  <th>비고2</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($user_ret)) {
                    $birth = substr((string)$row['u_birth'], 2, 8);
                    $birth = str_replace('-', '', $birth);
                    echo "
                    
                <tr>
                  <th>$row[regi_date]</td>
                  <td><a href = \"user_detail.php?u_id=$row[u_id]\" style = \"color:#212529\">$row[u_name]</a></td>
                  <td>$row[u_specify] | $row[u_rank]
                  </td>
                  <td>$row[u_email]</td>";
                    if ($isbest) {
                        echo "<td>$row[u_license]</td>";
                    } else {
                        echo '<td>blocked</td>';
                    }
                    echo "
                  <td>$birth</td>
                  <td>$row[u_phone]</td>
                  ";

                    if ($row['u_specify'] == '미인증' && $isbest) {
                        echo "<td>
                          <button type=\"button\" class=\"btn btn-block btn-default btn-sm\" onclick = \"javascript:admit('{$row[u_id]}')\">승인</button>
                          <button type=\"button\" class=\"btn btn-block btn-default btn-sm\" onclick = \"javascript:pend('{$row[u_id]}')\">반려</button>
                          <button type=\"button\" class=\"btn btn-block btn-default btn-sm\" onclick = \"javascript:reject('{$row[u_id]}')\">거절</button>
                        </td>";
                    } else {
                        echo '<td></td>';
                    }
                    $sentence = '된 회원입니다.';
                    $r = false;
                    $u_email = $row['u_email'];
                    $query = "select * from rejected_user where u_email = '$u_email'";
                    // $a = mysqli_num_rows(mysqli_query($conn, $query));
                    // echo $a;
                    if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
                        $sentence = '승인 반려' . $sentence;
                        $r = true;
                    }
                    $query = "select * from deleted user where u_email = '$u_email'";
                    if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
                        $sentence = '승인 거절' . $sentence;
                        $r = true;
                    }
                    if (!$r) {
                        $sentence = '';
                    }
                    echo "<td>$sentence</td>";
                    echo '</tr>';
                };
                ?>
                </tbody>
                <tfoot>
                <tr>
                <th> 회원가입 일시 </th>
                  <th>사용자 이름</th>
                  <th>회원 구분</th>
                  <th>이메일</th>
                  <th>면허번호</th>
                  <th>생년월일</th>
                  <th>전화번호</th>
                 
                  <th>비고</th>
                  <th>비고2</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
      </div>
      </section>
      </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">ESZETT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  function admit(u_id){
    if(confirm("의사 회원으로 인증하시겠습니까?")==true){
      window.location = "user_upgrade.php?u_id=" + u_id;
    }
    else return;
  }
</script>

<script>
  function pend(u_id){
    if(confirm("의사 회원 인증 반려하시겠습니까?")==true){
      window.location ="user_pend.php?u_id="+u_id;
    }
  }
</script>

<script>
  function reject(u_id){
    if(confirm("의사 회원 승인 거절하시겠습니까?")==true){
      window.location ="user_reject.php?u_id="+u_id;
    }
  }
</script>
</body>
</html>
