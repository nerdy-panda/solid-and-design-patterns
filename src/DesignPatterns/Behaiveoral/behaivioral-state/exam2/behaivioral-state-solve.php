<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface stateContract {
    public function getState():string;
    public function getCode():int;
}
class state implements stateContract {
    protected string $state;
    protected int $code;
    public function getState():string {
        return $this->state;
    }
    public function getCode():int {
        return $this->code;
    }
}
class published extends state {
    public function __construct()
    {
        $this->state = 'published';
        $this->code = 2;
    }
}
class draft extends state {
    public function __construct()
    {
        $this->state = 'draft';
        $this->code = 1;
    }
}
class deleted extends state {
    public function __construct()
    {
        $this->state = 'deleted';
        $this->code = 0;
    }
}

class article {
    protected string $title;
    protected string $body;
    protected stateContract $state;
    public function __construct(string $title , string $body , stateContract $state)
    {
        $this->title = $title ;
        $this->body = $body;
        $this->state = $state;
    }

    public function getState():stateContract
    {
        return $this->state;
    }

    public function getStringState():string {
        return $this->state->getState();
    }
    public function getIntState():int {
        return $this->state->getCode();
    }

    public function setState(stateContract $state):void
    {
        $this->state = $state;
    }
 
    public function getBody():string
    {
        return $this->body;
    }


    public function setBody(string $body):void
    {
        $this->body = $body;
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function setTitle(string $title):void
    {
        $this->title = $title;
    }
}
?>
<?php 
$articles = [];
$articles[] = new article('who is nerdpanda','nerdpanda is developer ',new deleted);
$articles[] = new article('how i can  buid pc ','very ez ',new draft);
$articles[] = new article('how i can make mony with programing ','build your ideas',new published);
?>
<?php 
foreach($articles as $article)
    dump($article->getTitle().' -> '.$article->getIntState());
?>