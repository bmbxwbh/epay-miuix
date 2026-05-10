<?php
if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>确认收款</title>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
        body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .mx-result-card { max-width: 420px; width: 100%; background: var(--mx-bg-card); border-radius: var(--mx-radius-lg); box-shadow: var(--mx-shadow-md); border: 1px solid var(--mx-border); overflow: hidden; }
        .mx-result-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .mx-result-icon svg { width: 36px; height: 36px; }
        .mx-result-icon.pending { background: var(--mx-accent-light); color: var(--mx-accent); }
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
        .mx-result-tips { text-align: center; font-size: 13px; color: var(--mx-text-tertiary); padding: 0 24px 20px; }
        .mx-result-footer { padding: 16px 24px; border-top: 1px solid var(--mx-border); text-align: center; font-size: 12px; color: var(--mx-text-tertiary); }
        .mx-loading-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.3); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 2000; }
        .mx-loading-overlay.show { display: flex; }
        .mx-loading-box { background: var(--mx-bg-card); border-radius: var(--mx-radius); padding: 28px 36px; text-align: center; box-shadow: var(--mx-shadow-lg); }
        .mx-loading-box svg { width: 32px; height: 32px; color: var(--mx-accent); margin-bottom: 12px; }
        .mx-loading-box p { font-size: 14px; color: var(--mx-text-secondary); }
    </style>
</head>
<body>
    <div class="mx-result-card mx-animate-scaleIn">
        <div class="mx-result-body">
            <div class="mx-result-icon pending"><?php echo MxIcons::CLOCK ?></div>
            <div class="mx-result-title" style="margin-top:16px">待你收款</div>
            <div class="mx-result-amount"><?php echo $money?></div>
        </div>
        <div class="mx-result-info">
            <div class="mx-result-row">
                <span class="label">转账时间</span>
                <span class="value"><?php echo $addtime?></span>
            </div>
        </div>
        <div class="mx-result-actions">
            <button class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" id="Confirm" disabled>收款</button>
        </div>
        <div class="mx-result-tips">1天内未确认，将退还给商家</div>
        <div class="mx-result-footer">Copyright © <?php echo date("Y")?> <?php echo $conf['sitename']?></div>
    </div>

    <div class="mx-loading-overlay" id="loadingOverlay">
        <div class="mx-loading-box">
            <?php echo MxIcons::LOADING ?>
            <p>正在加载</p>
        </div>
    </div>

    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script>
    document.body.addEventListener('touchmove',function(e){e.preventDefault()},{passive:false});
    wx.config(<?php echo $wxconfig?>);
    wx.ready(function(){
        document.getElementById('loadingOverlay').classList.remove('show');
        wx.checkJsApi({
            jsApiList: ['requestMerchantTransfer'],
            success: function(res){
                if(res.checkResult['requestMerchantTransfer']){ jsApiCall(); }
                else { alert('你的微信版本过低，请更新至最新版本。'); }
            }
        });
    });
    wx.error(function(res){});
    function jsApiCall(){
        var btn = document.getElementById('Confirm');
        btn.removeAttribute('disabled');
        btn.addEventListener('click', function(){
            WeixinJSBridge.invoke('requestMerchantTransfer', <?php echo $wxtransfer?>, function(res){
                if(res.err_msg === 'requestMerchantTransfer:ok'){
                    window.location.href = "<?php echo $url?>&do=success";
                }
            });
        });
    }
    </script>
</body>
</html>
