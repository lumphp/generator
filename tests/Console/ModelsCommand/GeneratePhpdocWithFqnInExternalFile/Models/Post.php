<?php

declare(strict_types=1);

namespace Lum\Generator\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Models;

use Lum\Generator\Tests\Console\ModelsCommand\GeneratePhpdocWithFqnInExternalFile\Builders\EMaterialQueryBuilder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function newEloquentBuilder($query): EMaterialQueryBuilder
    {
        return new EMaterialQueryBuilder($query);
    }
}
