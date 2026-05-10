<?php
@header('Content-Type: text/html; charset=UTF-8');
if($userrow['status']==0){
	sysmsg('你的商户由于违反相关法律法规与《<a href="/?mod=agreement">'.$conf['sitename'].'用户协议</a>》，已被禁用！');
}
$groupconfig = getGroupConfig($userrow['gid']);
$conf = array_merge($conf, $groupconfig);

// Current page detection
$current_page = basename($_SERVER['PHP_SELF'], '.php');
$is_active = function($pages) use ($current_page) {
	$pages = explode(',', $pages);
	foreach($pages as $p) { if(strpos($current_page, trim($p)) !== false) return true; }
	return false;
};
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"/>
<title><?php echo $title?> | <?php echo $conf['sitename']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<link rel="stylesheet" href="../assets/css/miuix.css"/>
<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<!-- Top App Bar -->
<header class="mx-topbar">
  <button class="mx-topbar-toggle" onclick="document.querySelector('.mx-sidebar').classList.toggle('open')">
    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>
  <a href="/user/" class="mx-topbar-logo">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--mx-accent)"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
    <?php echo $conf['sitename']?>
  </a>
  <nav class="mx-topbar-nav" style="margin-left:auto;">
    <a href="/" >首页</a>
    <a href="/?mod=doc">文档</a>
    <div style="display:flex;align-items:center;gap:8px;margin-left:8px;">
      <div class="mx-avatar" style="width:32px;height:32px;font-size:13px;background:var(--mx-accent-light);color:var(--mx-accent);">
        <?php echo strtoupper(substr($userrow['username'],0,1))?>
      </div>
      <span class="mx-text-sm mx-font-bold"><?php echo $userrow['username']?></span>
    </div>
    <a href="login.php?logout" class="mx-btn mx-btn-ghost mx-btn-sm">
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
      用户中心
    </a>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">个人资料</div>
    <a href="userinfo.php?mod=api" class="mx-sidebar-item <?php echo $is_active('userinfo')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
      API 信息
    </a>
    <a href="editinfo.php" class="mx-sidebar-item <?php echo $is_active('editinfo')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      修改资料
    </a>
    <a href="userinfo.php?mod=account" class="mx-sidebar-item <?php echo $is_active('userinfo')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
      修改密码
    </a>
    <?php if($conf['cert_open']>0){?>
    <a href="certificate.php" class="mx-sidebar-item <?php echo $is_active('certificate')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      实名认证
    </a>
    <?php }?>
    <?php if($conf['user_deposit']>0){?>
    <a href="deposit.php" class="mx-sidebar-item <?php echo $is_active('deposit')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12V7H5a2 2 0 010-4h14v4"/><path d="M3 5v14a2 2 0 002 2h16v-5"/><path d="M18 12a2 2 0 100 4h4v-4h-4z"/></svg>
      保证金
    </a>
    <?php }?>
  </div>

  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">查询</div>
    <a href="order.php" class="mx-sidebar-item <?php echo $is_active('order')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
      订单记录
    </a>
    <a href="settle.php" class="mx-sidebar-item <?php echo $is_active('settle')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      结算记录
    </a>
    <a href="record.php" class="mx-sidebar-item <?php echo $is_active('record')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      资金明细
    </a>
    <?php if($conf['settle_open']==2||$conf['settle_open']==3){?>
    <a href="apply.php" class="mx-sidebar-item <?php echo $is_active('apply')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      申请提现
    </a>
    <?php }?>
    <?php if($conf['recharge']==1){?>
    <a href="recharge.php" class="mx-sidebar-item <?php echo $is_active('recharge')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
      余额充值
    </a>
    <?php }?>
    <?php if($conf['group_buy']==1){?>
    <a href="groupbuy.php" class="mx-sidebar-item <?php echo $is_active('groupbuy')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
      购买会员
    </a>
    <?php }?>
    <?php if($conf['pay_domain_open']==1){?>
    <a href="domain.php" class="mx-sidebar-item <?php echo $is_active('domain')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/></svg>
      授权域名
    </a>
    <?php }?>
  </div>

  <?php if($conf['user_transfer']==1 || $conf['onecode']==1 || $userrow['open_code']==1 || $conf['invite_open']==1){?>
  <div class="mx-sidebar-section">
    <div class="mx-sidebar-label">其他</div>
    <?php if($conf['user_transfer']==1){?>
    <a href="transfer.php" class="mx-sidebar-item <?php echo $is_active('transfer')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 014-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 01-4 4H3"/></svg>
      代付管理
    </a>
    <?php }?>
    <?php if($conf['onecode']==1 || $userrow['open_code']==1){?>
    <a href="onecode.php" class="mx-sidebar-item <?php echo $is_active('onecode')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="8" height="8" rx="1"/><rect x="14" y="2" width="8" height="8" rx="1"/><rect x="2" y="14" width="8" height="8" rx="1"/><rect x="14" y="14" width="4" height="4" rx="0.5"/></svg>
      聚合收款
    </a>
    <?php }?>
    <?php if($conf['invite_open']==1){?>
    <a href="invite.php" class="mx-sidebar-item <?php echo $is_active('invite')?'active':''?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
      邀请返现
    </a>
    <?php }?>
  </div>
  <?php }?>

  <div class="mx-sidebar-section" style="margin-top:auto;padding-top:16px;border-top:1px solid var(--mx-border);">
    <a href="/?mod=doc" target="_blank" class="mx-sidebar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
      开发文档
    </a>
    <?php if(!empty($conf['appurl'])){?>
    <a href="<?php echo $conf['appurl']?>" target="_blank" class="mx-sidebar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
      APP 下载
    </a>
    <?php }?>
  </div>
</aside>

<!-- Main Content -->
<main class="mx-main">
