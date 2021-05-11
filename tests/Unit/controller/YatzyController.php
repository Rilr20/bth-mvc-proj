<?php

namespace Rilr\Controller;

use PHPUnit\Framework\TestCase;
use Rilr\Controller\Yatzycontroller;
use Session;
use ReflectionClass;

/**
 * test cases for class YatzyController
 */
class YatzyControllerCreateObjectTest extends TestCase
{

    public function testYatzyControllerResetGame()
    {
        $_SESSION["throws"] = "test";
        $_SESSION["playerScore"] = "test";

        $yatzyController = new Yatzycontroller();
        $reflector = new ReflectionClass('Rilr\Controller\Yatzycontroller');
        $method = $reflector->getMethod('resetGame');
        $method->setAccessible(true);

        $this->assertEquals(null, Session::get("throws"));
        $this->assertEquals(null, Session::get("playerScore"));

        $method->invokeArgs($yatzyController, array());

        $this->assertNotEquals(null, Session::get("throws"));
        $this->assertNotEquals(null, Session::get("playerScore"));
    }
}
