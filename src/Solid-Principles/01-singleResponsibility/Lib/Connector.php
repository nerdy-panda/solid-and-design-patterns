<?php
class Connector {
    /**
     connect() is no single responsibility because connect()  just should take connection
    but this method first make database connection and second  log connection error !!!!
     */

    public function connect(Logger $logger){
        try{
            $connection = new PDO('mysql');
        }
        catch(Exception $exception){
            $logger->error($exception->getMessage());
        }
    }
    /*
    */
    public function connect2(){
        return new PDO('mysql');
    }
}

?>