<?php require dirname(__DIR__,2).'/vendor/autoload.php';?>
<?php 
class fileReader {
    protected array $lines;
    public function __construct(string $file)
    {
        $file = file_get_contents($file);
        $pattern = '/^.+$/im';
        preg_match_all($pattern,$file,$file);
        $this->lines = $file[0];
    }
    public function iterator():lineIteratorContract {
        return lineIteratorFactory::make($this->lines);
    }
}
interface lineIteratorContract {}
class lineIterator implements lineIteratorContract {
    protected array $lines;
    protected int $pointer = 0;
    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }
    public function hasNext():bool {
        return $this->pointer < $this->count();
    }
    public function next():string {
        return $this->lines[$this->pointer++];
    }
    public function count():int {
        return sizeof($this->lines);
    }
}
class lineIteratorFactory {
    public static function make(array $lines):lineIteratorContract {
        return new lineIterator($lines);
    }
}
?>
<?php 
$reader = new fileReader(__FILE__);
$iterator = $reader->iterator();
// for($counter = 0 ; $counter < $reader->count() ; $counter++){
//     dump($reader->next());
//     echo str_repeat(PHP_EOL,2);
// }
while($iterator->hasNext())
    dump($iterator->next());
?>