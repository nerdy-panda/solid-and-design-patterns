<?php

namespace Nerdpanda\DesignPatterns\Structrual\Composite\Problem\Services;

class Driver
{
    protected string $name;
    protected array $directories;
    protected array $files;
    public function __construct(
        string $name , array $directories = [] , array $files = []
    )
    {
        $this->name = $name ;
        $this->directories = $directories ;
        $this->files = $files;
    }
    public function format():bool {
        dump('formatting....');
        return true;
    }
    public function ls():void{
        foreach ($this->directories as $directory)
            $directory->ls();
        foreach ($this->files as $file)
            $file->printName();
    }

    public function newFolder(Directory $folder):void
    {
        $this->directories[] = $folder;
    }
    public function newFile(File $file):void{
        $this->files[] = $file;
    }
}