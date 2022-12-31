<?php
class User{
    private string $name;
    private int $age;
    private string $email;
    public function __construct(
        string $name,
        string $age,
        string $email
    )
    {
        $this->name = $name ;
        $this->age = $age;
        $this->email = $email;
    }
    public function getName():string {
        return $this->name;
    }
    public function setName(string $name):void {
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }


    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function create()
    {
        echo "create user  <br>";
    }

    public function update()
    {
        
    }

//    public function sendWelcomeEmail(){
//
//    }
}