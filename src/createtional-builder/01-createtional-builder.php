<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
class article {
    protected string $title;
    protected string $content;
    protected bool $published;

    public function getTitle():string
    {
        return $this->title;
    }

    public function setTitle(string $title):void
    {
        $this->title = $title;
    }

    public function getContent():string
    {
        return $this->content;
    }

    public function setContent(string $content):void
    {
        $this->content = $content;
    }

    public function getPublished():bool
    {
        return $this->published;
    }

    public function setPublished(bool $published):void
    {
        $this->published = $published;
    }
}
class articleBuilder{
    protected article $article;
    public function __construct(article $article)
    {
        $this->article = new article();
    }
    public function title(string $title):self {
        $this->article->setTitle($title);
        return $this;
    }
    public function content(string $content):self {
        $this->article->setContent($content);
        return $this;
    }
    public function published(bool $published):self {
        $this->article->setPublished($published);
        return $this;
    }
    public function getArticle():article {
        return $this->article;
    }
}

class Appplication {
    protected array $articles = [];
    public function __construct(array $articles)
    {
        $this->articles = array_map(function(array $article){
            return (new articleBuilder( new article))
                        ->title($article[0])
                        ->content($article[1])
                        ->published($article[2])
                        ->getArticle();
        },$articles);
    }
    public function getArticles():array {
        return $this->articles;
    }
    public function setArticles(array $articles):void {
        $this->articles = $articles ;
    }
}
$articles = [
    ['hello-world','world is very nice ',true] ,
    ['who is nerdPadna','nerdapanda is developer for enterprise applications',false] ,
];
$application = new Appplication($articles);
dump($application->getArticles());
?>