<?php require_once dirname(__DIR__,2).'/vendor/autoload.php'; ?>
<?php
interface userFinderContract {
    public function find(int $id):array;
}
class userFinder implements userFinderContract {
    public function find(int $id):array {
        dump('select * from `users` where `id`=\''.$id.'\'');
        return ['id'=>$id , 'name'=>'nerdpanda'];
    }
}
$userFinder = new userFinder();
/* $nerdpadna = $userFinder->find(1);
dump($nerdpadna); */
// in other codes 
/* $nerdpadna = $userFinder->find(1);
dump($nerdpadna); */

class userFinderProxy{
    protected userFinderContract $userFinder ;
    protected array $cache =[];
    public function __construct(userFinderContract $userFinder)
    {
        $this->userFinder = $userFinder ;
    }
    public function find(int $id):array {
        if(isset($this->cache[$id]))
            return $this->cache[$id];
        else 
            return $this->cache[$id] = $this->userFinder->find($id);
    }
}
$userFinderProxy = new userFinderProxy($userFinder);
$userFinderProxy->find(1);
$userFinderProxy->find(1);
$userFinderProxy->find(2);
$userFinderProxy->find(2);
$userFinderProxy->find(1);
$userFinderProxy->find(2);
?>