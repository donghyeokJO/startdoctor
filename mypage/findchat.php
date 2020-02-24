<?php
    header('Content-Type:application/json');

    function get_keywords($filter, $u_id)
    {
        include 'config.php';
        include 'util.php';
        $conn = dbconnect($host, $dbid, $dbpass, $dbname);

        if ($filter == 'all') {
            $query1 = "select * from counsel where u_id ='$u_id'";
            $temparr = [];
            $i = 1;

            if ($result = mysqli_query($conn, $query1, MYSQLI_USE_RESULT)) {
                while ($row1 = mysqli_fetch_object($result)) {
                    $t = [];
                    $t['type'] = $row1->type;
                    $t['date'] = $row1->date;
                    $t['no'] = $i;
                    $t['title'] = $row1->title;
                    $t['id'] = $row1->id;
                    array_push($temparr, $t);

                    unset($t);
                    $i++;
                }
            }
        } elseif ($filter == '1') {
            $i = 1;
            $temparr = [];
            $query1 = "select * from counsel where u_id ='$u_id' and type ='인테리어'";
            $ret1 = mysqli_query($conn, $query1);
            while ($row1 = mysqli_fetch_object($ret1)) {
                $t = [];
                $t['type'] = $row->type;
                $t['date'] = $row1->date;
                $t['no'] = $i;
                $t['title'] = $row1->title;
                $t['id'] = $row1->id;
                array_push($temparr, $t);

                unset($t);
                $i++;
            }
        } elseif ($filter == '2') {
            $i = 1;
            $temparr = [];
            $query2 = "select * from counsel where u_id ='$u_id' and type ='마케팅'";
            $ret2 = mysqli_query($conn, $query2);
            while ($row2 = mysqli_fetch_object($ret2)) {
                $t = [];
                $t['type'] = $row2->type;
                $t['date'] = $row2->date;
                $t['no'] = $i;
                $t['title'] = $row2->title;
                $t['id'] = $row2->id;
                array_push($temparr, $t);
                unset($t);
                $i++;
            }
        } elseif ($filter == '3') {
            $i = 1;
            $temparr = [];
            $query3 = "select * from counsel where u_id ='$u_id' and type ='홈페이지'";
            $ret3 = mysqli_query($conn, $query3);
            while ($row3 = mysqli_fetch_object($ret3)) {
                $t = [];
                $t['type'] = '홈페이지';
                $t['date'] = $row3->date;
                $t['no'] = $i;
                $t['title'] = $row3->title;
                $t['fid'] = $row3->id;
                array_push($temparr, $t);

                unset($t);
                $i++;
            }
        } elseif ($filter == '4') {
            $i = 1;
            $temparr = [];
            $query4 = "select * from counsel where u_id ='$u_id' and type ='자금대출'";
            $ret4 = mysqli_query($conn, $query4);
            while ($row4 = mysqli_fetch_object($ret4)) {
                $t = [];
                $t['type'] = '자금대출';
                $t['date'] = $row4->date;
                $t['no'] = $i;
                $t['title'] = $row4->title;
                $t['fid'] = $row4->id;
                array_push($temparr, $t);

                unset($t);
                $i++;
            }
        } elseif ($filter == '5') {
            $i = 1;
            $temparr = [];
            $query5 = "select * from counsel where u_id ='$u_id' and type ='의료장비'";
            $ret5 = mysqli_query($conn, $query5);
            while ($row5 = mysqli_fetch_object($ret5)) {
                $t = [];
                $t['type'] = '의료 장비';
                $t['date'] = $row5->date;
                $t['no'] = $i;
                $t['title'] = $row5->title;
                $t['fid'] = $row5->id;
                array_push($temparr, $t);

                unset($t);
                $i++;
            }
        } elseif ($filter == '6') {
            $i = 1;
            $temparr = [];
            $query6 = "select * from counsel where u_id ='$u_id' and type ='기타'";
            $ret6 = mysqli_query($conn, $query6);
            while ($row6 = mysqli_fetch_assoc($ret6)) {
                $t = [];
                $t['type'] = '의료 소모품,세무사 및 기타';
                $t['date'] = $row6->date;
                $t['no'] = $i;
                $t['title'] = $row6->title;

                $t['fid'] = $row6->fid;
                array_push($temparr, $t);

                unset($t);
                $i++;
            }
        }

        echo json_encode($temparr);
    }

    get_keywords($_POST['filter'], $_POST['uid']);
