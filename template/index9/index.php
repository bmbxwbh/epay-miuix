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
		<li><a href="#" class="active">首页</a></li>
		<?php if($conf['test_open']){?><li><a href="/user/test.php">支付演示</a></li><?php }?>
		<li><a href="/doc.html">开放文档</a></li>
		<li><a onclick="return confirm('有事直奔主题，谢谢合作！')" href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes" target="_blank">联系我们</a></li>
		<li><a href="/user/" class="mx-topbar-btn">开始使用</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section class="mx-hero" style="background:var(--mx-accent);padding:120px 0 80px;">
	<div class="mx-container" style="display:flex;align-items:center;gap:48px;flex-wrap:wrap;">
		<div style="flex:1;min-width:300px;">
			<p style="font-size:14px;color:rgba(255,255,255,0.6);margin-bottom:8px;font-style:italic;">Make Something Amazing</p>
			<h1 style="font-size:clamp(22px,3vw,30px);font-weight:700;line-height:1.4;margin-bottom:16px;color:#fff;">每个梦想，都值得灌溉</h1>
			<p style="font-size:14px;color:rgba(255,255,255,0.8);line-height:1.8;margin-bottom:24px;"><?php echo $conf['sitename']?>旨在解决需要使用交易数据流的企业发卡、个人发卡、主机IDC等网站支付需求，提供的一个正规、安全、稳定、可靠、丰富的支付接口API，帮助开发者等个人主体快速使想法转变为产品原型。</p>
			<p style="font-size:14px;color:rgba(255,255,255,0.7);margin-bottom:24px;">帮助开发者快速将支付（支付宝，钱包，微信）集成到自己相应产品，效率高，见效快，费率低</p>
		</div>
		<div style="flex:1;min-width:280px;text-align:center;">
			<svg width="200" height="180" viewBox="0 0 200 180" fill="none" style="max-width:100%;opacity:0.8;">
				<rect x="30" y="10" width="140" height="160" rx="16" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
				<rect x="50" y="40" width="100" height="60" rx="8" fill="rgba(255,255,255,0.2)"/>
				<circle cx="100" cy="130" r="10" fill="rgba(255,255,255,0.3)"/>
			</svg>
		</div>
	</div>
</section>

<!-- Features -->
<section class="mx-section">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div class="mx-feature-title">安全保证</div>
				<div class="mx-feature-desc">多重账号保护措施安全可靠；业内费率低，维护商户利益，7*24小时全天候服务。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
				<div class="mx-feature-title">资金安全</div>
				<div class="mx-feature-desc">只负责交易处理不参与资金清算，保障您的资金安全。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
				<div class="mx-feature-title">高效服务</div>
				<div class="mx-feature-desc">产品服务灵活组合，满足企业多元化业务需求。</div>
			</div>
		</div>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));margin-top:20px;">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
				<div class="mx-feature-title">极简使用</div>
				<div class="mx-feature-desc">七行代码，极速完成，支付SDK接入，简洁的操作界面易于使用。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
				<div class="mx-feature-title">简单易用</div>
				<div class="mx-feature-desc">对于线下收款商户，免开发直接使用。开发者可自行对接使用。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-accent-light);color:var(--mx-accent);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
				<div class="mx-feature-title">完整 API + 开源代码</div>
				<div class="mx-feature-desc">提供完整的API和丰富的开源开发包、SDK、DEMO供接入参考。</div>
			</div>
		</div>
	</div>
</section>

<!-- Pricing -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">产品价格</h2>
		<div class="mx-badge mx-badge-info" style="margin-bottom:32px;font-size:13px;padding:6px 16px;">使用费用 = 订单费率 + 手续费</div>
		<div class="mx-stats-grid" style="grid-template-columns:repeat(3,1fr);">
			<div class="mx-card" style="padding:28px;text-align:center;">
				<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:12px;">一次性注册费用</p>
				<div style="font-size:32px;font-weight:700;color:var(--mx-text-primary);margin-bottom:8px;"><?php echo $conf['reg_pay_price']?>元</div>
				<p style="font-size:13px;color:var(--mx-text-tertiary);">由<?php echo $conf['sitename']?>收取注册费用</p>
			</div>
			<div class="mx-card" style="padding:28px;text-align:center;">
				<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:12px;">三网支付订单费率</p>
				<div style="font-size:32px;font-weight:700;color:var(--mx-accent);margin-bottom:8px;">3%</div>
				<p style="font-size:13px;color:var(--mx-text-tertiary);">由<?php echo $conf['sitename']?>官方收取</p>
			</div>
			<div class="mx-card" style="padding:28px;text-align:center;">
				<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:12px;">站长创业资助</p>
				<div style="font-size:32px;font-weight:700;color:var(--mx-success);margin-bottom:8px;">1-2%</div>
				<p style="font-size:13px;color:var(--mx-text-tertiary);">初创项目有减免机制最低0.8%</p>
			</div>
		</div>
	</div>
</section>

<!-- Steps -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">开通流程</h2>
		<div class="mx-badge mx-badge-info" style="margin-bottom:32px;font-size:13px;padding:6px 16px;">自助开户，开通流程大概需要 3 分钟</div>
		<div style="display:flex;align-items:center;justify-content:center;gap:12px;flex-wrap:wrap;">
			<div class="mx-card" style="padding:16px 24px;text-align:center;">
				<div style="font-size:13px;color:var(--mx-accent);font-weight:600;">1.填写个人资料</div>
			</div>
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-text-tertiary)" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
			<div class="mx-card" style="padding:16px 24px;text-align:center;">
				<div style="font-size:13px;color:var(--mx-accent);font-weight:600;">2.等待邮箱认证</div>
			</div>
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-text-tertiary)" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
			<div class="mx-card" style="padding:16px 24px;text-align:center;">
				<div style="font-size:13px;color:var(--mx-accent);font-weight:600;">3.付费开通商户</div>
			</div>
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-text-tertiary)" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
			<div class="mx-card" style="padding:16px 24px;text-align:center;">
				<div style="font-size:13px;color:var(--mx-accent);font-weight:600;">4.开始对接使用</div>
			</div>
		</div>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer" style="background:var(--mx-accent);color:rgba(255,255,255,0.7);">
	<div class="mx-container" style="text-align:center;">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="2" style="margin-bottom:12px;"><path d="M12 2L2 7l10 5 10-5-10-5z"/></svg>
		<p style="font-size:13px;"><?php echo $conf['sitename']?>&nbsp;&nbsp;&copy;&nbsp;<?php echo date("Y")?>&nbsp;All Rights Reserved.</p>
		<p style="font-size:13px;margin-top:4px;"><?php echo $conf['footer']?></p>
	</div>
</footer>
</body>
</html>
