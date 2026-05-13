#!/bin/bash
set -e

# ──────────────────────────────────────────────
# NAILTEAM 支付系统 MiUI Edition — 一键部署脚本
# ──────────────────────────────────────────────

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m'

info()  { echo -e "${CYAN}[INFO]${NC} $1"; }
ok()    { echo -e "${GREEN}[OK]${NC} $1"; }
warn()  { echo -e "${YELLOW}[WARN]${NC} $1"; }
err()   { echo -e "${RED}[ERROR]${NC} $1"; exit 1; }

# ── 检查依赖 ──
check_deps() {
    for cmd in docker; do
        command -v $cmd &>/dev/null || err "未找到 docker，请先安装: https://docs.docker.com/get-docker/"
    done

    # docker compose (v2 plugin) 或 docker-compose (standalone)
    if docker compose version &>/dev/null; then
        COMPOSE="docker compose"
    elif command -v docker-compose &>/dev/null; then
        COMPOSE="docker-compose"
    else
        err "未找到 docker compose，请升级 Docker 或安装 docker-compose"
    fi
}

# ── 交互式配置 ──
ask_config() {
    echo ""
    echo -e "${CYAN}═══════════════════════════════════════════${NC}"
    echo -e "${CYAN}  NAILTEAM 支付系统 MiUI Edition 一键部署${NC}"
    echo -e "${CYAN}═══════════════════════════════════════════${NC}"
    echo ""

    read -p "访问端口 [8080]: " PORT
    PORT=${PORT:-8080}

    read -p "MySQL root 密码: " MYSQL_ROOT_PWD
    [ -z "$MYSQL_ROOT_PWD" ] && MYSQL_ROOT_PWD=$(openssl rand -hex 12)
    info "MySQL root 密码: $MYSQL_ROOT_PWD"

    read -p "MySQL 数据库名 [epay]: " MYSQL_DB
    MYSQL_DB=${MYSQL_DB:-epay}

    read -p "MySQL 用户名 [epay]: " MYSQL_USER
    MYSQL_USER=${MYSQL_USER:-epay}

    read -p "MySQL 用户密码: " MYSQL_PWD
    [ -z "$MYSQL_PWD" ] && MYSQL_PWD=$(openssl rand -hex 12)
    info "MySQL 用户密码: $MYSQL_PWD"
}

# ── 生成 docker-compose.yml ──
gen_compose() {
    cat > docker-compose.yml <<EOF
services:
  epay:
    image: ghcr.io/bmbxwbh/epay-miuix:main
    container_name: epay-miuix
    restart: unless-stopped
    ports:
      - "${PORT}:80"
    volumes:
      - epay-data:/var/www/html/includes
    environment:
      - TZ=Asia/Shanghai
    depends_on:
      mysql:
        condition: service_healthy

  mysql:
    image: mysql:8.0
    container_name: epay-mysql
    restart: unless-stopped
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PWD}
      MYSQL_DATABASE: ${MYSQL_DB}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PWD}
    volumes:
      - mysql-data:/var/lib/mysql
    command: --default-authentication-plugin=mysql_native_password --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost", "-u", "root", "-p\${MYSQL_ROOT_PWD}"]
      interval: 5s
      timeout: 3s
      retries: 10

volumes:
  epay-data:
  mysql-data:
EOF
    ok "已生成 docker-compose.yml"
}

# ── 启动服务 ──
start_services() {
    info "拉取镜像并启动服务..."
    $COMPOSE up -d

    info "等待 MySQL 就绪..."
    sleep 10

    ok "服务启动完成！"
}

# ── 输出结果 ──
print_result() {
    echo ""
    echo -e "${GREEN}═══════════════════════════════════════════${NC}"
    echo -e "${GREEN}  部署成功！${NC}"
    echo -e "${GREEN}═══════════════════════════════════════════${NC}"
    echo ""
    echo -e "  安装向导:  ${CYAN}http://localhost:${PORT}/install/${NC}"
    echo -e "  管理后台:  ${CYAN}http://localhost:${PORT}/admin/${NC}"
    echo ""
    echo -e "  数据库主机:  ${YELLOW}mysql${NC}"
    echo -e "  数据库端口:  ${YELLOW}3306${NC}"
    echo -e "  数据库名:    ${YELLOW}${MYSQL_DB}${NC}"
    echo -e "  数据库用户:  ${YELLOW}${MYSQL_USER}${NC}"
    echo -e "  数据库密码:  ${YELLOW}${MYSQL_PWD}${NC}"
    echo ""
    echo -e "  管理命令:"
    echo -e "    查看日志:  ${CYAN}${COMPOSE} logs -f${NC}"
    echo -e "    停止服务:  ${CYAN}${COMPOSE} down${NC}"
    echo -e "    更新版本:  ${CYAN}${COMPOSE} pull && ${COMPOSE} up -d${NC}"
    echo ""
}

# ── 主流程 ──
main() {
    check_deps
    ask_config
    gen_compose
    start_services
    print_result
}

main "$@"
