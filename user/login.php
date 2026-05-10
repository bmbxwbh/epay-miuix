<?php
$is_defend=true;
include("../includes/common.php");

if(isset($_GET['logout'])){
	if(!checkRefererHost())exit();
	setcookie("user_token", "", time() - 2592000, "/");
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登录！');window.location.href='./login.php';</script>");
}elseif($islogin2==1){
	exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}
$csrf_token = md5(mt_rand(0,999).time());
$_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"/>
<title>登录 | <?php echo $conf['sitename']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<link rel="stylesheet" href="../assets/css/miuix.css"/>
<style>
body {
  background: var(--mx-bg);
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;
}
.login-card {
  max-width: 420px;
  width: 100%;
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius-lg);
  box-shadow: var(--mx-shadow-md);
  border: 1px solid var(--mx-border);
  padding: 40px 32px;
}
.login-logo {
  text-align: center;
  margin-bottom: 32px;
}
.login-logo-icon {
  width: 56px;
  height: 56px;
  border-radius: var(--mx-radius);
  background: var(--mx-accent);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
}
.login-logo-icon svg { width: 28px; height: 28px; }
.login-title {
  font-size: 22px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 4px;
}
.login-subtitle {
  font-size: 14px;
  color: var(--mx-text-tertiary);
  text-align: center;
}
.login-tabs {
  display: flex;
  gap: 4px;
  background: var(--mx-bg-secondary);
  border-radius: var(--mx-radius-sm);
  padding: 4px;
  margin-bottom: 24px;
}
.login-tab {
  flex: 1;
  padding: 10px;
  text-align: center;
  font-size: 14px;
  font-weight: 500;
  color: var(--mx-text-secondary);
  border-radius: 8px;
  cursor: pointer;
  transition: all var(--mx-transition);
  background: none;
  border: none;
}
.login-tab.active {
  background: var(--mx-bg-card);
  color: var(--mx-text-primary);
  box-shadow: var(--mx-shadow);
}
.login-footer {
  margin-top: 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.login-social {
  display: flex;
  gap: 12px;
  justify-content: center;
  margin-top: 20px;
}
.login-social-btn {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: var(--mx-bg-secondary);
  border: 1px solid var(--mx-border);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all var(--mx-transition);
  color: var(--mx-text-secondary);
}
.login-social-btn:hover { background: var(--mx-accent-light); color: var(--mx-accent); }
</style>
</head>
<body>
<div class="login-card mx-animate-scaleIn">
  <div class="login-logo">
    <div class="login-logo-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
    </div>
    <div class="login-title"><?php echo $conf['sitename']?></div>
    <div class="login-subtitle">请输入您的商户信息</div>
  </div>

  <form method="post" action="login.php" id="loginForm">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token?>">
    <input type="hidden" name="type" id="loginType" value="1">

    <?php if(!$conf['close_keylogin']){?>
    <div class="login-tabs">
      <button type="button" class="login-tab active" onclick="switchLoginType(this,1)">密码登录</button>
      <button type="button" class="login-tab" onclick="switchLoginType(this,0)">密钥登录</button>
    </div>
    <?php }?>

    <div class="mx-input-group" id="userGroup">
      <label class="mx-label" id="userLabel">邮箱 / 手机号</label>
      <input type="text" name="user" class="mx-input" placeholder="请输入邮箱或手机号" id="userInput" autocomplete="username">
    </div>

    <div class="mx-input-group" id="passGroup">
      <label class="mx-label" id="passLabel">密码</label>
      <input type="password" name="pass" class="mx-input" placeholder="请输入密码" id="passInput" autocomplete="current-password">
    </div>

    <?php if($conf['captcha_open_login']==1){?>
    <div class="mx-input-group" id="captcha">
      <div id="captcha_text" style="font-size:13px;color:var(--mx-text-tertiary);">正在加载验证码...</div>
      <div id="captcha_wait" style="display:none;"></div>
    </div>
    <div id="captchaform"></div>
    <?php }?>

    <button type="button" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" id="submit" style="margin-top:8px;">立即登录</button>
  </form>

  <div class="login-footer">
    <a href="findpwd.php" class="mx-btn mx-btn-ghost mx-btn-sm">找回密码</a>
    <?php if($conf['reg_open']!=0){?>
    <a href="reg.php" class="mx-btn mx-btn-outline mx-btn-sm">注册商户</a>
    <?php }?>
  </div>

  <?php if(!isset($_GET['connect'])){?>
  <div class="login-social">
    <?php if($conf['login_alipay']>0 || $conf['login_alipay']==-1){?>
    <div class="login-social-btn" title="支付宝登录" onclick="connect('alipay')">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
    </div>
    <?php }?>
    <?php if($conf['login_qq']>0){?>
    <div class="login-social-btn" title="QQ 登录" onclick="connect('qq')">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M8 15c-1.5-1-2-3-2-5a6 6 0 0112 0c0 2-.5 4-2 5"/></svg>
    </div>
    <?php }?>
    <?php if($conf['login_wx']>0 || $conf['login_wx']==-1){?>
    <div class="login-social-btn" title="微信登录" onclick="connect('wx')">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
    </div>
    <?php }?>
  </div>
  <?php }?>
</div>

<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
<script src="<?php echo $cdnpublic?>jsencrypt/3.5.4/jsencrypt.min.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script>
window.appendChildOrg = Element.prototype.appendChild;
Element.prototype.appendChild = function() {
    if(arguments[0].tagName == 'SCRIPT'){ arguments[0].setAttribute('referrerpolicy', 'no-referrer'); }
    return window.appendChildOrg.apply(this, arguments);
};
</script>
<script src="//static.geetest.com/v4/gt4.js"></script>
<script>
const PUBLIC_KEY_PEM = `<?php echo base64ToPem($conf['public_key'], 'PUBLIC KEY')?>`;
var captcha_open = 0;
var handlerEmbed = function(captchaObj) {
  captchaObj.appendTo('#captcha');
  captchaObj.onReady(function(){ $("#captcha_wait").hide(); }).onSuccess(function(){
    var result = captchaObj.getValidate();
    if(!result) return alert('请完成验证');
    $.captchaResult = result;
    $.captchaObj = captchaObj;
  });
};

function switchLoginType(el, type) {
  el.closest('.login-tabs').querySelectorAll('.login-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('loginType').value = type;
  if(type == 0) {
    document.getElementById('userLabel').textContent = '商户 ID';
    document.getElementById('userInput').placeholder = '请输入商户 ID';
    document.getElementById('passLabel').textContent = '商户密钥';
    document.getElementById('passInput').placeholder = '请输入商户密钥';
  } else {
    document.getElementById('userLabel').textContent = '邮箱 / 手机号';
    document.getElementById('userInput').placeholder = '请输入邮箱或手机号';
    document.getElementById('passLabel').textContent = '密码';
    document.getElementById('passInput').placeholder = '请输入密码';
  }
}

$(document).ready(function(){
  if($("#captcha").length > 0) captcha_open = 1;
  $("#submit").click(function(){
    var type = $("input[name='type']").val();
    var user = $("input[name='user']").val();
    var pass = $("input[name='pass']").val();
    if(user == '' || pass == '') { layer.alert(type == 1 ? '账号和密码不能为空！' : 'ID和密钥不能为空！'); return false; }
    submitLogin(type, user, pass);
  });
  // Enter key
  $("input").on("keydown", function(e){ if(e.keyCode == 13) $("#submit").click(); });
  if(captcha_open == 1) {
    $.ajax({
      url: "ajax.php?act=captcha", type: "get", cache: false, dataType: "json",
      success: function(data) {
        $('#captcha_text').hide();
        if(data.version == 1) {
          initGeetest4({captchaId: data.gt, product: 'popup', protocol: 'https://', riskType: 'slide', hideSuccess: true, nativeButton: {width: '100%'}}, handlerEmbed);
        } else {
          initGeetest({gt: data.gt, challenge: data.challenge, new_captcha: data.new_captcha, product: "popup", width: "100%", offline: !data.success}, handlerEmbed);
        }
      }
    });
  }
});

function submitLogin(type, user, pass) {
  var csrf_token = $("input[name='csrf_token']").val();
  if(captcha_open == 1 && !$.captchaResult) { layer.alert('请先完成滑动验证！'); return false; }
  var enc_type = '0';
  if(PUBLIC_KEY_PEM != '') {
    const enc = new JSEncrypt();
    enc.setPublicKey(PUBLIC_KEY_PEM);
    pass = enc.encrypt(pass);
    if(pass) enc_type = '1';
  }
  var ii = layer.load();
  $.ajax({
    type: "POST", dataType: "json",
    data: {type:type, user:user, pass:pass, enc:enc_type, csrf_token:csrf_token, ...$.captchaResult},
    url: "ajax.php?act=login",
    success: function(data) {
      layer.close(ii);
      if(data.code == 0) {
        layer.msg(data.msg, {icon: 16, time: 10000, shade: [0.3, "#000"]});
        setTimeout(function(){ window.location.href = data.url }, 1000);
      } else {
        layer.alert(data.msg, {icon: 2});
        if($.captchaObj) $.captchaObj.reset();
      }
    },
    error: function() { layer.msg('服务器错误', {icon: 2}); }
  });
}

function connect(type) {
  var ii = layer.load();
  $.ajax({
    type: "POST", url: "ajax.php?act=connect", data: {type:type}, dataType: 'json',
    success: function(data) {
      layer.close(ii);
      if(data.code == 0) { window.location.href = data.url; }
      else { layer.alert(data.msg, {icon: 7}); }
    }
  });
}
</script>
</body>
</html>
