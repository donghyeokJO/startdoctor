<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $data = $_POST['array'];
    $result = 200;
    for ($i = 0;$i < count($data);$i++) {
        $u_id = $data[$i];
        $query = "select * from user where u_id ='$u_id'";
        $temp = mysqli_query($conn, $query);
        $user = mysqli_fetch_array($temp);
        $count = $user['u_count'];
        $count = $count + 1;
        $query = "update user set u_count = '$count' where u_id = '$u_id'";
        if (!mysqli_query($conn, $query)) {
            $result = 201;
        }
    }
    echo json_encode(['result' => $result]);
