<?php
header('content-type: application/json');
session_start();

if (!$_GET['d'] or $_GET['d'] == 'undefined') {
    exit(json_encode(['code' => 400, 'msg' => '信息不完整']));
}

if (is_dir('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['d'] . '/')) {
    exit(json_encode(['code' => 400, 'msg' => '域名已存在']));
}

file_get_contents('http://150.138.77.253:6654/zoneadd.php?domain=' . $_GET['d']);

mkdir('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['d'] . '/', 0777);
file_put_contents('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['d'] . '/base.json', json_encode(['addtime' => time()]));
file_put_contents('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['d'] . '/records.json', '[]');


exit(json_encode(['code' => 200, 'msg' => '添加成功']));