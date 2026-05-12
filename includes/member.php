<?php
$clientip=real_ip($conf['ip_type']?$conf['ip_type']:0);

if(isset($_COOKIE["admin_token"]))
{
	$raw_token = rawurldecode($_COOKIE['admin_token']);
	$token=authcode(daddslashes($raw_token), 'DECODE', SYS_KEY);
	list($user, $sid, $expiretime) = explode("\t", $token);
	$session=md5($conf['admin_user'].$conf['admin_pwd'].$password_hash);
	if($session==$sid && $expiretime>time()) {
		$islogin=1;
	}
	// DEBUG: 临时调试，确认后删除
	if(!$islogin && basename($_SERVER['PHP_SELF']) !== 'login.php'){
		$debug_info = [
			'time' => date('Y-m-d H:i:s'),
			'file' => basename($_SERVER['PHP_SELF']),
			'has_cookie' => isset($_COOKIE["admin_token"]) ? 'YES' : 'NO',
			'cookie_len' => strlen($raw_token),
			'decoded_ok' => !empty($token) ? 'YES' : 'NO',
			'token_user' => $user ?? 'NULL',
			'token_sid' => $sid ?? 'NULL',
			'token_exp' => $expiretime ?? 'NULL',
			'expect_sid' => $session,
			'syskey_ok' => !empty(SYS_KEY) ? 'YES' : 'NO',
			'time_ok' => (isset($expiretime) && $expiretime>time()) ? 'YES' : 'NO',
		];
		@file_put_contents(ROOT.'debug_auth.log', json_encode($debug_info)."\n", FILE_APPEND);
	}
}
if(isset($_COOKIE["user_token"]))
{
	$token=authcode(daddslashes(rawurldecode($_COOKIE['user_token'])), 'DECODE', SYS_KEY);
	list($uid, $sid, $expiretime) = explode("\t", $token);
	$uid = intval($uid);
	$userrow=$DB->getRow("SELECT * FROM pre_user WHERE uid=:uid limit 1", [':uid'=>$uid]);
	$session=md5($userrow['uid'].$userrow['key'].$password_hash);
	if($userrow && $session==$sid && $expiretime>time()) {
		$islogin2=1;
	}
}
?>