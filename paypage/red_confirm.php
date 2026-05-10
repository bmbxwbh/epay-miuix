<?php
if(!defined('IN_CRONLITE'))exit();
include_once(SYSTEM_ROOT.'lib/mxicons.php');
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <title>红包领取确认</title>
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
            <div class="mx-result-amount"><?php echo htmlspecialchars($trans['money'], ENT_QUOTES, 'UTF-8')?></div>
        </div>
        <div class="mx-result-info">
            <div class="mx-result-row">
                <span class="label">创建时间</span>
                <span class="value"><?php echo htmlspecialchars($trans['addtime'], ENT_QUOTES, 'UTF-8')?></span>
            </div>
        </div>
        <div class="mx-result-actions">
            <button class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" id="Confirm">收款</button>
        </div>
        <div class="mx-result-tips">请在24小时内确认</div>
        <div class="mx-result-footer">Copyright © <?php echo date("Y")?> <?php echo htmlspecialchars($conf['sitename'], ENT_QUOTES, 'UTF-8')?></div>
    </div>

    <div class="mx-loading-overlay" id="loadingOverlay">
        <div class="mx-loading-box">
            <?php echo MxIcons::LOADING ?>
            <p>正在加载</p>
        </div>
    </div>

    <div class="mx-modal-overlay" id="errorModal">
        <div class="mx-modal">
            <div class="mx-modal-header">提示</div>
            <div class="mx-modal-body" id="errorContent"></div>
            <div class="mx-modal-footer">
                <button class="mx-btn mx-btn-secondary" onclick="document.getElementById('errorModal').classList.remove('open')">关闭</button>
            </div>
        </div>
    </div>

    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script>
    document.body.addEventListener('touchmove', function(e){ e.preventDefault(); }, {passive:false});
    function showError(msg) {
        document.getElementById('errorContent').textContent = msg;
        document.getElementById('errorModal').classList.add('open');
    }
    $(function(){
        $('#Confirm').click(function(){
            $('#loadingOverlay').addClass('show');
            $.ajax({
                type: 'POST', url: './red_ajax.php',
                data: {n:"<?php echo htmlspecialchars($biz_no, ENT_QUOTES, 'UTF-8')?>", t:"<?php echo htmlspecialchars($time, ENT_QUOTES, 'UTF-8')?>", s:"<?php echo htmlspecialchars($sign, ENT_QUOTES, 'UTF-8')?>", openid:"<?php echo htmlspecialchars($openid, ENT_QUOTES, 'UTF-8')?>"},
                dataType: 'json',
                success: function(r){
                    $('#loadingOverlay').removeClass('show');
                    if(r.code==0) window.location.href=r.redirect_url;
                    else showError(r.msg);
                },
                error: function(){
                    $('#loadingOverlay').removeClass('show');
                    showError('网络异常，请稍后再试！');
                }
            });
        });
    });
    </script>
</body>
</html>
