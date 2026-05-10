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
		<li><a href="#home" class="active">主页</a></li>
		<li><a href="#about">接入</a></li>
		<li><a href="#services">服务</a></li>
		<li><a href="#statistics">统计</a></li>
		<li><a href="./doc.html">开发文档</a></li>
		<li><a href="./agreement.html">服务条款</a></li>
		<?php if($conf['test_open']){?><li><a href="/user/test.php">在线测试</a></li><?php }?>
		<li><a href="./user/" class="mx-topbar-btn">商户登录</a></li>
	</ul>
</div>
<div class="mx-page">
<!-- Hero -->
<section id="home" class="mx-hero" style="background:var(--mx-accent);padding:120px 0 80px;">
	<div class="mx-container" style="display:flex;align-items:center;gap:48px;flex-wrap:wrap;">
		<div style="flex:1;min-width:300px;">
			<h1 style="font-size:clamp(26px,4vw,38px);font-weight:700;line-height:1.3;margin-bottom:16px;color:#fff;"><?php echo $conf['sitename']?></h1>
			<p style="font-size:16px;color:rgba(255,255,255,0.85);line-height:1.8;margin-bottom:24px;">极速响应、安全可靠、方便快捷是我们最大的特点，轻松实现手机付款、在线付款。<?php echo $conf['sitename']?>是您的不二之选。</p>
			<a href="./user/" class="mx-btn" style="background:#fff;color:var(--mx-accent);">商户中心</a>
		</div>
		<div style="flex:1;min-width:280px;text-align:center;">
			<svg width="200" height="180" viewBox="0 0 200 180" fill="none" style="max-width:100%;">
				<rect x="30" y="10" width="140" height="160" rx="16" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>
				<rect x="50" y="40" width="100" height="60" rx="8" fill="rgba(255,255,255,0.2)"/>
				<circle cx="100" cy="130" r="10" fill="rgba(255,255,255,0.3)"/>
			</svg>
		</div>
	</div>
</section>

<!-- About -->
<section id="about" class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:32px;align-items:center;">
			<div>
				<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">我们拥有比同行更优质的服务</h2>
				<p style="font-size:15px;color:var(--mx-text-secondary);margin-bottom:24px;"><?php echo $conf['sitename']?>为您提供多种解决方案。</p>
				<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:12px;margin-bottom:24px;">
					<div class="mx-card" style="padding:16px;">
						<p style="font-size:13px;color:var(--mx-text-secondary);">支持支付宝、微信、QQ钱包等主流支付渠道，PC网页支付、扫码支付、移动HTML5支付。</p>
					</div>
					<div class="mx-card" style="padding:16px;">
						<p style="font-size:13px;color:var(--mx-text-secondary);"><?php echo $conf['sitename']?>通过简单的页面配置，替代复杂繁琐的人工资金结算业务。</p>
					</div>
				</div>
				<a href="./doc.html" class="mx-btn mx-btn-primary">开发文档</a>
			</div>
			<div style="text-align:center;">
				<svg width="240" height="200" viewBox="0 0 240 200" fill="none" style="max-width:100%;">
					<rect x="20" y="20" width="200" height="160" rx="16" fill="var(--mx-bg-card)" stroke="var(--mx-border)" stroke-width="1"/>
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

<!-- CTA -->
<section style="background:var(--mx-accent);padding:40px 0;">
	<div class="mx-container" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
		<h4 style="font-size:16px;color:#fff;font-weight:500;">那么，你下一步准备好了吗？赶紧加入我们吧</h4>
		<a href="./user/reg.php" class="mx-btn" style="background:#fff;color:var(--mx-accent);">立即注册</a>
	</div>
</section>

<!-- Services -->
<section id="services" class="mx-section">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:32px;align-items:center;">
			<div style="text-align:center;">
				<svg width="240" height="200" viewBox="0 0 240 200" fill="none" style="max-width:100%;">
					<rect x="20" y="20" width="200" height="160" rx="16" fill="var(--mx-bg-secondary)" stroke="var(--mx-border)" stroke-width="1"/>
					<circle cx="120" cy="80" r="30" fill="var(--mx-accent-light)" stroke="var(--mx-accent)" stroke-width="2"/>
					<rect x="50" y="130" width="140" height="8" rx="4" fill="var(--mx-bg-tertiary)"/>
					<rect x="70" y="148" width="100" height="8" rx="4" fill="var(--mx-accent-light)"/>
				</svg>
			</div>
			<div>
				<div class="mx-features" style="grid-template-columns:1fr 1fr;gap:12px;">
					<div class="mx-card" style="padding:20px;">
						<div style="width:40px;height:40px;border-radius:var(--mx-radius-sm);background:var(--mx-accent-light);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-accent)" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
						</div>
						<h5 style="font-size:14px;font-weight:600;margin-bottom:6px;">支付能力</h5>
						<p style="font-size:13px;color:var(--mx-text-secondary);">适用于商家在移动端网页应用中集成快捷支付功能</p>
					</div>
					<div class="mx-card" style="padding:20px;">
						<div style="width:40px;height:40px;border-radius:var(--mx-radius-sm);background:var(--mx-success-light);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 002 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0022 16z"/></svg>
						</div>
						<h5 style="font-size:14px;font-weight:600;margin-bottom:6px;">金融科技</h5>
						<p style="font-size:13px;color:var(--mx-text-secondary);">融合行业解决方案，驱动产业模式升级</p>
					</div>
					<div class="mx-card" style="padding:20px;">
						<div style="width:40px;height:40px;border-radius:var(--mx-radius-sm);background:var(--mx-warning-light);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-warning)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
						</div>
						<h5 style="font-size:14px;font-weight:600;margin-bottom:6px;">接口支持</h5>
						<p style="font-size:13px;color:var(--mx-text-secondary);">支付、分享、账户、营销等九大优质接口</p>
					</div>
					<div class="mx-card" style="padding:20px;">
						<div style="width:40px;height:40px;border-radius:var(--mx-radius-sm);background:var(--mx-danger-light);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-danger)" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
						</div>
						<h5 style="font-size:14px;font-weight:600;margin-bottom:6px;">盈利模式</h5>
						<p style="font-size:13px;color:var(--mx-text-secondary);">为合作伙伴的插件及服务提供变现渠道</p>
					</div>
				</div>
				<div style="margin-top:20px;">
					<a href="./user/reg.php" class="mx-btn mx-btn-primary">加入我们</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Statistics -->
<section id="statistics" class="mx-section" style="background:var(--mx-accent);padding:60px 0;">
	<div class="mx-container">
		<div class="mx-stats-grid" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
			<div class="mx-stat-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);">
				<div class="mx-stat-icon" style="background:rgba(255,255,255,0.2);color:#fff;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
				<div><div style="font-size:20px;font-weight:700;color:#fff;">商户总数：2789</div></div>
			</div>
			<div class="mx-stat-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);">
				<div class="mx-stat-icon" style="background:rgba(255,255,255,0.2);color:#fff;"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
				<div><div style="font-size:20px;font-weight:700;color:#fff;">订单总数：548156</div></div>
			</div>
		</div>
	</div>
</section>

<!-- Outlook -->
<section id="outlook" class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:22px;font-weight:700;margin-bottom:12px;">展望未来</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);max-width:560px;margin:0 auto 40px;"><?php echo $conf['sitename']?>为您提供多种解决方案。</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr));">
			<div class="mx-card" style="padding:28px;text-align:center;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-accent-light);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-accent)" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
				</div>
				<p style="font-size:14px;color:var(--mx-text-secondary);line-height:1.7;font-style:italic;">"人生的磨难是很多的，所以我们不可对于每一件轻微的伤害都过于敏感。"</p>
				<p style="font-size:13px;color:var(--mx-text-tertiary);margin-top:12px;font-weight:600;">- <?php echo $conf['sitename']?> 创始人</p>
			</div>
			<div class="mx-card" style="padding:28px;text-align:center;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-success-light);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
				</div>
				<p style="font-size:14px;color:var(--mx-text-secondary);line-height:1.7;font-style:italic;">"人生必有风险，所以引人入胜亦在于此。"</p>
				<p style="font-size:13px;color:var(--mx-text-tertiary);margin-top:12px;font-weight:600;">- <?php echo $conf['sitename']?> 产品经理</p>
			</div>
			<div class="mx-card" style="padding:28px;text-align:center;">
				<div style="width:48px;height:48px;border-radius:50%;background:var(--mx-warning-light);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--mx-warning)" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
				</div>
				<p style="font-size:14px;color:var(--mx-text-secondary);line-height:1.7;font-style:italic;">"当你看到不可理解的现象，感到迷惑时，真理可能已经披着面纱悄悄地站在你的面前。"</p>
				<p style="font-size:13px;color:var(--mx-text-tertiary);margin-top:12px;font-weight:600;">- <?php echo $conf['sitename']?></p>
			</div>
		</div>
	</div>
</section>
</div><!-- /mx-page -->

<!-- Footer -->
<footer class="mx-footer" style="background:var(--mx-bg-card);">
	<div class="mx-container">
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr));padding:0 0 16px;text-align:left;">
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">关于我们</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">E-mail: <?php echo $conf['email']?></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;">客服QQ: <a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']?>&site=pay&menu=yes" target="_blank"><?php echo $conf['kfqq']?></a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">本站相关</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="./agreement.html">服务条款</a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="./doc.html">开发文档</a></p>
			</div>
			<div>
				<h4 style="font-size:14px;font-weight:600;margin-bottom:10px;color:var(--mx-text-primary);">合作伙伴</h4>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="<?php echo $conf['hzlink1'];?>"><?php echo $conf['hzhb1'];?></a></p>
				<p style="font-size:13px;color:var(--mx-text-secondary);margin-bottom:4px;"><a href="<?php echo $conf['hzlink2'];?>"><?php echo $conf['hzhb2'];?></a></p>
			</div>
		</div>
		<div class="mx-divider"></div>
		<div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
			<p style="font-size:13px;color:var(--mx-text-tertiary);"><?php echo date("Y")?> &copy; <?php echo $conf['sitename']?></p>
			<p style="font-size:13px;color:var(--mx-text-tertiary);"><?php echo $conf['footer']?></p>
		</div>
	</div>
</footer>
</body>
</html>
