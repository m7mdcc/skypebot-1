<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper\plugins;

require_once 'Plugin.php';

use SkypeWrapper\Wrapper;
use SkypeWrapper\objects\Chat;

class ChatOpener extends Plugin {
	public function __construct($parameter) {
		parent::__construct($parameter);
	}

	public function handleChat(Chat $objChat, $nChatId, $property, $value) {
		if($property == 'ACTIVITY_TIMESTAMP')
			Wrapper::getWrapper ()->invokeOpenChat($nChatId);

	}
}
?>

