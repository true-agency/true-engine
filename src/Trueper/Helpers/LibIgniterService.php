<?php
namespace Trueper\Helpers;

use Themosis\Core\IgniterService;

class LibIgniterService extends IgniterService {

    /**
     * Ignite a service.
     *
     * @return void
     */
    public function ignite()
    {
        $this->app->bind('true.lib', function($app){

            return new LibHelper;

        });
    }
}