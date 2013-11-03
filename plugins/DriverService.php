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

class DriverService extends Plugin {
	public function __construct($parameter) {
		parent::__construct($parameter);
	}
	
	protected function getBufferState(){
		$strResponse = '';
		$arrBufferState = Wrapper::getDriver()->getBuffersState();
		foreach ($arrBufferState as $strBufferName => $strState) {
			$strResponse .= $strBufferName." buffer: ".$strState."\n";
		}
		return $strResponse;
	}

	public function handleChatmessage(ChatMessage $objChatMessage, $nChatMessageId, $property, $value) {
		if ($property != 'BODY' && $property != 'STATUS') 
			return;
		if ($property == 'STATUS' && (
			$value == ChatMessage::STATUS_SENDING || 
			$value == ChatMessage::STATUS_SENT || 
			$value == ChatMessage::STATUS_RECIEVED
		)) 
			return;			
		if($property == 'STATUS' &&  $value == ChatMessage::STATUS_READ){
			@list($strAction, $strWhere, $strWhat) = explode(' ', strtolower(trim($objChatMessage->get('BODY'))), 3);
			if($strWhere == 'driver'){
				switch ($strWhat)
				{
					case 'buffer state':
						if($strAction == 'get')
							$strResponse = $this->getBufferState();
						else 
							$strResponse = 'object '.$strWhat.' cant '.$strAction.'ed';
					break;
					default :
						$strResponse = 'cant use object '.$strWhat;
					break;
				}

				Wrapper::getWrapper ()->invokeChatmessage ($objChatMessage->get('CHATNAME'), $strResponse);
			}
		}
	}
}
?>
