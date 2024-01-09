<?php

use fmihel\config\Config;
use fmihel\watch\Watcher;

require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/source/Watcher.php';

$SEP = Watcher::is_win() ? '\\' : '/';

$pwd = getcwd() . $SEP;
$configName = count($argv) > 1 ? $argv[1] : $pwd . 'watch.config.php';

if (file_exists($configName)) {
    Config::loadFromFile($configName);
}

$paths = Config::get('paths', [$pwd]);
if (Watcher::is_win()) {
    $abs = [];
    foreach ($paths as $path) {
        $abs[] = realpath($path) . $SEP;
    }
    $paths = $abs;
}

$exec = Config::get('exec', '');
$interval = Config::get('interval', 1);
$limit = Config::get('limit', -1);

$watcher = new Watcher($paths);

$watcher->watch(function () use ($exec) {
    if ($exec) {
        $ret = [];
        exec($exec, $ret);
        foreach ($ret as $line) {
            print $line . "\n";
        }
    } else {
        print 'change..' . "\n";
    }
}, $interval, $limit);
