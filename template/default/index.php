<?php if(!defined('IN_CRONLITE'))exit();
require INDEX_ROOT.'head.php';
?>

<!-- Hero -->
<section class="mx-hero">
  <div class="mx-container mx-text-center">
    <h1 class="mx-hero-title"><?php echo $conf['sitename']?></h1>
    <p class="mx-hero-subtitle">一站式聚合支付解决方案，快速接入主流支付渠道</p>
    <div class="mx-hero-actions">
      <a href="/user/" class="mx-btn mx-btn-primary mx-btn-lg">登录商户</a>
      <a href="/user/reg.php" class="mx-btn mx-btn-secondary mx-btn-lg">注册商户</a>
    </div>
  </div>
</section>

<!-- Features -->
<section class="mx-section">
  <div class="mx-container">
    <div class="mx-features">
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
        <div class="mx-feature-desc">简洁的 API 接口，几分钟完成对接</div>
      </div>
      <div class="mx-feature-card">
        <div class="mx-feature-icon" style="background:var(--mx-warning-light);color:var(--mx-warning);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <div class="mx-feature-title">安全可靠</div>
        <div class="mx-feature-desc">RSA 签名验证，风控检测与黑名单管理</div>
      </div>
    </div>
  </div>
</section>

<?php require INDEX_ROOT.'foot.php';?>
