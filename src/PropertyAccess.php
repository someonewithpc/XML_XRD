<?php
/**
 * Part of XML_XRD
 *
 * PHP version 5
 *
 * @category XML
 * @package  XML_XRD
 * @author   Christian Weiske <cweiske@php.net>
 * @license  http://www.gnu.org/copyleft/lesser.html LGPL
 * @link     http://pear.php.net/package/XML_XRD
 */

namespace XRD;

use XRD\LogicException;
use XRD\Element\Property;

/**
 * Provides ArrayAccess to extending classes (XRD\Document and XRD\Element\Link).
 *
 * By extending PropertyAccess, access to properties is possible with
 * "$object['propertyType']" array access notation.
 *
 * @category XML
 * @package  XML_XRD
 * @author   Christian Weiske <cweiske@php.net>
 * @license  http://www.gnu.org/copyleft/lesser.html LGPL
 * @version  Release: @package_version@
 * @link     http://pear.php.net/package/XML_XRD
 */
abstract class PropertyAccess implements \ArrayAccess
{

    /**
     * Array of property objects
     *
     * @var array
     */
    public $properties = array();


    /**
     * Check if the property with the given type exists
     *
     * Part of the ArrayAccess interface
     *
     * @param string $type Property type to check for
     *
     * @return boolean True if it exists
     */
    public function offsetExists($type): bool
    {
        foreach ($this->properties as $prop) {
            if ($prop->type == $type) {
                return true;
            }
        }
        return false;
    }

    /**
     * Return the highest ranked property with the given type
     *
     * Part of the ArrayAccess interface
     *
     * @param string $type Property type to check for
     *
     * @return string Property value or NULL if empty
     */
    public function offsetGet($type): mixed
    {
        foreach ($this->properties as $prop) {
            if ($prop->type == $type) {
                return $prop->value;
            }
        }
        return null;
    }

    /**
     * Not implemented.
     *
     * Part of the ArrayAccess interface
     *
     * @param string $type  Property type to check for
     * @param string $value New property value
     *
     * @return void
     *
     * @throws LogicException Always
     */
    public function offsetSet($type, $value): void
    {
        throw new LogicException('Changing properties not implemented');
    }

    /**
     * Not implemented.
     *
     * Part of the ArrayAccess interface
     *
     * @param string $type Property type to check for
     *
     * @return void
     *
     * @throws LogicException Always
     */
    public function offsetUnset($type): void
    {
        throw new LogicException('Changing properties not implemented');
    }

    /**
     * Get all properties with the given type
     *
     * @param string $type Property type to filter by
     *
     * @return array Array of Property objects
     */
    public function getProperties($type = null)
    {
        if ($type === null) {
            return $this->properties;
        }
        $properties = array();
        foreach ($this->properties as $prop) {
            if ($prop->type == $type) {
                $properties[] = $prop;
            }
        }
        return $properties;
    }
}
?>
