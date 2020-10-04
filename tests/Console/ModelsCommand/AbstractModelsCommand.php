<?php

declare(strict_types=1);

namespace Lum\Generator\Tests\Console\ModelsCommand;

use Lum\Generator\IdeHelperServiceProvider;
use Lum\Generator\Tests\SnapshotPhpDriver;
use Lum\Generator\Tests\TestCase;

abstract class AbstractModelsCommand extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->artisan('migrate');
        $this->mockFilesystem();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [IdeHelperServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $config = $app['config'];

        $config->set('database.default', 'sqlite');
        $config->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Load the Models from the Test dir
        $config->set('ide-helper.model_locations', [
            dirname((new \ReflectionClass(static::class))->getFileName()) . '/Models',
        ]);

        // Don't override integer -> int for tests
        $config->set('ide-helper.type_overrides', []);
    }

    protected function assertMatchesMockedSnapshot()
    {
        $this->assertMatchesSnapshot($this->mockFilesystemOutput, new SnapshotPhpDriver());
    }
}
