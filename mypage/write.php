<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $name = $_POST['name'];
    $user1 = $_POST['user1'];
    $user2 = $_POST['user2'];
    $msg = $_POST['msg'];
    $coach_id = $_POST['coach_id'];
    $date = date('Y-m-d H:i:s');
    $sql = "insert into chat(user1,user2,name,msg,date,coach_id) values('$user1','$user2','$name','$msg','$date','$coach_id')";
    $query = "update coach set last = '$date' where coach_id = '$coach_id'";
    mysqli_query($conn, $query);
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['statusCode' => 200]);
    } else {
        echo json_encode(['statusCode' => 201]);
    }
