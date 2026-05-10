<?php
if(!defined('IN_CRONLITE'))exit();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="keywords" content="<?php echo $conf['keywords']?>" />
	<meta name="description" content="<?php echo $conf['description']?>" />
	<link rel="stylesheet" href="/assets/css/miuix.css" />
	<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
	<title><?php echo $conf['title']?></title>
</head>
<body>
<div class="mx-topbar">
	<div class="mx-topbar-logo">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
		<?php echo $conf['sitename']?>
	</div>
	<button class="mx-topbar-toggle" onclick="this.nextElementSibling.classList.toggle('open')">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
	</button>
	<ul class="mx-topbar-nav">
		<li><a href="/" class="active">首页</a></li>
		<li><a href="produceIntroduce.html">功能介绍</a></li>
		<li><a href="doc.html">开发文档</a></li>
		<?php if($conf['test_open']==1){?>
		<li><a target="_blank" href="/user/test.php">在线测试</a></li>
		<?php }?>
		<?php if(!empty($conf['appurl'])){?>
		<li><a href="<?php echo $conf['appurl']?>">APP下载</a></li>
		<?php }?>
		<li><a href="/user/" class="mx-topbar-btn">商户登录</a></li>
	</ul>
</div>
<div class="mx-page">
