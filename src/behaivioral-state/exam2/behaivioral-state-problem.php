<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
class article {
    protected string $title;
    protected string $body;
    protected int $state;
    public function __construct(string $title , string $body , int $state)
    {
        $this->title = $title ;
        $this->body = $body;
        $this->state = $state;
    }

    public function getState():int
    {
        return $this->state;
    }

    public function getStringState():string {
        $state = null;
        switch($this->getState()){
            case 0 : 
                $state = 'deleted';
            break;
            case 1 : 
                $state = 'draft';
            break;
            case 2 : 
                $state = 'published';
            break;
            default :
                $state = 'unknow';
            break;
        }
        return $state;
    }
    public function setStringState(string $state):void {
        $state = strtolower($state);
        switch($state){
            case 'deleted': 
                $this->state = 0;
            break;
            case 'draft': 
                $this->state = 1;
            break;
            case 'published': 
                $this->state = 2;
            break;
            default : 
                throw new Exception($state.' -> is not supported');
        }
    }
    
    public function setState(int $state):void
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
$articles[] = new article('who is nerdpanda','nerdpanda is developer ',0);
$articles[] = new article('how i can  buid pc ','very ez ',1);
$articles[] = new article('how i can make mony with programing ','build your ideas',2);
?>
<?php 
foreach($articles as $article)
    dump($article->getTitle().' -> '.$article->getStringState());
?>