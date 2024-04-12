<?php
header('content-type: application/json');
session_start();

if (!$_GET['u'] || !$_GET['p']) {
    exit(json_encode(['code' => 400, 'msg' => '信息不完整']));
}

if (!is_dir('../../db/user/' . $_GET['u'] . '/')) {
    exit(json_encode(['code' => 400, 'msg' => '用户不存在']));
}

$base = json_decode(file_get_contents('../../db/user/' . $_GET['u'] . '/base.json'), true);

if ($base['pass'] != md5($_GET['p'])) {
    exit(json_encode(['code' => 400, 'msg' => '密码错误']));
}

$_SESSION['islogin'] = true;
$_SESSION['user'] = $_GET['u'];

exit(json_encode(['code' => 200, 'msg' => '登录成功']));