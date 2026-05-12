<?php
$is_defend=true;
include("../includes/common.php");
if(isset($_GET['regok'])){
	exit("<script language='javascript'>alert('恭喜你，商户注册成功！');window.location.href='./login.php';</script>");
}
if($islogin2==1){
	exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}

if($conf['reg_open']==0)sysmsg('未开放商户申请');

if(isset($_GET['invite'])){
    $invite_code = trim($_GET['invite']);
    $uid = get_invite_uid($invite_code);
    if($uid && is_numeric($uid)){
        $_SESSION['invite_uid'] = intval($uid);
    }
}

$csrf_token = md5(mt_rand(0,999).time());
$_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<title>申请商户 | <?php echo $conf['sitename']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="stylesheet" href="../assets/css/miuix.css" />
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
.login-footer {
  margin-top: 24px;
  display: flex;
  justify-content: center;
}
input:-webkit-autofill{-webkit-box-shadow:0 0 0px 1000px white inset;-webkit-text-fill-color:#333;}
</style>
</head>
<body>

<div class="login-card mx-animate-scaleIn">
  <div class="login-logo">
    <div class="login-logo-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
    </div>
    <div class="login-title"><?php echo $conf['sitename']?></div>
    <div class="login-subtitle">自助申请商户</div>
  </div>

  <form name="form" id="regForm"><input type="hidden" name="csrf_token" value="<?php echo $csrf_token?>"><input type="hidden" name="verifytype" value="<?php echo $conf['verifytype']?>">
<?php if($conf['reg_pay']){?><div style="text-align:center;margin-bottom:16px;font-size:14px;color:var(--mx-text-secondary);">商户申请价格为：<b><?php echo $conf['reg_pay_price']?></b>元</div><?php }?>

<?php if($conf['verifytype']==1){?>
<div class="mx-input-group">
  <label class="mx-label">手机号码</label>
  <input type="text" name="phone" class="mx-input" placeholder="手机号码（同时作为登录账号）" required>
</div>
<div class="mx-input-group">
  <label class="mx-label">短信验证码</label>
  <div style="display:flex;gap:8px;">
    <input type="text" name="code" class="mx-input" placeholder="短信验证码" required style="flex:1;">
    <a class="mx-btn mx-btn-outline" id="sendcode" style="white-space:nowrap;">获取验证码</a>
  </div>
</div>
<?php }else{?>
<div class="mx-input-group">
  <label class="mx-label">邮箱</label>
  <input type="email" name="email" class="mx-input" placeholder="邮箱（同时作为登录账号）" required>
</div>
<div class="mx-input-group">
  <label class="mx-label">邮箱验证码</label>
  <div style="display:flex;gap:8px;">
    <input type="text" name="code" class="mx-input" placeholder="邮箱验证码" required style="flex:1;">
    <a class="mx-btn mx-btn-outline" id="sendcode" style="white-space:nowrap;">获取验证码</a>
  </div>
</div>
<?php }?>

<div class="mx-input-group">
  <label class="mx-label">密码</label>
  <input type="password" name="pwd" class="mx-input" placeholder="请输入你的密码" required>
</div>
<div class="mx-input-group">
  <label class="mx-label">确认密码</label>
  <input type="password" name="pwd2" class="mx-input" placeholder="请再次输入密码" required>
</div>
<?php if($conf['reg_open']==2){?>
<div class="mx-input-group">
  <label class="mx-label">邀请码</label>
  <input type="text" name="invitecode" class="mx-input" placeholder="邀请码" required>
</div>
<?php }?>

<div style="margin:16px 0;">
  <label style="font-size:14px;color:var(--mx-text-secondary);cursor:pointer;">
    <input type="checkbox" checked required style="margin-right:6px;">同意<a href="../agreement.html" target="_blank" style="color:var(--mx-accent);">我们的条款</a>
  </label>
</div>

<button type="button" id="submit" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg">立即注册</button>
<div class="login-footer">
  <a href="login.php" class="mx-btn mx-btn-outline mx-btn-sm">返回登录</a>
</div>
  </form>
</div>

<!-- 注册须知弹窗 -->
<div class="mx-modal-overlay" id="regNoticeModal">
  <div class="mx-modal">
    <div class="mx-modal-header">注册须知</div>
    <div class="mx-modal-body">
      <?php echo $conf['zhuce']?>
    </div>
    <div class="mx-modal-footer">
      <button class="mx-btn mx-btn-primary" onclick="document.getElementById('regNoticeModal').classList.remove('open')">我知道了</button>
    </div>
  </div>
</div>

<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
<script src="<?php echo $cdnpublic?>jsencrypt/3.5.4/jsencrypt.min.js"></script>
<script src="//static.geetest.com/static/tools/gt.js"></script>
<script>
window.appendChildOrg = Element.prototype.appendChild;
Element.prototype.appendChild = function() {
    if(arguments[0].tagName == 'SCRIPT'){
        arguments[0].setAttribute('referrerpolicy', 'no-referrer');
    }
    return window.appendChildOrg.apply(this, arguments);
};
</script>
<script src="//static.geetest.com/v4/gt4.js"></script>
<script>
const PUBLIC_KEY_PEM = `<?php echo base64ToPem($conf['public_key'], 'PUBLIC KEY')?>`;
function invokeSettime(obj){
    var countdown=60;
    settime(obj);
    function settime(obj) {
        if (countdown == 0) {
            $(obj).attr("data-lock", "false");
			$(obj).attr("disabled",false);
            $(obj).text("获取验证码");
            countdown = 60;
            return;
        } else {
			$(obj).attr("data-lock", "true");
            $(obj).attr("disabled",true);
            $(obj).text("(" + countdown + ") s 重新发送");
            countdown--;
        }
        setTimeout(function() {
                    settime(obj) }
                ,1000)
    }
}
var handlerEmbed = function (captchaObj) {
	var sendto;
	captchaObj.onReady(function () {
		$("#wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=sendcode",
			data : {sendto:sendto, ...result},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					new invokeSettime("#sendcode");
					layer.msg('发送成功，请注意查收！');
				}else{
					layer.alert(data.msg);
					captchaObj.reset();
				}
			} 
		});
	}).onError(function(){
		layer.msg('验证码加载失败，请刷新页面重试', {icon: 5});
	});
	$('#sendcode').click(function () {
		if ($(this).attr("data-lock") === "true") return;
		if($("input[name='verifytype']").val()=='1'){
			sendto=$("input[name='phone']").val();
			if(sendto==''){layer.alert('手机号码不能为空！');return false;}
			if(sendto.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			sendto=$("input[name='email']").val();
			if(sendto==''){layer.alert('邮箱不能为空！');return false;}
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(sendto)){layer.alert('邮箱格式不正确！');return false;}
		}
		if(typeof captchaObj.showCaptcha === 'function'){
			captchaObj.showCaptcha();
		}else{
			captchaObj.verify();
		}
	});
};
$(document).ready(function(){
	$("#submit").click(function(){
		if ($(this).attr("data-lock") === "true") return;
		var email=$("input[name='email']").val();
		var phone=$("input[name='phone']").val();
		var code=$("input[name='code']").val();
		var pwd=$("input[name='pwd']").val();
		var pwd2=$("input[name='pwd2']").val();
		var invitecode=$("input[name='invitecode']").val();
		if(email=='' || phone=='' || code=='' || pwd=='' || pwd2==''){layer.alert('请确保各项不能为空！');return false;}
		if($("input[name='invitecode']").length>0 && invitecode==''){layer.alert('邀请码不能为空！');return false;}
		if(pwd!=pwd2){layer.alert('两次输入密码不一致！');return false;}
		if($("input[name='verifytype']").val()=='1'){
			if(phone.length!=11){layer.alert('手机号码不正确！');return false;}
		}else{
			var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
			if(!reg.test(email)){layer.alert('邮箱格式不正确！');return false;}
		}
		var enc_type = '0';
		if(PUBLIC_KEY_PEM != ''){
			const enc = new JSEncrypt();
			enc.setPublicKey(PUBLIC_KEY_PEM);
			pwd = enc.encrypt(pwd);
			if(pwd) enc_type = '1';
		}
		var ii = layer.load();
		$(this).attr("data-lock", "true");
		var csrf_token=$("input[name='csrf_token']").val();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=reg",
			data : {email:email,phone:phone,code:code,pwd:pwd,enc:enc_type,invitecode:invitecode,csrf_token:csrf_token},
			dataType : 'json',
			success : function(data) {
				$("#submit").attr("data-lock", "false");
				layer.close(ii);
				if(data.code == 1){
					layer.alert('恭喜你，商户申请成功！', {icon: 1}, function(){
						window.location.href="./login.php";
					});
				}else if(data.code == 2){
					var paymsg = '';
					$.each(data.paytype, function(key, value) {
						paymsg+='<button class="btn btn-default btn-block" onclick="window.location.href=\'../submit2.php?typeid='+key+'&trade_no='+data.trade_no+'\'" style="margin-top:10px;"><img width="20" src="../assets/icon/'+value.name+'.ico" class="logo">'+value.showname+'</button>';
					});
					layer.alert('<center><h2>¥ '+data.need+'</h2><hr>'+paymsg+'<hr>提示：支付完成后即可直接登录</center>',{
						btn:[],
						title:'支付确认页面',
						closeBtn: false
					});
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	$.ajax({
		url: "ajax.php?act=captcha",
		type: "get",
		cache: false,
		dataType: "json",
		success: function (data) {
			if(data.version == 1){
				initGeetest4({
					captchaId: data.gt,
					product: 'bind',
					protocol: 'https://',
					riskType: 'slide',
					hideSuccess: true,
				}, handlerEmbed);
			}else{
				initGeetest({
					width: '100%',
					gt: data.gt,
					challenge: data.challenge,
					new_captcha: data.new_captcha,
					product: "bind",
					offline: !data.success
				}, handlerEmbed);
			}
		}
	});
	<?php if(!empty($conf['zhuce'])){?>
	document.getElementById('regNoticeModal').classList.add('open');
	<?php }?>
});
</script>
</body>
</html>