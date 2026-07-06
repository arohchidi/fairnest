<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class PriceFormatterTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_if_price_is_formatted_correctly():void{
        $price = number_format(120000);
        $this->assertEquals('120,000',$price);

    }
}
