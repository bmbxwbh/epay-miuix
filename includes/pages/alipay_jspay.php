<?php if(!defined('IN_PLUGIN'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>支付宝支付</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-loading-card { max-width: 400px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); padding: 40px 24px; text-align: center; }
        .mx-loading-icon { width: 72px; height: 72px; border-radius: 50%; background: var(--mx-accent-light); color: var(--mx-accent); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; }
        .mx-loading-icon svg { width: 36px; height: 36px; }
        .mx-loading-title { font-size: 18px; font-weight: 600; color: var(--mx-text-primary); }
    </style>
</head>
<body>
    <div class="mx-loading-card">
        <div class="mx-loading-icon"><?php echo MxIcons::LOADING ?></div>
        <div class="mx-loading-title">正在跳转支付...</div>
    </div>
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
    <script>
    document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});
    var tradeNO='<?php echo $alipay_trade_no?>';
    function Alipayready(cb){if(window.AlipayJSBridge){cb();}else{document.addEventListener('AlipayJSBridgeReady',cb,false);}}
    function AlipayJsPay(){
        Alipayready(function(){
            AlipayJSBridge.call("tradePay",{tradeNO:tradeNO},function(result){
                var msg="";
                if(result.resultCode=="9000"){loadmsg();}
                else if(result.resultCode=="8000"){msg="正在处理中";}
                else if(result.resultCode=="4000"){msg="订单支付失败";}
                else if(result.resultCode=="6002"){msg="网络连接出错";}
                if(msg!=""){layer.msg(msg);}
            });
        });
    }
    function loadmsg(){
        $.ajax({type:"GET",dataType:"json",url:"/getshop.php",data:{type:"wxpay",trade_no:"<?php echo TRADE_NO?>"},
            success:function(data){if(data.code==1){layer.msg('支付成功，正在跳转中...',{icon:16,shade:0.01,time:15000});window.location.href=<?php echo $redirect_url?>;}else{setTimeout("loadmsg()",2000);}},
            error:function(){setTimeout("loadmsg()",2000);}
        });
    }
    window.onload=AlipayJsPay();
    </script>
</body>
</html>
