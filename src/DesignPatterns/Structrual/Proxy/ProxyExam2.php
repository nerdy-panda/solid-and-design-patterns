<?php require dirname(__DIR__,2).'/vendor/autoload.php';?>
<?php 
interface uploaderContract{
    public function upload(string $file,string $destination):bool;
}
class uploader implements uploaderContract {
    public function upload(string $file , string $destination):bool {
        return true;
    }
}
abstract class uploaderProxy implements uploaderContract {
    protected uploaderContract $uploader;
    public function __construct(uploaderContract $uploader)
    {
        $this->uploader = $uploader;
    }
}
class uploadWithCheckExistFile extends uploaderProxy{
    public function upload(string $file, string $destination): bool
    {
        if(file_exists($file))
            return $this->uploader->upload($file,$destination);
        else 
            throw new Exception("file {$file} not found ");
    }
}
class uploadWithCheckExistDestination extends uploaderProxy{
    public function upload(string $file, string $destination): bool
    {
        if(is_dir($destination))
            return $this->uploader->upload($file,$destination);
        else 
            throw new Exception("dir  {$destination} not found ");
    }
}
?>
<?php 
$file = __DIR__."/58iorCb";
$destination = __DIR__.'/media';
$uploader = new uploader();
$uploader = new uploadWithCheckExistDestination($uploader);
$uploader = new uploadWithCheckExistFile($uploader);
$uploaded = $uploader->upload($file,$destination);
?>
<?php
/*===== with out proxy =====*/
/*
$existDir = is_dir($destination);
$existFile = file_exists($file);
if ($existDir && $existFile){
    $uploader = new uploader();
    $uploaded = $uploader->upload($file,$destination);
}
elseif (!$existDir)
    throw new Exception("dir  {$destination} not found ");
elseif(!$existFile)
    throw new Exception("file {$file} not found ");
*/
?>
