<?php
class Car {
    protected string $name;
    protected DateTime $created;
//    protected DateDiff $dateDiff;
    public function __construct(
        string $name,
        DateTime $created ,
//        DateDiff $dateDiff
    ) {
        $this->name = $name;
        $this->created = $created;
//        $this->dateDiff = $dateDiff;
    }

    public function getName():string {
        return $this->name;
    }

    /**
     * @return DateInterval
     */
    public function diffWithNow(){
        $now = new DateTime("now");
        return $this->created->diff($now);
    }
    public function getAge():int{
        return $this->diffWithNow()->y;
    }
}