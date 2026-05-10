<?php if(!defined('IN_CRONLITE'))exit();?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8"/>
<title><?php echo htmlspecialchars($conf['title'], ENT_QUOTES, 'UTF-8')?></title>
<meta name="keywords" content="<?php echo htmlspecialchars($conf['keywords'], ENT_QUOTES, 'UTF-8')?>">
<meta name="description" content="<?php echo htmlspecialchars($conf['description'], ENT_QUOTES, 'UTF-8')?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
<meta name="theme-color" content="#f5f5f5"/>
<link rel="stylesheet" href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="<?php echo STATIC_ROOT?>css/miuix.css"/>
<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<!-- Top App Bar -->
<header class="mx-topbar">
  <a href="/" class="mx-topbar-logo">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--mx-accent)"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
    <?php echo htmlspecialchars($conf['sitename'], ENT_QUOTES, 'UTF-8')?>
  </a>
  <button class="mx-topbar-toggle" onclick="document.querySelector('.mx-topbar-nav').classList.toggle('open')">
    <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </button>
  <nav class="mx-topbar-nav">
    <a href="/" class="active">首页</a>
    <a href="/?mod=doc">开发文档</a>
    <?php if($conf['test_open']){?>
    <a href="/user/test.php">支付测试</a>
    <?php }?>
    <a href="/user/">用户中心</a>
    <a href="/user/reg.php" class="mx-topbar-btn">注册</a>
  </nav>
</header>
<div class="mx-page">
