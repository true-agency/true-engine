<?php 

// Autoload PSR-0 classes.
// The autoloading process is not handled by Composer...
// This mechanism allows a developer to use dependencies inside the plugin
// or to use them at the root of the WordPress project.
$loader = new \Symfony\Component\ClassLoader\ClassLoader();
$loader->addPrefixes(array(
    'Trueper' => __DIR__.DS.'src'.DS
));
$loader->register();

/**
 * Load the main class.
 */
add_filter('themosis_register_bindings', function ($app)
{
    $ignite = new \Trueper\Core\Ignite($app);
    $ignite->boot();
});