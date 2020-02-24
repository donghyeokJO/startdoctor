<?php
if (!$_GET['date']) {
    $_GET['date'] = date('Y-m-d H:i:s');
}

$res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"');
$data = [];
$date = $_GET['date'];

while ($v = $res->fetch_array(MYSQLI_ASSOC)) {
    $data[] = $v;
}

echo json_encode(['data' => $data]);
