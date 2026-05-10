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
		<?php if($conf['test_open']){?><li><a href="/user/test.php">DEMO体验</a></li><?php }?>
		<li><a href="doc.html">API开发文档</a></li>
		<li><a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes">联系我们</a></li>
		<li><a href="/user/" class="mx-topbar-btn">登录</a></li>
		<li><a href="/user/reg.php" class="mx-topbar-btn mx-btn-outline" style="border:1.5px solid var(--mx-accent);color:var(--mx-accent);background:transparent;">注册</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section class="mx-hero" style="background:var(--mx-accent-light);padding:120px 0 60px;">
	<div class="mx-container" style="display:flex;align-items:center;gap:48px;flex-wrap:wrap;">
		<div style="flex:1;min-width:300px;">
			<h1 style="font-size:clamp(24px,3vw,34px);font-weight:700;line-height:1.3;margin-bottom:16px;">全新支付体验</h1>
			<p style="font-size:15px;color:var(--mx-text-secondary);line-height:1.8;margin-bottom:24px;">资金记录、订单记录、收益统计、渠道分析...<br>全响应式界面，简易操作，安全便利快捷，为您稳定服务。</p>
		</div>
		<div style="flex:1;min-width:280px;text-align:center;">
			<svg width="200" height="160" viewBox="0 0 200 160" fill="none" style="max-width:100%;">
				<rect x="20" y="10" width="160" height="140" rx="16" fill="var(--mx-bg-card)" stroke="var(--mx-accent)" stroke-width="2"/>
				<rect x="40" y="40" width="120" height="10" rx="5" fill="var(--mx-accent-light)"/>
				<rect x="40" y="60" width="80" height="10" rx="5" fill="var(--mx-bg-tertiary)"/>
				<rect x="40" y="80" width="100" height="10" rx="5" fill="var(--mx-bg-tertiary)"/>
				<rect x="40" y="100" width="60" height="10" rx="5" fill="var(--mx-accent-light)"/>
				<rect x="40" y="120" width="50" height="20" rx="10" fill="var(--mx-accent)"/>
			</svg>
		</div>
	</div>
</section>

<!-- Payment Methods -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<div class="mx-partners">
			<div class="mx-partner-badge">支付宝</div>
			<div class="mx-partner-badge">微信支付</div>
			<div class="mx-partner-badge">银联</div>
			<div class="mx-partner-badge">QQ钱包</div>
			<div class="mx-partner-badge">京东支付</div>
			<div class="mx-partner-badge">百度钱包</div>
			<div class="mx-partner-badge">财付通</div>
			<div class="mx-partner-badge" style="color:var(--mx-text-tertiary);">正在接入...</div>
		</div>
	</div>
</section>

<!-- About -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;"><?php echo $conf['sitename']?>简介</h2>
		<div class="mx-card" style="max-width:700px;margin:0 auto;text-align:left;">
			<div class="mx-card-body">
				<p style="font-size:14px;color:var(--mx-text-secondary);line-height:1.8;margin-bottom:12px;"><?php echo $conf['orgname']?>成立于2018年，<?php echo $conf['sitename']?>（<?php echo $_SERVER['HTTP_HOST']?>）。</p>
				<p style="font-size:14px;color:var(--mx-text-secondary);line-height:1.8;margin-bottom:12px;"><?php echo $conf['sitename']?>平台主要服务于互联网和移动互联网领域，为网页游戏、手机游戏、阅读、音乐、交友、教育等移动应用提供综合计费营销服务，创新、诚信、灵活多元。</p>
				<p style="font-size:14px;color:var(--mx-text-secondary);line-height:1.8;">NAILTEAM 打破传统聚合支付的局限，引领新一代支付体验的个性化、自动化与工具化。</p>
			</div>
		</div>
	</div>
</section>

<!-- Process -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">成为<?php echo $conf['sitename']?>商户仅需六步</h2>
		<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:32px;"><?php echo $conf['sitename']?>让你轻松做生意</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(150px,1fr));">
			<?php
			$steps = [
				['注册商户','在线自助注册'],
				['绑定银行','轻松设置商户信息'],
				['接口对接','全平台SDK支持'],
				['自助下单','会员支付一键直达'],
				['全天客服','7*24小时专业服务'],
				['自动结算','信誉无忧充分保障'],
			];
			foreach($steps as $i=>$s):?>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div style="width:36px;height:36px;border-radius:50%;background:var(--mx-accent);color:#fff;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:14px;font-weight:600;"><?php echo $i+1?></div>
				<div class="mx-feature-title" style="font-size:14px;"><?php echo $s[0]?></div>
				<div class="mx-feature-desc" style="font-size:12px;"><?php echo $s[1]?></div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</section>

<!-- Advantages -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:32px;">品牌优势</h2>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr));">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div class="mx-feature-title">服务器安全</div>
				<div class="mx-feature-desc">采用群集服务器，防御高，故障率低，无论用户身在何方，均能获得流畅安全可靠的体验。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
				<div class="mx-feature-title">资金保障</div>
				<div class="mx-feature-desc">结算及时，资金秒到，资金平均停留的时间不超过12小时，您的资金安全将得到充分的保障。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg></div>
				<div class="mx-feature-title">持续更新</div>
				<div class="mx-feature-desc">系统持续更新，功能持续完善，让商户以及客户的体验不断接近完美。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-danger-light);color:var(--mx-danger);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div>
				<div class="mx-feature-title">界面简约</div>
				<div class="mx-feature-desc">简约的UI交互体验可以给您一个体验度极高的商户后台。</div>
			</div>
		</div>
	</div>
</section>

<!-- Contact -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:32px;">联系我们</h2>
		<div class="mx-stats-grid" style="grid-template-columns:repeat(3,1fr);">
			<div class="mx-card" style="padding:24px;text-align:center;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-accent-light);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-accent)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
				</div>
				<div style="font-size:14px;font-weight:600;margin-bottom:4px;color:var(--mx-text-primary);">公司地址</div>
				<div style="font-size:13px;color:var(--mx-text-secondary);">xxxxxx</div>
			</div>
			<div class="mx-card" style="padding:24px;text-align:center;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-success-light);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
				</div>
				<div style="font-size:14px;font-weight:600;margin-bottom:4px;color:var(--mx-text-primary);">联系方式</div>
				<div style="font-size:13px;color:var(--mx-text-secondary);">商务QQ：<a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes" target="_blank"><?php echo $conf['kfqq']?></a></div>
			</div>
			<div class="mx-card" style="padding:24px;text-align:center;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-warning-light);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-warning)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
				</div>
				<div style="font-size:14px;font-weight:600;margin-bottom:4px;color:var(--mx-text-primary);">电子邮箱</div>
				<div style="font-size:13px;color:var(--mx-text-secondary);"><?php echo $conf['email']?></div>
			</div>
		</div>
		<div style="margin-top:32px;">
			<a href="/user/" class="mx-btn mx-btn-primary mx-btn-lg">商户登录</a>
		</div>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));padding:0 0 16px;text-align:left;">
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">用户协议</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="#">禁售商品</a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="#">隐私协议</a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="agreement.html">注册协议</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">关于我们</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="/user/test.php">DEMO体验</a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="doc.html">API开发文档</a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes" target="_blank">联系我们</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">联系方式</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">全年无休 7x24小时</p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><?php echo $conf['email']?></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes" target="_blank"><?php echo $conf['kfqq']?></a></p>
			</div>
		</div>
		<div class="mx-divider"></div>
		<p style="font-size:13px;color:var(--mx-text-tertiary);text-align:center;padding-top:12px;">Copyright &copy; <?php echo date("Y")?> <?php echo $conf['sitename']?> All rights reserved. 版权所有</p>
		<p style="font-size:13px;color:var(--mx-text-tertiary);text-align:center;margin-top:4px;"><?php echo $conf['footer']?></p>
	</div>
</footer>
<!-- Scroll to top -->
<div style="position:fixed;bottom:24px;right:24px;z-index:999;">
	<button onclick="window.scrollTo({top:0,behavior:'smooth'})" style="width:44px;height:44px;border-radius:50%;background:var(--mx-accent);color:#fff;border:none;cursor:pointer;box-shadow:var(--mx-shadow-md);display:flex;align-items:center;justify-content:center;">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="18 15 12 9 6 15"/></svg>
	</button>
</div>
</body>
</html>
