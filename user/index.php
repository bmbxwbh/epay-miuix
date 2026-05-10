<?php
$is_defend=true;
include("../includes/common.php");

if(isset($_GET['invite'])){
    $invite_code = trim($_GET['invite']);
    $uid = get_invite_uid($invite_code);
    if($uid && is_numeric($uid)){
        $_SESSION['invite_uid'] = intval($uid);
    }
}

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

if(!$conf['reg_input_settle'] && (empty($userrow['account']) || empty($userrow['username']))){
	exit("<script language='javascript'>window.location.href='./completeinfo.php';</script>");
}

if($userrow['status']==0){
	$status_html = '<span class="mx-badge mx-badge-danger"><span class="mx-status-dot red"></span>已封禁</span>';
}elseif($userrow['pay']==0 && $userrow['settle']==0){
	$status_html = '<span class="mx-badge mx-badge-danger"><span class="mx-status-dot red"></span>关闭支付、结算</span>';
}elseif($userrow['pay']==0){
	$status_html = '<span class="mx-badge mx-badge-danger"><span class="mx-status-dot red"></span>关闭支付</span>';
}elseif($userrow['settle']==0){
	$status_html = '<span class="mx-badge mx-badge-danger"><span class="mx-status-dot red"></span>关闭结算</span>';
}elseif($conf['cert_force']==1 && $userrow['cert']==0){
	$status_html = '<a href="certificate.php"><span class="mx-badge mx-badge-warning"><span class="mx-status-dot orange"></span>未实名认证</span></a>';
}elseif($userrow['pay']==2){
	$status_html = '<span class="mx-badge mx-badge-warning"><span class="mx-status-dot orange"></span>待审核</span>';
}else{
	$status_html = '<span class="mx-badge mx-badge-success"><span class="mx-status-dot green"></span>正常</span>';
}
$title='用户中心';
include './head.php';

$rs=$DB->query("SELECT * FROM pre_settle WHERE uid={$uid} AND status=1 ORDER BY id DESC LIMIT 9");
$max_settle=0;
$chart='';
$i=0;
while($row = $rs->fetch())
{
	if($row['money']>$max_settle)$max_settle=$row['money'];
	$chart.='['.$i++.','.$row['money'].'],';
}
$chart=substr($chart,0,-1);

$list = $DB->getAll("SELECT * FROM pre_anounce WHERE status=1 ORDER BY sort ASC");
?>

<!-- Alerts -->
<?php
if($conf['cert_force']==1 && $userrow['cert']==0){
	echo '<div class="mx-alert mx-alert-danger"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg><div>请完成实名认证，否则您的商户无法正常收款！ <a href="./certificate.php" class="mx-btn mx-btn-sm mx-btn-outline" style="margin-left:12px;">立即认证</a></div></div>';
}
if($conf['verifytype']==1 && empty($userrow['phone'])){
	echo '<div class="mx-alert mx-alert-warning"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg><div>您还没有绑定密保手机，请 <a href="editinfo.php" class="mx-btn mx-btn-sm mx-btn-outline" style="margin-left:8px;">尽快绑定</a></div></div>';
}elseif($conf['verifytype']==0 && empty($userrow['email'])){
	echo '<div class="mx-alert mx-alert-warning"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg><div>您还没有绑定密保邮箱，请 <a href="editinfo.php" class="mx-btn mx-btn-sm mx-btn-outline" style="margin-left:8px;">尽快绑定</a></div></div>';
}
if(empty($userrow['pwd'])){
	echo '<div class="mx-alert mx-alert-warning"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg><div>您还没有设置登录密码，请 <a href="userinfo.php?mod=account" class="mx-btn mx-btn-sm mx-btn-outline" style="margin-left:8px;">点此设置</a></div></div>';
}
?>

<!-- Stats Cards -->
<div class="mx-stats-grid mx-stagger">
  <div class="mx-stat-card">
    <div class="mx-stat-icon blue">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
    </div>
    <div>
      <div class="mx-stat-value"><span class="mx-text-sm" style="color:var(--mx-text-tertiary)">¥</span><?php echo $userrow['money']?></div>
      <div class="mx-stat-label">商户当前余额</div>
    </div>
  </div>
  <div class="mx-stat-card">
    <div class="mx-stat-icon green">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div>
      <div class="mx-stat-value"><span class="mx-text-sm" style="color:var(--mx-text-tertiary)">¥</span><span id="settle_money">-</span></div>
      <div class="mx-stat-label">已结算余额</div>
    </div>
  </div>
  <div class="mx-stat-card">
    <div class="mx-stat-icon orange">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
    </div>
    <div>
      <div class="mx-stat-value"><span id="orders">-</span><span class="mx-text-sm" style="color:var(--mx-text-tertiary)"> 个</span></div>
      <div class="mx-stat-label">订单总数</div>
    </div>
  </div>
  <div class="mx-stat-card">
    <div class="mx-stat-icon red">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
    </div>
    <div>
      <div class="mx-stat-value"><span id="orders_today">-</span><span class="mx-text-sm" style="color:var(--mx-text-tertiary)"> 个</span></div>
      <div class="mx-stat-label">今日订单</div>
    </div>
  </div>
</div>

<!-- Main Content Grid -->
<div class="mx-dashboard-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
  <!-- Left: User Profile + Income Stats -->
  <div class="mx-flex-col mx-gap-16" style="display:flex;">
    <!-- Profile Card -->
    <div class="mx-card">
      <div class="mx-card-body" style="text-align:center;padding:24px;">
        <div class="mx-avatar mx-avatar-lg" style="margin:0 auto 12px;background:var(--mx-accent-light);color:var(--mx-accent);">
          <?php echo strtoupper(substr($userrow['username'],0,1))?>
        </div>
        <div class="mx-font-bold" style="font-size:18px;">欢迎您，<?php echo $userrow['username']?></div>
        <div class="mx-mt-16" style="margin-top:8px;"><?php echo $status_html?></div>
        <div class="mx-divider"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div style="text-align:center;">
            <div class="mx-font-bold" style="font-size:18px;" id="order_today_all">-</div>
            <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">今日收入</div>
          </div>
          <div style="text-align:center;">
            <div class="mx-font-bold" style="font-size:18px;" id="order_lastday_all">-</div>
            <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">昨日收入</div>
          </div>
        </div>
        <?php if($conf['user_transfer']==1){?>
        <div class="mx-divider"></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div style="text-align:center;">
            <div class="mx-font-bold" style="font-size:18px;" id="transfer_today_all">-</div>
            <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">今日支出</div>
          </div>
          <div style="text-align:center;">
            <div class="mx-font-bold" style="font-size:18px;" id="transfer_lastday_all">-</div>
            <div class="mx-text-xs" style="color:var(--mx-text-tertiary)">昨日支出</div>
          </div>
        </div>
        <?php }?>
        <div class="mx-divider"></div>
        <div style="display:flex;gap:8px;justify-content:center;">
          <a href="userinfo.php?mod=api" class="mx-btn mx-btn-secondary mx-btn-sm">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 11-7.778 7.778 5.5 5.5 0 017.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
            API 信息
          </a>
          <a href="editinfo.php" class="mx-btn mx-btn-secondary mx-btn-sm">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            修改资料
          </a>
        </div>
      </div>
    </div>

    <!-- Income Stats Table -->
    <div class="mx-card">
      <div class="mx-card-header">收入统计与通道费率</div>
      <div class="mx-table-responsive">
        <table class="mx-table">
          <thead><tr id="paytypes"></tr></thead>
          <tbody>
            <tr id="order_today"></tr>
            <tr id="order_lastday"></tr>
            <tr id="success_rate"></tr>
            <tr id="payrates"></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Right: Announcements + Chart -->
  <div class="mx-flex-col mx-gap-16" style="display:flex;">
    <!-- Announcements -->
    <div class="mx-card">
      <div class="mx-card-header">
        <span>公告通知</span>
        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
      </div>
      <div class="mx-list" style="border:none;box-shadow:none;border-radius:0;">
        <?php if(empty($list)){?>
        <div class="mx-empty" style="padding:32px;">
          <div class="mx-empty-title">暂无公告</div>
        </div>
        <?php } else { foreach($list as $row){?>
        <div class="mx-list-item">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="<?php echo $row['color']?$row['color']:'var(--mx-text-tertiary)'?>" stroke-width="1.8"><path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
          <span style="color:<?php echo $row['color']?$row['color']:'var(--mx-text-primary)'?>"><?php echo $row['content']?></span>
          <span class="mx-list-item-time"><?php echo $row['addtime']?></span>
        </div>
        <?php }}?>
      </div>
    </div>

    <!-- Chart -->
    <div class="mx-card">
      <div class="mx-card-header">
        <div class="mx-tabs" style="border:none;margin:-4px -8px;">
          <button class="mx-tab active" onclick="switchTab(this,'settle-tab')">结算统计</button>
          <button class="mx-tab" onclick="switchTab(this,'order-tab')">订单统计</button>
        </div>
      </div>
      <div class="mx-card-body">
        <div id="settle-tab" class="mx-tab-pane active">
          <div id="settle-chart" style="height:240px;"></div>
        </div>
        <div id="order-tab" class="mx-tab-pane">
          <div id="order-chart-container" style="height:240px;">
            <div class="mx-empty" style="padding:60px 0;">
              <div class="mx-empty-desc">切换到此标签页加载订单统计数据</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/assets/js/chart.js"></script>
<?php include 'foot.php';?>
<script>
function switchTab(el, tabId) {
  el.closest('.mx-tabs').querySelectorAll('.mx-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  el.closest('.mx-card-body').querySelectorAll('.mx-tab-pane').forEach(p => p.classList.remove('active'));
  document.getElementById(tabId).classList.add('active');
  if(tabId === 'order-tab') loadOrderChart();
}

$(document).ready(function(){
  $.ajax({
    type: "GET",
    url: "ajax2.php?act=getcount",
    dataType: 'json',
    async: true,
    success: function(data) {
      $('#orders').html(data.orders);
      $('#orders_today').html(data.orders_today);
      $('#settle_money').html(data.settle_money);
      $('#order_today_all').html('¥' + data.order_today_all);
      $('#order_lastday_all').html('¥' + data.order_lastday_all);
      $('#transfer_today_all').html('¥' + data.transfer_today_all);
      $('#transfer_lastday_all').html('¥' + data.transfer_lastday_all);
      $.each(data.channels, function(i, item) {
        $('#paytypes').append('<th>' + item.showname + '</th>');
      });
      $.each(data.channels, function(i, item) {
        $('#order_today').append('<td>今日：¥' + item.order_today + '</td>');
        $('#order_lastday').append('<td>昨日：¥' + item.order_lastday + '</td>');
        $('#success_rate').append('<td>' + item.success_rate + '%</td>');
        $('#payrates').append('<td>' + item.rate + '%</td>');
      });
    }
  });

  <?php if(!empty($conf['modal'])){?>
  // Show modal
  var modal = $('<div class="mx-modal-overlay open"><div class="mx-modal"><div class="mx-modal-header">欢迎回来</div><div class="mx-modal-body"><?php echo addslashes($conf['modal'])?></div><div class="mx-modal-footer"><button class="mx-btn mx-btn-secondary" onclick="$(this).closest(\'.mx-modal-overlay\').remove()">关闭</button></div></div></div>');
  $('body').append(modal);
  <?php }?>

  function loadOrderChart() {
    if(window.orderChartInstance) { window.orderChartInstance.destroy(); }
    $('#order-chart-container').html('<div class="mx-empty" style="padding:60px 0;"><div class="mx-empty-desc">加载中...</div></div>');
    $.ajax({
      type: "GET",
      url: "ajax2.php?act=orderCount",
      dataType: 'json',
      async: true,
      success: function(data) {
        $('#order-chart-container').html('<canvas id="orderChart"></canvas>');
        var ctx = document.getElementById('orderChart').getContext('2d');
        window.orderChartInstance = new Chart(ctx, {
          type: 'line',
          data: { labels: data.labels, datasets: data.datasets },
          options: {
            responsive: true, maintainAspectRatio: false,
            scales: { y: { beginAtZero: true, ticks: { callback: function(v) { return '¥' + v; } } } },
            plugins: { legend: { display: true, position: 'top' } }
          }
        });
      }
    });
  }
});
</script>
