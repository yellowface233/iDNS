<?php
header('content-type: application/json');

if (!$_GET['u'] || !$_GET['p'] || !$_GET['i']) {
    exit(json_encode(['code' => 400, 'msg' => '信息不完整']));
}

if (!file_exists('../../db/invite/' . $_GET['i'] . '.txt')) {
    exit(json_encode(['code' => 400, 'msg' => '邀请码错误']));
}

if (is_dir('../../db/user/' . $_GET['u'] . '/')) {
    exit(json_encode(['code' => 400, 'msg' => '用户已存在']));
}

mkdir('../../db/user/'.$_GET['u'].'/',0777);
mkdir('../../db/user/'.$_GET['u'].'/zones/',0777);

file_put_contents('../../db/user/'.$_GET['u'].'/base.json',json_encode([
    'pass' => md5($_GET['p']),
    'regtime'=>time(),
    'invitecode'=>$_GET['i']
]));

unlink('../../db/invite/' . $_GET['i'] . '.txt');


exit(json_encode(['code' => 200, 'msg' => '注册成功']));