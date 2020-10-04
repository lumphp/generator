<?php

declare(strict_types=1);

namespace Lum\Generator\Tests\Factories;

use Lum\Generator\Factories;
use PHPUnit\Framework\TestCase;

class AllTest extends TestCase
{
    public function testAll(): void
    {
        $factories = Factories::all();

        self::assertEmpty($factories);
    }
}
