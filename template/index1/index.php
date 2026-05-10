<?php
if(!defined('IN_CRONLITE'))exit();
require INDEX_ROOT.'head.php';
?>

<!-- Hero -->
<section style="padding:100px 0 60px;text-align:center;background:var(--mx-accent-light);">
	<div class="mx-container">
		<h1 style="font-size:clamp(28px,5vw,40px);font-weight:700;line-height:1.3;margin-bottom:16px;"><?php echo $conf['sitename']?></h1>
		<p style="font-size:16px;color:var(--mx-text-secondary);max-width:480px;margin:0 auto 32px;line-height:1.7;">一站式聚合支付解决方案<br>快速接入支付宝、微信、银联等主流支付渠道</p>
		<div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
			<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-lg" target="_blank">注册使用</a>
			<a href="/doc.html" class="mx-btn mx-btn-outline mx-btn-lg">开发文档</a>
		</div>
	</div>
</section>

<!-- Features -->
<section class="mx-section">
	<div class="mx-container">
		<div class="mx-features mx-stagger" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr));">
			<div class="mx-feature-card">
				<div class="mx-feature-icon">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
				</div>
				<div class="mx-feature-title">多渠道支付</div>
				<div class="mx-feature-desc">支持支付宝、微信、银联、QQ钱包等主流支付方式</div>
			</div>
			<div class="mx-feature-card">
				<div class="mx-feature-icon" style="background:var(--mx-success-light);color:var(--mx-success);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="20 6 9 17 4 12"/></svg>
				</div>
				<div class="mx-feature-title">快速接入</div>
				<div class="mx-feature-desc">简洁的 API 接口，几分钟完成对接，快速上线收款</div>
			</div>
			<div class="mx-feature-card">
				<div class="mx-feature-icon" style="background:var(--mx-warning-light);color:var(--mx-warning);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
				</div>
				<div class="mx-feature-title">安全可靠</div>
				<div class="mx-feature-desc">RSA 签名验证，风控检测与黑名单管理</div>
			</div>
			<div class="mx-feature-card">
				<div class="mx-feature-icon" style="background:var(--mx-danger-light);color:var(--mx-danger);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
				</div>
				<div class="mx-feature-title">实时结算</div>
				<div class="mx-feature-desc">自动结算，资金即时到账，详细账单对账</div>
			</div>
		</div>
	</div>
</section>

<!-- CTA -->
<section style="background:var(--mx-accent);text-align:center;padding:48px 0;">
	<div class="mx-container">
		<h2 style="font-size:22px;font-weight:700;color:#fff;margin-bottom:8px;">开始使用 <?php echo $conf['sitename']?></h2>
		<p style="font-size:15px;color:rgba(255,255,255,0.8);margin-bottom:24px;">注册即可体验高效便捷的支付服务</p>
		<a href="/user/reg.php" class="mx-btn" style="background:#fff;color:var(--mx-accent);font-weight:600;" target="_blank">免费注册</a>
	</div>
</section>

<?php require INDEX_ROOT.'foot.php';?>
