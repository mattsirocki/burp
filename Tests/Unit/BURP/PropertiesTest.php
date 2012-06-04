<?php

/**
 * BURP
 *
 * PHP version 5
 *
 * @category   Console
 * @package    BURP
 * @author     Matthew Sirocki <mattsirocki@gmail.com>
 * @copyright  2012, Matthew Sirocki
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.html)
 * @version    ${project.version}
 * @since      File available since Initial Release.
 * @filesource
 */

/*
 * Specify Namespace
 */
namespace Console;

/**
 * Properties Test
 *
 * @category   Console
 * @package    BURP
 * @author     Matthew Sirocki <mattsirocki@gmail.com>
 * @copyright  2012, Matthew Sirocki
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.html)
 * @version    Release ${project.version}
 * @since      Class available since Initial Release.
 */
class PropertiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Properties Instance
     *
     * @var \Console\BURP\Properties
     */
    public $properties;

    /**
     * @covers \Console\BURP\Properties::__construct
     * @group \Console
     * @group \Console\BURP
     * @group \Console\BURP\Properties
     *
     * @since Test available since Initial Release.
     */
    public function testConstructor()
    {
        $this->properties = new \Console\BURP\Properties();
        $this->assertTrue($this->properties instanceof \Console\BURP\Properties);
    }

    /**
     * @covers \Console\BURP\Properties::get
     * @depends testConstructor
     * @group \Console
     * @group \Console\BURP
     * @group \Console\BURP\Properties
     *
     * @since Test available since Initial Release.
     */
    public function testPropertyGetKeyNotString()
    {
        try
        {
            $this->properties->get(true);
        }
        catch (\Console\BURP\Exception $e)
        {
            $this->assertEquals('PropertyKeyNotString', $e->getKey());
        }
    }

    /**
     * @covers \Console\BURP\Properties::set
     * @depends testConstructor
     * @group \Console
     * @group \Console\BURP
     * @group \Console\BURP\Properties
     *
     * @since Test available since Initial Release.
     */
    public function testPropertySetKeyNotSet()
    {
        try
        {
            $this->properties->set(true, 'string');
        }
        catch (\Console\BURP\Exception $e)
        {
            $this->assertEquals('PropertyKeyNotString', $e->getKey());
        }
    }

    /**
     * @covers \Console\BURP\Properties::set
     * @depends testConstructor
     * @group \Console
     * @group \Console\BURP
     * @group \Console\BURP\Properties
     *
     * @since Test available since Initial Release.
     */
    public function testPropertySetValueNotString()
    {
        try
        {
            $this->properties->get('string', true);
        }
        catch (\Console\BURP\Exception $e)
        {
            $this->assertEquals('PropertyKeyNotString', $e->getKey());
        }
    }

    /**
     * @covers \Console\BURP\Properties::set
     * @depends testConstructor
     * @group \Console
     * @group \Console\BURP
     * @group \Console\BURP\Properties
     *
     * @since Test available since Initial Release.
     */
    public function testPropertySet()
    {
        $this->properties->set('user.name', 'Matthew Sirocki');
        $this->properties->set('user.last', 'Sirocki');
    }

    /**
     * @covers \Console\BURP\Properties::get
     * @depends testConstructor
     * @group \Console
     * @group \Console\BURP
     * @group \Console\BURP\Properties
     *
     * @since Test available since Initial Release.
     */
    public function testPropertyGet()
    {
        $this->assertEquals('Matthew Sirocki', $this->properties->get('user.name'));
        $this->assertEquals('Sirocki', $this->properties->get('user.last'));
    }
}

?>