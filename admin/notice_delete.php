<?php
     include 'config.php';
     include 'util.php';

     $conn = dbconnect($host, $dbid, $dbpass, $dbname);
     $n_no = $_GET['n_no'];

     $query = "delete from notice where n_no=$n_no";

     $ret = mysqli_query($conn, $query);

     if (!$ret) {
         alert_msg('Query Error : ' . mysqli_error($conn));
     } else {
         s_msg('성공적으로 삭제 되었습니다');
         echo "<meta http-equiv='refresh' content='0;url=notice.php'>";
     }
