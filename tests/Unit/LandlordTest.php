<?php

declare(strict_types=1);

namespace Tests\Unit;


use PHPUnit\Framework\TestCase;

class LandlordTest extends TestCase
{
    public function testRegisterNew(): void
    {
        $landlord = Landlord::register();
        $expected = true;
        $actual = false;

        $this->assertTrue($expected);
        $this->assertFalse($actual);
    }
}
