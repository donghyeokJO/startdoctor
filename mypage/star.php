<?php
    header('Content-Type:application/json');

    function get_keywords($u_id, $c_id)
    {
        include 'config.php';
        include 'util.php';
        $conn = dbconnect($host, $dbid, $dbpass, $dbname);
        $query = "insert into star(u_id,c_id) values('$u_id','$c_id')";
        if (mysqli_query($conn, $query)) {
            echo 'success';
        }
    }

    get_keywords($_POST['u_id'], $_POST['corp_id']);
