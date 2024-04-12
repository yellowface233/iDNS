<?php
header('content-type: application/json');
session_start();

if (!$_GET['domain'] or !$_GET['ttl'] or !$_GET['sub'] or !$_GET['type']) {
    exit(json_encode(['code' => 400, 'msg' => '信息不完整']));
}

if (!is_dir('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['domain'] . '/')) {
    exit(json_encode(['code' => 400, 'msg' => '域名不存在']));
}

file_get_contents('http://150.138.77.253:6654/adddomain.php?domain=' . $_GET['domain'] . '&sub=' . $_GET['sub'] . '&ttl=' . $_GET['ttl'] . '&type=' . $_GET['type'] . '&value=' . $_GET['value']);

$rd = file_get_contents('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['domain'] . '/records.json');
$rd = json_decode($rd, true);
$rd[] = [
    'sub' => $_GET['sub'],
    'type' => $_GET['type'],
    'ttl' => $_GET['ttl'],
    'value' => $_GET['value']
];

$rd = json_encode($rd, JSON_PRETTY_PRINT);
file_put_contents('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['domain'] . '/records.json', $rd);


exit(json_encode(['code' => 200, 'msg' => '添加成功']));