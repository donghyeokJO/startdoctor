<?php
    include 'config.php';
    include 'util.php';

    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $user1 = $_GET['corp_id'];
    $user2 = $_GET['u_id'];

    $query = "select * from coach where user1 ='$user1' and user2 = '$user2'";
    $ret = mysqli_query($conn, $query);

    if (mysqli_num_rows($ret) == 0) {
        $query = "insert into coach(user1,user2) values('$user1','$user2') ";
        $res = mysqli_query($conn, $query);
        if ($res) {
            $coach_id = mysqli_insert_id($conn);
            echo "<script>location.href='chat_list.php?coach_id=$coach_id'</script>";
        } else {
            msg('unknown error!');
        }
    } else {
        $coach = mysqli_fetch_array($ret);
        $coach_id = $coach['coach_id'];
        echo "<script>location.href='chat_list.php?coach_id=$coach_id'</script>";
    }
