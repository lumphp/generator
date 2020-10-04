<?php

declare(strict_types=1);

namespace Lum\Generator\Tests\Console\ModelsCommand\AllowGlobDirectory;

use Lum\Generator\Console\ModelsCommand;
use Lum\Generator\Tests\Console\ModelsCommand\AbstractModelsCommand;

final class Test extends AbstractModelsCommand
{
    /** @var string */
    private $cwd;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cwd = getcwd();
    }

    protected function tearDown(): void
    {
        chdir($this->cwd);

        parent::tearDown();
    }

    public function test(): void
    {
        $command = $this->app->make(ModelsCommand::class);

        chdir(__DIR__);

        $tester = $this->runCommand($command, [
            '--dir' => ['Services/*/Models'],
            '--write' => true,
        ]);

        $this->assertSame(0, $tester->getStatusCode());
        $this->assertStringContainsString('Written new phpDocBlock to', $tester->getDisplay());
        $this->assertMatchesMockedSnapshot();
    }
}
