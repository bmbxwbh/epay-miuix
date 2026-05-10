<?php if(!defined('IN_CRONLITE'))exit();
require INDEX_ROOT.'head.php';
?>

<!-- Hero Section -->
<section class="mx-hero">
  <div class="mx-container mx-text-center">
    <h1 class="mx-hero-title"><?php echo $conf['sitename']?></h1>
    <p class="mx-hero-subtitle">免签约支付聚合平台，一站式接入支付宝、微信、QQ 钱包等多种支付方式，高效便捷。</p>
    <div class="mx-hero-actions">
      <a href="/user/" class="mx-btn mx-btn-primary mx-btn-lg">登录商户</a>
      <a href="/user/reg.php" class="mx-btn mx-btn-secondary mx-btn-lg">注册商户</a>
    </div>
  </div>
</section>

<!-- Features -->
<section class="mx-section">
  <div class="mx-container">
    <h2 class="mx-text-center mx-font-bold" style="font-size:24px;margin-bottom:8px;">核心优势</h2>
    <p class="mx-text-center mx-mb-24" style="color:var(--mx-text-secondary);">为开发者打造的支付解决方案</p>
    <div class="mx-features">
      <div class="mx-feature-card">
        <div class="mx-feature-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
        </div>
        <div class="mx-feature-title">多种支付方式</div>
        <div class="mx-feature-desc">支持支付宝、微信、QQ 钱包、银联等多种主流支付渠道，满足不同场景需求。</div>
      </div>
      <div class="mx-feature-card">
        <div class="mx-feature-icon" style="background:var(--mx-success-light);color:var(--mx-success);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        </div>
        <div class="mx-feature-title">费率低至 2%</div>
        <div class="mx-feature-desc">每笔交易手续费低至 2%，相比同类平台更具成本优势。</div>
      </div>
      <div class="mx-feature-card">
        <div class="mx-feature-icon" style="background:var(--mx-warning-light);color:var(--mx-warning);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div class="mx-feature-title">安全可靠</div>
        <div class="mx-feature-desc">采用 RSA 公私钥验证，支持风控检测和黑名单管理，保障交易安全。</div>
      </div>
      <div class="mx-feature-card">
        <div class="mx-feature-icon" style="background:var(--mx-danger-light);color:var(--mx-danger);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <div class="mx-feature-title">快速集成</div>
        <div class="mx-feature-desc">简洁的 API 接口，几分钟即可完成对接，快速上线收款。</div>
      </div>
    </div>
  </div>
</section>

<!-- Partners -->
<section class="mx-section" style="background:var(--mx-bg-secondary);padding:40px 0;">
  <div class="mx-container mx-text-center">
    <h3 class="mx-font-bold mx-mb-24" style="font-size:18px;color:var(--mx-text-secondary);">支持的支付渠道</h3>
    <div class="mx-partners">
      <div class="mx-partner-badge">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#1677FF" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
        支付宝
      </div>
      <div class="mx-partner-badge">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#07C160" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
        微信支付
      </div>
      <div class="mx-partner-badge">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#12B7F5" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
        QQ 钱包
      </div>
      <div class="mx-partner-badge">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#E60012" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 12h8M12 8v8"/></svg>
        银联
      </div>
    </div>
  </div>
</section>

<?php require INDEX_ROOT.'foot.php';?>
