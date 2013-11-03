<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper\objects;

use SkypeWrapper\PropertyTypes;

class Object {
	protected	$arrPropertyList = array(
	);

	protected	$strObjectIdenty = "";
	protected	$objectId;
	protected	$arrProperties;

	public function __construct($objectId) {
		$this->objectId = $objectId;

		foreach ($this->arrPropertyList as $strProperty => $arrAttrbutes) {
			$tmp = $this->fetch($strProperty, true);
			if ($tmp !== false) {
				$this->arrProperties[$strProperty] = $tmp;
			}
		}
	}

	public function toArray() {
		return $this->arrProperties;
	}

	/* {{{ accessor */
	public function getId() {
		return $this->objectId;
	}

	public function get($strProperty) {
		if (isset($this->arrProperties[$strProperty])) {
			return $this->arrProperties[$strProperty];
		}
		if (isset($this->arrPropertyList[$strProperty])) {
			$this->arrProperties[$strProperty] = $this->fetch($strProperty);
			return $this->arrProperties[$strProperty];
		}

		throw new \Exception(sprintf("unsupported property [%s]", $strProperty));
	}

	/**
	 *	set arbitary property
	 *
	 *	- does not invoke set methods
	 *	- expecting $value as "plain" text
	 */
	public function set($strProperty, $value) {
		if (isset($this->arrPropertyList[$strProperty]) == false) {
			throw new \Exception(sprintf("unsupported property [%s]", $strProperty));
		}

		$this->arrProperties[$strProperty] = PropertyTypes::force($this->arrPropertyList[$strProperty]['type'], $value);
	}
	/* }}} */

	protected function fetch($strProperty, $bDefault = false) {
		if (isset($this->arrPropertyList[$strProperty]) == false) {
			throw new \Exception(sprintf("unsupported property [%s]", $strProperty));
		}
		$arrAttributes = $this->arrPropertyList[$strProperty];

		if ($bDefault && !$arrAttributes['default']) {
			return false;
		}

		list($r, $s) = \SkypeWrapper\Wrapper::getWrapper()->invoke("GET {$this->strObjectIdenty} {$this->objectId} $strProperty");
		$tmp = explode(" ", $s, 3);
		return PropertyTypes::force($arrAttributes['type'], $tmp[2]);
	}
}
?>
