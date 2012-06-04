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
namespace \Console\Burp;

/*
 * What do you do with bootstraps? You pull-em up!
 */

/**
 * Directory Separator Constant
 *
 * @name DS
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * Web Directory Seperator
 *
 * @name WS
 */
define('WS', chr(47));

/**
 * Namespace Seperator
 *
 * @name NS
 */
define('NS', chr(92));

/**
 * Newline Constant
 *
 * @name NL
 */
define( 'NL', chr(10));

/**
 * Return Constant
 *
 * @name RT
 */
define( 'RT', chr(12));

/**
 * Tab Constant
 *
 * @name TB
 */
define( 'TB', chr(9));

/**
 * Bootstrap
 *
 * @category   Console
 * @package    Burp
 * @author     Matthew Sirocki <mattsirocki@gmail.com>
 * @copyright  2012, Matthew Sirocki
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.html)
 * @version    Release ${project.version}
 * @since      Class available since Initial Release.
 */
class Bootstrap
{
    /**
     * Pull!
     *
     * @return void
     */
    public static function pull()
    {
        // Other Initialization Tasks
        error_reporting(E_ALL | E_STRICT);
        ini_set('error_log', Autoloader::getTemporaryDirectory('errors.log'));
    }
}

?>