<?php

declare(strict_types=1);

namespace Lum\Generator\Tests\Console\ModelsCommand\Ignored;

use Lum\Generator\Console\ModelsCommand;
use Lum\Generator\Tests\Console\ModelsCommand\AbstractModelsCommand;
use Lum\Generator\Tests\Console\ModelsCommand\Ignored\Models\Ignored;

class Test extends AbstractModelsCommand
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('ide-helper.ignored_models', [
            Ignored::class,
        ]);
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
