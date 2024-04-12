<?php
$ptitle = "管理[" . $_GET['domain'] . ']';
require_once '../header.php';
$domain = $_GET['domain'];
if(!isset($_SESSION['user'])) {
    exit('请先登录<a href="/index.cmd">首页</a>');
}
if (!is_dir('../db/user/' . $_SESSION['user'] . '/zones/' . $_GET['domain'] . '/')) {
    echo '<div class="main" id="_pjax_update_2" style="max-width: 1200px; margin: 0 auto;margin-top: 32px;">
    <!-- 页面本体 pjax更新 -->
    <div class="mdui-card">
        <div class="mdui-card-content">
            <div class="heading" style="zoom:1.18;">
                <button class="mdui-btn mdui-btn-icon mdui-ripple" onclick="history.go(-1)">
                    <i class="mdui-icon material-icons">keyboard_arrow_left</i>
                </button>
                &nbsp;
                <h3 style="display:inline;font-weight:normal;vertical-align:middle">
                   
        ' . $domain . '
                </h3>
            </div>
        </div>
    </div>
    <br />
    域名不存在。</div>';
    exit;
}

?>

<div class="main" id="_pjax_update_2" style="max-width: 1200px; margin: 0 auto;margin-top: 32px;">
    <!-- 页面本体 pjax更新 -->
    <div class="mdui-card">
        <div class="mdui-card-content">
            <div class="heading" style="zoom:1.18;">
                <button class="mdui-btn mdui-btn-icon mdui-ripple" onclick="history.go(-1)">
                    <i class="mdui-icon material-icons">keyboard_arrow_left</i>
                </button>
                &nbsp;
                <h3 style="display:inline;font-weight:normal;vertical-align:middle">
                    <?= $_GET['domain']; ?>
                </h3>
            </div>
            <br />
            <div class="mdui-tab" mdui-tab>
                <a href="#overview" class="mdui-ripple">总览</a>
                <a href="#record" class="mdui-ripple">解析管理</a>
                <a href="#monitor" class="mdui-ripple">掉线切换</a>
                <a href="#settings" class="mdui-ripple">域名设置</a>
            </div>
        </div>
    </div>

    <br />

    <div class="mdui-card" id="overview" style="display:none">
        <div class="mdui-card-content">
            您需要将
            <?= $domain; ?>的NS改为下面的服务器，解析才可生效：
            <div class="mdui-card">
                <div class="mdui-card-content">
                    ns1.idns.org.cn<br />
                    ns2.idns.org.cn
                </div>
            </div>
            <br />
            您目前的NS记录(若显示iDNS / idns，则为更新成功):
            <div class="mdui-card">
                <div class="mdui-card-content">
                    <?
                    $records = dns_get_record($domain, DNS_NS);
                    $ryes = false;
                    if ($records) {
                        foreach ($records as $record) {
                            echo $record['target'] . '<br />';
                            if ($record['target'] == 'iDNS' or $record['target'] == 'idns') {
                                $ryes = true;
                            }
                        }
                    } else {
                        echo 'No records found';
                    }
                    ?>
                </div>
            </div>
            <br />
            <?
            if (!$ryes) {
                echo '<font color=red>请更换解析，否则无法生效！</font>';
            } else {
                echo '<font color=green>恭喜，DNS设置成功，解析已生效！</font>';
            }
            ?>
        </div>
    </div>

    <div id="record" style="display:none">
        <div class="mdui-card">
            <div class="mdui-card-content">
                <a style="color:unset;text-decoration:unset;" onclick="
                new mdui.Dialog('#newsubdomain',{closeOnConfirm: true,history:false}).open();
                ">
                    <div class="mdui-chip">
                        <span class="mdui-chip-title">添加记录</span>
                    </div>
                </a>
            </div>
        </div>

        <br />

        <div class="mdui-table-fluid">
            <table class="mdui-table mdui-table-hoverable">
                <thead>
                    <tr>
                        <th>前缀</th>
                        <th>类型</th>
                        <th>记录值</th>
                        <th>TTL</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $records = file_get_contents('../db/user/' . $_SESSION['user'] . '/zones/' . $domain . '/records.json');
                    $records = json_decode($records, true);

                    foreach ($records as $record) {
                        echo '
                        <tr>
                            <td>' . $record['sub'] . '</td>
                            <td>' . $record['type'] . '</td>
                            <td>' . $record['value'] . '</td>
                            <td>' . $record['ttl'] . '</td>
                            <td><button class="mdui-btn mdui-color-red mdui-ripple mdui-btn-dense" onclick="'; ?>
                        mdui.dialog({
                        title: '删除域名',
                        history:false,
                        content: '确定删除解析[<?= $record['sub']; ?>]吗？此操作不可逆，将立即清空所有解析记录。',
                        buttons: [
                        {
                        text: '取消'
                        },
                        {
                        text: '确认',
                        onClick: function(inst){
                        fetch('/api/delsubdomain.cmd?domain=<?= $domain; ?>&ttl=<?= $record['ttl']; ?>&type=<?= $record['type']; ?>&sub=<?= $record['sub']; ?>&value=<?= $record['value']; ?>').then((o)=>{
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
                        });
                        <?php echo '">删除</button></td>
                        </tr>
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mdui-card" id="monitor" style="display:none">
        <div class="mdui-card-content">
            注意：本区域解析与解析管理区隔离，请不要在两边同时添加解析。
            <a style="color:unset;text-decoration:unset;" onclick="
                new mdui.Dialog('#newsubmonitordomain',{closeOnConfirm: true,history:false}).open();
                ">
                <div class="mdui-chip">
                    <span class="mdui-chip-title">添加监控记录</span>
                </div>
            </a>
        </div>
    </div>

    <div class="mdui-card" id="settings" style="display:none">
        <div class="mdui-card-content">
            暂未开发 (如需开启DNSSEC 请联系xiobb手动启用)
        </div>
    </div>

    <div class="mdui-dialog" id="newsubmonitordomain">
        <div class="mdui-dialog-title">添加监控记录</div>
        <div class="mdui-dialog-content">
        
        </div>
        <div class="mdui-dialog-actions">
       
        </div>
    </div>

    <div class="mdui-dialog" id="newsubdomain">
        <div class="mdui-dialog-title">添加记录</div>
        <div class="mdui-dialog-content">
            <select class="mdui-select" id="recordtype" mdui-select="{position: 'bottom'}">
                <option value="A">A</option>
                <option value="AAAA">AAAA</option>
                <option value="CNAME">CNAME</option>
                <option value="MX">MX</option>
                <option value="NS">NS</option>
                <option value="TXT">TXT</option>
            </select>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">子域名(根域填写：@)</label>
                <input class="mdui-textfield-input" type="text" id="recordsub" />
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">记录值</label>
                <input class="mdui-textfield-input" type="text" id="recordvalue" />
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">TTL</label>
                <input class="mdui-textfield-input" type="number" id="recordttl" />
            </div>
        </div>
        <div class="mdui-dialog-actions">
            <button class="mdui-btn mdui-ripple" mdui-dialog-cancel>取消</button>
            <button class="mdui-btn mdui-ripple" mdui-dialog-confirm onclick="
            this.innerText='请稍后..';
            fetch('/api/addsubdomain.cmd?domain=<?= $domain; ?>&type='+recordtype.value+'&sub='+recordsub.value+'&value='+recordvalue.value+'&ttl='+recordttl.value).then((r)=>{
                r.json().then((r)=>{
                    if(r.code==200) {
                        mdui.alert('添加成功');
                        this.innerText='添加';
                    } else {
                        mdui.snackbar({message: r.msg,position: 'top'});
                        this.innerText='添加';
                    }
                });
            });
            ">提交</button>
        </div>
    </div>

</div>

<?php

require_once '../footer.php';
