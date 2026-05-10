<?php if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>支付提示</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-result-card { max-width: 420px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .mx-result-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .mx-result-icon svg { width: 36px; height: 36px; }
        .mx-result-icon.warning { background: var(--mx-warning-light); color: var(--mx-warning); }
        .mx-result-body { padding: 32px 24px 16px; text-align: center; }
        .mx-result-title { font-size: 18px; font-weight: 600; color: var(--mx-text-primary); margin-bottom: 8px; }
        .mx-result-desc { font-size: 14px; color: var(--mx-text-secondary); line-height: 1.6; }
        .mx-result-desc strong { color: var(--mx-warning); }
        .mx-result-actions { padding: 0 24px 24px; display: flex; gap: 12px; }
        .mx-result-actions .mx-btn { flex: 1; }
        .mx-result-footer { padding: 16px 24px; border-top: 1px solid var(--mx-border); text-align: center; font-size: 12px; color: var(--mx-text-tertiary); }
    </style>
</head>
<body>
    <div class="mx-result-card mx-animate">
        <div class="mx-result-body">
            <div class="mx-result-icon warning"><?php echo MxIcons::WARNING ?></div>
            <div class="mx-result-title" style="margin-top:16px">防诈骗提醒</div>
            <div class="mx-result-desc">您当前支付的商品为 <strong><?php echo $order['name']?></strong> ，请勿用他人发过来的二维码或链接进行支付，以防资金损失！</div>
        </div>
        <div class="mx-result-actions">
            <a href="<?php echo $order['payurl']?>" class="mx-btn mx-btn-primary">继续支付</a>
            <button class="mx-btn mx-btn-secondary" id="Close">关闭</button>
        </div>
        <div class="mx-result-footer">Copyright © <?php echo date("Y")?> <?php echo $conf['sitename']?></div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script>
    document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});
    if(navigator.userAgent.indexOf("AlipayClient")>-1){
        function Alipayready(cb){if(window.AlipayJSBridge){cb();}else{document.addEventListener('AlipayJSBridgeReady',cb,false);}}
        Alipayready(function(){$('#Close').click(function(){AlipayJSBridge.call('popWindow');});});
    }else if(navigator.userAgent.indexOf("MicroMessenger")>-1){
        if(typeof WeixinJSBridge=="undefined"){if(document.addEventListener){document.addEventListener('WeixinJSBridgeReady',jsApiCall,false);}else if(document.attachEvent){document.attachEvent('WeixinJSBridgeReady',jsApiCall);document.attachEvent('onWeixinJSBridgeReady',jsApiCall);}}else{jsApiCall();}
        function jsApiCall(){$('#Close').click(function(){WeixinJSBridge.call('closeWindow');});}
    }else{$('#Close').click(function(){window.opener=null;window.close();});}
    </script>
</body>
</html>
