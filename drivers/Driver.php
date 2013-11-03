<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper\drivers;

require_once 'ComDriver.php';
require_once 'DbusDriver.php';

use SkypeWrapper\Wrapper;

abstract class Driver {
	
	const DEFAULT_PROTOCOL = 7;
	const DEFAULT_TIMEOUT = 60;
	
	protected	$nTimeout = self::DEFAULT_TIMEOUT;
		
	protected	$strIdenty;
	public		$nProtocol;
	
	public function __construct($strIdenty, $nProtocol = self::DEFAULT_PROTOCOL) {
		$this->strIdenty = $strIdenty;
		$this->nProtocol = intval($nProtocol);
	}
	public function getTiemout() {
		return $this->nTimeout;
	}
	public function setTimeout($nTimeout) {
		$this->nTimeout = $nTimeout;
	}
	
	// ---
	// Function prototype
	// ---
	
	/**
	 * can use driver
	 * @return boolean
	 */
	public static function test() {
		return false;
	}
	
	abstract public function connect();
	abstract public function invoke($strCommand);
	abstract public function poll($nTimeout = self::DEFAULT_TIMEOUT);
	abstract public function callback($strCommand);
	abstract public function getBuffersState();
	abstract public function collectGurbage();
	
	// ---
	// Wraper methods use
	// ---
	
	public function invokeProtocol($nProtocol) {
		list($r, $s) = $this->invoke("PROTOCOL $nProtocol");
		if ($s < $nProtocol) {
			Wrapper::_debug("requested protocol [$nProtocol] is not supported -> falling back to $s");
		}

		$this->nProtocol = $s;

		return $s;
	}
}

?>
