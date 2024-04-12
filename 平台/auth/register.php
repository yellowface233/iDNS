<?php
$ptitle = "注册";
require_once '../header.php';

?>

<div class="main" id="_pjax_update_2" style="max-width: 1200px; margin: 0 auto;margin-top: 32px;">
    <!-- 页面本体 pjax更新 -->
    <div class="mdui-card">
        <div class="mdui-card-content">
            <center>
                <h1 style="font-weight: normal;">注册 <small>Register</small></h1>
            </center>
            <div style="max-width: 800px;margin:0 auto;padding:5px 5px 5px 5px;">
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">用户名</label>
                    <input class="mdui-textfield-input" type="text" id=u />
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">密码</label>
                    <input class="mdui-textfield-input" type="password" id=p />
                </div>
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">邀请码</label>
                    <input class="mdui-textfield-input" type="text" id=invite />
                </div>
                <br />
                <button class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple mdui-btn-raised" onclick="
                fetch('/api/auth/register.cmd?u='+u.value+'&p='+p.value+'&i='+invite.value).then((o)=>{
                    o.json().then((o)=>{
                        if(o.code==200) {
                            mdui.snackbar({message: '注册成功',position: 'top'});
                            setTimeout(()=>{location = '/auth/login.cmd';},1000);
                        }else{
                            mdui.snackbar({message: o.msg,position: 'top'});
                        }
                    });
                });
                ">注册</button>
                <br />
            </div>
        </div>
    </div>
</div>

</div>


<?php

require_once '../footer.php';
