<?php require dirname(__DIR__,3).'/vendor/autoload.php';?>
<?php 
class vim {
    protected string $mode;
    public function __construct(string $mode)
    {
        $this->mode = $mode;
    }
    public function getMode():string 
    {
        return $this->mode;
    }
    public function setMode(string $mode):void
    {
        $this->mode = $mode;
    }
    public function switch():void {
        $mode = strtolower($this->mode);
        if($mode=='normal')
            $this->mode = 'insert';
        else if($mode=='insert')
            $this->mode = 'normal';
        else 
            throw new Exception($mode.' mode is not detected ');
    }
}
?>
<?php 
// normal || insert 
$vim = new vim('normal');
dump($vim);
$vim->switch();
dump($vim);
?>