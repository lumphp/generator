<?php

declare(strict_types=1);

namespace Lum\Generator\Tests\Console\ModelsCommand\CustomDate;

use Lum\Generator\Console\ModelsCommand;
use Lum\Generator\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class Test extends AbstractModelsCommand
{
    protected function setUp(): void
    {
        parent::setUp();

        Date::use(CarbonImmutable::class);
    }

    protected function tearDown(): void
    {
        Date::use(Carbon::class);

        parent::tearDown();
    }

    public function test(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        $tester = $this->runCommand($command, [
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}
