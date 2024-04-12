<?php session_start();
//header('content-type:text/plain');exit('系统维护');
?><!doctype html>
<html lang="zh-cmn-Hans" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="renderer" content="webkit" />
    <meta name="force-rendering" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="stylesheet" href="https://unpkg.zhimg.com/mdui@1.0.2/dist/css/mdui.min.css" />
    <script src="https://jsd.onmicrosoft.cn/npm/pace-js@latest/pace.min.js"></script>
    <link rel="stylesheet" href="https://jsd.onmicrosoft.cn/npm/pace-js@latest/themes/blue/pace-theme-flash.min.css">
    <title>
        <?php echo $ptitle; ?> - iDNS.ORG.CN
    </title>

    <style>
        @media screen and (max-width: 1200px) {
            .main {
                padding: 8px !important;
            }
        }
    </style>
</head>

<body class="mdui-appbar-with-toolbar mdui-theme-primary-indigo mdui-theme-accent-indigo mdui-theme-layout-auto">
    <header class="appbar mdui-appbar mdui-appbar-fixed" style="box-shadow: none !important;">
        <div class="mdui-appbar mdui-shadow-2" style="box-shadow: none !important;">
            <div class="mdui-toolbar mdui-color-theme mdui-shadow-2">
                <a href="/index.cmd" class="mdui-typo-headline">iDNS.ORG.CN</a>
                <a href="?" class="mdui-typo-title" id="_pjax_update_1"><?php echo $ptitle; ?></a>
                <div class="mdui-toolbar-spacer"></div>
                <a href="javascript:location.reload();" class="mdui-btn mdui-btn-icon">
                    <i class="mdui-icon material-icons">refresh</i>
                </a>
            </div>
        </div>
    </header>