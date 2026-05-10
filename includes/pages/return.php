<?php if(!defined('IN_PLUGIN'))exit();
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
        .mx-loading-card { max-width: 400px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); padding: 40px 24px; text-align: center; }
        .mx-loading-icon { width: 72px; height: 72px; border-radius: 50%; background: var(--mx-accent-light); color: var(--mx-accent); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
        .mx-loading-icon svg { width: 36px; height: 36px; }
        .mx-loading-title { font-size: 18px; font-weight: 600; color: var(--mx-text-primary); margin-bottom: 8px; }
        .mx-loading-desc { font-size: 14px; color: var(--mx-text-secondary); }
    </style>
</head>
<body>
    <div class="mx-loading-card">
        <div class="mx-loading-icon"><?php echo MxIcons::LOADING ?></div>
        <div class="mx-loading-title">正在检测付款结果...</div>
        <div class="mx-loading-desc">稍后页面将自动跳转</div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
    <script>
    document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});
    function loadmsg(){
        $.ajax({type:"GET",dataType:"json",url:"/getshop.php",data:{type:"wxpay",trade_no:"<?php echo $order['trade_no']?>"},
            success:function(data){if(data.code==1){layer.msg('支付成功，正在跳转中...',{icon:16,shade:0.1,time:15000});setTimeout(window.location.href=data.backurl,1000);}else{setTimeout("loadmsg()",2000);}},
            error:function(){setTimeout("loadmsg()",2000);}
        });
    }
    window.onload=loadmsg();
    </script>
</body>
</html>
