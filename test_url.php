<?php
include_once("./routers/Router.php");
$obj = new Router();
echo $obj->route('https://mysite.ru/products') ."\n";      // Вызван метод getAll() из класса Product'
echo $obj->route('https://mysite.ru/products/12') ."\n";   // Вызван метод get() из класса Product'
echo $obj->route('https://mysite.ru/orders') ."\n";        // Вызван метод create() из класса Order