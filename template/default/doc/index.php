<?php
if(!defined('IN_CRONLITE'))exit();
?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>开发文档 - <?php echo $conf['sitename']?></title>
    <!-- MiUI Design System -->
    <link rel="stylesheet" href="/assets/css/miuix.css">
    <!-- jQuery -->
    <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <!-- layui (functional dependency for tabs/panels) -->
    <link rel="stylesheet" href="<?php echo $cdnpublic?>layui/2.6.13/css/layui.css" />
    <script src="<?php echo $cdnpublic?>layui/2.6.13/layui.js"></script>
    <!-- zTree (functional dependency for sidebar tree) -->
    <link rel="stylesheet" href="<?php echo $cdnpublic?>zTree.v3/3.5.42/css/zTreeStyle/zTreeStyle.min.css" />
    <script src="<?php echo $cdnpublic?>zTree.v3/3.5.42/js/jquery.ztree.core.min.js"></script>
    <!-- SyntaxHighlighter -->
    <script src="/assets/doc/js/shCore.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/assets/doc/css/shCoreDefault.css"/>
    <!-- Doc base CSS -->
    <link rel="stylesheet" href="/assets/doc/css/style.css" />
    <link rel="stylesheet" href="/assets/doc/css/docView.css" />
    <!-- MiUI Doc Override (must load after base CSS) -->
    <link rel="stylesheet" href="/assets/doc/css/miuix-doc.css" />
    <script src="/assets/doc/js/home.js"></script>
    <script src="/assets/doc/js/docView.js"></script>
</head>
<body>
    <!-- Top Bar -->
    <div id="navbar">
        <div class="bg-blur"></div>
        <div class="navbar-body">
            <ul class="layui-nav" lay-filter="">
                <div class="navRight">
                    <li class="layui-nav-item layui-this" lay-unselect>
                        <a href="/" style="padding-right: 40px;">返回官网</a>
                    </li>
                </div>
            </ul>
            <div class="nav-menu">
                <a href="/" class="logo" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="var(--mx-accent)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                    <span style="font-size:16px;font-weight:600;color:var(--mx-text-primary);"><?php echo $conf['sitename']?></span>
                </a>
                <a href="javascript:;" id="navMenuLeft"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg></a>
                <a href="javascript:;" id="navMenuRight"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <script>
    function showMask(){ $('#mask').show(); }
    function hideMask(){ $('#mask').hide(); }
    function clickMask(){ closeMenuLeft(); closeMenuRight(); }
    function openMenuLeft(){
        $('#leftbar').addClass('show-item');
        $('#navMenuLeft').addClass('active');
        showMask();
    }
    function closeMenuLeft(){
        $('#leftbar').removeClass('show-item');
        $('#navMenuLeft').removeClass('active');
        hideMask();
    }
    $('#navMenuLeft').click(function(){
        var isShow = $('#leftbar').hasClass('show-item');
        if(isShow){ closeMenuLeft(); } else { closeMenuRight(); openMenuLeft(); }
    });
    function openMenuRight(){
        $('#navbar > .navbar-body > .layui-nav').addClass('show-item');
        $('#navMenuRight').addClass('active');
        showMask();
    }
    function closeMenuRight(){
        $('#navbar > .navbar-body > .layui-nav').removeClass('show-item');
        $('#navMenuRight').removeClass('active');
        hideMask();
    }
    $('#navMenuRight').click(function(){
        var isShow = $('#navbar > .navbar-body > .layui-nav').hasClass('show-item');
        if(isShow){ closeMenuRight(); } else { closeMenuLeft(); openMenuRight(); }
    });
    </script>

    <!-- Left Sidebar -->
    <div id="leftbar" class="layui-nav-side">
        <div class="layui-tab layui-tab-brief" style="margin-top:0">
            <ul class="layui-tab-title">
                <li class="layui-this"><svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg> 目录</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <ul id="treeDirectory" class="ztree showIcon"></ul>
                </div>
                <div class="layui-tab-item">
                    <div class="searchBox">
                        <div id="searchForm">
                            <div class="inputBox">
                                <input type="text" id="search-keyword" autocomplete="off" name="keyword" placeholder="搜索关键词" class="layui-input"/>
                                <svg class="input-icon" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            </div>
                        </div>
                        <ul id="treeSearch"></ul>
                        <div class="searchResultNone">
                            <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" style="opacity:0.3"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <p>未搜索到结果</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright noScroll"><?php echo $conf['sitename']?></div>
        </div>
    </div>
    <script id="searchListTemplate" type="text/html">
        {{#  layui.each(d, function(index, item){ }}
        <li>
            <a href="{{ item.url }}">
                <h3>{{ item.searchedTitle }}</h3>
                <p>{{ item.searchedContent }}</p>
            </a>
        </li>
        {{#  }) }}
    </script>

    <!-- Content -->
    <div id="body">
        <div id="content_body" name="content_body" style="width:100%;height:100%;border:none;overflow:auto;">
            <div id="article-content" class="markdown-body">
                <script>
                    var catalogList = [{"id":1,"parent_id":0,"title":"接口说明","mdFileName":"index.md","url":"index.html","level":0},{"id":2,"parent_id":0,"title":"签名规则","mdFileName":"sign_note.md","url":"sign_note.html","level":0},{"id":3,"parent_id":0,"title":"支付方式列表","mdFileName":"paytype.md","url":"paytype.html","level":0},{"id":4,"parent_id":0,"title":"支付相关接口","level":0},{"id":5,"parent_id":4,"title":"页面跳转支付","mdFileName":"pay_submit.md","url":"pay_submit.html","level":1},{"id":6,"parent_id":4,"title":"统一下单接口","mdFileName":"pay_create.md","url":"pay_create.html","level":1},{"id":7,"parent_id":4,"title":"订单查询","mdFileName":"pay_query.md","url":"pay_query.html","level":1},{"id":8,"parent_id":4,"title":"支付结果通知","mdFileName":"pay_notify.md","url":"pay_notify.html","level":1},{"id":9,"parent_id":4,"title":"订单退款","mdFileName":"pay_refund.md","url":"pay_refund.html","level":1},{"id":10,"parent_id":4,"title":"订单退款查询","mdFileName":"pay_refundquery.md","url":"pay_refundquery.html","level":1},{"id":11,"parent_id":4,"title":"关闭订单","mdFileName":"pay_close.md","url":"pay_close.html","level":1},{"id":20,"parent_id":0,"title":"商户相关接口","level":0},{"id":21,"parent_id":20,"title":"查询商户信息","mdFileName":"merchant_info.md","url":"merchant_info.html","level":1},{"id":22,"parent_id":20,"title":"查询订单列表","mdFileName":"merchant_orders.md","url":"merchant_orders.html","level":1},{"id":30,"parent_id":0,"title":"代付相关接口","level":0},{"id":31,"parent_id":30,"title":"转账发起","mdFileName":"transfer_submit.md","url":"transfer_submit.html","level":1},{"id":32,"parent_id":30,"title":"转账查询","mdFileName":"transfer_query.md","url":"transfer_query.html","level":1},{"id":33,"parent_id":30,"title":"可用余额查询","mdFileName":"transfer_balance.md","url":"transfer_balance.html","level":1},{"id":50,"parent_id":0,"title":"SDK下载","pageTitle":"接口说明","mdFileName":"sdk.md","url":"sdk.html","level":0}];
                    initTree(catalogList);
                </script>
                <h1 id="接口说明及规范"><a href="#接口说明及规范">接口说明及规范</a></h1><h2 id="协议规则"><a href="#协议规则">协议规则</a></h2><p>提交数据格式：<code>application/x-www-form-urlencoded</code></p><p>返回数据格式：<code>JSON</code></p><p>字符编码：<code>UTF-8</code></p><p>签名算法：<code>SHA256WithRSA</code></p><h2 id="V2升级说明"><a href="#V2升级说明">V2升级说明</a></h2><p>1、V2接口全面使用 RSA 签名算法；V1接口使用 MD5 签名算法</p><p>2、V2接口改用全新的接口地址，支持退款、代付等功能；V1接口使用submit.php和mapi.php提交订单</p><p>3、V2接口新增timestamp入参和返回值用于校验时间戳</p><h2 id="获取RSA密钥对"><a href="#获取RSA密钥对">获取RSA密钥对</a></h2><p>在 商户后台-&gt;个人资料-&gt;API信息 页面，点击【生成商户RSA密钥对】，生成后注意保存【商户私钥】。对接接口时只需要用到【平台公钥】与【商户私钥】。</p><h2 id="旧版接口文档"><a href="#旧版接口文档">旧版接口文档</a></h2><p><a href="/doc_old.html">查看V1旧版接口文档</a></p>            <div id="mask" style="display:none" onclick="clickMask()"></div>
            </div>
        </div>
    </div>

    <script>
    $(function(){
        var leftBarTimeout = null;
        $('#leftbar').hover(function(e){
            if(null !== leftBarTimeout){ clearTimeout(leftBarTimeout); leftBarTimeout = null; }
            if(e.type === 'mouseenter'){ $('.left-show-hide').fadeIn(250); }
            else if($('#leftbar').css('left') == '0px'){ $('.left-show-hide').fadeOut(500); }
        });
    });
    function showLeftbar(){
        $('#leftbar').css('left', 0);
        $('#body').css('padding-left','');
        $('.left-show-hide > i').html('&#xe603;');
    }
    function hideLeftbar(){
        $('#leftbar').css('left', '-280px');
        $('#body').css('padding-left',0);
        $('.left-show-hide > i').html('&#xe602;');
        $('.left-show-hide').fadeIn(250);
    }
    $('.left-show-hide').click(function(){
        if($('#leftbar').css('left') == '0px'){ hideLeftbar(); } else { showLeftbar(); }
    });
    </script>
</body>
</html>
