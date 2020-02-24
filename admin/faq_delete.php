<?php
     include 'config.php';
     include 'util.php';

     $conn = dbconnect($host, $dbid, $dbpass, $dbname);
     $f_no = $_GET['f_no'];

     $query = "delete from faq where f_no=$f_no";

     $ret = mysqli_query($conn, $query);

     if (!$ret) {
         alert_msg('Query Error : ' . mysqli_error($conn));
     } else {
         s_msg('성공적으로 삭제 되었습니다');
         echo "<meta http-equiv='refresh' content='0;url=faq.php'>";
     }
