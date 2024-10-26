<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $category = $_POST["category"];
    $select = $_POST["select"];
    $agreement = $_POST["agreement"];

    
    echo "ФИО: $name<br>";
    echo "Email: $email<br>";
    echo "Сообщение: $message<br>";
    echo "Категория: $category<br>";
    echo "Професия: $select<br>";
    echo "Согласие: $agreement<br>";

}