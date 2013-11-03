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
use SkypeWrapper\objects\ChatMessage;

class PingPong extends Plugin {
	public function __construct($parameter) {
		parent::__construct($parameter);
	}

	public function handleChatmessage(ChatMessage $objChatMessage, $nChatMessageId, $property, $value) {
		if ($property != 'BODY' && $property != 'STATUS') 
			return;
		if ($property == 'STATUS' && ($value == ChatMessage::STATUS_SENDING)) 
			return;				
		if(strtoupper($objChatMessage->get('BODY')) == "PING" && $property == 'STATUS' &&  $value == ChatMessage::STATUS_READ)
			Wrapper::getWrapper ()->invokeChatmessage ($objChatMessage->get('CHATNAME'), 'PONG');
		
		/*
		if ($property == 'STATUS' && ($value == ChatMessage::STATUS_READ || $value == ChatMessage::STATUS_SENDING)) 
			return;
		
		sleep(1);
		if(strtoupper($objChatMessage->get('BODY')) == "PING" && $property == 'STATUS' &&  $value == ChatMessage::STATUS_RECIEVED)
			Wrapper::getWrapper ()->invokeChatmessage ($objChatMessage->get('CHATNAME'), 'PONG');
		*/
	}
}
?>
