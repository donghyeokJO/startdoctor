<?php
function dbconnect($host, $dbid, $dbpass, $dbname)
{
    $conn = mysqli_connect($host, $dbid, $dbpass, $dbname);
    if ($conn == false) {
        die('Not connected : ' . mysqli_error());
    }
    return $conn;
}
function msg($msg)
{
    echo "
        <script>
             window.alert('$msg');
             history.go(-1);
        </script>";
    exit;
}
function s_msg($msg)
{
    echo "
        <script>
            window.alert('$msg');
        </script>";
}
?>  