<?php if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>微信支付引导</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); min-height: 100vh; }
        .mx-guide { max-width: 480px; margin: 0 auto; padding: 24px 20px; }
        .mx-guide-header { text-align: center; padding: 32px 0 24px; }
        .mx-guide-icon { width: 64px; height: 64px; border-radius: 50%; background: var(--mx-warning-light); color: var(--mx-warning); display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
        .mx-guide-icon svg { width: 32px; height: 32px; }
        .mx-guide-title { font-size: 20px; font-weight: 600; color: var(--mx-text-primary); margin-bottom: 8px; }
        .mx-guide-subtitle { font-size: 14px; color: var(--mx-text-secondary); }
        .mx-guide-card { background: var(--mx-bg-card); border-radius: var(--mx-radius); box-shadow: var(--mx-shadow); border: 1px solid var(--mx-border); margin-bottom: 16px; overflow: hidden; }
        .mx-guide-card-header { padding: 16px 20px; border-bottom: 1px solid var(--mx-border); font-weight: 600; font-size: 15px; display: flex; align-items: center; gap: 10px; }
        .mx-guide-card-header .step { width: 24px; height: 24px; border-radius: 50%; background: var(--mx-accent); color: #fff; font-size: 13px; font-weight: 600; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .mx-guide-card-body { padding: 16px 20px; font-size: 14px; color: var(--mx-text-secondary); line-height: 1.8; }
        .mx-guide-card-body strong { color: var(--mx-accent); font-weight: 600; }
        .mx-guide-alert { display: flex; align-items: flex-start; gap: 12px; padding: 14px 18px; border-radius: var(--mx-radius-sm); background: var(--mx-danger-light); color: #c92a25; font-size: 14px; margin-bottom: 24px; line-height: 1.5; }
        .mx-guide-alert svg { width: 20px; height: 20px; flex-shrink: 0; margin-top: 1px; }
        .mx-guide-img { width: 100%; border-radius: var(--mx-radius-sm); margin: 12px 0; }
        .mx-guide-actions { padding: 8px 0 24px; }
    </style>
</head>
<body>
    <div class="mx-guide">
        <div class="mx-guide-header mx-animate">
            <div class="mx-guide-icon"><?php echo MxIcons::WARNING ?></div>
            <div class="mx-guide-title">微信支付暂不可用</div>
            <div class="mx-guide-subtitle">支付通道维护中，请使用QQ/支付宝付款</div>
        </div>

        <div class="mx-guide-alert mx-animate">
            <?php echo MxIcons::INFO ?>
            <span>遇到微信支付失败时，请先使用QQ或支付宝完成付款</span>
        </div>

        <div class="mx-guide-card mx-animate">
            <div class="mx-guide-card-header">
                <span class="step">1</span>
                <span>微信公众号搜索 <strong>QQ钱包</strong></span>
            </div>
            <div class="mx-guide-card-body">
                在微信中搜索并关注 <strong>QQ钱包</strong> 公众号
            </div>
        </div>

        <div class="mx-guide-card mx-animate">
            <div class="mx-guide-card-header">
                <span class="step">2</span>
                <span>将微信余额转入QQ</span>
            </div>
            <div class="mx-guide-card-body">
                通过公众号将微信零钱余额直接转入您的QQ账户
            </div>
        </div>

        <div class="mx-guide-card mx-animate">
            <div class="mx-guide-card-header">
                <span class="step">3</span>
                <span>使用QQ支付下单</span>
            </div>
            <div class="mx-guide-card-body">
                返回支付页面，选择 <strong>QQ支付</strong> 完成付款即可
            </div>
        </div>

        <img src="./assets/img/wxtoqq.png" class="mx-guide-img mx-animate" alt="微信转QQ教程">

        <div class="mx-guide-actions">
            <button class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" onclick="history.go(-1)">返回支付页面</button>
        </div>
    </div>
</body>
</html>
