<?php
    include 'config.php';
    include 'util.php';
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);

    $query = 'select * from coach';
    $ret = mysqli_query($conn, $query);
    $coaches = mysqli_fetch_all($ret);
    $all = mysqli_num_rows($ret);
    echo $all;
    $arr = [];
    for ($i = 0;$i < $all;$i++) {
        $cid = $coaches[$i][0];
        echo $cid;
        $query = "select * from chat where coach_id = '$cid' order by date desc";
        $res = mysqli_query($conn, $query);
        $chat = mysqli_fetch_array($res);
        $t = [];
        $t['msg'] = $chat['msg'];
        $id = $chat['user1'];
        echo $id;
        $qu = "select * from user where u_id = '$chat[user1]'";
        $asdf = mysqli_query($conn, $qu);
        $as = mysqli_fetch_array($asdf);
        $t['name'] = $as['u_name'];
        $t['date'] = $chat['date'];
        $arr = $t;
        unset($t);
    }
    echo json_encode($arr);
