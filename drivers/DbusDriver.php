<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper\drivers;

use SkypeWrapper\Wrapper;
use SkypeWrapper\Exception;

class DbusDriver extends Driver {
	const DBUS_DESTINATION = "com.Skype.API";
	const DBUS_PATH_INVOKE = "/com/Skype";
	const DBUS_PATH_NOTIFY = "/com/Skype/Client";
	const DBUS_INTERFACE = "com.Skype.API";

	protected	$objDbus = null;
	
	public static function test() {
		return function_exists('dbus_bus_get');
	}

	public function connect() {
		Wrapper::_debug("!init connection\n");
		// Create skype object
		$this->objDbus = dbus_bus_get(DBUS_BUS_SESSION);
		if (!$this->objDbus) {
			throw new \Exception("dbus_bus_get() failed");
		}

		$this->objDbus->registerObjectPath(self::DBUS_PATH_NOTIFY, array($this, 'callback'));

		list($r, $s) = $this->invoke("NAME " . $this->strIdenty, -1);
		if ($r == "CONNSTATUS") {
			Wrapper::getWrapper()->handleConnstatus($s);
			return true;
		}

		Wrapper::getWrapper()->invokeProtocol(self::DEFAULT_PROTOCOL);
		return true;
	}	
	public function invoke($s) {
		$m = new \DBusMessage(\DBUS_MESSAGE_TYPE_METHOD_CALL);
		$m->setDestination(self::dbus_destination);
		$m->setPath(self::dbus_path_invoke);
		$m->setInterface(self::dbus_interface);
		$m->setMember("Invoke");
		$m->setAutoStart(true);
		$m->appendArgs($s);

		Wrapper::_debug("invoke: %s\n", $s);
		$r = $this->dbus_connection->sendWithReplyAndBlock($m, $this->nTimeout);
		if (!$r) {
			throw new \Exception("dbus_connection_send_with_reply_and_block() failed");
		}
		$tmp = $r->getArgs();
		Wrapper::_debug("reply: %s\n", $tmp[0]);
		if ($tmp[0] == "" || $tmp[0] == "OK" || $strReply == "PONG") 
			return array($tmp[0], null);

		list($r, $s) = explode(" ", $tmp[0], 2);
		if ($r == "ERROR") 
			throw new Exception(null, intval($s));

		return array($r, $s);	
	}
	public function poll($timeout = self::DEFAULT_TIMEOUT) {
		Wrapper::_debug("poll:   timeout=%d\n", $timeout);
		return $this->objDbus->poll($timeout);
	}
	public function callback($m) {
		$tmp = $m->getArgs();
		Wrapper::_debug("notify: %s\n", $tmp[0]);
		list($r, $s) = explode(" ", $tmp[0], 2);
		if ($r == "ERROR") {
			throw new \SkypeWrapper\Exception(null, intval($s));
		}

		$method = sprintf("handle%s", ucfirst(strtolower($r)));
		if (method_exists(Wrapper::getWrapper(), $method)) 
			Wrapper::getWrapper()->$method($s);
		else 
			throw new \Exception(sprintf("handler not found [%s]", $method));
		
	}
	public function getBuffersState()
	{
		return array(
		);
	}
	public function collectGurbage() {
		
	}
}
?>
