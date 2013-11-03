<?php
/**
 * Skype API Wrapper plugins
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper\plugins;

require_once 'Plugin.php';

use SkypeWrapper\Wrapper;
use SkypeWrapper\objects\ChatMessage;

class MessageReader extends Plugin {
	public function __construct($parameter) {
		parent::__construct($parameter);
	}

	public function handleChatmessage(ChatMessage $objChatMessage, $nChatMessageId, $property, $value) {
		if ($property != 'BODY' && $property != 'STATUS')
			return;
		if ($property == 'STATUS' && ($value == ChatMessage::STATUS_READ || $value == ChatMessage::STATUS_SENDING))
			return;

		if($property == 'STATUS' &&  $value == ChatMessage::STATUS_RECIEVED)
			Wrapper::getWrapper ()->setChatmessage($objChatMessage->getId(), 'SEEN');
	}
}
?>
