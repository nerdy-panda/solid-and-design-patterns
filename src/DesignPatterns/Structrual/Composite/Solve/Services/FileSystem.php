<?php

namespace Nerdpanda\DesignPatterns\Structrual\Composite\Solve\Services;

abstract class FileSystem {
    protected string $name;
    public function __construct(string $name)
    {
        $this->name = $name ;
    }
    public function getName():string {
        return $this->name;
    }
    public function dump(int $indent = 0):void {
        echo str_repeat("\t",$indent).$this->getName().PHP_EOL;
    }
}