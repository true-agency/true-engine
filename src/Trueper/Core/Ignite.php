<?php
namespace Trueper\Core;

class Ignite {

    protected $app = null;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Register all providers
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register('\Trueper\Core\IgniterService');
    }
}