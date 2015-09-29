<?php
namespace Trueper\Helpers;

/**
 * Helper for Wordpress Theme
 */
class ThemeHelper {

    use \Trueper\Traits\SingletonTrait;

    /**
     * Return URI to theme directory
     *
     * @return string
     */
    public function url()
    {
        return get_template_directory_uri();
    }

    /**
     * Return directory path to the theme.
     *
     * @param  string $path Additional path to be appended
     *
     * @return string
     */
    public function dir($path = '')
    {
        return get_template_directory() . $path;
    }

    /**
     * Return URI to css file, located in the theme assets folder
     *
     * @param  string $css CSS filename
     *
     * @return string
     */
    public function css($css)
    {
        return get_template_directory_uri() . '/assets/css/' . $css . '.css';
    }

    /**
     * Return URI to javascript file, located in the theme assets folder
     *
     * @param  string $js javascript filename
     *
     * @return string
     */
    public function js($js)
    {
        return get_template_directory_uri() . '/assets/js/' . $js . '.js';
    }
    
}
