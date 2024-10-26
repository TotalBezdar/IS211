<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $lucky1 = rand(1, 25);
    $lucky2 = rand(1, 25);
    echo "$name выбрал билет: $lucky1 и $lucky2 ";
}