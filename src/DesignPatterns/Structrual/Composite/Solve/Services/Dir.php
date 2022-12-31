<?php

namespace Nerdpanda\DesignPatterns\Structrual\Composite\Solve\Services;

class Dir extends FileSystem {
    protected array $content;
    public function __construct(string $name , fileSystem ...$fileSystem)
    {
        parent::__construct($name);
        $this->content = $fileSystem;
    }
    public function getContent():array {
        return $this->content;
    }
    public function put(fileSystem $fileSystem):void {
        $this->content[] = $fileSystem;
    }
    public function pull(fileSystem $fileSystem):void {
        $filtered = array_filter($this->content,fn(fileSystem $item)=> $fileSystem!=$item);
        $this->content = $filtered;
    }
    public function dump(int $indent = 0):void {
        parent::dump($indent++);
        foreach($this->getContent() as $content){
            $content->dump($indent);
        }
    }
}