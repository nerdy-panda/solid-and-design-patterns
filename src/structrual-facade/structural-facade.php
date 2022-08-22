<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php
class uniqueDirectoryMaker {
    public function make(string $destination):string {
        return 'nmj4h21';
    }
}
class fileMover {
    public function move(string $from,string $to):bool {
        dump($from.' -> '.$to);
        return true;
    }
}
?>
<?php
$_FILES['avatar']['tmp_name'] = '/tmp/82jprye36';
$destination = __DIR__.'/media/';
##################################### normal usage #########################

$directoryMaker = new uniqueDirectoryMaker();
$fileMover = new fileMover();

$finalDestination = $destination.$directoryMaker->make($destination);
$fileMover->move($_FILES['avatar']['tmp_name'],$finalDestination);

##################################### EZ usage #########################

class fileUploader{
    protected fileMover $fileMover;
    protected uniqueDirectoryMaker $directoryMaker;
    public function __construct(fileMover $fileMover, uniqueDirectoryMaker $directoryMaker)
    {
        $this->fileMover = $fileMover;
        $this->directoryMaker = $directoryMaker;
    }
    public function getFileMover():fileMover{
        return $this->fileMover;
    }
    public function setFileMover(fileMover $fileMover):void {
        $this->fileMover = $fileMover;
    }
    public function getDirectoryMaker():uniqueDirectoryMaker {
        return $this->directoryMaker;
    }
    public function setDirectoryMaker(uniqueDirectoryMaker $directoryMaker):void
    {
        $this->directoryMaker = $directoryMaker ;
    }
    public function upload(string $file , string $destination):bool {
        $finalDestination = $this->directoryMaker->make($destination);
        return $this->fileMover->move($file,$finalDestination);
    }
}
$uploader = new fileUploader($fileMover,$directoryMaker);
$uploader->upload($_FILES['avatar']['tmp_name'],$destination);