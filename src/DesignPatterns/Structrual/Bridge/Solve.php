<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php
interface humanContract {
    public function getName():string;
    public function setName(string $name);
}
interface helloableContract {
    public function hello():void;
}
interface presentableContract {
    public function present():void;
}
interface talkableContract extends helloableContract , presentableContract {}
interface languageContract extends helloableContract {
    public function present(string $name): void;
}
class persianLanguage implements languageContract {
    public function hello():void 
    {
        dump('salam');
    }
    public function present(string $name): void
    {
        dump('man '.$name.' hastam ');
    }
}
class englishLanguage implements languageContract {
    public function hello():void 
    {
        dump('hey');
    }
    public function present(string $name): void
    {
        dump('im '.$name);
    }
}
class chienseLanguage implements languageContract {
    public function hello():void 
    {
        dump('嘿');
    }
    public function present(string $name): void
    {
        dump('我是'.$name);
    }
}
class human implements humanContract , talkableContract {
    protected string $name;
    protected languageContract $language;
    public function __construct(string $name , languageContract $language)
    {
        $this->name = $name ;
        $this->language = $language;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name ;
    }
    public function getLanguage():languageContract {
        return $this->language;
    }
    public function setLanguage(languageContract $language):void {
        $this->language = $language;
    }
    public function hello(): void
    {
        $this->language->hello();
    }
    public function present(): void
    {
        $this->language->present($this->name);
    }
}
?>
<?php 
class languageRepository {
    public $english  = englishLanguage::class ;
    public $persian = persianLanguage::class ;
    public $chiens = chienseLanguage::class ;
    public function __construct()
    {
        foreach(get_class_vars(self::class) as $key=> $value)
            $this->{$key} = new $value;
    }
}
?>
<?php 
function goNextLine():void {
    echo PHP_EOL;
}
?>
<?php 
$languages = new languageRepository;
$persianHuman = new human('mohammad reza',$languages->persian);
$chiensHuman = new human('diego',$languages->chiens);
$englishHuman = new human('john',$languages->english);


$persianHuman->hello();
$persianHuman->present();

goNextLine();

$chiensHuman->hello();
$chiensHuman->present();

goNextLine();

$englishHuman->hello();
$englishHuman->present();
?>