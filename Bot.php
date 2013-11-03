<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper;

require_once 'Wrapper.php';
require_once 'SkypeWrapper.php';
//require_once 'Skype/Bot/Plugin.php';

use SkypeWrapper\Wrapper;

class Bot {
	const PROTOCOL_VERSION = 8;

	protected $arrPlugins = array();

	public function __construct($strIdenty, $bDebug = false) {
		Wrapper::initWrapper($strIdenty, self::PROTOCOL_VERSION, $bDebug);
	}
	public function run() {
		$this->_startup();
		echo Wrapper::getWrapper()->getIdenty()." start\n";
		while (true) {
			try {
				Wrapper::getWrapper()->poll(15);
				Wrapper::getDriver()->collectGurbage();
				Wrapper::getWrapper()->invokePing();
//				echo "garbage collected\n";
			} catch (\SkypeWrapper\Exception $e) {
				print $e;
			} catch (\Exception $e) {
				print $e;
			}
		}
	}
	private function _startup() {
		Wrapper::getWrapper()->connect();

		// search friends, group, chats in advance
		$arrUserIdList = Wrapper::getWrapper()->invokeSearchFriends();
		foreach ($arrUserIdList as $strUserId) {
			Wrapper::getWrapper()->getUser($strUserId);	// dummy
		}

		$arrGroupIdList = Wrapper::getWrapper()->invokeSearchGroups(\SkypeWrapper\objects\Group::SEARCH_TYPE_ALL);
		foreach ($arrGroupIdList as $nGroupId) {
			Wrapper::getWrapper()->getGroup($nGroupId);	// dummy
		}

		$arrChatIdList = Wrapper::getWrapper()->invokeSearchChats();		// invokeSearchChats does not return chat ids...
		foreach ($arrChatIdList as $nChatId) {
			Wrapper::getWrapper()->getChat($nChatId);	// dummy
		}

		return true;
	}
	public function loadPlugin($strPluginName, $arrParameter) {
		if (isset($this->arrPlugins[$strPluginName])) {
			return true;
		}

		$strClassName = sprintf("\SkypeWrapper\plugins\%s", $strPluginName);
		if (class_exists($strClassName) == false) {
			$strClassPath = sprintf("plugins/%s.php", $strPluginName);
			include_once($strClassPath);
		}
		if (class_exists($strClassName) == false) {
			throw new \Exception(sprintf("plugin class not found [%s]", $strClassName));
		}

		$objPlugin = new $strClassName($arrParameter);
		if (is_subclass_of($strClassName, "\SkypeWrapper\plugins\Plugin") == false) {
			throw new Exception(sprintf("plugin class [%s] does not have \SkypeWrapper\plugins\Plugin class as a parent", $strClassName));
		}

		$this->arrPlugins[$strPluginName] = $objPlugin;

		// add callbacks (...)
		$arrCallbackTypeList = Wrapper::getWrapper()->getCallbackTypeList();
		foreach ($arrCallbackTypeList as $strType) 
			Wrapper::getWrapper()->addCallback($strType, array($objPlugin, sprintf("handle%s", ucfirst($strType))));

		return true;
	}

}
?>
