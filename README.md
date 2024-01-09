# php-watch 
Мониторинг изменений в `*.php` файлах.
## Установка 
```bash
composer require fmihel/php-watch 
``` 
## Быстрый старт :
(```Пример: запуск тестов PHPUnit на каждое изменение файлов```)
#### 1. Определить `watch.config.php`
```php
<?php
$config=[
    'paths'=>['./tests/server/'],
    'exec'=>'./vendor/bin/phpunit --verbose tests/server'
    // Alert!! --------------------
    // on WINDOWS use absolute path
    //'exec'=>'c:/work/project/vendor/bin/phpunit --verbose tests/server'
    // ----------------------------
];    
```
#### 2. Запустить скрипт 
```bash
php ./vendor/fmihel/php-watch/watch.php
```

## Параметры `watch.php` 
#### Переименование файла конфигурации
```watch.php [<CUSTOM-FILE-NAME>]```

Пример:
```bash
php ./vendor/fmihel/php-watch/watch.php my.config.php 
```

## Пераметры `watch.config.php`
```php
$config=[
    'paths'=>[...], // список путей мониторинга 
    'exec'=>'',     // строка запуска, если произошли изменения
    'interval'=>2,  // интервал сканирования
    'limit'=>-1,    // кол-во сканирований, после которого скрипт
                    // остановится. -1 - бесконечно 
];    
```

## class ```Watcher```
#### методы:
|имя|параметры|описание|
|----|----|----|
|`construct`(array $paths)|`$paths` - массив путей мониторинга|создает экземпляр класса|
|`watch`($callback,$inteval=2,$limit=-1)|`$callback` вызываемая ф-ция если произошли изменения<br>`$inteval` - интервал мониторинга в сек.<br> `$limit` -  кол-во сканирований, после которого скрипт остановится, -1 - бесконечно|НЕБЛОКИРУЮЩИЙ заупуск процесса мониторинга  |


---


