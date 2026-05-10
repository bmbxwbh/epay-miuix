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
		<li><a href="/" class="active">首页</a></li>
		<li><a href="/doc.html">开发文档</a></li>
		<?php if($conf['test_open']){?><li><a href="/user/test.php">支付测试</a></li><?php }?>
		<li><a href="/user/">登录</a></li>
		<li><a href="/user/reg.php" class="mx-topbar-btn">注册</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section class="mx-hero" style="background:var(--mx-accent-light);padding:120px 0 60px;">
	<div class="mx-container" style="display:flex;align-items:center;gap:48px;flex-wrap:wrap;">
		<div style="flex:1;min-width:300px;">
			<h1 style="font-size:clamp(28px,4vw,40px);font-weight:700;line-height:1.3;margin-bottom:16px;"><?php echo $conf['sitename']?></h1>
			<p style="font-size:16px;color:var(--mx-text-secondary);line-height:1.8;margin-bottom:24px;">用数据赋能你我，让生意简单好做。<br>无论您是传统产业、创业者或者互联网企业，诚邀您共建支付服务新生态。</p>
			<div style="display:flex;gap:12px;flex-wrap:wrap;">
				<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-lg">成为商户</a>
				<a href="/doc.html" class="mx-btn mx-btn-outline mx-btn-lg">开发文档</a>
			</div>
		</div>
		<div style="flex:1;min-width:280px;text-align:center;">
			<svg width="180" height="180" viewBox="0 0 180 180" fill="none" style="max-width:100%;">
				<circle cx="90" cy="90" r="80" fill="var(--mx-accent-light)" stroke="var(--mx-accent)" stroke-width="2"/>
				<rect x="50" y="55" width="80" height="50" rx="8" fill="var(--mx-bg-card)" stroke="var(--mx-accent)" stroke-width="2"/>
				<path d="M70 80h40M70 90h25" stroke="var(--mx-accent)" stroke-width="2" stroke-linecap="round"/>
				<circle cx="90" cy="120" r="8" fill="var(--mx-success)"/>
			</svg>
		</div>
	</div>
</section>

<!-- Products -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">产品中心</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);margin-bottom:32px;">提供支付接入方案，可在各种场景中轻松收款</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));">
			<?php
			$products = [
				['快捷支付','var(--mx-accent-light)','var(--mx-accent)'],
				['扫码支付','var(--mx-success-light)','var(--mx-success)'],
				['公众号支付','var(--mx-warning-light)','var(--mx-warning)'],
				['APP支付','var(--mx-danger-light)','var(--mx-danger)'],
				['小程序支付','var(--mx-accent-light)','var(--mx-accent)'],
				['H5支付','var(--mx-success-light)','var(--mx-success)'],
				['网关支付','var(--mx-warning-light)','var(--mx-warning)'],
				['企业收付款','var(--mx-danger-light)','var(--mx-danger)'],
				['跨境支付','var(--mx-accent-light)','var(--mx-accent)'],
			];
			foreach($products as $p):?>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 10px;background:<?php echo $p[1]?>;color:<?php echo $p[2]?>;">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;"><?php echo $p[0]?></div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</section>

<!-- Advantages -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">我们的优势</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);margin-bottom:32px;">方便快捷的支付接入体验，让支付和收款更简单！</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div>
				<div><div class="mx-feature-title">极简使用</div><div class="mx-feature-desc">七行代码，极速完成，支付接入，简洁的操作界面易于使用。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/><path d="M12 6v6l4 2"/></svg></div>
				<div><div class="mx-feature-title">灵活便利</div><div class="mx-feature-desc">产品服务灵活组合，满足企业多元化业务需求。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div><div class="mx-feature-title">不介入资金流</div><div class="mx-feature-desc">只负责交易处理不参与资金清算，保障您的资金安全。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;background:var(--mx-danger-light);color:var(--mx-danger);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 002 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0022 16z"/></svg></div>
				<div><div class="mx-feature-title">大数据</div><div class="mx-feature-desc">运用交易数据分析功能，了解公司运营状况。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>
				<div><div class="mx-feature-title">增值服务</div><div class="mx-feature-desc">提供金融产品及技术服务，帮助企业整合互联网金融。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div>
				<div><div class="mx-feature-title">安全稳定</div><div class="mx-feature-desc">平台运行于阿里云计算中心，多备份容灾保障。</div></div>
			</div>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="mx-section" style="background:var(--mx-accent);text-align:center;padding:60px 0;">
	<div class="mx-container">
		<h2 style="font-size:22px;font-weight:700;color:#fff;margin-bottom:8px;"><?php echo $conf['sitename']?>，做您身边的支付服务商</h2>
		<p style="font-size:15px;color:rgba(255,255,255,0.8);margin-bottom:24px;">选择对的服务商能让您更快更好的迈进互联网金融时代</p>
		<div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
			<a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&Site=pay&Menu=yes" target="_blank" class="mx-btn" style="background:#fff;color:var(--mx-accent);">点击咨询</a>
			<a href="/user/reg.php" class="mx-btn mx-btn-outline" style="border-color:#fff;color:#fff;">立即注册</a>
		</div>
	</div>
</section>

<!-- Features -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">特色与服务</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);margin-bottom:32px;">高额佣金激励回报，打造支付合作共赢生态圈</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));">
			<?php
			$services = [
				['支付能力','让接入支付变的简单方便'],
				['资源共享','丰富的外部资源提高顾客忠诚度'],
				['准确营销','利用支付数据找到有价值的顾客'],
				['专业产品','满足商家多样的管理收银营销诉求'],
				['技术支持','快速响应，7x24小时解答技术问题'],
				['合作伙伴','高额激励回报，打造合作共赢生态'],
			];
			foreach($services as $s):?>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 10px;">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;"><?php echo $s[0]?></div>
				<div class="mx-feature-desc" style="font-size:12px;"><?php echo $s[1]?></div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</section>

<!-- Service Details -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:24px;">
			<div class="mx-feature-card">
				<div class="mx-feature-title" style="margin-bottom:12px;">专业的技术团队与行业资源</div>
				<div class="mx-feature-desc">专业的技术团队与丰富的行业资源保障稳定、便捷的产品和服务。通过SDK接入多种主流通道，用SaaS模式创建商户交易管理系统。</div>
			</div>
			<div class="mx-feature-card">
				<div class="mx-feature-title" style="margin-bottom:12px;">一站式的平台管理系统</div>
				<div class="mx-feature-desc">渠道分层管理系统。无论是平台自营或是代理，均能进行层级管理，全局把控交易和财务。</div>
			</div>
			<div class="mx-feature-card">
				<div class="mx-feature-title" style="margin-bottom:12px;">便捷的商户管理平台</div>
				<div class="mx-feature-desc">商户支付管理系统。满足企业集中式管理支付应用，进行快速的财务对账，便捷的交易与结算查询。</div>
			</div>
			<div class="mx-feature-card">
				<div class="mx-feature-title" style="margin-bottom:12px;">简便的全流程自助服务</div>
				<div class="mx-feature-desc">提供方便简易的入网申请、在线接口联调、测试上线等自助式操作功能，化繁为简。</div>
			</div>
		</div>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer">
	<div class="mx-container">
		<div style="display:flex;gap:24px;flex-wrap:wrap;justify-content:space-between;align-items:center;">
			<div>
				<img src="assets/img/logo.png" style="max-height:36px;margin-bottom:8px;" alt=""/>
				<p style="font-size:13px;color:var(--mx-text-secondary);">
					<b>快速导航：</b>
					<a href="/">首页</a> |
					<a href="/doc.html">开发文档</a> |
					<a href="/agreement.html">服务条款</a> |
					<a href="/user/">用户中心</a>
				</p>
				<p style="font-size:13px;color:var(--mx-text-secondary);">
					<b>举报邮箱：</b><?php echo $conf['email']?>
				</p>
			</div>
			<div style="text-align:right;">
				<p style="font-size:13px;color:var(--mx-text-secondary);"><b>联系方式：</b></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);">QQ：<a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&Site=pay&Menu=yes" target="_blank"><?php echo $conf['kfqq']?></a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);">邮箱：<a href="mailto:<?php echo $conf['email']?>"><?php echo $conf['email']?></a></p>
			</div>
		</div>
		<div class="mx-divider"></div>
		<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
			<p style="font-size:13px;color:var(--mx-text-tertiary);"><?php echo $conf['sitename']?>&nbsp;&nbsp;&copy;&nbsp;<?php echo date("Y")?>&nbsp;All Rights Reserved.</p>
			<p style="font-size:13px;color:var(--mx-text-tertiary);"><?php echo $conf['footer']?></p>
		</div>
	</div>
</footer>
</body>
</html>
