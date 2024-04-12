<?php
header('content-type: application/json');
session_start();

if (!$_GET['domain'] or !$_GET['ttl'] or !$_GET['sub'] or !$_GET['type']) {
    exit(json_encode(['code' => 400, 'msg' => '信息不完整']));
}

if (!is_dir('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['domain'] . '/')) {
    exit(json_encode(['code' => 400, 'msg' => '域名不存在']));
}

file_get_contents('http://150.138.77.253:6654/deldomain.php?domain=' . $_GET['domain'] . '&sub=' . $_GET['sub'] . '&ttl=' . $_GET['ttl'] . '&type=' . $_GET['type'] . '&value=' . $_GET['value']);

$rd = file_get_contents('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['domain'] . '/records.json');
$rd = json_decode($rd, true);
$rid = 99999;

foreach ($rd as $id => $r) {
    if ($r['sub'] == $_GET['sub'] and $r['type'] == $_GET['type'] and $r['ttl'] == $_GET['ttl'] and $r['value'] == $_GET['value']) {
        $rid = $id;
    }
}

unset($rd[$rid]);

$rd = json_encode($rd, JSON_PRETTY_PRINT);
file_put_contents('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['domain'] . '/records.json', $rd);


exit(json_encode(['code' => 200, 'msg' => '删除成功']));