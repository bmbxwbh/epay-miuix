<?php
if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>红包领取成功</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-result-card { max-width: 420px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .mx-result-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .mx-result-icon svg { width: 36px; height: 36px; }
        .mx-result-icon.success { background: var(--mx-success-light); color: var(--mx-success); }
        .mx-result-body { padding: 32px 24px 24px; text-align: center; }
        .mx-result-title { font-size: 15px; color: var(--mx-text-secondary); margin-bottom: 8px; }
        .mx-result-amount { font-size: 40px; font-weight: 700; color: var(--mx-text-primary); letter-spacing: -0.02em; line-height: 1.2; }
        .mx-result-amount::before { content: "¥"; font-size: 22px; font-weight: 500; vertical-align: super; margin-right: 2px; }
        .mx-result-info { padding: 0 24px 24px; }
        .mx-result-row { display: flex; justify-content: space-between; padding: 12px 0; font-size: 14px; border-bottom: 1px solid var(--mx-border); }
        .mx-result-row:last-child { border-bottom: none; }
        .mx-result-row .label { color: var(--mx-text-tertiary); }
        .mx-result-row .value { color: var(--mx-text-primary); font-weight: 500; }
        .mx-result-actions { padding: 0 24px 24px; }
        .mx-result-footer { padding: 16px 24px; border-top: 1px solid var(--mx-border); text-align: center; font-size: 12px; color: var(--mx-text-tertiary); }
    </style>
</head>
<body>
    <div class="mx-result-card mx-animate">
        <div class="mx-result-body">
            <div class="mx-result-icon success"><?php echo MxIcons::SUCCESS ?></div>
            <div class="mx-result-title" style="margin-top:16px">你已收款，资金<?php echo $receive_action.$receive_name?></div>
            <div class="mx-result-amount"><?php echo $trans['money']?></div>
        </div>
        <div class="mx-result-info">
            <div class="mx-result-row">
                <span class="label">创建时间</span>
                <span class="value"><?php echo $trans['addtime']?></span>
            </div>
            <div class="mx-result-row">
                <span class="label">收款时间</span>
                <span class="value"><?php echo $trans['paytime']?></span>
            </div>
        </div>
        <div class="mx-result-actions">
            <button class="mx-btn mx-btn-secondary mx-btn-block mx-btn-lg" id="Close">关闭</button>
        </div>
        <div class="mx-result-footer">Copyright © <?php echo date("Y")?> <?php echo $conf['sitename']?></div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="js/close.js"></script>
    <script>document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});</script>
</body>
</html>
