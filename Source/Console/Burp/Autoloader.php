<?php

/**
 * Burp
 *
 * PHP version 5
 *
 * @category   Console
 * @package    Burp
 * @author     Matthew Sirocki <mattsirocki@gmail.com>
 * @copyright  2012, Matthew Sirocki
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.html)
 * @version    Release ${project.version}
 * @since      File available since Initial Release.
 * @filesource
 */

/*
 * Specify Namespace
 */
namespace Console\Burp;

/**
 * Autoloader
 *
 * @category   Console
 * @package    Burp
 * @author     Matthew Sirocki <mattsirocki@gmail.com>
 * @copyright  2012, Matthew Sirocki
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.html)
 * @version    Release ${project.version}
 * @since      Class available since Initial Release.
 */
class Autoloader
{
    /**
     * Binaries Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the binaries directory.
     */
    public static function getBinariesDirectory($addendum = null)
    {
        return self::_getDirectory('Binaries', func_get_args());
    }

    /**
     * Cache Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the cache directory.
     */
    public static function getCacheDirectory($addendum = null)
    {
        return self::_getDirectory('Cache', func_get_args());
    }

    /**
     * Configuration Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the configuration directory.
     */
    public static function getConfiguationDirectory($addendum = null)
    {
        return self::_getDirectory('Configuration', func_get_args());
    }

    /**
     * Data Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the data directory.
     */
    public static function getDataDirectory($addendum = null)
    {
        return self::_getDirectory('Data', func_get_args());
    }

    /**
     * Documentation Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the documentation directory.
     */
    public static function getDocumentationDirectory($addendum = null)
    {
        return self::_getDirectory('Documentation', func_get_args());
    }

    /**
     * Downloads Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the downloads directory.
     */
    public static function getDownloadsDirectory($addendum = null)
    {
        return self::_getDirectory('Downloads', func_get_args());
    }

    /**
     * Source Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the source directory.
     */
    public static function getSourceDirectory($addendum = null)
    {
        return self::_getDirectory('Source', func_get_args());
    }

    /**
     * Temporary Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the temporary directory.
     */
    public static function getTemporaryDirectory($addendum = null)
    {
        return self::_getDirectory('Temporary', func_get_args());
    }

    /**
     * Tests Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the tests directory.
     */
    public static function getTestsDirectory($addendum = null)
    {
        return self::_getDirectory('Tests', func_get_args());
    }

    /**
     * Web Directory Path
     *
     * @param string $addendum [$addendum ...]
     *     Accepts one or more addendums to be added to the path. Each of the
     *     addendums is automatically prefixed by a directory separator.
     *     (Default: null)
     *
     * @return string
     *     Path to the web directory.
     */
    public static function getWebDirectory($addendum = null)
    {
        return self::_getDirectory('Web', func_get_args());
    }

    /**
    * Initialize Autoloader
    *
    * @param string|string[integer] $paths
    *     Path(s) to look in.
    *
    * @return void
    */
    public static function initialize($paths)
    {
        self::_add_paths((array) $paths);
        self::_register();

        self::load('\Console\Burp\Bootstrap');
        Bootstrap::pull();
    }

    /**
     * Autoload Function
     *
     * @param string $resource
     *     Name of resource to load.
     *
     * @return boolean
     *     Returns true on success.
     *
     * @throws \Console\Burp\Exception|\Exception
     */
    public static function load($resource)
    {
        // Define Directory Separator Constant
        if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

        // If the resource has already been loaded, return true.
        if (self::_check_load($resource))
            return true;

        // If the $name doesn't begin with either "Console\Burp" or
        // "\Console\Burp" it isn't our problem; return false.
        if (!preg_match('(^\\?Console\\Burp)', $resource))
            return false;

        // Replace underscore ('_') package separators and backspace ('\')
        // namespace separators with directory separators in the resource $name.
        $file = str_replace(array('_', '\\'), DS, $resource);

        foreach (self::$_paths as $path)
        {
            if (file_exists($path . DS . $file))
            {
                require_once $path . DS . $file;

                if (!self::_check_load($resource))
                    self::_error('AutoloaderMissingResource', $resource, $file);

                return true;
            }
        }

        self::_error('AutoloaderMissingFile', $resource, $file);
    }

    /**
     * Array of search paths.
     *
     * @var string[integer]
     */
    protected static $_paths;

    /**
     * Whether the Autoloader has been registered.
     *
     * @var boolean
     */
    protected static $_registered;

    /**
     * Add search paths.
     *
     * @param string[integer] $paths
     *     Array of paths to add.
     *
     * @return void
     */
    protected static function _add_paths($paths)
    {
        foreach ($paths as $path)
            self::$_paths[] = rtrim($path, DIRECTORY_SEPARATOR);
    }

    /**
     * Check if the resource was loaded.
     *
     * @param string $name
     *     Name of the resource.
     *
     * @return boolean
     *     Returns whether the resource was loaded.
     */
    protected static function _check_load($name)
    {
        if (!class_exists($name, false) && !interface_exists($name, false))
            return false;

        return true;
    }

    /**
     * Raise an error using \Console\Burp\Exception if it is available.
     * Otherwise, the generic Exception class is used.
     *
     * Note: Changes here should be coordinated with \Console\Burp\Exception.
     *
     * @param string $key
     *     Accepts the Exception key.
     * @param string $resource
     *     Accepts the name of the resource being loaded.
     * @param string $file
     *     Accepts the path of the file where the resource was expected.
     *
     * @return void
     */
    protected static function _error($key, $resource, $file)
    {
        if (self::load('\Console\Burp\Exception'))

            throw \Console\Burp\Exception::factory($key)->
                localize($resource, $file);

        elseif ($key == 'AutoloaderMissingFile')

            throw new \Exception("Unable to load the resource, $resource; the file, $file, does not exist in any of the registered paths.");

        elseif ($key == 'AutoloaderMissingResource')

            throw new \Exception("Unable to load the resource, $resource; the resource was not found in the file that it maps to, $file.");
    }

    /**
     * Get specified directory path.
     *
     * @param string $directory
     *     Accepts a directory identifier.
     * @param array $addendums
     *     Accepts an array of additional path addendums. Each of the addendums
     *     is automatically prefixed by a directory separator.
     *     (Default: array())
     *
     * @return string
     *     Returns the path to the specified directory. If the requested
     *     directory does not exist, the path to the project root is returned.
     */
    protected static function _getDirectory($directory, $addendums = array())
    {
        // Define Directory Separator Constant
        if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

        $root = dirname(dirname(dirname(__FILE__)));
        $rest = implode(DS, $addendums);

        // Array of possible paths in order of preference.
        $directories = array(
            'Binaries'      => array('${path.binaries}',      $root . DS . 'Binaries'),
            'Cache'         => array('${path.cache}',         $root . DS . 'Cache'),
            'Configuration' => array('${path.configuration}', $root . DS . 'Configuration'),
            'Data'          => array('${path.data}',          $root . DS . 'Data'),
            'Documentation' => array('${path.documentation}', $root . DS . 'Documentation'),
            'Downloads'     => array('${path.downloads}',     $root . DS . 'Downloads'),
            'Source'        => array('${path.source}',        $root . DS . 'Source'),
            'Temporary'     => array('${path.temporary}',     $root . DS . 'Temporary'),
            'Tests'         => array('${path.tests}',         $root . DS . 'Tests'),
            'Web'           => array('${path.web}',           $root . DS . 'Web'),
        );

        foreach ($directories[$directory] as $path)
            if (file_exists($path))
                return $path . DS . $rest;

        return rtrim($root . DS . $rest, DS);
    }

    /**
     * Register the Autoloader
     *
     * @return void
     */
    protected static function _register()
    {
        if (!self::$_registered) {
            spl_autoload_register('\Console\Burp\Autoloader::load');
            self::$_registered = true;
        }
    }
}

Autoloader::initialize(dirname(dirname(dirname(__FILE__))));

?>