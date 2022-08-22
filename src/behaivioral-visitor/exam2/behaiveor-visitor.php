<?php require_once dirname(__DIR__,3).'/vendor/autoload.php'; ?>
<?php 
interface visitorContract {
    public function visit(visitableContract $visitable):void;
}
interface visitableContract {
    public function accept(visitorContract $visitor):void;
    public function accepts(visitorContract ...$visitors):void;
}
class article implements visitableContract {
    protected string $title;
    protected string $content;
    public function __construct(string $title , string $content)
    {
        $this->title = $title ; 
        $this->content = $content ;
    }
    public function getTitle():string {
        return $this->title;
    }
    public function setTitle(string $title):void {
        $this->title = $title;
    }
    public function getContent():string {
        return $this->content;
    }
    public function setContent(string $content):void {
        $this->content = $content;
    }
    public function accept(visitorContract $visitor): void
    {
        $visitor->visit($this);
    }
    public function accepts(visitorContract ...$visitors): void
    {
        foreach($visitors as $visitor)
            $this->accept($visitor);
    }
}
class contentTrimer implements visitorContract {
    public function visit(visitableContract $visitable): void {
        $content = $visitable->getContent();
        $content = trim($content," ");
        $content = preg_replace("/\s+/", " ", $content);
        $visitable->setContent($content);
    }
}
class linkPlacer implements visitorContract {
    public function visit(visitableContract $visitable): void
    {
        $content = $visitable->getContent();
        $content = str_replace('[link]','http://nerdpanda.ir',$content);
        $visitable->setContent($content);
    }
}
class trimTitle implements visitorContract {
    public function visit(visitableContract $visitable): void {
        $title = $visitable->getTitle();
        $title = trim($title);
        $visitable->setTitle($title);
    }
}
class titleSluger implements visitorContract {
    public function visit(visitableContract $visitable): void
    {
        $visitable->setTitle(
            str_replace(' ','-',$visitable->getTitle())
        );
    }
}
$helloWorld = new article('        hello world','this world made for [link]        this world is      very nice       ');
dump($helloWorld);
$titleTrimer = new trimTitle;
$titleSluger = new titleSluger;
$contentTrimer = new contentTrimer;
$linkPlacer = new linkPlacer;
$helloWorld->accept($titleTrimer);
dump($helloWorld);
$helloWorld->accept($titleSluger);
dump($helloWorld);
$helloWorld->accept($contentTrimer);
dump($helloWorld);
$helloWorld->accept($linkPlacer);
dump($helloWorld);
?>