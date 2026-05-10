<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
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
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
		<?php echo $conf['sitename']?>
	</div>
	<button class="mx-topbar-toggle" onclick="this.nextElementSibling.classList.toggle('open')">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
	</button>
	<ul class="mx-topbar-nav">
		<li><a href="/agreement.html">服务条款</a></li>
		<li><a href="/doc.html">开发文档</a></li>
		<?php if($conf['test_open']==1){?><li><a href="/user/test.php">支付测试</a></li><?php }?>
		<li><a href="/user/login.php">商户登录</a></li>
		<li><a href="/user/reg.php" class="mx-topbar-btn">商户注册</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section class="mx-hero" style="background:var(--mx-accent);padding:120px 0 80px;">
	<div class="mx-container" style="display:flex;align-items:center;gap:48px;flex-wrap:wrap;">
		<div style="flex:1;min-width:300px;">
			<h1 style="font-size:clamp(28px,5vw,44px);font-weight:700;line-height:1.2;margin-bottom:16px;color:#fff;"><?php echo $conf['sitename']?></h1>
			<p style="font-size:18px;color:rgba(255,255,255,0.85);line-height:1.6;margin-bottom:24px;">我们专注的每一面，都是为了给你更好的体验。行业内最安全，简单易用，专业的技术团队，最放心的免签约支付平台。</p>
			<div style="display:flex;gap:12px;flex-wrap:wrap;">
				<a href="/user/" class="mx-btn" style="background:#fff;color:var(--mx-accent);">商户中心</a>
				<a href="/doc.html" class="mx-btn mx-btn-outline" style="border-color:#fff;color:#fff;">开发文档</a>
			</div>
		</div>
		<div style="flex:1;min-width:280px;">
			<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:12px;">
				<div class="mx-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);padding:20px;">
					<div style="width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
					</div>
					<div style="font-size:14px;font-weight:600;color:#fff;">数据统计</div>
					<div style="font-size:12px;color:rgba(255,255,255,0.7);">后台数据详尽直观</div>
				</div>
				<div class="mx-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);padding:20px;">
					<div style="width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
					</div>
					<div style="font-size:14px;font-weight:600;color:#fff;">系统安全</div>
					<div style="font-size:12px;color:rgba(255,255,255,0.7);">安全稳定的系统保障</div>
				</div>
				<div class="mx-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);padding:20px;">
					<div style="width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-5"/></svg>
					</div>
					<div style="font-size:14px;font-weight:600;color:#fff;">快捷支付</div>
					<div style="font-size:12px;color:rgba(255,255,255,0.7);">节省开发及维护成本</div>
				</div>
				<div class="mx-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);padding:20px;">
					<div style="width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
					</div>
					<div style="font-size:14px;font-weight:600;color:#fff;">方便快捷</div>
					<div style="font-size:12px;color:rgba(255,255,255,0.7);">聚合多种交易渠道</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Why Choose Us -->
<section class="mx-section" style="background:var(--mx-bg-secondary);text-align:center;">
	<div class="mx-container">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">你凭什么选择我们？</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);max-width:640px;margin:0 auto 40px;">提供多种支付接入方式，方便，简单，快捷，快速集成，效率高，见效快，费率低。支持全球三大主流结算币种，多元化产品为你提供一站式支付服务。</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
			<div class="mx-card" style="padding:28px;text-align:left;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-accent-light);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-accent)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
				</div>
				<h3 style="font-size:16px;font-weight:600;margin-bottom:8px;color:var(--mx-accent);">云支付</h3>
				<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:12px;">支持支付宝、微信、QQ钱包等主流支付渠道，PC网页支付、扫码支付、移动HTML5支付。</p>
				<div style="display:flex;gap:6px;flex-wrap:wrap;">
					<span class="mx-badge mx-badge-info">支付宝</span>
					<span class="mx-badge mx-badge-info">微信</span>
					<span class="mx-badge mx-badge-info">QQ</span>
				</div>
			</div>
			<div class="mx-card" style="padding:28px;text-align:left;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-success-light);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 002 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0022 16z"/></svg>
				</div>
				<h3 style="font-size:16px;font-weight:600;margin-bottom:8px;color:var(--mx-success);">云钱包</h3>
				<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:12px;">通过<?php echo $conf['sitename']?>为用户提供统一虚拟账户，提升用户支付体验。</p>
				<div style="display:flex;gap:6px;flex-wrap:wrap;">
					<span class="mx-badge mx-badge-success">资金统计</span>
					<span class="mx-badge mx-badge-success">订单明细</span>
				</div>
			</div>
			<div class="mx-card" style="padding:28px;text-align:left;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-warning-light);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-warning)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
				</div>
				<h3 style="font-size:16px;font-weight:600;margin-bottom:8px;color:var(--mx-warning);">云结算</h3>
				<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:12px;">通过简单的页面配置，替代复杂繁琐的人工资金结算业务。</p>
				<div style="display:flex;gap:6px;flex-wrap:wrap;">
					<span class="mx-badge mx-badge-warning">支付宝</span>
					<span class="mx-badge mx-badge-warning">微信支付</span>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Features -->
<section class="mx-section">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:24px;align-items:center;">
			<div>
				<h2 style="font-size:22px;font-weight:700;margin-bottom:16px;">聚合钱包，融合支付</h2>
				<p style="font-size:15px;color:var(--mx-text-secondary);margin-bottom:24px;"><?php echo $conf['sitename']?>通过简单的页面配置，可以替代复杂繁琐的人工资金结算业务，提高业务实时性，降低错误。</p>
				<div style="display:flex;flex-direction:column;gap:16px;">
					<div class="mx-flex mx-items-center mx-gap-12">
						<div style="width:36px;height:36px;border-radius:50%;background:var(--mx-success-light);display:flex;align-items:center;justify-content:center;">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
						</div>
						<div style="font-size:15px;font-weight:600;color:var(--mx-text-primary);">长期稳定支付通道</div>
					</div>
					<div class="mx-flex mx-items-center mx-gap-12">
						<div style="width:36px;height:36px;border-radius:50%;background:var(--mx-accent-light);display:flex;align-items:center;justify-content:center;">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-accent)" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
						</div>
						<div style="font-size:15px;font-weight:600;color:var(--mx-text-primary);">方便快捷账号管理</div>
					</div>
					<div class="mx-flex mx-items-center mx-gap-12">
						<div style="width:36px;height:36px;border-radius:50%;background:var(--mx-warning-light);display:flex;align-items:center;justify-content:center;">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-warning)" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
						</div>
						<div style="font-size:15px;font-weight:600;color:var(--mx-text-primary);">高效实时监控订单</div>
					</div>
				</div>
			</div>
			<div style="text-align:center;">
				<svg width="240" height="200" viewBox="0 0 240 200" fill="none" style="max-width:100%;">
					<rect x="20" y="20" width="200" height="160" rx="16" fill="var(--mx-bg-secondary)" stroke="var(--mx-border)" stroke-width="1"/>
					<rect x="40" y="50" width="160" height="12" rx="6" fill="var(--mx-accent-light)"/>
					<rect x="40" y="72" width="120" height="12" rx="6" fill="var(--mx-bg-tertiary)"/>
					<rect x="40" y="94" width="140" height="12" rx="6" fill="var(--mx-bg-tertiary)"/>
					<rect x="40" y="116" width="100" height="12" rx="6" fill="var(--mx-accent-light)"/>
					<rect x="40" y="140" width="60" height="28" rx="14" fill="var(--mx-accent)"/>
				</svg>
			</div>
		</div>
	</div>
</section>

<!-- Service -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:24px;align-items:center;">
			<div style="text-align:center;order:2;">
				<svg width="240" height="200" viewBox="0 0 240 200" fill="none" style="max-width:100%;">
					<rect x="20" y="20" width="200" height="160" rx="16" fill="var(--mx-bg-card)" stroke="var(--mx-border)" stroke-width="1"/>
					<circle cx="120" cy="80" r="30" fill="var(--mx-accent-light)" stroke="var(--mx-accent)" stroke-width="2"/>
					<rect x="50" y="130" width="140" height="8" rx="4" fill="var(--mx-bg-tertiary)"/>
					<rect x="70" y="148" width="100" height="8" rx="4" fill="var(--mx-accent-light)"/>
				</svg>
			</div>
			<div>
				<h2 style="font-size:22px;font-weight:700;margin-bottom:16px;">高效技术服务</h2>
				<p style="font-size:15px;color:var(--mx-text-secondary);margin-bottom:24px;">我们提供7X24小时在线服务，对日交易高额用户提供贵宾服务！用最具影响力品牌协助，全力协助新兴品牌。</p>
				<a onclick="return confirm('请直奔主题,不要问在不在,节省彼此的时间,懂?')" href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=qq&menu=yes" class="mx-btn mx-btn-primary" target="_blank">联系客服</a>
			</div>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="mx-section" style="text-align:center;">
	<div class="mx-container">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">展望未来</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);max-width:560px;margin:0 auto 24px;">"我们趋行在人生这个亘古的旅途，在坎坷中奔跑，在挫折里涅槃，忧愁缠满全身，痛苦飘洒一地。"</p>
		<div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
			<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-lg">申请商户</a>
			<a href="/doc.html" class="mx-btn mx-btn-outline mx-btn-lg">开发文档</a>
		</div>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer">
	<div class="mx-container">
		<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
			<p style="font-size:13px;color:var(--mx-text-tertiary);"><?php echo $conf['sitename']?>&nbsp;&nbsp;&copy;&nbsp;<?php echo date("Y")?>&nbsp;All Rights Reserved.</p>
			<p style="font-size:13px;color:var(--mx-text-tertiary);"><?php echo $conf['footer']?></p>
		</div>
	</div>
</footer>
</body>
</html>
