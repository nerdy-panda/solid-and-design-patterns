<?php require dirname(__DIR__,2).'/vendor/autoload.php';?>
<?php 
interface articleContract {
    public function getBody():string;
    public function setBody(string $body):void;
}
class article implements articleContract{
    protected string $body;
    public function __construct(string $body) {
        $this->body = $body;
    }
    public function getBody():string {
        return $this->body;
    }
    public function setBody(string $body):void {
        $this->body = $body;
    }
}
interface saverContract {
    public function save():void;
}
abstract class saver implements saverContract {
    protected string $body;
    public function __construct(string $body)
    {
        $this->body = $body;
    }
    public function getBody():string {
        return $this->body;
    }
    public function setBody(string $body):void {
        $this->body = $body;
    }
}
class oneDriveSaver extends saver {
    public function save():void {
        dump("save -> {$this->body} -> to OneDriver");
    }
}
class GoogleDriveSaver extends saver {
    public function save():void {
        dump("save -> {$this->body} -> to GoogleDriver");
    }
}
interface subjectContract {
    public function addSaver(saverContract $saver):void;
    public function removeSaver(saverContract $saver):void;
    public function getSavers():array;
    public function getArticle():articleContract;
    public function setArticle(articleContract $article):void;
    public function save():void;
    public function update(string $body):void;
}

abstract class subject implements subjectContract {
    protected array $savers;
    protected articleContract $article;
    public function __construct(articleContract $article , saverContract ...$savers)
    {
        $this->article= $article ;
        $this->savers = $savers;
    }
    public function addSaver(saverContract $saver):void {
        $this->savers[] = $saver;
    }
    public function removeSaver(saverContract $saver):void {
        $this->savers = array_filter($this->savers , fn($saverItem)=> $saverItem!=$saver);
    }
    public function getSavers():array {
        return $this->savers;
    }
    public function getArticle():articleContract {
        return $this->article;
    }
    public function setArticle(articleContract $article):void {
        $this->article = $article;
    }
    public function save():void {
        foreach($this->savers as $saver)
            $saver->save();
    }
    public function update(string $body): void
    {
        $this->article->setBody($body);
        foreach($this->savers as $saver)
            $saver->setBody($body);
    }
}
class articleController extends subject {
    
}
?>
<?php
$article =  new article('hey im nerdpanda ');
$oneDrive = new oneDriveSaver($article->getBody());
$controller = new articleController($article,$oneDrive);
$controller->save();

dump(str_repeat("==",64));
//=====================================================================
$googleDriver = new GoogleDriveSaver($article->getBody());
$controller->addSaver($googleDriver);
$controller->update('hey im nerdpanda im back end developer');
$controller->save();

dump(str_repeat("==",64));
//=====================================================================
$controller->removeSaver($googleDriver);
$controller->update('hey im nerdpanda im back end developer for enterprise web apps');
$controller->save();

?>