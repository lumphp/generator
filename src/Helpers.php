<?php

declare(strict_types=1);

namespace Lum\Generator;

class Helpers
{
    public static function isLaravel(): bool
    {
        return class_exists('Illuminate\Foundation\Application');
    }
}
