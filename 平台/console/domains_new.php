<?php
$ptitle = "添加域名";
require_once '../header.php';
if(!isset($_SESSION['user'])) {
    exit('请先登录<a href="/index.cmd">首页</a>');
}
?>

<div class="main" id="_pjax_update_2" style="max-width: 1200px; margin: 0 auto;margin-top: 32px;">
    <!-- 页面本体 pjax更新 -->
    <div class="mdui-card">
        <div class="mdui-card-content">
            <center>
                <button class="mdui-fab mdui-color-theme-accent mdui-ripple" title="返回上页" onclick="history.go(-1)">
                    <i class="mdui-icon material-icons">keyboard_arrow_left</i>
                </button>
                <h1 style="font-weight: normal;">添加域名</h1>
            </center>
            <div style="max-width: 800px;margin:0 auto;padding:5px 5px 5px 5px;">
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">域名 (e.g. i45s.com)</label>
                    <input class="mdui-textfield-input" type="text" id=domain />
                </div>
                <br />
                <button class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple mdui-btn-raised" onclick="
                fetch('/api/newdomain.cmd?d='+document.getElementById('domain').value).then((o)=>{
                    o.json().then((o)=>{
                        if(o.code==200) {
                            mdui.snackbar({message: '添加成功',position: 'top'});
                            setTimeout(()=>{location = '/console/dashboard.cmd';},1000);
                        }else{
                            mdui.snackbar({message: o.msg,position: 'top'});
                        }
                    });
                });
                ">添加</button>
                <br />
                添加前，请将域名的DNS指向: <code>ns1.idns.org.cn</code> 和 <code>ns2.idns.org.cn</code>
            </div>
        </div>
    </div>
</div>

<?php

require_once '../footer.php';
