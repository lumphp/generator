<?php

declare(strict_types=1);

namespace Lum\Generator\Tests\Console\ModelsCommand\Ignored\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Lum\Generator\Tests\Console\ModelsCommand\Ignored\Models\NotIgnored
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotIgnored query()
 * @mixin \Eloquent
 */
class NotIgnored extends Model
{
}
