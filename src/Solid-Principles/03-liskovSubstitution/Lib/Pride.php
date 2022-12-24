<?php

class Pride extends Car
{

    /**
     * @return int
     * change behaivor from parrent 
     * parrent return object but this return integer
     */
    public function diffWithNow(){
        $now = new DateTime("now");
        return $now->getTimestamp();
    }
}