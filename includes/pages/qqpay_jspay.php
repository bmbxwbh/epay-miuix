<?php if(!defined('IN_PLUGIN'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>正在跳转支付</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-result-card { max-width: 420px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .mx-result-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .mx-result-icon svg { width: 36px; height: 36px; }
        .mx-result-icon.loading { background: var(--mx-accent-light); color: var(--mx-accent); }
        .mx-result-body { padding: 40px 24px 24px; text-align: center; }
        .mx-result-title { font-size: 18px; font-weight: 600; color: var(--mx-text-primary); }
    </style>
<link rel="stylesheet" href="/assets/css/miuix-override.css"/>
</head>
<body>
    <div class="mx-result-card mx-animate">
        <div class="mx-result-body">
            <div class="mx-result-icon loading"><?php echo MxIcons::LOADING ?></div>
            <div class="mx-result-title" style="margin-top:20px">正在跳转支付...</div>
        </div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
    <script src="//open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
    <script>
    document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});
    function callpay(){
        mqq.tenpay.pay({tokenId:'<?php echo $tokenId; ?>',appInfo:"<?php echo $appInfo; ?>"},function(result,resultCode){
            if(result.resultCode==0){loadmsg();}
        });
    }
    function loadmsg(){
        $.ajax({type:"GET",dataType:"json",url:"/getshop.php",data:{type:"qqpay",trade_no:"<?php echo $order['trade_no']?>"},
            success:function(data){if(data.code==1){layer.msg('支付成功，正在跳转中...',{icon:16,shade:0.1,time:15000});setTimeout(window.location.href=data.backurl,1000);}else{setTimeout("loadmsg()",2000);}},
            error:function(){setTimeout("loadmsg()",2000);}
        });
    }
    window.onload=callpay();
    </script>
</body>
</html>
