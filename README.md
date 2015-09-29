# True Engine

An extended Wordpress framework library on top of [Themosis Framework](http://www.themosis.com/).

## Custom Themosis Modification

While we should try to avoid changing Themosis Framework directly to allow smooth update, in some cases this is not possible. This section should try to list out changes made to these files.

### Allow additional IgniterService

For us too hook into Themosis and register additional ServiceProvider (IgniterService), we need to add following filter after Themosis core Application register its igniters:

```
/*----------------------------------------------------*/
// Register Core Igniter services
/*----------------------------------------------------*/
$app->registerCoreIgniters();

// Allow other plugins to register igniter
apply_filters('themosis_register_bindings', $app);
```

### .blade.php support
In order for most editors to recognise blade syntax, we added `.blade.php` support to Scout compiler. Edited files are:
- `ViewFinder`
- `ViewFactory`