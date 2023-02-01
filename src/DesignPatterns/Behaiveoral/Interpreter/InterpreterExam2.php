<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php 
interface expressionContract {
    public function interpret():int ;
}
class operand  implements expressionContract  {
    protected int $value;
    public function __construct(int $value)
    {
        $this->value = $value; 
    }
    public function interpret():int
    {
        return $this->value;
    }
}
abstract class operator implements expressionContract {
    protected int $first_number;
    protected int $second_number;
    public function  __construct(int $first_number , int $second_number)
    {
        $this->first_number = $first_number ;
        $this->second_number = $second_number;
    }
}
class addOperator extends operator {
    public function interpret(): int
    {
        return $this->first_number + $this->second_number;
    }
}
class subOperator extends operator {
    public function interpret(): int
    {
        return $this->first_number - $this->second_number;
    }
}
interface  expressionSpotterContract{
    public function operators():array;
    public function operands():array;
}
class expressionSpotter implements expressionSpotterContract {
    protected string $expression;
    public function __construct(string $expression)
    {
        $this->expression = $expression;
    }
    public function operators():array {
        $result = [];
        $pattern = '/-|\+/im';
        preg_match_all($pattern,$this->expression,$result);
        $result = $result[0];
        return $result;
    }
    public function operands():array {
        $result = [];
        $pattern = '/\d+/im';
        preg_match_all($pattern,$this->expression,$result);
        $result = $result[0];
        return $result;
    }
}
class calculator implements expressionContract{
    protected expressionSpotterContract $spotter;
    public function __construct(expressionSpotterContract $spotter)
    {
        $this->spotter = $spotter;
    }
    public function interpret(): int
    {
        $calculations = [];
        $operands = $this->spotter->operands();
        $operators = $this->spotter->operators();
        $operatorsMap = ['+'=> addOperator::class , '-'=>subOperator::class];
        foreach ($operators as $key => $operator) {
            if($key===0){
                $first_number = new operand($operands[0]);
                $second_number = new operand($operands[1]);
                $first_number = $first_number->interpret();
                $second_number = $second_number->interpret();
                $calculations[$key]= new $operatorsMap[$operator]($first_number,$second_number);
                $calculations[$key] = $calculations[$key]->interpret();
            }
            else 
            {
                $first_number = new operand($calculations[$key-1]);
                $second_number = new operand($operands[$key+1]);
                $first_number = $first_number->interpret();
                $second_number = $second_number->interpret();
                $calculations[$key]= new $operatorsMap[$operator]($first_number,$second_number);
                $calculations[$key] = $calculations[$key]->interpret();
            }
        }
        return end($calculations);
    }
}
?>
<?php
// $first_operand = new operand(12);
// $second_operand = new operand(18);
// $addOperator = new addOperator($first_operand->interpret(),$second_operand->interpret());
// $subOperator = new subOperator($first_operand->interpret(),$second_operand->interpret());
// $combo = new addOperator($addOperator->interpret(),$subOperator->interpret());
// dump($combo->interpret());
?>
<?php 
$expression = '12+6-4';
$expressionSpotter = new expressionSpotter($expression);
$calculator = new calculator($expressionSpotter);
$result = $calculator->interpret();
dump("{$expression}={$result}");
?>