<?php
interface DatabaseConnector{
    public function connect():void;
    public function getConnection():PDO;
}
class MySql implements DatabaseConnector {
    protected string $dsn;
    protected PDO $connection;
    public function __construct(
        protected string $host,
        protected string $user ,
        protected string $password ,
        protected null|string $database=null ,
        protected array $options = []
    ) {
        $this->dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8;";
    }
    public function connect():void {
        $this->connection = new PDO($this->dsn,$this->user,$this->password,$this->options);
    }
    public function getConnection():PDO {
        return $this->connection;
    }
}

class Sqlite implements DatabaseConnector {
    protected string $dsn;
    protected PDO $connection;
    public function __construct(
        protected string $database ,
    )
    {
        $this->dsn = "sqlite:".__DIR__.DIRECTORY_SEPARATOR.$this->database;
    }

    public function connect(): void
    {
        $this->connection = new PDO($this->dsn);
    }
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

class Article {
    protected DatabaseConnector $database;
    protected PDO $connection;
    public function __construct(
        DatabaseConnector $database
    )
    {
        $this->database = $database ;
        $this->connection = $database->getConnection();
    }
    public function all(int $fetchMode=2):array{
        $statement = $this->connection->query(
            "select * from `articles`"
        );
        $result = $statement->fetchAll($fetchMode);
        return $result;
    }
}
$mySql = new MySql(
    host: "localhost" ,
    database: "php" ,
    user: "root" ,
    password:"root" ,
);
$sqlite = new Sqlite('identifier.sqlite');
$sqlite->connect();
$mySql->connect();
$connector = ((rand(0,1)) ? $sqlite : $mySql);
var_dump(get_class( $connector)." Driver");
$article = new Article($connector);
$articles = $article->all(PDO::FETCH_CLASS);
var_dump($articles);
?>

