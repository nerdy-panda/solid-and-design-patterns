<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
interface state {
    public function mode():string;
    public function switch(editor $editor):void;
}
class normalMode implements state {
    public function mode():string {
        return 'normal';
    }
    public function switch(editor $editor):void {
        $editor->setMode(new insertMode);
    }
}
class insertMode implements state {
    public function mode():string {
        return 'insert';
    }
    public function switch(editor $editor):void {
        $editor->setMode(new normalMode);
    }
}
interface editor {}
class vim implements editor {
    protected state $mode;
    public function __construct(state $mode)
    {
        $this->mode = $mode;
    }
    public function getMode():string 
    {
        return $this->mode;
    }
    public function setMode(state $mode):void
    {
        $this->mode = $mode;
    }
    public function switch():void {
        $this->mode->switch($this);
    }
}
?>
<?php 
// normal || insert 
$vim = new vim(new normalMode);
dump($vim);
$vim->switch();
dump($vim);
?>