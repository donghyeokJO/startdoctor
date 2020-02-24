<?php
    header('Content-Type:application/json');

    function get_keywords($u_id)
    {
        include 'config.php';
        include 'util.php';
        $conn = dbconnect($host, $dbid, $dbpass, $dbname);
        $query = "select * from user_view where u_id = '$u_id'";
        if ($result = mysqli_query($conn, $query, MYSQLI_USE_RESULT)) {
            $i = 1;
            $temparr = [];
            while ($row = mysqli_fetch_object($result)) {
                $t = [];
                $t['no'] = $i;
                $i++;
                $t['date'] = $row['date'];
                $t['subject'] = $row['subject'];
                $t['juso'] = $row['juso'];
                array_push($temparr, $t);

                unset($t);
            }
        }
        echo json_encode($temparr);
    }

    get_keywords($_POST['uid']);
