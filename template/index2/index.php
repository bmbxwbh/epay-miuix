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
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
		<img src="assets/img/logo.png" style="max-height:36px;" alt="<?php echo $conf['sitename']?>"/>
	</div>
	<button class="mx-topbar-toggle" onclick="this.nextElementSibling.classList.toggle('open')">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
	</button>
	<ul class="mx-topbar-nav">
		<li><a href="/" class="active">首页</a></li>
		<li><a href="/doc.html">开发文档</a></li>
		<?php if($conf['test_open']){?><li><a href="/user/test.php">支付测试</a></li><?php }?>
		<li><a href="/user/" class="mx-topbar-btn">登录</a></li>
		<li><a href="/user/reg.php" class="mx-topbar-btn mx-btn-outline" style="border:1.5px solid var(--mx-accent);color:var(--mx-accent);background:transparent;">注册</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- FAQ (hidden) -->
<div id="faq" style="display:none">
<div class="mx-container" style="padding-top:24px;">
<div class="mx-card" style="max-width:800px;margin:0 auto;">
<div class="mx-card-header">常见问题</div>
<div class="mx-card-body">
<?php
$faqs = [
	['Q','怎么入驻'.$conf['sitename'].'成为商户?','A','通过平台的账户注册功能，即可免费入驻，快速实现支付接入 <a href="/user/">点此进入</a>'],
	['Q','怎么快速接入？','A','点击开发文档有详细的接入手册，还有SDK一键接入'],
	['Q','平台可以卖些什么？','A','虚拟商品(例如软件注册码，论坛帐号等等，CDK,优惠券)，不可以卖虚假物品或涉嫌黄赌毒等商品'],
	['Q','商户结算方式有哪些？','A','支持支付宝、银行卡，后期还会增加微信结算'],
	['Q','每日结算时间？','A','商户账户金额满10.00元，当天晚上12点后，系统自动帮您提现，财务将于第二天12点前结算到您预留的账户'],
	['Q','如何查询订单？','A','打开平台的订单查询页面，输入订单号即可查询 <a href="/user/order.php">点此进入</a>'],
	['Q','不会接入？商业合作？','A','请联系平台客服 <a href="https://wpa.qq.com/msgrd?v=3&uin='.$conf['kfqq'].'&Site=pay&Menu=yes" target="_blank">点击查看联系方式</a>'],
];
foreach($faqs as $faq):?>
<div style="padding:14px 0;border-bottom:1px solid var(--mx-border);">
	<div style="font-size:14px;font-weight:600;color:var(--mx-text-primary);cursor:pointer;" onclick="this.nextElementSibling.style.display=this.nextElementSibling.style.display==='none'?'block':'none'">
		<span style="display:inline-block;width:24px;height:24px;border-radius:50%;background:var(--mx-accent);color:#fff;text-align:center;line-height:24px;font-size:12px;margin-right:8px;"><?php echo $faq[0]?></span>
		<?php echo $faq[1]?>
	</div>
	<div style="display:none;padding:8px 0 0 32px;font-size:13px;color:var(--mx-text-secondary);line-height:1.7;"><?php echo $faq[3]?></div>
</div>
<?php endforeach;?>
</div>
</div>
<div style="text-align:center;margin-top:20px;">
<button class="mx-btn mx-btn-ghost" onclick="document.getElementById('faq').style.display='none';document.getElementById('index').style.display='block';">返回首页</button>
</div>
</div>
</div>
<!-- Main Content -->
<div id="index">
<!-- Hero -->
<section class="mx-hero" style="background:var(--mx-accent-light);padding:120px 0 60px;">
	<div class="mx-container">
		<div style="max-width:640px;">
			<h1 style="font-size:clamp(28px,4vw,40px);font-weight:700;line-height:1.3;margin-bottom:16px;"><?php echo $conf['sitename']?></h1>
			<p style="font-size:16px;color:var(--mx-text-secondary);line-height:1.8;margin-bottom:24px;">致力于帮助企业快速和高质量地建立支付模块，聚合主流通道，为您提供全方位支付体验，告别繁琐的接入流程。</p>
			<div style="display:flex;gap:12px;flex-wrap:wrap;">
				<a href="/user/" class="mx-btn mx-btn-primary mx-btn-lg">立即体验</a>
				<a href="javascript:;" class="mx-btn mx-btn-ghost mx-btn-lg" onclick="document.getElementById('index').style.display='none';document.getElementById('faq').style.display='block';">帮助中心</a>
			</div>
		</div>
	</div>
</section>

<!-- Services -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">寄售服务项目</h2>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-bottom:32px;letter-spacing:0.1em;">CONSIGNMENT SERVICE ITEMS</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg></div>
				<div class="mx-feature-title" style="font-size:14px;">电商/优惠券</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/></svg></div>
				<div class="mx-feature-title" style="font-size:14px;">论坛/邀请码</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
				<div class="mx-feature-title" style="font-size:14px;">企业/个人软件</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-danger-light);color:var(--mx-danger);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg></div>
				<div class="mx-feature-title" style="font-size:14px;">视频CDK/游戏CDK</div>
			</div>
		</div>
	</div>
</section>

<!-- Payment Channels -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">支付渠道</h2>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-bottom:32px;letter-spacing:0.1em;">CHANNEL OF PAYMENT</p>
		<div class="mx-partners">
			<div class="mx-partner-badge"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-accent)" stroke-width="2"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>支付宝</div>
			<div class="mx-partner-badge"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>微信支付</div>
			<div class="mx-partner-badge"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-warning)" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/></svg>银联</div>
			<div class="mx-partner-badge"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-danger)" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>QQ钱包</div>
			<div class="mx-partner-badge"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-text-secondary)" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>京东支付</div>
			<div class="mx-partner-badge"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-text-secondary)" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/></svg>百度钱包</div>
		</div>
	</div>
</section>

<!-- Platform Features -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">平台功能</h2>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-bottom:32px;letter-spacing:0.1em;">PLATFORM FUNCTION</p>
		<div class="mx-card" style="max-width:600px;margin:0 auto 24px;text-align:left;">
			<div class="mx-card-header">手续费扣除模式</div>
			<div class="mx-card-body">
				<div class="mx-flex mx-items-center mx-gap-12" style="padding:10px 0;border-bottom:1px solid var(--mx-border);">
					<div style="width:32px;height:32px;border-radius:50%;background:var(--mx-accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;">A</div>
					<div><div style="font-size:14px;font-weight:600;color:var(--mx-text-primary);">模式1. 买家承担</div><div style="font-size:13px;color:var(--mx-text-secondary);">买家付款时连同手续费一并支付</div></div>
				</div>
				<div class="mx-flex mx-items-center mx-gap-12" style="padding:10px 0;">
					<div style="width:32px;height:32px;border-radius:50%;background:var(--mx-accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;">B</div>
					<div><div style="font-size:14px;font-weight:600;color:var(--mx-text-primary);">模式2. 商家承担</div><div style="font-size:13px;color:var(--mx-text-secondary);">手续费在成功付款的订单内扣除</div></div>
				</div>
			</div>
		</div>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
			<?php
			$features = [
				['极简使用','七行代码，极速完成，支付接入','var(--mx-accent-light)','var(--mx-accent)'],
				['灵活便利','产品服务灵活组合','var(--mx-success-light)','var(--mx-success)'],
				['大数据','运用交易数据分析功能','var(--mx-warning-light)','var(--mx-warning)'],
				['安全稳定','多备份容灾保障','var(--mx-danger-light)','var(--mx-danger)'],
				['不介入资金流','只负责交易处理','var(--mx-accent-light)','var(--mx-accent)'],
				['安全密码','为你的账户安全保驾护航','var(--mx-success-light)','var(--mx-success)'],
				['增值服务','帮助企业整合互联网金融','var(--mx-warning-light)','var(--mx-warning)'],
				['自助服务','7*24小时客户服务','var(--mx-danger-light)','var(--mx-danger)'],
			];
			foreach($features as $f):?>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:<?php echo $f[2]?>;color:<?php echo $f[3]?>;">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;"><?php echo $f[0]?></div>
				<div class="mx-feature-desc" style="font-size:12px;"><?php echo $f[1]?></div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</section>

<!-- Core Advantages -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:32px;">核心优势</h2>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div><div class="mx-feature-title">服务器安全</div><div class="mx-feature-desc">采用群集服务器，防御高，故障率低，无论用户身在何处，均能获得流畅安全可靠的体验。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
				<div><div class="mx-feature-title">资金保障</div><div class="mx-feature-desc">商户的商品全部加密处理，专业运维24小时处理，您的帐户安全将得到充分保障。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
				<div><div class="mx-feature-title">专属客服</div><div class="mx-feature-desc">专业客服团队，专属客服一对一贴心服务，7*24小时全天候在线。</div></div>
			</div>
			<div class="mx-feature-card" style="display:flex;gap:16px;align-items:flex-start;text-align:left;">
				<div class="mx-feature-icon" style="flex-shrink:0;background:var(--mx-danger-light);color:var(--mx-danger);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>
				<div><div class="mx-feature-title">费率超低</div><div class="mx-feature-desc">支付渠道直接对接官方，去掉中间商差价，提供更低廉的费率。</div></div>
			</div>
		</div>
	</div>
</section>
</div><!-- /index -->
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));padding:0 0 16px;text-align:left;">
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">快速通道</h4>
				<p style="margin-bottom:4px;font-size:13px;"><a href="/user/" style="color:var(--mx-text-secondary);">商户登录</a></p>
				<p style="margin-bottom:4px;font-size:13px;"><a href="/user/reg.php" style="color:var(--mx-text-secondary);">商户注册</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">更多内容</h4>
				<p style="margin-bottom:4px;font-size:13px;"><a href="/doc.html" style="color:var(--mx-text-secondary);">帮助中心</a></p>
				<p style="margin-bottom:4px;font-size:13px;"><a href="/doc.html" style="color:var(--mx-text-secondary);">开发文档</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">服务协议</h4>
				<p style="margin-bottom:4px;font-size:13px;"><a href="/agreement.html" style="color:var(--mx-text-secondary);">服务协议</a></p>
				<p style="margin-bottom:4px;font-size:13px;"><a href="/agreement.html" style="color:var(--mx-text-secondary);">法律声明</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">联系我们</h4>
				<p style="margin-bottom:4px;font-size:13px;color:var(--mx-text-secondary);">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
					QQ：<a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&Site=pay&Menu=yes" target="_blank"><?php echo $conf['kfqq']?></a>
				</p>
				<p style="margin-bottom:4px;font-size:13px;color:var(--mx-text-secondary);">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
					<a href="mailto:<?php echo $conf['email']?>"><?php echo $conf['email']?></a>
				</p>
			</div>
		</div>
		<div class="mx-divider"></div>
		<p style="font-size:13px;color:var(--mx-text-tertiary);padding-top:12px;text-align:center;"><?php echo $conf['sitename']?>&nbsp;&nbsp;&copy;<?php echo date("Y")?>&nbsp;All Rights Reserved.&nbsp;<?php echo $conf['footer']?></p>
	</div>
</footer>
</body>
</html>
