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
<link rel="stylesheet" href="/assets/css/miuix.css" />
<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<title><?php echo $conf['title']?></title>
</head>
<body data-spy="scroll">
<!-- Topbar -->
<div class="mx-topbar">
	<div class="mx-topbar-logo">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/></svg>
		<?php echo $conf['sitename']?>
	</div>
	<button class="mx-topbar-toggle" onclick="this.nextElementSibling.classList.toggle('open')">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
	</button>
	<ul class="mx-topbar-nav">
		<li><a href="#home" class="active">首页</a></li>
		<li><a href="#service">优势</a></li>
		<li><a href="#team">团队</a></li>
		<?php if($conf['test_open']){?><li><a href="/user/test.php">在线测试</a></li><?php }?>
		<li><a href="/doc.html">开发文档</a></li>
		<li><a href="/user/reg.php">接入申请</a></li>
		<li><a href="/user/" class="mx-topbar-btn">商户登录</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section id="home" class="mx-hero" style="background:var(--mx-accent);padding:120px 0 80px;">
	<div class="mx-container" style="text-align:center;">
		<h1 style="font-size:clamp(28px,5vw,44px);font-weight:700;line-height:1.2;margin-bottom:16px;color:#fff;">欢迎来到 <?php echo $conf['sitename']?></h1>
		<p style="font-size:18px;color:rgba(255,255,255,0.85);margin-bottom:8px;">NAILTEAM 结算费率低至<?php echo $conf['settle_rate']?>%！</p>
		<p style="font-size:15px;color:rgba(255,255,255,0.7);margin-bottom:32px;">支持多种支付方式：支付宝、QQ钱包、微信、财付通支付，可根据开发文档快速接入！</p>
		<div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
			<a href="./user/reg.php" class="mx-btn" style="background:#fff;color:var(--mx-accent);">申请接入</a>
			<a href="./user/" class="mx-btn mx-btn-outline" style="border-color:#fff;color:#fff;">商户登录</a>
		</div>
	</div>
</section>

<!-- Services -->
<section id="service" class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">为什么选择我们？</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);max-width:640px;margin:0 auto 40px;"><?php echo $conf['sitename']?>免去个人站长无法签约支付接口以及企业申请签约支付接口麻烦的问题，免签约也能享受及时到账的乐趣。</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg></div>
				<div class="mx-feature-title">方便接入</div>
				<div class="mx-feature-desc">根据开发文档可快速接入你的网站，让你的网站支持在线支付功能。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>
				<div class="mx-feature-title">低手续费</div>
				<div class="mx-feature-desc">结算费率低至<?php echo $conf['settle_rate']*100?>%，每日满<?php echo $conf['settle_money']?>元自动结算。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg></div>
				<div class="mx-feature-title">智能提醒</div>
				<div class="mx-feature-desc">提供商户APP、QQ机器人、邮箱等多种提醒方式可选。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-danger-light);color:var(--mx-danger);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div class="mx-feature-title">安全放心</div>
				<div class="mx-feature-desc">支付接口全为自己申请，不存在二次对接，彻底避免对接方跑路。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
				<div class="mx-feature-title">自动结算</div>
				<div class="mx-feature-desc">采取T+1结算方式，交易金额满<?php echo $conf['settle_money']?>元系统自动结算。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div>
				<div class="mx-feature-title">插件拓展</div>
				<div class="mx-feature-desc">提供SDK测试包，方便快速开发和接入。</div>
			</div>
		</div>
	</div>
</section>

<!-- Milestones -->
<section id="milestone" class="mx-section" style="background:var(--mx-accent);padding:60px 0;">
	<div class="mx-container">
		<div class="mx-stats-grid" style="grid-template-columns:repeat(3,1fr);">
			<div style="text-align:center;">
				<div style="font-size:36px;font-weight:700;color:#fff;">1,292</div>
				<div style="font-size:14px;color:rgba(255,255,255,0.8);">接入商户</div>
			</div>
			<div style="text-align:center;">
				<div style="font-size:36px;font-weight:700;color:#fff;">9,039</div>
				<div style="font-size:14px;color:rgba(255,255,255,0.8);">接入网站</div>
			</div>
			<div style="text-align:center;">
				<div style="font-size:36px;font-weight:700;color:#fff;">129</div>
				<div style="font-size:14px;color:rgba(255,255,255,0.8);">合作伙伴</div>
			</div>
		</div>
	</div>
</section>

<!-- Team -->
<section id="team" class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:32px;">我们的团队</h2>
		<div class="mx-card" style="max-width:360px;margin:0 auto;padding:28px;text-align:center;">
			<div class="mx-avatar mx-avatar-lg" style="margin:0 auto 16px;background:var(--mx-accent-light);color:var(--mx-accent);">
				<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
			</div>
			<h3 style="font-size:16px;font-weight:600;margin-bottom:4px;">客服</h3>
			<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:12px;">业务售后综合客服</p>
			<div style="display:flex;gap:12px;justify-content:center;">
				<a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes" target="_blank" style="color:var(--mx-accent);">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
				</a>
			</div>
		</div>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer">
	<div class="mx-container" style="text-align:center;">
		<p style="font-size:14px;font-weight:600;margin-bottom:8px;"><?php echo $conf['sitename']?></p>
		<p style="font-size:13px;color:var(--mx-text-tertiary);">Copyright&nbsp;&nbsp;&copy;&nbsp;<?php echo date("Y")?>&nbsp;All Rights Reserved.</p>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-top:4px;"><?php echo $conf['footer']?></p>
	</div>
</footer>
</body>
</html>
