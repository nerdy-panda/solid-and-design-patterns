<?php require dirname(__DIR__,1).'/vendor/autoload.php';?>
<?php 
interface DataBaseConnectorContract {
    public function connect():void;
}
interface SqlConnectorContract extends DataBaseConnectorContract{}
interface NoSqlConnectorContract extends DataBaseConnectorContract {}

interface MySqlConnectorContract extends SqlConnectorContract {}
interface RedisConnectorContract extends NoSqlConnectorContract {}

?>
<?php 
class MySqlConnector implements MySqlConnectorContract {
    public function connect(): void {
        dump('connect to mysql');
    }
}
class PostgressConnector implements MySqlConnectorContract {
    public function connect(): void {
        dump('connect to mysql');
    }
}
class RedisConnector implements RedisConnectorContract {
    public function connect(): void {
        dump('connect to redis');
    }
}
class MongoConnector implements RedisConnectorContract {
    public function connect(): void {
        dump('connect to redis');
    }
}
?>
<?php 
class SqlDatabaseFactory {
    public function create(string $type):DataBaseConnectorContract {
        switch($type) {
            case 'mySql' : 
                return new MySqlConnector;
            break;
            case 'postgress' : 
                return new PostgressConnector;
            break;
        }
    }
}
class NoSqlDatabaseFactory {
    public function create(string $type):DataBaseConnectorContract {
        switch($type) {
            case 'redis' : 
                return new RedisConnector;
            break;
            case 'mongo' : 
                return new MongoConnector;
            break;
        }
    }
}
?>
<?php 
class DatabaseFactory {
    public static function create(string $type) {
        if($type=='sql')
            return new SqlDatabaseFactory;
        else 
            return new NoSqlDatabaseFactory;
    }
}

dd(DatabaseFactory::create('sql')->create('postgress'));
?>