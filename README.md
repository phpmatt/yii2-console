### 安装
1. git clone https://github.com/phpmatt/yii2-console.git
2. composer install
3. ./yii migrate
### 配置数据库信息
config/db.php
### URL美化
```
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
    ],
],
```
### 运行
./yii serve --port=1024
http://localhost:1024/console