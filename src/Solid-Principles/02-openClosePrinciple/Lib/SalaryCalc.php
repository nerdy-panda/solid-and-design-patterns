<?php
class SalaryCalc {
    private array $employees;
    public function __construct(array $employees)
    {
        $this->employees = $employees;
    }
    public function calc():int{
        $sum = 0;
        foreach ($this->employees as $employee)
            $sum += $employee->salary();
//            if ($employee instanceof Admin)
//                $sum += 35000;
//            else if ($employee instanceof Author)
//                $sum += 15000;
        return $sum;
    }
}