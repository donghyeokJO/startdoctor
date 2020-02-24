<?php
    header('Content-Type:application/json');

    function get_keywords($filter, $u_id)
    {
        include 'config.php';
        include 'util.php';
        $conn = dbconnect($host, $dbid, $dbpass, $dbname);

        // $temparr = [0 => $filter];
        // $temparr = [1 => $u_id];
        if ($filter == 'all') {
            $query1 = "select * from form1 where u_id ='$u_id'";
            $query2 = "select * from form2 where u_id ='$u_id'";
            $query3 = "select * from form3 where u_id ='$u_id'";
            $query4 = "select * from form4 where u_id ='$u_id'";
            $query5 = "select * from form5 where u_id ='$u_id'";
            $query6 = "select * from form6 where u_id ='$u_id'";
            $temparr = [];
            $i = 1;

            if ($result = mysqli_query($conn, $query1, MYSQLI_USE_RESULT)) {
                while ($row1 = mysqli_fetch_object($result)) {
                    $t = [];
                    $t['type'] = '인테리어';
                    $t['date'] = $row1->date;
                    $t['no'] = $i;
                    $t['form'] = 'form1';
                    $t['fid'] = $row1->fid;
                    array_push($temparr, $t);
                    ;
                    unset($t);
                    $i++;
                }
            } else {
            }
            if ($result = mysqli_query($conn, $query2, MYSQLI_USE_RESULT)) {
                while ($row2 = mysqli_fetch_object($result)) {
                    $t = [];
                    $t['type'] = '마케팅';
                    $t['date'] = $row2->date;
                    $t['no'] = $i;
                    $t['form'] = 'form2';
                    $t['fid'] = $row2->fid;
                    array_push($temparr, $t);
                    ;
                    unset($t);
                    $i++;
                }
            } else {
            }
            if ($result = mysqli_query($conn, $query3, MYSQLI_USE_RESULT)) {
                while ($row3 = mysqli_fetch_object($result)) {
                    $t = [];
                    $t['type'] = '홈페이지';
                    $t['date'] = $row3->date;
                    $t['no'] = $i;
                    $t['form'] = 'form3';
                    $t['fid'] = $row3->fid;
                    array_push($temparr, $t);
                    ;
                    unset($t);
                    $i++;
                }
            } else {
            }
            if ($result = mysqli_query($conn, $query4, MYSQLI_USE_RESULT)) {
                while ($row4 = mysqli_fetch_object($result)) {
                    $t = [];
                    $t['type'] = '자금대출';
                    $t['date'] = $row4->date;
                    $t['no'] = $i;
                    $t['form'] = 'form4';
                    $t['fid'] = $row4->fid;
                    array_push($temparr, $t);
                    ;
                    unset($t);
                    $i++;
                }
            } else {
            }
            if ($result = mysqli_query($conn, $query5, MYSQLI_USE_RESULT)) {
                while ($row5 = mysqli_fetch_object($result)) {
                    $t = [];
                    $t['type'] = '의료장비';
                    $t['date'] = $row5->date;
                    $t['no'] = $i;
                    $t['form'] = 'form5';
                    $t['fid'] = $row5->fid;
                    array_push($temparr, $t);
                    ;
                    unset($t);
                    $i++;
                }
            } else {
            }
            if ($result = mysqli_query($conn, $query6, MYSQLI_USE_RESULT)) {
                while ($row6 = mysqli_fetch_object($result)) {
                    $t = [];
                    $t['type'] = '의료소모품,세무사 및 기타';
                    $t['date'] = $row6->date;
                    $t['no'] = $i;
                    $t['form'] = 'form6';
                    $t['fid'] = $row6->fid;
                    $temparr += $t;
                    unset($t);
                    $i++;
                }
            } else {
            }
        } elseif ($filter == '1') {
            $i = 1;
            $temparr = [];
            $query1 = "select * from form1 where u_id ='$u_id'";
            $ret1 = mysqli_query($conn, $query1);
            while ($row1 = mysqli_fetch_object($ret1)) {
                $t = [];
                $t['type'] = '인테리어';
                $t['date'] = $row1->date;
                $t['no'] = $i;
                $t['form'] = 'form1';
                $t['fid'] = $row1->fid;
                array_push($temparr, $t);
                ;
                unset($t);
                $i++;
            }
        } elseif ($filter == '2') {
            $i = 1;
            $temparr = [];
            $query2 = "select * from form2 where u_id ='$u_id'";
            $ret2 = mysqli_query($conn, $query2);
            while ($row2 = mysqli_fetch_object($ret2)) {
                $t = [];
                $t['type'] = '마케팅';
                $t['date'] = $row2->date;
                $t['no'] = $i;
                $t['form'] = 'form2';
                $t['fid'] = $row2->fid;
                array_push($temparr, $t);
                ;
                unset($t);
                $i++;
            }
        } elseif ($filter == '3') {
            $i = 1;
            $temparr = [];
            $query3 = "select * from form3 where u_id ='$u_id'";
            $ret3 = mysqli_query($conn, $query3);
            while ($row3 = mysqli_fetch_object($ret3)) {
                $t = [];
                $t['type'] = '홈페이지';
                $t['date'] = $row3->date;
                $t['no'] = $i;
                $t['form'] = 'form3';
                $t['fid'] = $row3->fid;
                array_push($temparr, $t);
                ;
                unset($t);
                $i++;
            }
        } elseif ($filter == '4') {
            $i = 1;
            $temparr = [];
            $query4 = "select * from form4 where u_id ='$u_id'";
            $ret4 = mysqli_query($conn, $query4);
            while ($row4 = mysqli_fetch_object($ret4)) {
                $t = [];
                $t['type'] = '자금대출';
                $t['date'] = $row4->date;
                $t['no'] = $i;
                $t['form'] = 'form4';
                $t['fid'] = $row4->fid;
                array_push($temparr, $t);
                ;
                unset($t);
                $i++;
            }
        } elseif ($filter == '5') {
            $i = 1;
            $temparr = [];
            $query5 = "select * from form5 where u_id ='$u_id'";
            $ret5 = mysqli_query($conn, $query5);
            while ($row5 = mysqli_fetch_object($ret5)) {
                $t = [];
                $t['type'] = '의료 장비';
                $t['date'] = $row5->date;
                $t['no'] = $i;
                $t['form'] = 'form5';
                $t['fid'] = $row5->fid;
                array_push($temparr, $t);
                ;
                unset($t);
                $i++;
            }
        } elseif ($filter == '6') {
            $i = 1;
            $temparr = [];
            $query6 = "select * from form6 where u_id ='$u_id'";
            $ret6 = mysqli_query($conn, $query6);
            while ($row6 = mysqli_fetch_assoc($ret6)) {
                $t = [];
                $t['type'] = '의료 소모품,세무사 및 기타';
                $t['date'] = $row6->date;
                $t['no'] = $i;
                $t['form'] = 'form6';
                $t['fid'] = $row6->fid;
                array_push($temparr, $t);
                ;
                unset($t);
                $i++;
            }
        }

        echo json_encode($temparr);
    }

    get_keywords($_POST['filter'], $_POST['uid']);
