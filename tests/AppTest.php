<?php 
namespace app\Tests;

use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    public function testAreWorkingTests(): void
    {
        $this->assertEquals(2,1+1);
    }
}