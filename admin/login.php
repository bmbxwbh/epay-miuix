<?php
$verifycode = 1;
$login_limit_count = 5;
$login_limit_file = '@login.lock';

if(!function_exists("imagecreate") || !file_exists('code.php'))$verifycode=0;
include("../includes/common.php");

if(isset($_GET['act']) && $_GET['act']=='login'){
  if(!checkRefererHost()){
    @file_put_contents(dirname(__DIR__).'/debug_auth.log', json_encode([
        'time' => date('Y-m-d H:i:s'),
        'type' => 'REFERER_FAIL',
        'referer' => $_SERVER['HTTP_REFERER'] ?? 'NONE',
        'host' => $_SERVER['HTTP_HOST'],
    ])."\n", FILE_APPEND);
    exit('{"code":403}');
  }
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $code = trim($_POST['code']);
  $enc_type = isset($_POST['enc']) ? $_POST['enc'] : '0';
  if(empty($username) || empty($password)){
    exit(json_encode(['code'=>-1,'msg'=>'用户名或密码不能为空']));
  }
  if($verifycode==1 && (!$code || strtolower($code) != $_SESSION['vc_code'])){
    exit(json_encode(['code'=>-1,'msg'=>'验证码错误']));
  }
  $errcount = $DB->getColumn("SELECT count(*) FROM `pre_log` WHERE `ip`=:ip AND `date`>DATE_SUB(NOW(),INTERVAL 1 DAY) AND `uid`=0 AND `type`='登录失败'", [':ip'=>$clientip]);
  if($errcount >= $login_limit_count && file_exists($login_limit_file) && !$conf['totp_open']){
    exit(json_encode(['code'=>-1,'msg'=>'多次登录失败，暂时禁止登录。可删除@login.lock文件解除限制']));
  }
  if($enc_type == '1'){
    $plain = '';
    $private_key = base64ToPem($conf['private_key'], 'PRIVATE KEY');
    $pkey = openssl_pkey_get_private($private_key);
    if(!openssl_private_decrypt(base64_decode($password), $plain, $pkey, OPENSSL_PKCS1_PADDING)){
      exit(json_encode(['code'=>-1,'msg'=>'密码解密失败']));
    }
    $password = $plain;
  }
  if($username == $conf['admin_user'] && $password == $conf['admin_pwd']){
    if ($conf['totp_open'] == 1 && !empty($conf['totp_secret'])) {
      if (file_exists($login_limit_file)) { unlink($login_limit_file); }
      exit(json_encode(['code'=>-1, 'msg'=>'需要验证动态口令', 'vcode' => 2]));
    }
    $DB->insert('log', ['uid'=>0, 'type'=>'登录后台', 'date'=>'NOW()', 'ip'=>$clientip]);
    if (file_exists($login_limit_file)) { unlink($login_limit_file); }
    $session=md5($username.$password.$password_hash);
    $expiretime=time() + 2592000;
    $token=authcode("{$username}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
    $cookie_result = setcookie("admin_token", rawurlencode($token), $expiretime, '/', '', $is_https, true);
    // DEBUG: 临时调试
    @file_put_contents(dirname(__DIR__).'/debug_auth.log', json_encode([
        'time' => date('Y-m-d H:i:s'),
        'type' => 'LOGIN',
        'user' => $username,
        'token_len' => strlen($token),
        'cookie_ok' => $cookie_result ? 'YES' : 'NO',
        'syskey_prefix' => substr(SYS_KEY, 0, 8),
    ])."\n", FILE_APPEND);
    unset($_SESSION['vc_code']);
    exit(json_encode(['code'=>0]));
  }else{
    $DB->insert('log', ['uid'=>0, 'type'=>'登录失败', 'date'=>'NOW()', 'ip'=>$clientip]);
    unset($_SESSION['vc_code']);
    $errcount++;
    $retry_times = $login_limit_count - $errcount;
    if($retry_times < 0) $retry_times = 0;
    if($retry_times <= 0){
      file_put_contents($login_limit_file, '1');
      exit(json_encode(['code'=>-1,'msg'=>'多次登录失败，暂时禁止登录。可删除@login.lock文件解除限制','vcode'=>1]));
    }else{
      exit(json_encode(['code'=>-1,'msg'=>'用户名或密码错误，你还可以尝试'.$retry_times.'次','vcode'=>1]));
    }
  }
}elseif(isset($_GET['act']) && $_GET['act']=='totp'){
  if(!checkRefererHost())exit('{"code":403}');
  $code = trim($_POST['code']);
  if (empty($code)) exit(json_encode(['code'=>-1,'msg'=>'请输入动态口令']));
  if ($conf['totp_open'] != 1 || empty($conf['totp_secret'])) {
    exit(json_encode(['code'=>-1,'msg'=>'未启用TOTP二次验证']));
  }
  try {
    $totp = \lib\TOTP::create($conf['totp_secret']);
    if (!$totp->verify($code)) {
      exit(json_encode(['code'=>-1,'msg'=>'动态口令错误']));
    }
  } catch (Exception $e) {
    exit(json_encode(['code'=>-1,'msg'=>$e->getMessage()]));
  }
  $DB->insert('log', ['uid'=>0, 'type'=>'登录后台', 'date'=>'NOW()', 'ip'=>$clientip]);
  $session=md5($conf['admin_user'].$conf['admin_pwd'].$password_hash);
  $expiretime=time() + 2592000;
  $token=authcode("{$conf['admin_user']}\t{$session}\t{$expiretime}", 'ENCODE', SYS_KEY);
  $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
  setcookie("admin_token", rawurlencode($token), $expiretime, '/', '', $is_https, true);
  exit(json_encode(['code'=>0]));
}elseif(isset($_GET['logout'])){
	if(!checkRefererHost())exit();
	$is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
	setcookie("admin_token", "", time() - 2592000, '/', '', $is_https, true);
	exit("<script language='javascript'>window.location.href='./login.php';</script>");
}elseif($islogin==1){
	exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"/>
<title>管理员登录 | NAILTEAM 管理中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<link rel="stylesheet" href="../assets/css/miuix.css"/>
<link rel="stylesheet" href="../assets/css/miuix-override.css"/>
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
.login-title { font-size: 22px; font-weight: 700; text-align: center; margin-bottom: 4px; }
.login-subtitle { font-size: 14px; color: var(--mx-text-tertiary); text-align: center; }
.totp-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  background: var(--mx-accent-light);
  color: var(--mx-accent);
  border-radius: var(--mx-radius-sm);
  font-size: 13px;
  font-weight: 500;
  margin-bottom: 16px;
}
</style>
</head>
<body>
<div class="login-card mx-animate-scaleIn">
  <div class="login-logo">
    <div class="login-logo-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
    </div>
    <div class="login-title">NAILTEAM 管理中心</div>
    <div class="login-subtitle">管理员登录</div>
  </div>

  <!-- Login Form -->
  <form id="login-form" method="post" onsubmit="return submitlogin()">
    <div class="mx-input-group">
      <label class="mx-label">用户名</label>
      <input type="text" name="user" class="mx-input" placeholder="请输入管理员用户名" autocomplete="username">
    </div>
    <div class="mx-input-group">
      <label class="mx-label">密码</label>
      <input type="password" name="pass" class="mx-input" placeholder="请输入密码" autocomplete="current-password">
    </div>
    <?php if($verifycode==1){?>
    <div class="mx-input-group">
      <label class="mx-label">验证码</label>
      <div style="display:flex;gap:12px;">
        <input type="text" name="code" class="mx-input" placeholder="输入验证码" autocomplete="off" style="flex:1;">
        <img id="verifycode" src="./code.php?r=<?php echo time();?>" style="height:42px;border-radius:var(--mx-radius-sm);cursor:pointer;border:1px solid var(--mx-border);" onclick="this.src='./code.php?r='+Math.random();" title="点击更换验证码">
      </div>
    </div>
    <?php }?>
    <button type="submit" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg" style="margin-top:8px;">立即登录</button>
    <div style="text-align:center;margin-top:16px;">
      <a href="javascript:void(0);" onclick="findpwd()" class="mx-text-sm" style="color:var(--mx-text-tertiary)">忘记密码？</a>
    </div>
  </form>

  <!-- TOTP Form -->
  <form id="totp-form" method="post" onsubmit="return doTotp()" style="display:none;">
    <div class="totp-badge" style="display:flex;justify-content:center;">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
      TOTP 二次验证
    </div>
    <div class="mx-input-group">
      <label class="mx-label">动态口令</label>
      <input type="number" name="totp_code" id="totp_code" class="mx-input" placeholder="输入 6 位动态口令" autocomplete="off" maxlength="6">
    </div>
    <button type="submit" class="mx-btn mx-btn-primary mx-btn-block mx-btn-lg">验证并登录</button>
  </form>
</div>

<!-- Find Password Modal -->
<div class="mx-modal-overlay" id="findpwdModal">
  <div class="mx-modal">
    <div class="mx-modal-header">找回管理员密码</div>
    <div class="mx-modal-body">
      <p>进入数据库管理器（phpMyAdmin），点击进入当前网站所在数据库，然后查看 pay_config 表即可找回管理员密码。</p>
      <?php if($conf['totp_open'] == 1){?>
      <p style="margin-top:12px;font-size:13px;color:var(--mx-text-tertiary);">如需关闭 TOTP 二次验证，请执行：<br><code style="font-size:12px;background:var(--mx-bg-secondary);padding:2px 6px;border-radius:4px;">UPDATE pay_config SET v='0' WHERE k='totp_open';</code></p>
      <?php }?>
    </div>
    <div class="mx-modal-footer">
      <button class="mx-btn mx-btn-secondary" onclick="document.getElementById('findpwdModal').classList.remove('open')">关闭</button>
    </div>
  </div>
</div>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
<script src="<?php echo $cdnpublic?>jsencrypt/3.5.4/jsencrypt.min.js"></script>
<script>
const PUBLIC_KEY_PEM = `<?php echo base64ToPem($conf['public_key'], 'PUBLIC KEY')?>`;

function submitlogin(){
  var enc_type = '0';
  var user = $("input[name='user']").val();
  var pass = $("input[name='pass']").val();
  var code = $("input[name='code']").val();
  if(user=='' || pass==''){layer.alert('用户名或密码不能为空！');return false;}
  if(PUBLIC_KEY_PEM != ''){
    const enc = new JSEncrypt();
    enc.setPublicKey(PUBLIC_KEY_PEM);
    pass = enc.encrypt(pass);
    if(pass) enc_type = '1';
  }
  var ii = layer.load(2);
  $.ajax({
    type: 'POST', url: '?act=login',
    data: {username:user, password:pass, code:code, enc:enc_type},
    dataType: 'json',
    success: function(data) {
      layer.close(ii);
      if(data.code == 0){
        layer.msg('登录成功，正在跳转', {icon: 1, shade: 0.01, time: 15000});
        window.location.href='./';
      }else{
        if(data.vcode==1){
          $("#verifycode").attr('src', './code.php?r='+Math.random());
        }else if(data.vcode==2){
          $("#totp-form").show();
          $("#login-form").hide();
          $("#totp_code").focus();
          return false;
        }
        layer.alert(data.msg, {icon: 2});
      }
    },
    error: function(){ layer.close(ii); layer.msg('服务器错误'); }
  });
  return false;
}

function doTotp(){
  var code = $("#totp_code").val();
  if(code.length != 6){ layer.msg('动态口令格式错误', {icon: 2}); return false; }
  var ii = layer.load(2, {shade:[0.1,'#fff']});
  $.post('?act=totp', {code:code}, function(res){
    layer.close(ii);
    if(res.code == 0){
      layer.msg('登录成功，正在跳转', {icon: 1, shade: 0.01, time: 15000});
      window.location.href = './';
    }else{
      layer.alert(res.msg, {icon: 2});
    }
  }, 'json');
  return false;
}

function findpwd(){ document.getElementById('findpwdModal').classList.add('open'); }

$(document).ready(function(){
  $("#totp_code").keyup(function(){
    if($(this).val().length == 6) $("#totp-form").submit();
  });
});
</script>
</body>
</html>
