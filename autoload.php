<?php
function autoloadClasses($className)
{
    $class = str_replace('\\', '/', $className);
    $path = "./". $class.".php";
echo $path;
    if (file_exists($path)) {
        require_once($path);
        echo $path;
    }
}

spl_autoload_register("autoloadClasses");