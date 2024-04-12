<?php
header('content-type: application/json');
session_start();

if (!$_GET['d'] or $_GET['d'] == 'undefined') {
    exit(json_encode(['code' => 400, 'msg' => '信息不完整']));
}

if (!is_dir('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['d'] . '/')) {
    exit(json_encode(['code' => 400, 'msg' => '域名不存在']));
}

file_get_contents('http://150.138.77.253:6654/zonedel.php?domain=' . $_GET['d']);

deleteDir('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['d'] . '/');


function deleteDir($dirPath){
    if(!is_dir($dirPath)){
        return;
    }
    $dirsStack = array($dirPath);
    
    while($dir = array_shift($dirsStack)){
        $dirHandle = opendir($dir);
        while(false !== ($file = readdir($dirHandle))){
            if($file != '.' && $file != '..'){
                $filePath = $dir.'/'.$file;
                if(is_dir($filePath)){
                    array_push($dirsStack, $filePath);
                }else{
                    unlink($filePath);
                }
            }
        }
        closedir($dirHandle);
        rmdir($dir);
    }
}
 


exit(json_encode(['code' => 200, 'msg' => '删除成功']));