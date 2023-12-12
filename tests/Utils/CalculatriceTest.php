<?php

namespace App\Tests\Utils;

use App\Utils\Calculatrice;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalculatriceTest extends KernelTestCase
{
    public function testAdd()
    {
        $calculatrice = new Calculatrice();
        $result1 = $calculatrice->add(5, 10);
        $result2 = $calculatrice->add(3, 4);
        $result3 = $calculatrice->add(6, 8);
        $this->assertEquals(15, $result1);
        $this->assertEquals(7, $result2);
        $this->assertEquals(14, $result3);
    }
}
