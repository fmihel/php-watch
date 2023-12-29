<?php

use fmihel\config\Config;
use fmihel\console;
use fmihel\lib\Dir;
use fmihel\watch\Watcher;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__.'/Watcher.php';



$pwd = getcwd().'/';
$configName = count($argv)>1 ? $argv[1] : $pwd.'watcher.config.php';

if (file_exists($configName)){
    Config::loadFromFile($configName);
};

$paths = Config::get('paths',[$pwd]);
$exec = Config::get('exec','');
$interval = Config::get('interval',1);
$limit = Config::get('limit',-1);

$watcher = new Watcher($paths);

$watcher->watch(function() use ($exec) {
    if ($exec){ 
        exec($exec, $ret);
        foreach ($ret as $line) {
            print $line . "\n";
          }
    }else{
        print 'change..'."\n";
    }
 },$interval,$limit);


