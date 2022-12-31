<?php
require_once __DIR__.'/Lib/User.php';
require_once __DIR__.'/Lib/UserWelcomeMail.php';
$panda = new User('nerd','20','nerdpanda@gmail.com');
$pandaWelcomeMail = new UserWelcomeMail($panda->getEmail());
$panda->create();
$pandaWelcomeMail->send();