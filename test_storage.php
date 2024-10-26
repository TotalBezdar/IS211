<?php 
include_once ("./services/FileStorage.php");

$store = new FileStorage();
$arrData =
    [
        ['id' => 1, 'name' => 'Пикен Бургер', 
        'description' => 'Котлета пикачиная, сыр чеддер, соус цезарь и соус барбекю, свежий томат, салат айсберг, лук фри',
        'image' => "../img/png1.jpg",
        'weigth' => 250, 
        'price' => 300.00],
        ['id' => 2, 'name' => 'Хот-чили', 
        'description' => 'Котлета из мраморной говядины, жареные шампиньоны с луком, халапеньо, сыр, томаты, огурец,
        соус сливочный и чили',
        'image' => "./img/png2.jpg",
        'weigth' => 270, 
        'price' => 355.00],
        ['id' => 3, 'name' => 'Кранберри', 
        'description' => 'Котлета из мраморной говядины, соус клюквенный, соус барбекю, соус ранч, помидор, сыр и салат айсберг',
        'image' => "../img/png3.jpg",
        'weigth' => 280, 
        'price' => 355.00],
    ];
$store->saveData('data.json', $arrData);
$arrData = $store->loadData('data.json');
var_dump($arrData);