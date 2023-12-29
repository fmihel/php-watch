<?php
namespace fmihel\watch;

use fmihel\lib\Dir;
use React\EventLoop\Loop;


class Watcher{
    private $paths = [];
    private $files = [];
    private $timer;
    public function __construct(array $paths=[__DIR__.'/']) {
        $this->paths = $paths;
        $this->files = $this->getFiles();
    }
    private function getFiles():array{
        foreach($this->paths as $path){
            $files = Dir::files($path,'php',true,false);
            $out = [];
            foreach($files as $file){
                $out[] = ['file'=>$file,'t'=>filemtime($file)];
            }
        }
        return $out;
    }
    private function isChanged():bool{
        
        $news = $this->getFiles();
        if (count($news) !== count($this->files)){
            $this->files = $news;
            return true;
        }
        foreach($this->files as $file){
            $find = false;
            foreach($news as $new){
                if ($new['file'] === $file['file']){
                    $find = true;
                    if ($new['t']!==$file['t']){
                        $this->files = $news;
                        return true;
                    }
                    break;
                }
            }
            if (!$find){
                $this->files = $news;
                return true;
            }
        }
        return false;
    }

    public function watch($callback,$interval = 1,$limit=-1){

        $first = true;

        $this->timer = Loop::addPeriodicTimer($interval, function () use ($callback,&$first,&$limit){
            
            if ($first || $this->isChanged()){
                $callback();
                $first =  false;
            }

            $limit--;
            if ($limit === 0){
                Loop::cancelTimer($this->timer);
            }
        
        });
        print 'stop------------------------';
    }

}
