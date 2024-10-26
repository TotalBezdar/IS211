<?php
namespace Controllers;

use Services\FileStorage;
use Services\ProductDBStorage;
use Templates\ProductTemplate;


class Product
{
    public function get(int $id): string
    {
        $obj = new FileStorage();
        $products = $obj->loadData('data.json');
        foreach ($products as $item){
            if($item['id'] == $id){
             $obj = new ProductTemplate();
             $template = $obj -> getPageTemplate($item);
             return $template;
            }
        }
        return '404';      
    }
    public function getAll(): string
    {
        $objStorage = new FileStorage();
        $products = $objStorage->loadData('data.json');

        //$objStorage = new ProductDBStorage();
        //$products = $objStorage->loadData('product');

        $objTemplate = new ProductTemplate();
        $template = $objTemplate -> getTemplate($products);

        return $template;
    }
}