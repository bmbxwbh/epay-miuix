<?php
if(!defined('IN_CRONLITE'))exit();
require INDEX_ROOT.'head.php';
?>
<!-- Hero Section -->
<section class="mx-hero" style="background:var(--mx-accent-light);padding:120px 0 80px;">
	<div class="mx-container" style="display:flex;align-items:center;gap:48px;flex-wrap:wrap;">
		<div style="flex:1;min-width:300px;">
			<h1 style="font-size:clamp(28px,4vw,42px);font-weight:700;line-height:1.3;margin-bottom:16px;color:var(--mx-text-primary);">专业的收银系统</h1>
			<p style="font-size:16px;color:var(--mx-text-secondary);line-height:1.8;margin-bottom:24px;">全面集成主流支付渠道，为企业提供解决<b>收款</b>、<b>付款</b>、<b>结算</b>、<b>营销</b>等问题的技术方案。<br>提供企业统一管理电子钱包的技术方案。</p>
			<div style="display:flex;gap:12px;flex-wrap:wrap;">
				<a href="/user/reg.php" class="mx-btn mx-btn-primary mx-btn-lg" target="_blank">注册使用</a>
				<a href="/doc.html" class="mx-btn mx-btn-outline mx-btn-lg">查看文档</a>
			</div>
		</div>
		<div style="flex:1;min-width:280px;text-align:center;">
			<svg width="200" height="200" viewBox="0 0 200 200" fill="none" style="max-width:100%;">
				<rect x="40" y="20" width="120" height="160" rx="16" fill="var(--mx-accent-light)" stroke="var(--mx-accent)" stroke-width="2"/>
				<rect x="55" y="50" width="90" height="60" rx="8" fill="var(--mx-bg-card)" stroke="var(--mx-border)" stroke-width="1"/>
				<circle cx="100" cy="140" r="12" fill="var(--mx-accent)"/>
				<line x1="55" y1="70" x2="145" y2="70" stroke="var(--mx-border)" stroke-width="1"/>
				<line x1="55" y1="90" x2="120" y2="90" stroke="var(--mx-border)" stroke-width="1"/>
			</svg>
		</div>
	</div>
</section>

<!-- Cloud Payment -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:24px;font-weight:700;margin-bottom:12px;color:var(--mx-text-primary);">云支付</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);margin-bottom:32px;">全支付场景及渠道覆盖</p>
		<p style="font-size:14px;color:var(--mx-text-secondary);max-width:640px;margin:0 auto 40px;">支持支付宝、微信、银联、QQ钱包、快钱等主流支付渠道，让您拥有PC网页支付、扫码支付、手机APP支付、移动HTML5支付、微信公众号支付。</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));">
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;">PC网页支付</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-success-light);color:var(--mx-success);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M7 7h.01M7 12h.01M7 17h.01M12 7h5M12 12h5M12 17h5"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;">扫码支付</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-warning-light);color:var(--mx-warning);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;">APP支付</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;padding:20px;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-danger-light);color:var(--mx-danger);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M8 12h8M12 8v8"/></svg>
				</div>
				<div class="mx-feature-title" style="font-size:14px;">H5支付</div>
			</div>
		</div>
	</div>
</section>

<!-- Cloud Wallet -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:24px;font-weight:700;margin-bottom:12px;color:var(--mx-text-primary);">云钱包</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);max-width:560px;margin:0 auto 40px;">企业通过<?php echo $conf['sitename']?>为用户提供统一虚拟账户，提升用户支付体验，为拓展增值服务提供基础。</p>
		<div class="mx-features" style="grid-template-columns:repeat(3,1fr);">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
				</div>
				<div class="mx-feature-title">用户管理</div>
				<div class="mx-feature-desc">统一账户体系</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-success-light);color:var(--mx-success);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
				</div>
				<div class="mx-feature-title">资金统计</div>
				<div class="mx-feature-desc">实时数据追踪</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 12px;background:var(--mx-warning-light);color:var(--mx-warning);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
				</div>
				<div class="mx-feature-title">安全保障</div>
				<div class="mx-feature-desc">多重安全防护</div>
			</div>
		</div>
	</div>
</section>

<!-- Cloud Settlement -->
<section class="mx-section">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:24px;font-weight:700;margin-bottom:12px;color:var(--mx-text-primary);">云结算</h2>
		<p style="font-size:15px;color:var(--mx-text-secondary);max-width:560px;margin:0 auto 40px;">通过简单的页面配置，可以替代复杂繁琐的人工资金结算业务，提高业务实时性，降低错误。</p>
		<div class="mx-card" style="max-width:480px;margin:0 auto;">
			<div class="mx-card-body" style="text-align:left;">
				<div class="mx-flex mx-items-center mx-gap-12" style="padding:12px 0;border-bottom:1px solid var(--mx-border);">
					<div style="width:40px;height:40px;border-radius:var(--mx-radius-sm);background:var(--mx-accent-light);display:flex;align-items:center;justify-content:center;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-accent)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
					</div>
					<div>
						<div style="font-size:14px;font-weight:600;color:var(--mx-text-primary);">自动化结算</div>
						<div style="font-size:13px;color:var(--mx-text-secondary);">无需人工干预，系统自动完成</div>
					</div>
				</div>
				<div class="mx-flex mx-items-center mx-gap-12" style="padding:12px 0;border-bottom:1px solid var(--mx-border);">
					<div style="width:40px;height:40px;border-radius:var(--mx-radius-sm);background:var(--mx-success-light);display:flex;align-items:center;justify-content:center;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-success)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
					</div>
					<div>
						<div style="font-size:14px;font-weight:600;color:var(--mx-text-primary);">实时到账</div>
						<div style="font-size:13px;color:var(--mx-text-secondary);">交易完成后即时结算</div>
					</div>
				</div>
				<div class="mx-flex mx-items-center mx-gap-12" style="padding:12px 0;">
					<div style="width:40px;height:40px;border-radius:var(--mx-radius-sm);background:var(--mx-warning-light);display:flex;align-items:center;justify-content:center;">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--mx-warning)" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
					</div>
					<div>
						<div style="font-size:14px;font-weight:600;color:var(--mx-text-primary);">账单明细</div>
						<div style="font-size:13px;color:var(--mx-text-secondary);">详细的交易记录和对账单</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Advantages -->
<section class="mx-section" style="background:var(--mx-bg-secondary);">
	<div class="mx-container" style="text-align:center;">
		<h2 style="font-size:24px;font-weight:700;margin-bottom:32px;color:var(--mx-text-primary);">我们的优势</h2>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr));">
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
				</div>
				<div class="mx-feature-title">降低研发成本</div>
				<div class="mx-feature-desc">简单快速的接入方式，缩短开发周期，实现快速上线。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-success-light);color:var(--mx-success);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
				</div>
				<div class="mx-feature-title">轻松结算对账</div>
				<div class="mx-feature-desc">降低财务人员在结算方面投入的时间和精力。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-warning-light);color:var(--mx-warning);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
				</div>
				<div class="mx-feature-title">全面开放API</div>
				<div class="mx-feature-desc">让企业更加自主的使用<?php echo $conf['sitename']?>相关服务。</div>
			</div>
			<div class="mx-feature-card" style="text-align:center;">
				<div class="mx-feature-icon" style="margin:0 auto 16px;background:var(--mx-danger-light);color:var(--mx-danger);">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
				</div>
				<div class="mx-feature-title">安全稳定高效</div>
				<div class="mx-feature-desc">HTTPS传输加密，REST API数字签名验证，ACL权限控制。</div>
			</div>
		</div>
	</div>
</section>

<!-- CTA -->
<section class="mx-section" style="background:var(--mx-accent);text-align:center;padding:60px 0;">
	<div class="mx-container">
		<h2 style="font-size:24px;font-weight:700;margin-bottom:12px;color:var(--mx-text-inverse);">想要了解更多</h2>
		<p style="font-size:15px;color:rgba(255,255,255,0.8);margin-bottom:32px;">我们随时为您提供帮助和支持</p>
		<div class="mx-features" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;">
			<div class="mx-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);text-align:center;padding:24px;">
				<div style="margin-bottom:12px;">
					<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
				</div>
				<h4 style="color:#fff;font-size:15px;font-weight:600;margin-bottom:6px;">了解更多</h4>
				<p style="color:rgba(255,255,255,0.7);font-size:13px;">帮助中心为您提供答案</p>
			</div>
			<div class="mx-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);text-align:center;padding:24px;">
				<div style="margin-bottom:12px;">
					<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
				</div>
				<h4 style="color:#fff;font-size:15px;font-weight:600;margin-bottom:6px;">开发文档</h4>
				<p style="color:rgba(255,255,255,0.7);font-size:13px;">获取API接口和SDK</p>
			</div>
			<div class="mx-card" style="background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.2);text-align:center;padding:24px;">
				<div style="margin-bottom:12px;">
					<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
				</div>
				<h4 style="color:#fff;font-size:15px;font-weight:600;margin-bottom:6px;">商务合作</h4>
				<p style="color:rgba(255,255,255,0.7);font-size:13px;">期待与您的联系</p>
			</div>
		</div>
		<div style="margin-top:32px;">
			<a href="/user/reg.php" class="mx-btn" style="background:#fff;color:var(--mx-accent);padding:14px 40px;font-size:16px;font-weight:600;" target="_blank">注册成为会员</a>
		</div>
	</div>
</section>
<?php require INDEX_ROOT.'foot.php';?>
