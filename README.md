# RHINOSHIELD_Exam

此專案使用 Docker Compose 來建立 PHP 開發環境，並且預先安裝了 Composer 和 PHPUnit。

## 需求
- Docker：請確認您的系統已安裝並啟動 Docker。
- Docker Compose：此設置使用 Docker Compose 版本 3.8。

## 設定與安裝
1. clone repository
將專案複製到本地環境：
```bash
git clone https://github.com/kai890707/RHINOSHIELD_Exam.git
cd RHINOSHIELD_Exam
```
2. 建構並啟動容器
使用以下指令構建並啟動容器：
```bash
docker-compose up --build
```
此命令將會：
- 基於 php:8.2-cli 構建 Docker 映像。
- 安裝系統所需的依賴，如 git、zip 和 libzip-dev。
- 安裝 zip PHP 擴展。
- 全域安裝 Composer。
- 全域安裝 PHPUnit。
3. 運行 Composer
當容器啟動並運行後，您可以在容器內運行 Composer 指令。
安裝專案的依賴：
```bash
docker-compose exec php composer install
```
4. 運行 PHPUnit 測試
您可以在容器內執行以下指令來運行 PHPUnit 測試：
```bash
docker-compose exec php phpunit
```
5. 停止容器
若要停止容器，請執行：
```bash
docker-compose down
```

## 專案路徑
1. 起始點
位於`app/public/index.php`，該檔案為類別使用的主要描述
2. 主要邏輯
位於`app/src/Service/Exam_one`
3. 測試
位於`app/testing`

## 檔案運行
- 若欲執行相關類別請於`index.php`中撰寫與使用，請執行
```bash
docker-compose exec php php app/public/index.php
```
- 若欲執行測試相關類別，請執行
```bash
docker-compose exec php app/vendor/bin/phpunit  app/tests/{filename}
```
例如執行`AbstractApiClientTest.php`測試，則執行
```bash
docker-compose exec php app/vendor/bin/phpunit  app/tests/AbstractApiClientTest.php
```

## 注意事項
`docker-compose.yml` 設定將當前目錄 (.) 掛載到容器內的 `/var/www/html` 路徑，請確保您的專案文件位於正確的目錄中。