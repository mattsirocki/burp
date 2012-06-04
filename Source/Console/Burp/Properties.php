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
 * Properties
 *
 * @category   Console
 * @package    Burp
 * @author     Matthew Sirocki <mattsirocki@gmail.com>
 * @copyright  2012, Matthew Sirocki
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.html)
 * @version    Release ${project.version}
 * @since      Class available since Initial Release.
 */
class Properties
{
    /**
     * Get a Property
     *
     * @param string $key
     *     Accepts a property key.
     *
     * @return string|array
     *     Returns the specified property.
     */
    public function get($key)
    {
        // Type Checking
        if (!is_string($key))
            throw Exception::factory('PropertyKeyNotString')->localize('get');

        // Check Existence
        if (!isset($this->_properties[$key]))
            throw Exception::factory('PropertyKeyNotSet')->localize($key);

        // Return the Value
        return $this->_properties[$key];
    }

    /**
     * Set a Property
     *
     * @param string $key
     *     Accepts the property key.
     * @param string $value
     *     Accepts the property value.
     *
     * @return void
     */
    public function set($key, $value)
    {
        // Type Checking
        if (!is_string($key))
            throw Exception::factory('PropertyKeyNotString')->localize('set');
        if (!is_string($value))
            throw Exception::factory('PropertyValueNotString')->localize('set');

        // Set the Value
        $this->_properties[$key] = $value;
    }

    /**
     * Array of Properties
     *
     * @var array
     */
    protected $_properties;
}

?>