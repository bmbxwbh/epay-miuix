<?php
@header('Content-Type: text/html; charset=UTF-8');

$admin_cdnpublic = 0;
if($admin_cdnpublic==1){
	$cdnpublic = '//lib.baomitu.com/';
}elseif($admin_cdnpublic==2){
	$cdnpublic = 'https://s4.zstatic.net/ajax/libs/';
}elseif($admin_cdnpublic==4){
	$cdnpublic = 'https://cdnjs.snrat.com/ajax/libs/';
}else{
	$cdnpublic = '/assets/vendor/';
}

// Current page detection for sidebar active state
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$is_active = function($pages) use ($current_page) {
	$pages = explode(',', $pages);
	foreach($pages as $p) {
		$p = trim($p);
		if($p === '') continue;
		if(strpos($current_page, $p) !== false) return true;
	}
	return false;
};
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo $title ?> | 支付管理中心</title>
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/css/miuix.css"/>
  <link rel="stylesheet" href="../assets/css/miuix-override.css"/>
  <script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<?php if($islogin==1){?>
<!-- Top App Bar -->
<header class="mx-topbar">
  <button class="mx-topbar-toggle" onclick="document.querySelector('.mx-sidebar').classList.toggle('open')">
    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>
  <a href="./" class="mx-topbar-logo">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--mx-accent)"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
    支付管理中心
  </a>
  <nav class="mx-topbar-nav" style="margin-left:auto;">
    <a href="../" >前台首页</a>
    <div style="display:flex;align-items:center;gap:8px;margin-left:8px;">
      <div class="mx-avatar" style="width:32px;height:32px;font-size:13px;background:var(--mx-accent-light);color:var(--mx-accent);">
        <?php echo strtoupper(substr(htmlspecialchars($conf['admin_user'] ?? 'A', ENT_QUOTES, 'UTF-8'),0,1))?>
      </div>
      <span class="mx-text-sm mx-font-bold"><?php echo htmlspecialchars($conf['admin_user'] ?? '管理员', ENT_QUOTES, 'UTF-8')?></span>
    </div>
    <a href="login.php?logout" class="mx-btn mx-btn-ghost mx-btn-sm" onclick="return confirm('是否确定退出登录？')">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      退出
    </a>
  </nav>
</header>

<div class="mx-page">
<div class="mx-layout">
<!-- Sidebar -->
<aside class="mx-sidebar" id="sidebar">
  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">概览</div>
    <a href="./" class="mx-sidebar-item <?php echo $is_active('index')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12l9-9 9 9"/><path d="M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10"/></svg>
      首页
    </a>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">商户管理</div>
    <a href="./ulist.php" class="mx-sidebar-item <?php echo $is_active('ulist')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
      商户列表
    </a>
    <a href="./uset.php" class="mx-sidebar-item <?php echo $is_active('uset')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
      用户设置
    </a>
    <a href="./glist.php" class="mx-sidebar-item <?php echo $is_active('glist,group,gedit')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
      用户分组
    </a>
    <?php if($conf['reg_open']==2){?>
    <a href="./invitecode.php" class="mx-sidebar-item <?php echo $is_active('invitecode')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
      邀请码管理
    </a>
    <?php }?>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">订单管理</div>
    <a href="./order.php" class="mx-sidebar-item <?php echo $is_active('order')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
      订单记录
    </a>
    <a href="./export.php" class="mx-sidebar-item <?php echo $is_active('export')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
      支付测试
    </a>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">财务管理</div>
    <a href="./slist.php" class="mx-sidebar-item <?php echo $is_active('slist,settle')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      结算管理
    </a>
    <a href="./transfer.php" class="mx-sidebar-item <?php echo $is_active('transfer')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 014-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
      代付管理
    </a>
    <a href="./transfer_batch.php" class="mx-sidebar-item <?php echo $is_active('transfer_batch')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
      批量代付
    </a>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">支付管理</div>
    <a href="./pay_plugin.php" class="mx-sidebar-item <?php echo $is_active('pay_plugin')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/></svg>
      支付插件
    </a>
    <a href="./pay_channel.php" class="mx-sidebar-item <?php echo $is_active('pay_channel')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
      支付通道
    </a>
    <a href="./pay_type.php" class="mx-sidebar-item <?php echo $is_active('pay_type')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
      支付方式
    </a>
    <a href="./pay_roll.php" class="mx-sidebar-item <?php echo $is_active('pay_roll')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 11-2.12-9.36L23 10"/></svg>
      子通道管理
    </a>
    <a href="./ps_receiver.php" class="mx-sidebar-item <?php echo $is_active('ps_receiver')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
      分账接收人
    </a>
    <a href="./ps_order.php" class="mx-sidebar-item <?php echo $is_active('ps_order')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      分账订单
    </a>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">风控管理</div>
    <a href="./risk.php" class="mx-sidebar-item <?php echo $is_active('risk')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      风控记录
    </a>
    <a href="./blacklist.php" class="mx-sidebar-item <?php echo $is_active('blacklist')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
      黑名单管理
    </a>
    <?php if($conf['pay_domain_forbid']==1 || $conf['pay_domain_open']==1){?>
    <a href="./domain.php" class="mx-sidebar-item <?php echo $is_active('domain')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
      域名白名单
    </a>
    <?php }?>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">系统管理</div>
    <a href="./set.php?mod=site" class="mx-sidebar-item <?php echo $is_active('set')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
      系统设置
    </a>
    <a href="./log.php" class="mx-sidebar-item <?php echo $is_active('log')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      操作日志
    </a>
    <a href="./gonggao.php" class="mx-sidebar-item <?php echo $is_active('gonggao')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
      公告管理
    </a>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">微信企业号</div>
    <a href="./pay_weixin.php" class="mx-sidebar-item <?php echo $is_active('pay_weixin')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
      企业微信配置
    </a>
    <a href="./set_wxkf.php" class="mx-sidebar-item <?php echo $is_active('set_wxkf')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      客服账号管理
    </a>
  </div>
</aside>

<!-- Main Content -->
<main class="mx-main">
<?php }?>
