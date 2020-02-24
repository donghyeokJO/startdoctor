<?php
include 'config.php';
include 'util.php';
$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$query = 'select * from form3 where u_id=1 union select * from form5 where u_id=1';
$ret = mysqli_query($query);
$as = mysqli_fetch_array($ret);
?>

<html>
    <form method ="POST" action="http://analysis-web2-dev.ap-northeast-2.elasticbeanstalk.com/user/user_login/">
        <input type = "number" name ="u_id"/>
        <input type ="submit"/>
        </form>
</html>