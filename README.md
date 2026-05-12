# NAILTEAM 支付系统 - MiUI Edition

**NAILTEAM 支付系统** 由NAILTEAM开发，是一款开源的免签约支付产品，能够帮助开发者一站式接入支付宝、微信、财付通、QQ钱包等多种支付方式，实现高效的支付集成。

本分支基于原版进行 **MiUI (HyperOS) 设计语言** 全面重构，提供现代化的用户界面体验。

---

## 功能特色

- **多渠道支付集成**：支持支付宝、微信、财付通、QQ钱包、微信WAP、银联、抖音支付等多种支付方式
- **便捷的支付解决方案**：简化支付流程，支持快速集成和上线，提供完整的 API 接口
- **后台管理和数据统计**：提供支付统计、代付统计、利润分析等多种后台管理功能
- **安全可靠**：采用 RSA 公私钥验证，支持风控检测和黑名单管理
- **插件扩展**：支持 60+ 支付插件，可根据需求灵活扩展
- **移动端优化**：全新的 MiUI 风格支付页面，支持各种移动端支付场景

---

## 快速部署

### 🚀 一键部署（推荐）

```bash
curl -fsSL https://raw.githubusercontent.com/bmbxwbh/epay-miuix/main/install.sh | bash
```

或手动执行：

```bash
git clone https://github.com/bmbxwbh/epay-miuix.git
cd epay-miuix
bash install.sh
```

脚本会自动检测 Docker 环境，交互式配置端口和数据库，生成 `docker-compose.yml` 并启动服务。

### Docker Compose 部署

```bash
git clone https://github.com/bmbxwbh/epay-miuix.git
cd epay-miuix

# 编辑 docker-compose.yml 修改数据库密码
# 启动服务
docker compose up -d

# 访问 http://localhost:8080/install/ 完成安装
```

### Docker 镜像

项目通过 GitHub Actions 自动构建多平台镜像（`linux/amd64` + `linux/arm64`），发布至 GitHub Container Registry：

```bash
# 拉取最新镜像
docker pull ghcr.io/bmbxwbh/epay-miuix:main

# 或使用特定版本标签
docker pull ghcr.io/bmbxwbh/epay-miuix:1.0.0
```

### 手动部署

需要 PHP ≥ 7.4 + MySQL 5.7+ + Nginx/Apache。

1. 将项目文件上传至 Web 根目录
2. 导入 `install/install.sql` 到数据库
3. 编辑 `config.php` 填写数据库信息
4. 访问 `/install/` 完成安装
5. 配置 Nginx 伪静态（见下方）

---

## Nginx 配置

### 伪静态规则

```nginx
location / {
    if (!-e $request_filename) {
        rewrite ^/(.[a-zA-Z0-9\-\_]+)\.html$ /index.php?mod=$1 last;
    }
    rewrite ^/pay/(.*)$ /pay.php?s=$1 last;
    rewrite ^/api/(.*)$ /api.php?s=$1 last;
    rewrite ^/doc/(.[a-zA-Z0-9\-\_]+)\.html$ /index.php?doc=$1 last;
}
```

### 安全目录拦截

```nginx
location ^~ /plugins/   { deny all; }
location ^~ /includes/  { deny all; }
location ^~ /install/   { deny all; }
location ~* \.(sql|log|bak|lock)$ { deny all; }
location ~ /\. { deny all; }
```

### 完整 Nginx 配置

```nginx
server {
    listen 80;
    server_name pay.example.com;
    root /path/to/epay-miuix;
    index index.php;

    # 安全：禁止访问敏感目录
    location ^~ /plugins/   { deny all; }
    location ^~ /includes/  { deny all; }
    location ^~ /install/   { deny all; }
    location ~* \.(sql|log|bak|lock)$ { deny all; }
    location ~ /\. { deny all; }

    # 伪静态
    location / {
        if (!-e $request_filename) {
            rewrite ^/(.[a-zA-Z0-9\-\_]+)\.html$ /index.php?mod=$1 last;
        }
        rewrite ^/pay/(.*)$ /pay.php?s=$1 last;
        rewrite ^/api/(.*)$ /api.php?s=$1 last;
        rewrite ^/doc/(.[a-zA-Z0-9\-\_]+)\.html$ /index.php?doc=$1 last;
    }

    # PHP-FPM
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # 静态资源缓存
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff2?|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
        access_log off;
    }

    # 安全头
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;

    client_max_body_size 10m;
}
```

---

## 反向代理配置

当 Nginx 作为前端反代（SSL 终结），后端跑在内网或 Docker 中：

```nginx
server {
    listen 443 ssl http2;
    server_name pay.example.com;

    ssl_certificate     /etc/nginx/ssl/pay.example.com.pem;
    ssl_certificate_key /etc/nginx/ssl/pay.example.com.key;
    ssl_protocols TLSv1.2 TLSv1.3;

    # 反代到后端
    location / {
        proxy_pass http://127.0.0.1:8080;
        proxy_set_header Host              $host;
        proxy_set_header X-Real-IP         $remote_addr;
        proxy_set_header X-Forwarded-For   $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_set_header Referer           $http_referer;
        proxy_connect_timeout 30s;
        proxy_send_timeout    60s;
        proxy_read_timeout    60s;
    }

    # 静态资源直接由 Nginx 服务
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg|woff2?|ttf|eot)$ {
        root /path/to/epay-miuix;
        expires 30d;
        access_log off;
    }

    # 安全：敏感目录拦截
    location ^~ /plugins/   { return 403; }
    location ^~ /includes/  { return 403; }
    location ^~ /install/   { return 403; }
    location ~* \.(sql|log|bak|lock)$ { return 403; }

    add_header Strict-Transport-Security "max-age=31536000" always;
    client_max_body_size 10m;
}

# HTTP → HTTPS 强制跳转
server {
    listen 80;
    server_name pay.example.com;
    return 301 https://$host$request_uri;
}
```

### 反代注意事项

1. **真实 IP 传递**：确保 `X-Real-IP` / `X-Forwarded-For` 正确传递，否则风控、日志、IP 地理校验将失效
2. **防止 IP 伪造**：在 Nginx 反代层配置 `set_real_ip_from` 定义可信代理 IP
3. **支付回调 URL**：后台「系统设置 → 网站 URL」必须填公网地址（如 `https://pay.example.com/`），不能填内网地址
4. **Referer 校验**：反代需透传 `Referer` 头，否则部分安全校验会失败
5. **HTTPS 协议头**：反代需传递 `X-Forwarded-Proto: https`，否则 PHP 的 `is_https()` 判断错误

---

## MiUI 设计重构

本分支对全站界面进行了 MiUI (HyperOS) 设计语言重构：

### 设计特点
- **纯色背景**：移除所有背景图片和渐变，统一使用纯色背景
- **现代图标**：采用 stroke-based SVG 图标系统，简约高级风格
- **卡片式布局**：圆角 16px + 轻阴影 + 1px 边框
- **暗色模式**：自动适配 `prefers-color-scheme: dark`
- **设计令牌**：统一使用 CSS 变量（`--mx-accent`、`--mx-bg`、`--mx-text-primary` 等）

### 已重构区域
| 区域 | 说明 |
|---|---|
| 收银台 | `cashier.php` 主收银台页面 |
| 支付页面 | `paypage/` 全部子页面（红包、转账、成功、失败） |
| 用户中心 | `user/` 通过 `head.php` 统一注入 MiUI 样式 |
| 管理后台 | `admin/` 通过 `head.php` 统一注入 MiUI 样式 |
| 前台模板 | `template/index1~index10` 共 10 套首页模板 |
| 默认模板 | `template/default/` 首页、文档、协议等 |
| 安装向导 | `install/index.php` 全新 MiUI 风格 |
| 插件页面 | `includes/pages/` 所有支付结果/跳转页面 |
| 文档页面 | `template/default/doc/` API 文档页面 |

### 技术实现
- **`assets/css/miuix.css`**：MiUI 设计系统核心样式
- **`assets/css/miuix-override.css`**：Bootstrap 3 视觉覆写层
- **`assets/doc/css/miuix-doc.css`**：文档页 MiUI 覆写
- **`includes/lib/mxicons.php`**：SVG 图标组件库（13 个图标）

---

## 更新日志

### 2026/05/12 - Cookie 安全修复 + Docker 支持
1. 修复全站登录 token cookie 传输损坏问题：`authcode` 编码输出含 `+` `/` 的 base64 字符串原样写入 cookie，在部分浏览器/反代环境下被损坏，统一添加 `rawurlencode` / `rawurldecode` 编解码
2. 影响范围覆盖全部 11 处 cookie 写入（管理员登录、TOTP 登录、用户登录、密钥登录、微信登录、OAuth 登录、QQ 登录、SSO）及 2 处读取
3. 新增 Docker 容器化部署支持（Nginx + PHP-FPM 单镜像）
4. 新增 GitHub Actions 自动构建多平台 Docker 镜像（amd64/arm64）
5. 新增 `docker-compose.yml` 一键部署（含 MySQL）
6. README 补充 Nginx 伪静态、反向代理完整配置文档

### 2026/05/10 - MiUI 设计重构
1. 全站界面迁移至 MiUI (HyperOS) 设计语言
2. 移除所有背景图片，统一纯色背景
3. 新增 SVG 图标系统，替换 Font Awesome 图标
4. 新增暗色模式自动适配
5. 重构 36 个用户可见页面
6. 净减少约 2000 行冗余代码

### 2026/05/10 - 紧急修复
1. 修复管理员登录后跳转循环：`setcookie` 的 path 参数传 `null` 导致 cookie 在部分环境下不可见，统一改为显式 `'/'`
2. 修复全部首页模板（index1~10 + default）CSS 路径错误：`STATIC_ROOT` 拼接 `../assets/css/miuix.css` 解析到不存在的路径，改为绝对路径 `/assets/css/miuix.css`
3. 修复退出登录时 cookie 清除路径与设置路径不一致

### 2026/02/28
1. 新增 H5 跳转微信小程序客服支付

### 2026/02/23
1. 新增抖音支付
2. 部分间连支付分账规则支持选择实时和延迟分账
3. 新增发起支付地区屏蔽设置

### 2026/01/28
1. 后台登录增加 TOTP 二次验证
2. 新增校验扫码 IP 所在地与下单 IP 所在地是否一致功能
3. 非官方微信支付插件可开启扫码支付前快捷登录，用于判断黑名单
4. 支付宝当面付支付前快捷登录已支持所有非官方支付插件
5. 增加获取微信小程序用户标识功能
6. 用户组增加更多配置项
7. 中转代理增加代理 API 的方式
8. 优化随机增减金额逻辑
9. 修改获取银行卡信息接口

---

## 推荐插件

推荐使用 **Bepusdt** 插件进行 USDT（TRC20）收款。
Bepusdt 是适用于NAILTEAM 支付系统的 USDT 收款插件，收到的货币直接转入商户钱包，不经过任何第三方。

**插件开源地址**：
🔗 [https://github.com/v03413/bepusdt](https://github.com/v03413/bepusdt)

---

## 许可证

本项目基于原版NAILTEAM 支付系统二次开发。
