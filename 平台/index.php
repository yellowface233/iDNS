<?php
$ptitle = "首页";
require_once 'header.php';

?>

<div class="main" id="_pjax_update_2" style="max-width: 1200px; margin: 0 auto;margin-top: 32px;">
    <!-- 页面本体 pjax更新 -->
    <div class="mdui-card">
        <div class="mdui-card-content">
            <center>
                <h1 style="font-weight: normal;">iDNS.ORG.CN [停止维护，留作纪念]</h1>
                <p>基于Windows Server的域名DNS解决方案</p>
                <p>TTL低至1秒 / 全球分发节点 / 支持DNSSEC / 支持子域接入</p>
                <p>IPv6 支持 / 掉线切换 / 生效检测</p>
                <br /><br />
                <?php if ($_SESSION['islogin']) { ?>
                    <a href="/console/dashboard.cmd"><button
                            class="mdui-btn mdui-color-theme-accent mdui-ripple">管理</button></a>
                <?php } else { ?> <a href="/auth/login.cmd"><button
                            class="mdui-btn mdui-color-theme-accent mdui-ripple">登录</button></a>&emsp;
                    <a href="/auth/register.cmd"><button
                            class="mdui-btn mdui-color-theme-accent mdui-ripple">注册</button></a>
                <?php } ?>
                &emsp;
                    <a href="/cgi-bin/enterprise.cgi"><button
                            class="mdui-btn mdui-color-theme-accent mdui-ripple">企业定制</button></a>
            </center>
        </div>
    </div>
</div>

<?php

require_once 'footer.php';
