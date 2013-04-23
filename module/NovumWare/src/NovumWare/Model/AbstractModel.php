<?php
namespace NovumWare\Model;

abstract class AbstractModel implements \ArrayAccess
{
	/**
	 * Constructor
	 *
	 * @param mixed $initialProperties
	 */
	public function __construct($initialProperties=null) {
		if ($initialProperties) {
			if (!is_array($initialProperties)) $initialProperties = get_object_vars($initialProperties);
			$this->setProperties($initialProperties);
		}
	}

	/**
	 * @return array Associative array representing the properties of this object
	 */
	public function toArray() {
		return get_object_vars($this);
	}

	/**
	 * Set Model properties from an array of values
	 *
	 * @param array $data
	 */
	public function setProperties(array $propertiesArray) {
		// Possibly check if properties are public or private using Reflection Classes?
		foreach ($propertiesArray as $property => $value) if (property_exists($this, $property)) $this->$property = $value;
	}


	// ========================================================================= IMPLEMENTS ARRAY ACCESS =========================================================================
	public function offsetExists($offset) { return isset($this->$offset); }
	public function offsetGet($offset) { return $this->$offset; }
	public function offsetUnset($offset) {
//		throw new Exception('Need to implement this method with the magic method __unset()');
		unset($this->$offset);
	}
	public function offsetSet($offset, $value) { $this->$offset = $value; }
}