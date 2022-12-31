<?php

namespace Nerdpanda\DesignPatterns\Structrual\Composite\Problem\Services;

class File
{
    protected string $name;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function printName():void{
        dump($this->name);
    }
}