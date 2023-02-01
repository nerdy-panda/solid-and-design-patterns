<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
interface dictionaryContract {
    public function getChar(string $charKey):?string;
    public function getCharMap():array;
}
class dictionary implements dictionaryContract{
    protected array $charMap = [
        'a'=>'آ' , 
        'b' => 'ب'
    ];
    public function getCharMap():array {
        return $this->charMap;
    }
    public function getChar(string $charKey):?string {
        return $this->charMap[$charKey]??null;
    }
}
class dictionaryFactory {
    protected static dictionaryContract $instance;
    public static function make():dictionaryContract {
        if(isset($instance))
            return self::$instance;
        else 
            return self::$instance = new dictionary;
    }
}
interface expressionContract {
    public function interpret(array $charMap):string;
}
interface charContract extends expressionContract {}
class char implements charContract {
    protected string $char;
    public function __construct(string $char)
    {
        $this->char = $char;
    }
    public function interpret(array $charMap): string
    {
        return $charMap[$this->char];
    }
}
class charFactory {
    protected static array $chars = [];
    public static function make(string $char):charContract {
        if(array_key_exists($char,self::$chars))
            return self::$chars[$char];
        else 
            return self::$chars[$char] = new char($char);
    }
}
class expressionSpotter implements expressionContract {
    protected string $expression ;
    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }
    public function getExpression():string {
        return $this->expression;
    }
    public function setExpression(string $expression):void {
        $this->expression = $expression;
    }
    public function interpret(array $charMap): string
    {
        $result = '';
        $expressions = str_split($this->expression);
        foreach($expressions as $expression){
            $char = charFactory::make($expression);
            $result .= $char->interpret($charMap);
        }
        return $result;
    }

}
?>
<?php 
//this text is finglish (farsi word but with english chars)

$expression = 'baba'; // -> dad , father .....
$dictionary =  dictionaryFactory::make();
$expressionSpotter = new expressionSpotter($expression);
$converted = $expressionSpotter->interpret($dictionary->getCharMap());
dump($converted);

$expressionSpotter->setExpression('ab'); // ab -> water 
dump($expressionSpotter->interpret($dictionary->getCharMap()));
?>
<?php 











# finglish to persina 
# arra.item 
#ubuntu command to windows 
#ubuntu shortcut to windows 
#calc 
?>