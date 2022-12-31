<?php

class DateDiff
{
    protected DateTime $firstDateTime;
    protected DateTime $secondDateTime;
    public function __construct(
        DateTime $firstDateTime ,
        DateTime $secondDateTime,
    )
    {
        $this->firstDateTime = $firstDateTime ;
        $this->secondDateTime = $secondDateTime ;
    }

    public function getFirstDateTime():DateTime {
        return $this->firstDateTime;
    }
    public function getSecondDateTime():DateTime {
        return $this->secondDateTime;
    }
    public function setFirstDateTime(DateTime $dateTime):void{
        $this->firstDateTime = $dateTime;
    }
    public function setSecondDateTime(DateTime $dateTime):void {
        $this->secondDateTime = $dateTime;
    }
    public function diff():DateInterval{
        return $this->firstDateTime->diff($this->secondDateTime);
    }
}