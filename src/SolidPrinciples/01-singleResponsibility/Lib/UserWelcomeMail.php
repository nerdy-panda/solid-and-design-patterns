<?php
class UserWelcomeMail {
    private string $email;
    public function __construct(string $email)
    {
        $this->email = $email ;
    }

    public function send()
    {
        echo "send email to {$this->email}<br>";
    }
}