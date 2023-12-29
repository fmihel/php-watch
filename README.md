# php-watch v0.0.1
Мониторинг изменений в файлах.
### Установка / Install
```bash
composer require fmihel/php-watch 
``` 
### Быстрый старт / Quickstart example:
(```Пример: запуск тестов PHPUnit на каждое изменение файлов```)
1. Определить `watch.config.php`
```php
<?php
$config=[
    'paths'=>[
        './tests/server/'
    ],
    'exec'=>'./vendor/bin/phpunit --verbose tests/server'
];    
```
2. Запустить скрипт 
```bash
php ./vendor/fmihel/php-watch/source/watch.php

```

