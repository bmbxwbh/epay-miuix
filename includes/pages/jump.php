<?php
if(!defined('IN_PLUGIN'))exit();
$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($useragent, 'iphone')!==false || strpos($useragent, 'ipod')!==false){
	$alert_icon = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>';
	$alert_text = '在 Safari 中打开';
}elseif(strpos($useragent, 'micromessenger')!==false){
	$alert_icon = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>';
	$alert_text = '在浏览器中打开';
}else{
	$alert_icon = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>';
	$alert_text = '在浏览器中打开';
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>请使用浏览器打开</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <style>
body {
  background: var(--mx-bg);
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;
}
.jump-card {
  max-width: 400px;
  width: 100%;
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius-lg);
  box-shadow: var(--mx-shadow-md);
  border: 1px solid var(--mx-border);
  overflow: hidden;
}
.jump-header {
  padding: 32px 24px 24px;
  text-align: center;
  background: linear-gradient(135deg, var(--mx-accent) 0%, #5a9bff 100%);
  color: #fff;
}
.jump-header-icon {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  background: rgba(255,255,255,0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
}
.jump-header-icon svg { width: 32px; height: 32px; }
.jump-header-title { font-size: 18px; font-weight: 600; margin-bottom: 4px; }
.jump-header-desc { font-size: 14px; opacity: 0.85; }
.jump-body { padding: 24px; }
.jump-steps { margin-bottom: 24px; }
.jump-step {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: 14px 0;
  border-bottom: 1px solid var(--mx-border);
}
.jump-step:last-child { border-bottom: none; }
.jump-step-num {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: var(--mx-accent-light);
  color: var(--mx-accent);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  font-weight: 700;
  flex-shrink: 0;
}
.jump-step-content { font-size: 14px; color: var(--mx-text-secondary); line-height: 1.6; }
.jump-step-content strong { color: var(--mx-text-primary); font-weight: 600; }
.jump-alert {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 16px;
  background: var(--mx-accent-light);
  color: var(--mx-accent);
  border-radius: var(--mx-radius-sm);
  font-size: 13px;
  font-weight: 500;
  margin-bottom: 20px;
}
.jump-alert svg { flex-shrink: 0; }
.jump-continue {
  display: block;
  width: 100%;
  padding: 14px;
  background: var(--mx-accent);
  color: #fff;
  border: none;
  border-radius: var(--mx-radius-full);
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  transition: all var(--mx-transition);
}
.jump-continue:hover {
  background: var(--mx-accent-hover);
  box-shadow: 0 4px 12px rgba(52, 130, 255, 0.3);
}
.jump-continue:active { transform: scale(0.98); }
.jump-copy {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  margin-top: 12px;
  padding: 10px;
  background: var(--mx-bg-secondary);
  border-radius: var(--mx-radius-sm);
  font-size: 13px;
  color: var(--mx-text-secondary);
  cursor: pointer;
  border: none;
  width: 100%;
  transition: all var(--mx-transition);
}
.jump-copy:hover { background: var(--mx-bg-tertiary); }
.jump-footer {
  padding: 16px 24px;
  border-top: 1px solid var(--mx-border);
  text-align: center;
  font-size: 12px;
  color: var(--mx-text-tertiary);
}
    </style>
</head>
<body>
<div class="jump-card mx-animate">
    <div class="jump-header">
        <div class="jump-header-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
        </div>
        <div class="jump-header-title">请使用浏览器打开</div>
        <div class="jump-header-desc">当前应用不支持直接访问</div>
    </div>
    <div class="jump-body">
        <div class="jump-alert">
            <?php echo $alert_icon?>
            <span>点击右上角，选择「<?php echo $alert_text?>」</span>
        </div>
        <div class="jump-steps">
            <div class="jump-step">
                <div class="jump-step-num">1</div>
                <div class="jump-step-content">点击页面<strong>右上角</strong>的菜单按钮</div>
            </div>
            <div class="jump-step">
                <div class="jump-step-num">2</div>
                <div class="jump-step-content">选择「<strong><?php echo $alert_text?></strong>」</div>
            </div>
            <div class="jump-step">
                <div class="jump-step-num">3</div>
                <div class="jump-step-content">在浏览器中继续完成支付</div>
            </div>
        </div>
        <a class="jump-continue" id="J_BtnDowanloadApp">继续访问</a>
        <button class="jump-copy" id="copyUrl" onclick="copyCurrentUrl()">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
            复制链接地址
        </button>
    </div>
    <div class="jump-footer">由安全支付平台提供技术支持</div>
</div>
<a style="display:none;" href="" id="vurl" rel="noreferrer"></a>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script>
function openu(u){
    document.getElementById("vurl").href = u;
    document.getElementById("vurl").click();
}
var url = window.location.href;
document.querySelector('body').addEventListener('touchmove', function(event){
    event.preventDefault();
}, {passive: false});

if(navigator.userAgent.indexOf("QQ/") > -1){
    openu("ucbrowser://" + url);
    openu("mttbrowser://url=" + url);
    openu("googlechrome://" + url);
    document.querySelector('body').addEventListener('click', function(){
        openu("ucbrowser://" + url);
        openu("mttbrowser://url=" + url);
        openu("googlechrome://" + url);
    });
}

function copyCurrentUrl(){
    if(navigator.clipboard){
        navigator.clipboard.writeText(url).then(function(){
            var btn = document.getElementById('copyUrl');
            btn.innerHTML = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> 已复制';
            setTimeout(function(){ btn.innerHTML = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> 复制链接地址'; }, 2000);
        });
    }
}
</script>
</body>
</html>
