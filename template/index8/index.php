<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<meta name="keywords" content="<?php echo $conf['keywords']?>">
<meta name="description" content="<?php echo $conf['description']?>">
<link rel="stylesheet" href="<?php echo STATIC_ROOT?>../assets/css/miuix.css" />
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<title><?php echo $conf['title']?></title>
</head>
<body>
<!-- Topbar -->
<div class="mx-topbar">
	<div class="mx-topbar-logo">
		<img src="assets/img/logo.png" style="max-height:36px;" alt="<?php echo $conf['sitename']?>"/>
	</div>
	<button class="mx-topbar-toggle" onclick="this.nextElementSibling.classList.toggle('open')">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
	</button>
	<ul class="mx-topbar-nav">
		<li><a href="/" class="active">网站首页</a></li>
		<li><a href="/user/test.php" target="_blank">demo测试</a></li>
		<li><a href="/doc.html" target="_blank">开发文档</a></li>
		<li><a href="/user/" class="mx-topbar-btn">商户登录</a></li>
		<li><a href="/user/reg.php" class="mx-topbar-btn mx-btn-outline" style="border:1.5px solid var(--mx-accent);color:var(--mx-accent);background:transparent;">注册商户</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section class="mx-hero" style="background:var(--mx-accent-light);padding:120px 0 60px;">
	<div class="mx-container" style="text-align:center;">
		<h1 style="font-size:clamp(26px,4vw,36px);font-weight:700;line-height:1.3;margin-bottom:16px;"><?php echo $conf['sitename']?> - 为创业者而生</h1>
		<p style="font-size:16px;color:var(--mx-text-secondary);margin-bottom:24px;">专注于提供安全、高效、严谨、便捷的订单数据服务！</p>
		<a href="/user/login.php" class="mx-btn mx-btn-primary mx-btn-lg">立即登录</a>
	</div>
</section>

<!-- Features -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:32px;">全天候无人值守 7X24小时高效运转</h2>
		<div class="mx-features" style="grid-template-columns:repeat(3,1fr);">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
				<div class="mx-feature-title">极速响应</div>
				<div class="mx-feature-desc">付款后立即回调，无等待，流程超顺畅</div>
				<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-sm" style="margin-top:12px;">加入我们</a>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
				<div class="mx-feature-title">资金直达</div>
				<div class="mx-feature-desc">系统收到交易消息后自动将余额提现</div>
				<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-sm" style="margin-top:12px;">加入我们</a>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div class="mx-feature-title">账户安全</div>
				<div class="mx-feature-desc">绑定后无法更改，防止他人修改结算账户</div>
				<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-sm" style="margin-top:12px;">加入我们</a>
			</div>
		</div>
	</div>
</section>

<!-- Partners -->
<section class="mx-section" style="background:var(--mx-bg-secondary);text-align:center;">
	<div class="mx-container">
		<h3 style="font-size:16px;font-weight:600;margin-bottom:24px;color:var(--mx-text-secondary);">平台合作伙伴</h3>
		<div class="mx-partners">
			<div class="mx-partner-badge">阿里云</div>
			<div class="mx-partner-badge">QQ钱包</div>
			<div class="mx-partner-badge">微信支付</div>
			<div class="mx-partner-badge">财付通</div>
		</div>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer">
	<div class="mx-container" style="text-align:center;">
		<p style="font-size:13px;color:var(--mx-text-tertiary);"><?php echo $conf['sitename']?>&nbsp;&nbsp;&copy;&nbsp;<?php echo date("Y")?>&nbsp;All Rights Reserved.</p>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-top:4px;"><?php echo $conf['footer']?></p>
	</div>
</footer>
</body>
</html>
