# 臺體大 - 桌球國手運動傷害評估系統程式說明

### API 程式使用 YII2-BASIC 框架開發

## 一、檔案目錄

```sh
ntus_sias
-- bin
---- mysql
---- webserver
-- config
---- php
---- vhosts
-- setup
---- mysql
------ init.sql
-- www
---- api
---- web
-- docker-compose.yml
-- .env
-- README.md
```

### **`/bin`** docker 部署環境時參考之安裝設定資料夾

### **`/config`** php、apache 設定檔放置區

### **`/setup/mysql/init.sql`** 此檔案為資料庫初始化資料與架構

### **`/www/api`** 為 **API** 程式放置資料夾

    /api/config/web.php     # 路由及其他引用模組設定
    /api/config/db.php      # 連線資料庫資料
    /api/module/v1          # 開發程式放置資料夾

### **`/www/web`** 為 **問卷填寫網頁** 程式放置資料夾

### ＊**`docker-compose.yml`** docker-compose 指令執行參照設定檔，系統部署時必須之檔案，不可缺失

### ＊**`.env`** docker-compose 指令執行參照設定檔

---

## 二、系統架設方式

1. 確定系統有安裝 docker、docker-compose
2. 將 `ntus_sias` 資料夾放置在任意目錄
3. 進入 `ntus_sias` 目錄
4. 使用 docker-compose 部署系統

```sh
docker-compose up -d --build
```

5. 預設 API 存取網址為

```sh
http://{hostname}:8100/api/web/v1/{resource}/{action}
```

6. 預設 問卷存取網址為

```sh
http://{hostname}:8100/web
```

7. 預設 phpmyadmin 頁面為

```sh
http://{hostname}:8102
```

8. API Spec.
連結：https://bit.ly/38RLHYf 

---

# 三、預設存取帳號等資訊

|                        |                      |                   |
| ---------------------- | -------------------- | ----------------- |
| 服務名稱               | 帳號                 | 密碼              |
| phpmyadmin、mysql      | sias_ntus            | sias_ntus20191101 |
| 問卷網頁 administrator | siasNtusAdmin_hidden |                   |

