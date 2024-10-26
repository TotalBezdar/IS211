<?php
namespace Services;

use Interfaces\FileStorageInterface;
use PDO;

class ProductDBStorage implements FileStorageInterface
{
    const DNS = 'mysql:dbname=burgerkrig;host=localhost';
    const USERS = 'root';
    const PASSWORD = '';

    private $connection;
    public function __construct()
    {
        $this->connection = new PDO(self::DNS, self::USERS, self::PASSWORD);
    }
    public function saveData($nameFile, $arr)
    {

    }
    public function loadData($nameFile): ?array
    {
        $sql = "SELECT * FROM product";
        $result = $this->connection->query($sql);
        $row = $result->fetchAll();
var_dump($row);
exit();
        return $row;
    }
}