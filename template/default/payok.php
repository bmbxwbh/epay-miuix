<?php
if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>支付结果</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-result-card { max-width: 420px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .mx-result-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .mx-result-icon svg { width: 36px; height: 36px; }
        .mx-result-icon.success { background: var(--mx-success-light); color: var(--mx-success); }
        .mx-result-body { padding: 40px 24px 24px; text-align: center; }
        .mx-result-title { font-size: 20px; font-weight: 600; color: var(--mx-text-primary); margin-bottom: 8px; }
        .mx-result-desc { font-size: 14px; color: var(--mx-text-secondary); }
        .mx-result-actions { padding: 24px; display: flex; gap: 12px; }
        .mx-result-actions .mx-btn { flex: 1; }
        .mx-result-footer { padding: 16px 24px; border-top: 1px solid var(--mx-border); text-align: center; font-size: 12px; color: var(--mx-text-tertiary); }
    </style>
</head>
<body ontouchstart="">
    <div class="mx-result-card mx-animate">
        <div class="mx-result-body">
            <div class="mx-result-icon success"><?php echo MxIcons::SUCCESS ?></div>
            <div class="mx-result-title" style="margin-top:20px">支付成功</div>
            <div class="mx-result-desc">支付成功，请回到网站查看订单</div>
        </div>
        <div class="mx-result-actions">
            <button class="mx-btn mx-btn-primary" onclick="alert('请回到网站查看订单！')">确定</button>
            <button class="mx-btn mx-btn-secondary" id="Close">关闭</button>
        </div>
        <div class="mx-result-footer">Copyright © <?php echo date("Y")?></div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
    <script>
    document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});
    if(navigator.userAgent.indexOf("AlipayClient")>-1){
        function Alipayready(cb){if(window.AlipayJSBridge){cb();}else{document.addEventListener('AlipayJSBridgeReady',cb,false);}}
        Alipayready(function(){$('#Close').click(function(){AlipayJSBridge.call('popWindow');});});
    }else if(navigator.userAgent.indexOf("MicroMessenger")>-1){
        if(typeof WeixinJSBridge=="undefined"){
            if(document.addEventListener){document.addEventListener('WeixinJSBridgeReady',jsApiCall,false);}
            else if(document.attachEvent){document.attachEvent('WeixinJSBridgeReady',jsApiCall);document.attachEvent('onWeixinJSBridgeReady',jsApiCall);}
        }else{jsApiCall();}
        function jsApiCall(){$('#Close').click(function(){WeixinJSBridge.call('closeWindow');});}
    }else{$('#Close').click(function(){window.opener=null;window.close();});}
    </script>
</body>
</html>
