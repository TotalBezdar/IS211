<?php 
namespace Test;

use PHPUnit\Framework\TestCase;
use Routers\Router;

class RouterTest extends TestCase {
    public function test_router() {
        $router = new Router();
        $html = $router->route( "http://localhost/orders" );
        $pos= mb_strpos($html, "Создаие заказа");
        if((!($pos>=0)) and ($pos==false))
            $pos= -1;
        $this->assertNotFase( $pos>=0 );
    }
}