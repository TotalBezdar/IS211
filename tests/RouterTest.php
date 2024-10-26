<?php 
namespace Test;

use PHPUnit\Framework\TestCase;
use Routers\Router;

class RouterTest extends TestCase {
    public function test_router() {
        $router = new Router();
        $html = $router->route( "http://localhost/orders" );
        $pos= mb_strpos($html, "Создание заказаароартоаро");
        if((!($pos>=0)) and ($pos==false))
            $pos= -1;
        $this->assertNotFalse( $pos>=0 );
    }
}