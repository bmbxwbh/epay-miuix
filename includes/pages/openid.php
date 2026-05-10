<?php if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>获取<?php echo $openid_name?></title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-result-card { max-width: 420px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .mx-result-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .mx-result-icon svg { width: 36px; height: 36px; }
        .mx-result-icon.success { background: var(--mx-success-light); color: var(--mx-success); }
        .mx-result-body { padding: 32px 24px 16px; text-align: center; }
        .mx-result-title { font-size: 18px; font-weight: 600; color: var(--mx-text-primary); margin-bottom: 8px; }
        .mx-result-info { padding: 0 24px 16px; }
        .mx-result-info label { display: block; font-size: 13px; color: var(--mx-text-tertiary); margin-bottom: 8px; }
        .mx-result-textarea { width: 100%; padding: 12px 16px; background: var(--mx-bg-secondary); border: 1.5px solid transparent; border-radius: var(--mx-radius-sm); font-size: 14px; color: var(--mx-text-primary); text-align: center; resize: none; outline: none; box-sizing: border-box; }
        .mx-result-textarea:focus { border-color: var(--mx-accent); background: var(--mx-bg-card); box-shadow: 0 0 0 3px var(--mx-accent-light); }
        .mx-result-actions { padding: 0 24px 24px; display: flex; gap: 12px; }
        .mx-result-actions .mx-btn { flex: 1; }
        .mx-result-footer { padding: 16px 24px; border-top: 1px solid var(--mx-border); text-align: center; font-size: 12px; color: var(--mx-text-tertiary); }
    </style>
</head>
<body>
    <div class="mx-result-card mx-animate">
        <div class="mx-result-body">
            <div class="mx-result-icon success"><?php echo MxIcons::SUCCESS ?></div>
            <div class="mx-result-title" style="margin-top:16px">获取<?php echo $openid_name?>成功</div>
        </div>
        <div class="mx-result-info">
            <label>如未自动填写，请手动复制下方<?php echo $openid_name?>：</label>
            <textarea class="mx-result-textarea" rows="2" readonly><?php echo $openid_content?></textarea>
        </div>
        <div class="mx-result-actions">
            <button class="mx-btn mx-btn-primary copy-btn" data-clipboard-text="<?php echo $openid_content?>">点击复制</button>
            <button class="mx-btn mx-btn-secondary" id="Close">关闭</button>
        </div>
        <div class="mx-result-footer">Copyright © <?php echo date("Y")?> <?php echo $conf['sitename']?></div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
    <script src="<?php echo $cdnpublic?>clipboard.js/1.7.1/clipboard.min.js"></script>
    <script>
    document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});
    $(function(){
        var clipboard = new Clipboard('.copy-btn');
        clipboard.on('success', function(e){ layer.msg('复制成功！', {icon:1}); });
        clipboard.on('error', function(e){ layer.msg('复制失败，请长按链接后手动复制', {icon:2}); });
    });
    if(navigator.userAgent.indexOf("AlipayClient/")>-1){
        function Alipayready(cb){if(window.AlipayJSBridge){cb();}else{document.addEventListener('AlipayJSBridgeReady',cb,false);}}
        Alipayready(function(){$('#Close').click(function(){AlipayJSBridge.call('popWindow');});});
    }else if(navigator.userAgent.indexOf("MicroMessenger/")>-1){
        if(typeof WeixinJSBridge=="undefined"){if(document.addEventListener){document.addEventListener('WeixinJSBridgeReady',jsApiCall,false);}else if(document.attachEvent){document.attachEvent('WeixinJSBridgeReady',jsApiCall);document.attachEvent('onWeixinJSBridgeReady',jsApiCall);}}else{jsApiCall();}
        function jsApiCall(){$('#Close').click(function(){WeixinJSBridge.call('closeWindow');});}
    }else if(navigator.userAgent.indexOf("QQ/")>-1){$('#Close').hide();}
    else{$('#Close').click(function(){window.opener=null;window.close();});}
    </script>
</body>
</html>
