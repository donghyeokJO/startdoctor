<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $data = $_POST['array'];

    for ($i = 0;$i < count($data);$i++) {
        $id = $data[$i];
        $query = "select * from seminar where id ='$id'";
        $temp = mysqli_query($conn, $query);
        $user = mysqli_fetch_array($temp);

        $query = "update seminar set came = '참석' where id = '$id'";
        if (!mysqli_query($conn, $query)) {
            $result = 201;
        }
    }
    echo json_encode(['result' => $result]);
