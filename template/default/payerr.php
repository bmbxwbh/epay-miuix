<?php
if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>错误提示</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-result-card { max-width: 420px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .mx-result-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .mx-result-icon svg { width: 36px; height: 36px; }
        .mx-result-icon.error { background: var(--mx-danger-light); color: var(--mx-danger); }
        .mx-result-body { padding: 40px 24px 24px; text-align: center; }
        .mx-result-title { font-size: 18px; font-weight: 600; color: var(--mx-text-primary); margin-bottom: 8px; }
        .mx-result-actions { padding: 24px; }
        .mx-result-footer { padding: 16px 24px; border-top: 1px solid var(--mx-border); text-align: center; font-size: 12px; color: var(--mx-text-tertiary); }
    </style>
</head>
<body>
    <div class="mx-result-card mx-animate">
        <div class="mx-result-body">
            <div class="mx-result-icon error"><?php echo MxIcons::ERROR ?></div>
            <div class="mx-result-title" style="margin-top:20px">该订单处理异常，已自动退款！</div>
        </div>
        <div class="mx-result-actions">
            <button class="mx-btn mx-btn-secondary mx-btn-block mx-btn-lg" id="Close">关闭</button>
        </div>
        <div class="mx-result-footer">Copyright © <?php echo date("Y")?></div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="/paypage/js/close.js"></script>
    <script>document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});</script>
</body>
</html>
