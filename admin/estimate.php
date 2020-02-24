<?php
  include 'config.php';
  include 'util.php';

  $conn = dbconnect($host, $dbid, $dbpass, $dbname);

  $estimate_query1 = 'select * from form1 ';
  $estimate_ret1 = mysqli_query($conn, $estimate_query1);
  $e1 = mysqli_num_rows($estimate_ret1);

  $estimate_query2 = 'select * from form2 ';
  $estimate_ret2 = mysqli_query($conn, $estimate_query2);
  $e2 = mysqli_num_rows($estimate_ret2);

  $estimate_query3 = 'select * from form3 ';
  $estimate_ret3 = mysqli_query($conn, $estimate_query3);
  $e3 = mysqli_num_rows($estimate_ret3);

  $estimate_query4 = 'select * from form4 ';
  $estimate_ret4 = mysqli_query($conn, $estimate_query4);
  $e4 = mysqli_num_rows($estimate_ret4);

  $estimate_query5 = 'select * from form5 ';
  $estimate_ret5 = mysqli_query($conn, $estimate_query5);
  $e5 = mysqli_num_rows($estimate_ret5);

  $estimate_query6 = 'select * from form6 ';
  $estimate_ret6 = mysqli_query($conn, $estimate_query6);
  $e6 = mysqli_num_rows($estimate_ret6);

  $total_num = $e1 + $e2 + $e3 + $e4 + $e5 + $e6;

?>
<!DOCTYPE html>
<html>
<head>
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
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                사용자 관리
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="user.php" class="nav-link">
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
          <li class="nav-item has-treeview  menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                컨텐츠 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="estimate.php" class="nav-link active">
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
              <h3 class="card-title">스타트 닥터 비교견적목록</h3>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>번호</th>
                    <th>사용자 이름</th>
                    
                  <th>유형</th>
                  <th>답변 수</th>
                  <th>일시</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i++;
                while ($row = mysqli_fetch_assoc($estimate_ret1)) {
                    $u_id = $row['u_id'];
                    $fid = $row['fid'];
                    $query = "select * from user where u_id='$u_id'";
                    $tmp = mysqli_query($conn, $query);
                    $u_name = mysqli_fetch_assoc($tmp)['u_name'];
                    $query = "select * from f1_answer where fid='$fid'";
                    $ans_num = mysqli_num_rows(mysqli_query($conn, $query));
                    echo "
                    <tr>
                    <td><a href=\"estimate_detail.php?type=1&fid=$fid\">$i</a></td>
                    <td>$u_name</td>
                    <td>인테리어</td>
                    <td>$ans_num</td>
                    <td>$row[date]</td>
                    </tr>
                    ";
                    $i++;
                };
                while ($row = mysqli_fetch_assoc($estimate_ret2)) {
                    $u_id = $row['u_id'];
                    $fid = $row['fid'];
                    $query = "select * from user where u_id='$u_id'";
                    $tmp = mysqli_query($conn, $query);
                    $u_name = mysqli_fetch_assoc($tmp)['u_name'];
                    $query = "select * from f2_answer where fid='$fid'";
                    $ans_num = mysqli_num_rows(mysqli_query($conn, $query));
                    echo "
                    <tr>
                     <td><a href=\"estimate_detail.php?type=2&fid=$fid\">$i</a></td>
                    <td>$u_name</td>
                    <td>마케팅</td>
                    <td>$ans_num</td>
                    <td>$row[date]</td>
                    </tr>
                    ";
                    $i++;
                };
                while ($row = mysqli_fetch_assoc($estimate_ret3)) {
                    $u_id = $row['u_id'];
                    $fid = $row['fid'];
                    $query = "select * from user where u_id='$u_id'";
                    $tmp = mysqli_query($conn, $query);
                    $u_name = mysqli_fetch_assoc($tmp)['u_name'];
                    $query = "select * from f3_answer where fid='$fid'";
                    $ans_num = mysqli_num_rows(mysqli_query($conn, $query));
                    echo "
                    <tr>
                     <td><a href=\"estimate_detail.php?type=3&fid=$fid\">$i</a></td>
                    <td>$u_name</td>
                    <td>홈페이지</td>
                    <td>$ans_num</td>
                    <td>$row[date]</td>
                    </tr>
                    ";
                    $i++;
                };
                while ($row = mysqli_fetch_assoc($estimate_ret4)) {
                    $u_id = $row['u_id'];
                    $fid = $row['fid'];
                    $query = "select * from user where u_id='$u_id'";
                    $tmp = mysqli_query($conn, $query);
                    $u_name = mysqli_fetch_assoc($tmp)['u_name'];
                    $query = "select * from f4_answer where fid='$fid'";
                    $ans_num = mysqli_num_rows(mysqli_query($conn, $query));
                    echo "
                    <tr>
                     <td><a href=\"estimate_detail.php?type=4&fid=$fid\">$i</a></td>
                    <td>$u_name</td>
                    <td>자금대출</td>
                    <td>$ans_num</td>
                    <td>$row[date]</td>
                    </tr>
                    ";
                    $i++;
                };
                while ($row = mysqli_fetch_assoc($estimate_ret5)) {
                    $u_id = $row['u_id'];
                    $fid = $row['fid'];
                    $query = "select * from user where u_id='$u_id'";
                    $tmp = mysqli_query($conn, $query);
                    $u_name = mysqli_fetch_assoc($tmp)['u_name'];
                    $query = "select * from f5_answer where fid='$fid'";
                    $ans_num = mysqli_num_rows(mysqli_query($conn, $query));
                    echo "
                    <tr>
                     <td><a href=\"estimate_detail.php?type=5&fid=$fid\">$i</a></td>
                    <td>$u_name</td>
                    <td>의료장비</td>
                    <td>$ans_num</td>
                    <td>$row[date]</td>
                    </tr>
                    ";
                    $i++;
                };
                while ($row = mysqli_fetch_assoc($estimate_ret6)) {
                    $u_id = $row['u_id'];
                    $fid = $row['fid'];
                    $query = "select * from user where u_id='$u_id'";
                    $tmp = mysqli_query($conn, $query);
                    $u_name = mysqli_fetch_assoc($tmp)['u_name'];
                    $query = "select * from f6_answer where fid='$fid'";
                    $ans_num = mysqli_num_rows(mysqli_query($conn, $query));
                    echo "
                    <tr>
                     <td><a href=\"estimate_detail.php?type=6&fid=$fid\">$i</a></td>
                    <td>$u_name</td>
                    <td>의료소모품,세무사 및 기타</td>
                    <td>$ans_num</td>
                    <td>$row[date]</td>
                    </tr>
                    ";
                    $i++;
                };
                ?>
                </tbody>
                <tfoot>
                <tr>
                <th>번호</th>
                <th>사용자 이름</th>
                  <th>유형</th>
                  <th>답변 수</th>
                  <th>일시</th>
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
</body>
</html>
