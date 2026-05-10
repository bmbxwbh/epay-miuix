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
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"/></svg>
		<?php echo $conf['sitename']?>
	</div>
	<button class="mx-topbar-toggle" onclick="this.nextElementSibling.classList.toggle('open')">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
	</button>
	<ul class="mx-topbar-nav">
		<li><a href="/" class="active">首页</a></li>
		<?php if($conf['test_open']){?><li><a href="/user/test.php">DEMO体验</a></li><?php }?>
		<li><a href="/doc.html">开发文档</a></li>
		<li><a href="/user/" class="mx-topbar-btn">登录</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section class="mx-hero" style="background:var(--mx-accent-light);padding:120px 0 60px;">
	<div class="mx-container" style="display:flex;align-items:center;gap:48px;flex-wrap:wrap;">
		<div style="flex:1;min-width:300px;">
			<h1 style="font-size:clamp(26px,4vw,36px);font-weight:700;line-height:1.3;margin-bottom:16px;"><?php echo $conf['sitename']?>/Payment</h1>
			<p style="font-size:16px;color:var(--mx-text-secondary);line-height:1.8;margin-bottom:24px;">让支付接入前所未有的简单。无需后端开发，一个SDK即可接入一套完整的支付系统，高速集成主流支付接口。<br>结算费率低至0.05%，单笔交易费率低至3%。</p>
			<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-lg">立即开启</a>
		</div>
		<div style="flex:1;min-width:280px;text-align:center;">
			<svg width="200" height="180" viewBox="0 0 200 180" fill="none" style="max-width:100%;">
				<rect x="30" y="10" width="140" height="160" rx="16" fill="var(--mx-bg-card)" stroke="var(--mx-accent)" stroke-width="2"/>
				<rect x="50" y="40" width="100" height="60" rx="8" fill="var(--mx-accent-light)"/>
				<circle cx="100" cy="130" r="10" fill="var(--mx-accent)"/>
			</svg>
		</div>
	</div>
</section>

<!-- Features -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<div class="mx-features" style="grid-template-columns:repeat(3,1fr);">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
				<div class="mx-feature-title">快速高效</div>
				<div class="mx-feature-desc">10分钟超快速响应，1V1专业客服服务，7*24小时技术支持。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
				<div class="mx-feature-title">稳定持久</div>
				<div class="mx-feature-desc">多机房异地容灾系统，服务器可用性99.9%，专业运维团队值守。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
				<div class="mx-feature-title">安全可靠</div>
				<div class="mx-feature-desc">金融级安全防护标准，强有力抵御外部入侵，支持高并发交易。</div>
			</div>
		</div>
	</div>
</section>

<!-- Payment Assistant -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">最专业的支付帮手</h2>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-bottom:32px;letter-spacing:0.1em;">- Payment Assistant -</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));">
			<?php
			$assists = [
				['手机APP支付','APP内实现收款','var(--mx-accent)'],
				['手机网页支付','手机浏览器内收款','var(--mx-success)'],
				['公众号支付','微信浏览器内收款','var(--mx-warning)'],
				['PC网页支付','PC浏览器内收款','var(--mx-danger)'],
				['线下扫码支付','扫描二维码收款','var(--mx-accent)'],
			];
			foreach($assists as $a):?>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 10px;background:<?php echo $a[2]?>1A;color:<?php echo $a[2]?>;">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;"><?php echo $a[0]?></div>
				<div class="mx-feature-desc" style="font-size:12px;"><?php echo $a[1]?></div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</section>

<!-- Products -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">产品与服务</h2>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-bottom:32px;letter-spacing:0.1em;">- PRODUCT SERVICE -</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(220px,1fr));">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
				<div class="mx-feature-title">财务对账</div>
				<div class="mx-feature-desc">相近的订单统计，企业收支一目了然</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-success-light);color:var(--mx-success);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
				<div class="mx-feature-title">商户系统</div>
				<div class="mx-feature-desc">添加商户账号，为交易实现分账功能</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-warning-light);color:var(--mx-warning);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
				<div class="mx-feature-title">接口申请</div>
				<div class="mx-feature-desc">全支付场景覆盖，主流支付接口支持</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-danger-light);color:var(--mx-danger);"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 7h.01M7 12h.01M7 17h.01M12 7h5M12 12h5M12 17h5"/></svg></div>
				<div class="mx-feature-title">二维码支付</div>
				<div class="mx-feature-desc">专业收款工具，线下商户经营必备</div>
			</div>
		</div>
	</div>
</section>

<!-- Payment Channels -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:8px;">对接多家支付接口</h2>
		<p style="font-size:13px;color:var(--mx-text-tertiary);margin-bottom:8px;letter-spacing:0.1em;">- Multiple Payments -</p>
		<p style="font-size:14px;color:var(--mx-text-secondary);margin-bottom:32px;">对接行业内最优质的多家支付接口，全力保障业务流畅。</p>
		<div class="mx-partners">
			<div class="mx-partner-badge">支付宝</div>
			<div class="mx-partner-badge">微信支付</div>
			<div class="mx-partner-badge">QQ钱包</div>
			<div class="mx-partner-badge">银联支付</div>
			<div class="mx-partner-badge">京东支付</div>
			<div class="mx-partner-badge">百度钱包</div>
			<div class="mx-partner-badge">Apple Pay</div>
			<div class="mx-partner-badge">蚂蚁花呗</div>
		</div>
	</div>
</section>

<!-- Custom Solutions -->
<section class="mx-section">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:24px;align-items:center;">
			<div>
				<h2 style="font-size:22px;font-weight:700;margin-bottom:16px;">定制化支付解决方案</h2>
				<ul style="list-style:none;padding:0;">
					<li style="padding:8px 0;font-size:14px;color:var(--mx-text-secondary);display:flex;gap:8px;align-items:flex-start;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
						支持不同业务场景的交易方式。
					</li>
					<li style="padding:8px 0;font-size:14px;color:var(--mx-text-secondary);display:flex;gap:8px;align-items:flex-start;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
						免费在线一对一分析支付场景、梳理企业收款需求，提出接入建议、定制支付解决方案。
					</li>
				</ul>
			</div>
			<div>
				<h2 style="font-size:22px;font-weight:700;margin-bottom:16px;">专业的全流程服务</h2>
				<ul style="list-style:none;padding:0;">
					<li style="padding:8px 0;font-size:14px;color:var(--mx-text-secondary);display:flex;gap:8px;align-items:flex-start;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
						支持个性化定制和私有化部署。
					</li>
					<li style="padding:8px 0;font-size:14px;color:var(--mx-text-secondary);display:flex;gap:8px;align-items:flex-start;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
						全程跟进定制化业务需求，可部署企业本地服务器，数据安全可控。
					</li>
					<li style="padding:8px 0;font-size:14px;color:var(--mx-text-secondary);display:flex;gap:8px;align-items:flex-start;">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
						客户成功团队全面提供7*10小时服务。
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="mx-section" style="background:var(--mx-accent);text-align:center;padding:60px 0;">
	<div class="mx-container">
		<h2 style="font-size:22px;font-weight:700;color:#fff;margin-bottom:8px;">立即开启支付新时代！</h2>
		<p style="font-size:15px;color:rgba(255,255,255,0.8);margin-bottom:24px;"><?php echo $conf['sitename']?>，支付技术服务商，让支付简单、专业、快捷！</p>
		<a href="/user/" class="mx-btn" style="background:#fff;color:var(--mx-accent);">立即开启</a>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));padding:0 0 16px;text-align:left;">
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">联系我们</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">商务合作QQ: <?php echo $conf['kfqq']?></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">Email: <a href="mailto:<?php echo $conf['email']?>"><?php echo $conf['email']?></a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">产品项目</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">商户系统</p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">二维码支付</p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">H5支付</p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">开发者</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="/user/test.php">DEMO体验</a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="doc.html">API开发文档</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">关于我们</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes">接口合作</a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes">流量合作</a></p>
			</div>
		</div>
		<div class="mx-divider"></div>
		<p style="font-size:13px;color:var(--mx-text-tertiary);text-align:center;padding-top:12px;"><?php echo $conf['sitename']?>&nbsp;&nbsp;&copy;&nbsp;<?php echo date("Y")?>&nbsp;All Rights Reserved.&nbsp;<?php echo $conf['footer']?></p>
	</div>
</footer>
</body>
</html>
