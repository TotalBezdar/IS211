<?php

include_once ("./templates/ProductTemplate.php");
include_once ("./services/FileStorage.php");

$store = new FileStorage();
$arrData = $store->loadData('data.json');

$templ = new ProductTemplate();
echo $templ->getTemplate($arrData);