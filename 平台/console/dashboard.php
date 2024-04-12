<?php
$ptitle = "总览";
require_once '../header.php';
if(!isset($_SESSION['user'])) {
    exit('请先登录<a href="/index.cmd">首页</a>');
}
?>

<div class="main" id="_pjax_update_2" style="max-width: 1200px; margin: 0 auto;margin-top: 32px;">
    <!-- 页面本体 pjax更新 -->
    <div class="mdui-card">
        <div class="mdui-card-content">
            <div class="mdui-chip">
                <span class="mdui-chip-icon">
                    <i class="mdui-icon material-icons">face</i>
                </span>
                <span class="mdui-chip-title">欢迎，
                    <?php echo $_SESSION['user']; ?>！
                </span>
            </div>
            &emsp;
            <a href="/console/domains_new.cmd" style="color:unset;text-decoration:unset;">
                <div class="mdui-chip">
                    <span class="mdui-chip-title">添加域名</span>
                </div>
            </a>
            &emsp;
            <a href="/api/auth/logout.cmd" style="color:unset;text-decoration:unset;">
                <div class="mdui-chip">
                    <span class="mdui-chip-title">退出登录</span>
                </div>
            </a>
        </div>
    </div>

    <br />

    <div class="mdui-table-fluid">
        <table class="mdui-table mdui-table-hoverable">
            <thead>
                <tr>
                    <th>域名</th>
                    <th class="mdui-table-col-numeric">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $directory = '../db/user/'.$_SESSION['user'].'/zones/';
                $files = scandir($directory);
                $files = array_diff($files, array('.', '..'));

                foreach ($files as $file) {
                    echo '<tr>
                    <td>' . $file . '</td>
                    <td><a href="/console/domain.cmd?domain='.$file.'"><button class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-btn-dense" >管理</button
                    ></a>&emsp;
                    <button class="mdui-btn mdui-color-red mdui-ripple mdui-btn-dense" onclick="';?> mdui.dialog({
                        title: '删除域名',
                        content: '确定删除域名[<?=$file;?>]吗？此操作不可逆，将立即清空所有解析记录。',
                        buttons: [
                          {
                            text: '取消'
                          },
                          {
                            text: '确认',
                            onClick: function(inst){
                                fetch('/api/deldomain.cmd?d=<?=$file;?>').then((o)=>{
                                 o.json().then((o)=>{
                                     if(o.code==200) {
                                        mdui.alert('删除成功。');
                                      }else{
                                        mdui.snackbar({message: o.msg,position: 'top'});
                                       }
                                 });
                             });
                
                            }
                          }
                        ]
                      }); <?php echo ' ">删除</button></td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

require_once '../footer.php';
