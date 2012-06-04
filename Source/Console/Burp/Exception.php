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
 * Exception
 *
 * @category   Console
 * @package    Burp
 * @author     Matthew Sirocki <mattsirocki@gmail.com>
 * @copyright  2012, Matthew Sirocki
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.html)
 * @version    Release ${project.version}
 * @since      Class available since Initial Release.
 */
class Exception extends \Exception
{
    /**
     * Exception Factory
     *
     * Sample Usage:
     *
     * <code>
     * throw \Web\Table\Exception::factory('EXCEPTION_KEY')->
     *     localize('key_0', 'value_0', 'key_1', 'value_1');
     * </code>
     *
     * @param string $key
     *     Accepts the message key.
     * @param \Exception $previous
     *     Previous Exception instance.
     *     (Default: null)
     *
     * @return Exception
     *     Returns a new Exception.
     */
    public static function factory($key, $previous = null)
    {
        return new Exception($key, $previous);
    }

    /**
    * Exception Messages
    *
    * @var string[string]
    */
    protected static $_messages = array(
        // AUTOLOADER EXCEPTIONS
        'AUTOLOADER-MISSING-FILE'     => 'We had some trouble loading "{0}". The file "{1}" does not exist in any of the registered paths.',
        'AUTOLOADER-MISSING-RESOURCE' => 'We had some trouble loading "{0}". Make sure it is properly defined in "{1}".',

        // PROPERTIES EXCEPTIONS
        'PropertyKeyNotSet'      => 'Cannot read the "{0}" property; the key is not set.',
        'PropertyKeyNotString'   => 'Cannot {0} the specified property; the key must be a string.',
        'PropertyValueNotString' => 'Cannot set the specified property; the value must be a string.',

        // GENERAL API EXCEPTIONS
        'UNKNOWN-EXCEPTION'           => 'Error throwing Exception with key "{0}"; the specified key is invalid.',
    );

    /**
     * Public Constructor
     *
     * @param string $key
     *     Accepts the message key.
     * @param \Exception $previous
     *     Previous Exception instance.
     *     (Default: null)
     *
     * @return void
     */
    public function __construct($key, $previous = null)
    {
        if (!isset($this->_messages[$key]))
            throw Exception::factory('UNKNOWN-EXCEPTION', $this)->
                localize($key);

        $message = $this->_messages[$key];
        $code    = array_search($key, array_keys($this->_messages));

        parent::__construct($message, $code, $previous);
    }

    /**
     * Exception Key
     *
     * @return string
     *     Returns the Exception key.
     */
    public function getKey()
    {
        return $this->__key;
    }

    /**
     * Exception Localization
     *
     * @param string $value [$value ...]
     *     Accepts one or more localization strings.
     *
     * @return Exception
     *     Returns the localized Exception.
     */
    public function localize($value)
    {
        foreach (func_get_args() as $key => $value)
            $this->message = str_replace('{'.$key.'}', $value, $this->message);

        return $this;
    }

    /**
     * Exception Key
     *
     * @var string
     */
    private $__key;
}

?>