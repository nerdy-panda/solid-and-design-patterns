<?php

namespace Nerdpanda\DesignPatterns\Structrual\Composite\Problem\Services;

class Dir
{
    public function ls():void{
        foreach ($this->directories as $directory)
            $directory->ls();
        foreach ($this->files as $file)
            $file->info();
    }

    public function newFolder(Directory $folder):void
    {
        $this->directories[] = $folder;
    }
    public function newFile(File $file):void{
        $this->files = $file;
    }
}