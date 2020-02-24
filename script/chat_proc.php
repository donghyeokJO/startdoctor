<?php
    header('Content-Type:application/json');

    function get_chat($coach_id)
    {
        include 'config.php';
        include 'util.php';
        $conn = dbconnect($host, $dbid, $dbpass, $dbname);
        $query = "select * from chat where coach_id = '$coach_id";
        if ($result = mysqli_query($conn, $query)) {
            $temp_arr = [];
            while ($row = mysqli_fetch_array($result)) {
                $t = [];
                $t['user'] = $row['name'];
                $t['time'] = $row['date'];
                $t['message'] = $row['msg'];
                $temp_arr = $t;
                unset($t);
            }
        } else {
            $temp_arr = [0 => 'empty'];
        }
        echo json_encode($temp_arr);
    }

    get_chat($_POST['coach_id']);
