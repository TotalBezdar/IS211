<?php 

class UserDbStorage
{
    private $connection;
    public function __construct()
    {
        $dns = 'mysql:dbname=mydb;host=localhost';
        $users = 'root';
        $password = '';
        $this -> connection = new PDO($dns, $users, $password);
    }
    public function insert()
    {
        $data = data('Y-m-d');
        $sql = "INSERT INTO users (email, first_name, last_name, age, data_created)
        VALUES ('{$_POST['email']}',
        '{$_POST['first_name']}',
        '{$_POST['last_name']}',
        '{$_POST['age']}',
        '{$data}')";
      
        $this -> connection ->exec($sql);
    }
    public function update()
    {
            // Обработаем полученные данные - запрос на Изменение
    
        $id        = $_POST["id"];
        $first_name= $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $age       = $_POST["age"];
        $email     = $_POST["email"];
    
        // Составим запрос
        $sql = "UPDATE user SET 
        email='{$email}', 
        first_name='{$first_name}',
        last_name='{$last_name}', 
        age='{$age}'
        WHERE id={$id}";
    
        $this -> connection ->exec($sql);
    }
    
    public function delete()
    {
            // Обработаем GET с параметром delete - запрос на Удаление
    if (isset($_GET["delete"])) {
        $id = $_GET["id"];
        // Составим запрос
        $sql = "DELETE FROM user WHERE id={$id}";
        $this -> connection ->exec($sql);
    }   
    }
    public function list()
    {
        $sql = "SELECT * FROM users";
        $result = $this -> connection ->query($sql);
        $rows = $result -> fetchAll();
        return $rows;
    }
    
}
$obj = new UserDbStorage();
var_dump($obj->list());
// проверка добавления
$_POST['email'] = "test@mail.ru";
$_POST['first_name']= "Дмитрий";
$_POST['last_name']= "Медведев";
$_POST['age']= 50;
$obj->insert();