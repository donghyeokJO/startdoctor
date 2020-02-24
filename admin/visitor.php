<?php
  include 'config.php';
  include 'util.php';

  $conn = dbconnect($host, $dbid, $dbpass, $dbname);
  session_start();
  $u_email = $_SESSION['u_email'];

  $admin_query = "select * from user where u_email='$u_email'";
  $admin_ret = mysqli_query($conn, $admin_query);
  $admin = mysqli_fetch_array($admin_ret);
  $isadmin = false;
  if ($admin['u_specify'] == '관리자') {
      $isadmin = true;
  }
  if ($isadmin == false) {
      echo "<meta http-equiv='refresh' content='0;url=../main/index.php'>";
  }
  $user_query = 'select * from user';
  $user_ret = mysqli_query($conn, $user_query);
  $user = mysqli_fetch_array($user_ret);
  $user_num = mysqli_num_rows($user_ret);

  $question_query = 'select * from question';
  $question_ret = mysqli_query($conn, $question_query);
  $question_num = mysqli_num_rows($question_ret);

  $notice_query = 'select * from notice';
  $notice_ret = mysqli_query($conn, $notice_query);
  $notice_num = mysqli_num_rows($notice_ret);

  $faq_query = 'select * from faq';
  $faq_ret = mysqli_query($conn, $faq_query);
  $faq_num = mysqli_num_rows($faq_ret);
?>

<style>
    table{
      border-collapse: collapse;
      border: 1px solid black;
    }
    table.type1 {
      border-collapse: separate;
      border-spacing: 1px;
      text-align: center;
    }

    table.type1 th {
      font-weight: bold;
      vertical-align: top;
      color: #fff;
      background: #5658d3 ;
    }

    table.type11 td {
      vertical-align: top;
      border-bottom: 1px solid #ccc;
      background: #eee;
    }
</style>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="google-signin-client_id" content="848021792134-aoqdq5vc61rhn1e0cnekrmaih7ge8hll.apps.googleusercontent.com">
  <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics">
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
  <script>
(function(w,d,s,g,js,fs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
  js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
}(window,document,'script'));
</script>


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
        <a href="../main/index.php" class="nav-link">Home</a>
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
          <a href="#" class="d-block"><?php echo "$admin[u_name]"?></a>
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
            <a href="#" class="nav-link">
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
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
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
                <a href="visitor.php" class="nav-link active">
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
        <!-- Small boxes (Stat box) -->

        <!-- The Sign-in button. This will run `queryReports()` on success. -->

      <script>

    gapi.analytics.ready(function() {
    
      gapi.analytics.auth.authorize({
        container: 'embed-api-auth-container',
        clientid: '9572161998-jck6jqjfb1duqfa51573no4ru2g43m01.apps.googleusercontent.com'
      });
    
      var viewSelector = new gapi.analytics.ViewSelector({
        container: 'view-selector-container'
      });
    
      viewSelector.execute();
    
      var mainChart = new gapi.analytics.googleCharts.DataChart({
        query: {
          'dimensions': 'ga:source',
          'metrics': 'ga:newUsers',
          'sort': '-ga:newUsers',
          'max-results': '10'
        },
        chart: {
          type: 'TABLE',
          container: 'newUsers-main-chart-container',
          options: {
            width: '100%'
          }
        }
      });
    
      var breakdownChart = new gapi.analytics.googleCharts.DataChart({
        query: {
          'dimensions': 'ga:date',
          'metrics': 'ga:newUsers',
          'start-date': '30daysAgo',
          'end-date': 'today'
        },
        chart: {
          type: 'LINE',
          container: 'newUsers-breakdown-chart-container',
          options: {
            width: '100%'
          }
        }
      });
    
      var mainChartRowClickListener;
    
      viewSelector.on('change', function(ids) {
        var options = {query: {ids: ids}};
    
        if (mainChartRowClickListener) {
          google.visualization.events.removeListener(mainChartRowClickListener);
        }
    
        mainChart.set(options).execute();
        breakdownChart.set(options);
    
        if (breakdownChart.get().query.filters) breakdownChart.execute();
      });
    
      mainChart.on('success', function(response) {
    
        var chart = response.chart;
        var dataTable = response.dataTable;
    
        mainChartRowClickListener = google.visualization.events
            .addListener(chart, 'select', function(event) {
    
          if (!chart.getSelection().length) return;
    
          var row =  chart.getSelection()[0].row;
          var source =  dataTable.getValue(row, 0);
          var options = {
            query: {
              filters: 'ga:source==' + source
            },
            chart: {
              options: {
                title: source
              }
            }
          };
    
          breakdownChart.set(options).execute();
        });
      });
    });
    </script>

<script>

    gapi.analytics.ready(function() {
    
      gapi.analytics.auth.authorize({
        container: 'embed-api-auth-container',
        clientid: '9572161998-jck6jqjfb1duqfa51573no4ru2g43m01.apps.googleusercontent.com'
      });
    
      var viewSelector = new gapi.analytics.ViewSelector({
        container: 'view-selector-container'
      });
    
      viewSelector.execute();
    
      var mainChart = new gapi.analytics.googleCharts.DataChart({
        query: {
          'dimensions': 'ga:userType',
          'metrics': 'ga:avgSessionDuration',
          'sort': '-ga:avgSessionDuration',
          'max-results': '10'
        },
        chart: {
          type: 'TABLE',
          container: 'avgSessionDuration-main-chart-container',
          options: {
            width: '100%'
          }
        }
      });
    
      var breakdownChart = new gapi.analytics.googleCharts.DataChart({
        query: {
          'dimensions': 'ga:date',
          'metrics': 'ga:avgSessionDuration',
          'start-date': '30daysAgo',
          'end-date': 'today'
        },
        chart: {
          type: 'LINE',
          container: 'avgSessionDuration-breakdown-chart-container',
          options: {
            width: '100%'
          }
        }
      });
    
      var mainChartRowClickListener;
    
      viewSelector.on('change', function(ids) {
        var options = {query: {ids: ids}};
    
        if (mainChartRowClickListener) {
          google.visualization.events.removeListener(mainChartRowClickListener);
        }
    
        mainChart.set(options).execute();
        breakdownChart.set(options);
    
        if (breakdownChart.get().query.filters) breakdownChart.execute();
      });
    
      mainChart.on('success', function(response) {
    
        var chart = response.chart;
        var dataTable = response.dataTable;
    
        mainChartRowClickListener = google.visualization.events
            .addListener(chart, 'select', function(event) {
    
          if (!chart.getSelection().length) return;
    
          var row =  chart.getSelection()[0].row;
          var userType =  dataTable.getValue(row, 0);
          var options = {
            query: {
              filters: 'ga:userType==' + userType
            },
            chart: {
              options: {
                title: userType
              }
            }
          };
    
          breakdownChart.set(options).execute();
        });
      });
    });
    </script>

<script>

gapi.analytics.ready(function() {

  gapi.analytics.auth.authorize({
    container: 'embed-api-auth-container',
    clientid: '9572161998-jck6jqjfb1duqfa51573no4ru2g43m01.apps.googleusercontent.com'
  });

  var viewSelector = new gapi.analytics.ViewSelector({
    container: 'view-selector-container'
  });

  viewSelector.execute();

  var mainChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      'dimensions': 'ga:browser',
      'metrics': 'ga:Users',
      'sort': '-ga:Users',
      'max-results': '10'
    },
    chart: {
      type: 'TABLE',
      container: 'Users-main-chart-container',
      options: {
        width: '100%'
      }
    }
  });

  var breakdownChart = new gapi.analytics.googleCharts.DataChart({
    query: {
      'dimensions': 'ga:date',
      'metrics': 'ga:Users',
      'start-date': '30daysAgo',
      'end-date': 'today'
    },
    chart: {
      type: 'LINE',
      container: 'Users-breakdown-chart-container',
      options: {
        width: '100%'
      }
    }
  });

  var mainChartRowClickListener;

  viewSelector.on('change', function(ids) {
    var options = {query: {ids: ids}};

    if (mainChartRowClickListener) {
      google.visualization.events.removeListener(mainChartRowClickListener);
    }

    mainChart.set(options).execute();
    breakdownChart.set(options);

    if (breakdownChart.get().query.filters) breakdownChart.execute();
  });

  mainChart.on('success', function(response) {

    var chart = response.chart;
    var dataTable = response.dataTable;

    mainChartRowClickListener = google.visualization.events
        .addListener(chart, 'select', function(event) {

      if (!chart.getSelection().length) return;

      var row =  chart.getSelection()[0].row;
      var browser =  dataTable.getValue(row, 0);
      var options = {
        query: {
          filters: 'ga:browser==' + browser
        },
        chart: {
          options: {
            title: browser
          }
        }
      };

      breakdownChart.set(options).execute();
    });
  });
});
</script>
<!-- Load the JavaScript API client and Sign-in library. -->


        <!-- /.row -->
        <!-- Main row -->
       
              <!-- /.card-body -->
    <div id="embed-api-auth-container"></div>
    <br>
    <div id="view-selector-container" style ="display:none"></div>
    <br>
    <div id="newUsers-main-chart-container"></div>
    <div id="newUsers-breakdown-chart-container"></div>
    <br>
    <div id="avgSessionDuration-main-chart-container"></div>
    <div id="avgSessionDuration-breakdown-chart-container"></div>
    <br>
    <div id="Users-main-chart-container"></div>
    <div id="Users-breakdown-chart-container"></div>
            <!-- /.card -->

       
    <!-- /.content -->

  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">ESZETT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer> -->

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
</body>
</html>
