<?php
$is_defend = true;
include("./inc.php");
@header('Content-Type: text/html; charset=UTF-8');
$trade_no=daddslashes($_GET['trade_no']);
$row=$DB->getRow("SELECT * FROM pre_order WHERE trade_no='{$trade_no}' limit 1");
if(!$row)showerror('订单号不存在');
if($row['status']!=1)showerror('订单未完成支付');
if(!isset($_SESSION['paypage_trade_no']) || $_SESSION['paypage_trade_no']!=$trade_no)showerror('订单校验失败');
$userrow=$DB->getRow("select codename,username from pre_user where uid='{$row['uid']}' limit 1");
$codename = !empty($userrow['codename'])?$userrow['codename']:$userrow['username'];
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
<title>支付成功</title>
<link rel="stylesheet" href="/assets/css/miuix.css">
<style>
body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; }
.success-card {
  max-width: 400px;
  width: 90%;
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius-lg);
  box-shadow: var(--mx-shadow-md);
  padding: 40px 24px;
  text-align: center;
}
.success-icon {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  background: var(--mx-success-light);
  color: var(--mx-success);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
}
.success-icon svg { width: 36px; height: 36px; }
.success-amount {
  font-size: 36px;
  font-weight: 700;
  color: var(--mx-text-primary);
  margin-bottom: 4px;
}
.success-amount::before { content: '¥'; font-size: 20px; font-weight: 500; }
.success-title { font-size: 18px; font-weight: 600; margin-bottom: 24px; color: var(--mx-text-primary); }
.success-info { text-align: left; }
.success-row {
  display: flex;
  justify-content: space-between;
  padding: 12px 0;
  font-size: 14px;
  border-bottom: 1px solid var(--mx-border);
}
.success-row:last-child { border-bottom: none; }
.success-row-label { color: var(--mx-text-tertiary); }
.success-row-value { color: var(--mx-text-primary); font-weight: 500; }
</style>
</head>
<body>
<div class="success-card mx-animate-scaleIn">
  <div class="success-icon">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
  </div>
  <div class="success-title">支付成功</div>
  <div class="success-amount"><?php echo htmlspecialchars($row['money'], ENT_QUOTES, 'UTF-8')?></div>
  <div class="mx-divider" style="margin:20px 0;"></div>
  <div class="success-info">
    <div class="success-row">
      <span class="success-row-label">收款方</span>
      <span class="success-row-value"><?php echo htmlspecialchars($codename, ENT_QUOTES, 'UTF-8')?></span>
    </div>
    <div class="success-row">
      <span class="success-row-label">完成时间</span>
      <span class="success-row-value"><?php echo htmlspecialchars($row['endtime'], ENT_QUOTES, 'UTF-8')?></span>
    </div>
    <div class="success-row">
      <span class="success-row-label">订单号</span>
      <span class="success-row-value" style="font-size:13px;"><?php echo htmlspecialchars($trade_no, ENT_QUOTES, 'UTF-8')?></span>
    </div>
  </div>
  <button class="mx-btn mx-btn-secondary mx-btn-block" style="margin-top:24px;" id="closeBtn">关闭</button>
</div>

<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script src="//open.mobile.qq.com/sdk/qqapi.js?_bid=152"></script>
<script src="js/close.js"></script>
<script>
document.body.addEventListener('touchmove', function(e){ e.preventDefault(); }, {passive: false});
document.getElementById('closeBtn').onclick = function(){ window.close(); };
</script>
</body>
</html>
