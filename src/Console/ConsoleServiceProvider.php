<?php

namespace XuanQuynh\Laravel\Console;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected $defer = true;

    /**
     * The supported commands.
     *
     * @var array
     */
    protected $commands = [
        'ClassMakeCommand' => 'command.class.make',
        'InterfaceMakeCommand' => 'command.interface.make',
        'TraitMakeCommand' => 'command.trait.make',
    ];

    /**
     * Register any services for the application.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->commands as $command => $name) {
            $this->{'register'.$command}($name);
        }

        $this->commands(array_values($this->commands));
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return array_values($this->commands);
    }

    /**
     * Register the command.
     *
     * @param  string  $name
     * @return void
     */
    protected function registerClassMakeCommand($name)
    {
        $this->app->singleton($name, function ($app) {
            return new ClassMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @param  string  $name
     * @return void
     */
    protected function registerInterfaceMakeCommand($name)
    {
        $this->app->singleton($name, function ($app) {
            return new InterfaceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @param  string  $name.
     * @return void
     */
    protected function registerTraitMakeCommand($name)
    {
        $this->app->singleton($name, function ($app) {
            return new TraitMakeCommand($app['files']);
        });
    }
}