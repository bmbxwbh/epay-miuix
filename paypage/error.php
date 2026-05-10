<?php if(!defined('IN_CRONLITE'))exit();?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
<title>提示</title>
<link rel="stylesheet" href="../assets/css/miuix.css">
<style>
body { background: var(--mx-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; }
.error-card {
  max-width: 400px;
  width: 90%;
  background: var(--mx-bg-card);
  border-radius: var(--mx-radius-lg);
  box-shadow: var(--mx-shadow-md);
  padding: 40px 24px;
  text-align: center;
}
.error-icon {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  background: var(--mx-warning-light);
  color: var(--mx-warning);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
}
.error-icon svg { width: 36px; height: 36px; }
.error-msg { font-size: 16px; font-weight: 500; color: var(--mx-text-primary); line-height: 1.6; margin-bottom: 24px; }
</style>
</head>
<body>
<div class="error-card">
  <div class="error-icon">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
  </div>
  <div class="error-msg"><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8')?></div>
  <button class="mx-btn mx-btn-secondary mx-btn-block" id="closeBtn">关闭</button>
</div>
<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script src="js/close.js"></script>
<script>
document.body.addEventListener('touchmove', function(e){ e.preventDefault(); }, {passive: false});
document.getElementById('closeBtn').onclick = function(){ window.close(); };
</script>
</body>
</html>
