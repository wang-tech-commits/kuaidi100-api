# kuaidi100-api

> 快递100API Laravel框架下使用
## 1.安装

```shell script
composer require wang-tech-commits/kuaidi100-api
```

## 2.初始化

```shell script
php artisan vendor:publish --provider="MrwangTc\Kuaidi100\ServiceProvider"
```

## 3.修改配置文件

## 4.开始使用

### 1.实时快递查询
```php
<?php

use MrwangTc\Kuaidi100\Express\Synquery;

$express = new Synquery();
$synQuery = $express->pollQuery('快递公司编码', '快递单号');
```

### 2.查询地图轨迹
```php
<?php

use MrwangTc\Kuaidi100\Express\Maptrack;

$express = new Maptrack();
$mapQuery = $express->mapQuery('快递公司编码', '快递单号');
```

### 3.智能单号识别
```php
<?php

use MrwangTc\Kuaidi100\Express\Autonumber;

$express = new Autonumber();
$auto    = $express->auto('快递单号');
```

## 陆续更新中……