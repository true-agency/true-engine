<?php
namespace Trueper\Core;

use Themosis\Core\IgniterService as ThemosisIgniter;
use Trueper\Helpers\AcfHelper;
use Trueper\Helpers\LibHelper;
use Trueper\Helpers\ThemeHelper;

class IgniterService extends ThemosisIgniter {

    /**
     * Provides binding for all services and aliases
     *
     * @return void
     */
    public function ignite()
    {
        $this->registerServices();
        $this->registerAliases();
    }

    /**
     * Register all libraries that should proivde services
     *
     * @return void
     */
    public function registerServices()
    {
        $this->app->bind('helpers.lib', function($app) {
            return new LibHelper;
        });
        $this->app->bind('helpers.theme', function($app) {
            return ThemeHelper::instance();
        });
        $this->app->bind('helpers.acf', function($app) {
            $helper = AcfHelper::instance();
            $helper->setThemeHelper($this->app['helpers.theme']);
            $helper->setLib($this->app['helpers.lib']);

            return $helper;
        });
    }

    /**
     * Register all aliases
     *
     * @return void
     */
    public function registerAliases()
    {
        
    }
}