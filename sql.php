<?php

$dns = 'mysql:dbname=burgerkrig;host=localhost';
$users = 'root';
$password = '';

try {

   $conn = new PDO($dns, $users, $password);

   // Обработаем полученные данные - запрос на Изменение
   if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $id = $_POST["id"];
      $first_name = $_POST["first_name"];
      $last_name = $_POST["last_name"];
      $age = $_POST["age"];
      $email = $_POST["email"];

      // Составим запрос
      $sql = "UPDATE users SET 
         email='{$email}', 
         first_name='{$first_name}',
         last_name='{$last_name}', 
         age='{$age}'
         WHERE id={$id}";

      $conn->exec($sql);
   }
   // Обработаем GET с параметром delete - запрос на Удаление
   if (isset($_GET["delete"])) {
      $id = $_GET["id"];
      // Составим запрос
      $sql = "DELETE FROM users WHERE id={$id}";
      $conn->exec($sql);
   }  
   //  $sql = "INSERT INTO users (email, first_name, last_name, age, date_created)
   //  VALUES ('iTom@mail.ru', 'Тимофей', 'Иванов', 15, '2024-04-08')";

   //  $conn->exec($sql);
   //  $conn->exec("INSERT INTO users (email, first_name, last_name, age, date_created)
   //  VALUES ('iTom2@mail.ru', 'Тимофей2', 'Иванов', 16, '2024-04-08')");

   //  $conn->exec("INSERT INTO users (email, first_name, last_name, age, date_created)
   //  VALUES ('petr@mail.ru', 'Петр', 'Петров', 17, '2024-04-08')");

   //  echo "В таблицу Users добавленны строки";

   $sql = "SELECT * FROM users";
   $result = $conn->query($sql);
   $html = <<<LINE
         <table class="table">
         <thead>
            <tr>
               <th> Id </th>
               <th> Имя, Фамилия </th>
               <th> Возраст </th> 
               <th> Email </th>
            </tr> 
            </thead>
            <tbody>
      LINE;
   while ($row = $result->fetch()) {

      $html .= "<tr>";

      $html .= "<form = method = POST>";

      $html .= "<td>{$row['id']}
      <input type='hidden' name='id' value='{$row['id']}'>
      </td> 
      <td>
         <input type = 'text' name='first_name' value = {$row['first_name']}>
         <input type = 'text' name='last_name' value = {$row['last_name']}>
      </td>
      <td><input type = 'text' name='age' value = {$row['age']}></td>
      <td><input type = 'text' name='email' value = {$row['email']}></td>";

      $html .= "<td><button type='submit'>Изменить</button></td>";

      // Добавим кнопку Удалить
      $html .= <<<LINE
              <td>
                 <a href='sql.php?delete&id={$row['id']}'>
                     <input type='button' value='Удалить'>
                 </a>
              </td>
             LINE;

      $html .= "</form>";

      $html .= "</tr>";
   }
   $html .= "</table>";
   $html .= <<<LINE
   <div class="row">
       <div class="col-6">
           <form action="/orders" method="POST">

               <label for="name">Ваше ФИО:</label><br>
               <input type="text" id="name" name="name" class="form-control" required><br><br>

               <label for="address">Адрес доставки:</label><br>
               <input type="text" id="address" name="address" class="form-control" required><br><br>

               <label for="phone">Телефон:</label><br>
               <input type="text" id="phone" name="phone" class="form-control" required><br><br>
               <label for="email">Email:</label>
               <input type="email" id="email" class="form-control" name="email" required>

               <button type="submit">Создать заказ</button>
       </div>
   </div>
   LINE;

   function getBaseTemplate()
   {
      $template = <<<END
      <!DOCTYPE html>
      <html lang="ru">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Таблица пользователя</title>
          <link rel="stylesheet" href="https://localhost/css/bootstrap.min.css">
      </head>
      <body>
          <div class="container">
          %s
      </div>
      </body>
      </html>
      END;
      return $template;
   }
   echo $template = sprintf(getBaseTemplate(), $html);
} catch (PDOException $e) {
   echo "Datebase error: " . $e->getMessage();
   
}
