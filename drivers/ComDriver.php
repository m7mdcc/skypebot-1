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

class ComDriver extends Driver {
	const COM_OBJECT				= "Skype4COM.Skype";
	private   $objCom               = null,                 // COM object.
			  $objEvent             = null,                 // Skype event sink object.
			  $objConvert			= null;                 // Skype Convert object.
  
	public static function test() {
		return class_exists('\COM');
	}	
	private static function makeSeed() {
	   list($usec, $sec) = explode(' ', microtime());
	   return (float) $sec + ((float) $usec * 100000);
	}	
	private static function makeRand() {
		mt_srand(self::makeSeed());
		return mt_rand();
	}
	
	/**
	 *  Create and initiate a new Skype COM object handler.
	 **/
	public function connect() {
		Wrapper::_debug("!init connection\n");
		// Create skype object
		$this->objCom = new \COM(self::COM_OBJECT);;
		if (!$this->objCom) 
			throw new \Exception("init class COM() failed");
		
		$this->objEvent = new ComDriverEvents();
		$this->objEvent->objConvert = $this->objCom->convert();

		// Create sink object
		com_event_sink($this->objCom, $this->objEvent, "_ISkypeEvents");

		$this->objConvert = $this->objCom->convert();
		$this->objConvert->language = "ru";
	
		// Start minimized and without splash screen
		if (!$this->objCom->client()->isRunning()) {
			Wrapper::_debug("!start Skype\n");
			$this->objCom ->client()->start(true, true);
			sleep(5);
		}
	
		$this->attach(5,false);
		
		if(!$this->objEvent->bAttached)
			throw new \Exception("atach to Skype failed");
			
		list($r, $s) = $this->invoke("NAME " . $this->strIdenty, -1);

		if ($r == "CONNSTATUS") {
			Wrapper::getWrapper()->handleConnstatus($s);
			return true;
		}

		Wrapper::getWrapper()->invokeProtocol($this->nProtocol);
		return true;
	}	
	public function attach($r,$b) {
		Wrapper::_debug("!attach\n");
		//Attach to Skype
		$this->objCom->attach($r, $b);
		com_message_pump(1000);
	}
	public function invoke($strCommand) {
		$nRand = self::makeRand();
		
		/**
		 * 1 - счетчик команд
		 * 2 - команда
		 * 3 - ответ
		 * 4 - флак блокирующей комманды, наверное всегда да
		 * 5 - таймаут
		 */
		$objСommand = $this->objCom->command($nRand, $strCommand, '', TRUE, $this->nTimeout * 1000);
		
		if(substr($strCommand, 0, 3) == 'SET' || substr($strCommand, 0, 4) == 'ING')
			Wrapper::_debug("invoke: %s\n", $strCommand);
		$this->objCom->SendCommand($objСommand);
		$strReply = $this->objEvent->getReply($nRand);							
		if (!$strReply) 
			throw new \Exception("COM::SendCommand() failed");
		if(substr($strCommand, 0, 3) == 'SET' || substr($strCommand, 0, 4) == 'ING')
			Wrapper::_debug("reply: %s\n", $strReply);
		if ($strReply == "" || $strReply == "OK" || $strReply == "PONG") 
			return array($strReply, null);

		list($r, $s) = explode(" ", $strReply, 2);
		if ($r == "ERROR") 
			throw new Exception(null, intval($s));

		return array($r, $s);
	}
	public function poll($nTimeout = self::DEFAULT_TIMEOUT) {
		Wrapper::_debug("poll:   timeout=%d\n", $nTimeout);
		return com_message_pump($nTimeout * 1000 );
	}
	public function callback($strCommand) {
		Wrapper::_debug("notify: %s\n", $strCommand);
		echo "notify: $strCommand\n";
		list($r, $s) = explode(" ", $strCommand, 2);
		if ($r == "ERROR") {
			throw new Exception(null, intval($s));
		}

		$method = sprintf("handle%s", ucfirst(strtolower($r)));
		if (method_exists(Wrapper::getWrapper(), $method)) {
			Wrapper::getWrapper()->$method($s);
		
		} 
		elseif(!in_array($method, Wrapper::getWrapper()->arrNoNotified))
			throw new \Exception(sprintf("handler not found [%s]", $method));

	}
	
	public function getBuffersState()
	{
		return array(
			'commands' => $this->objEvent->getCommandsCount(),
			'replies' => $this->objEvent->getRepliesCount(),
		);
	}
	
	public function collectGurbage()
	{
		$this->objEvent->cleanCommandsBuffer();
		$this->objEvent->cleanRepliesBuffer();
	}
}

class ComDriverEvents {	
	public $bTerminated = false;
	public $bAttached = false;
	
	public $objConvert;
	
	// ---
	// Sinc command model
	// ---
	
	/**
	 * @var array(
	 *		'id' => array(
	 *			'id' => ...,
  	 *			'send_time' => ...,
	 *			'expire_time' => ...,
	 *			'object' => ...
	 *		) 
	 * )
	 */
	protected $arrCommands = array();
	/**
	 * @var array(
	 *		'id' => array(
	 *			'id' => ...,
  	 *			'send_time' => ...,
	 *			'expire_time' => ...,
	 *			'object' => ...
	 *		) 
	 * )
	 */
	protected $arrReplies = array();
	
	
	protected function addCommand($objCommand) {
		$nTimestamp = time();
		$this->arrCommands[$objCommand->id] = array(
				'id' => $objCommand->id,
  	 			'send_time' => $nTimestamp,
	 			'expire_time' => $nTimestamp + $objCommand->Timeout / 1000,
	 			'object' => $objCommand
		);
	}	
	public function getCommand($nId) {
		if(empty($this->arrCommands[$nId]))
			return null;
		
		if($this->arrCommands[$nId]['expire_time'] < time())
			return null;
		
		list(, $strCommand) = explode(' ', $this->arrCommands[$nId]['object']->Command, 2);
		return $strCommand;
	}	
	public function getCommandsCount()
	{
		return count($this->arrCommands);
	}
	public function cleanCommandsBuffer()
	{
		foreach ($this->arrCommands as $nCommandId => $arrCommandAttrs) {
			if($arrCommandAttrs['expire_time'] < time())
				unset($this->arrCommands[$nCommandId]);
		}
	}
	protected function addReply($objReply) {
		if(!empty($this->arrCommands[$objReply->Id]))
		{
			$this->arrReplies[$objReply->Id] = array(
					'id' => $objReply->Id,
					'send_time' => $this->arrCommands[$objReply->Id]['send_time'],
					'expire_time' => $this->arrCommands[$objReply->Id]['expire_time'],
					'object' => $objReply
			);
			return true;
		}
		else return false;
	}	
	public function getReply($nId) {
		if(empty($this->arrCommands[$nId]))
			return null;
		
		while(1)
		{
			if($this->arrCommands[$nId]['expire_time'] < time())
				return null;
			
			if(!empty($this->arrReplies[$nId]))
			{
				list(, $strReply) = explode(' ', $this->arrReplies[$nId]['object']->Reply, 2);
				return $strReply;
			}
			
			com_message_pump(10);
		}
	}
	public function getRepliesCount()
	{
		return count($this->arrReplies);
	}
	public function cleanRepliesBuffer()
	{
		foreach ($this->arrReplies as $nReplyId => $arrReplyAttrs) {
			if($arrReplyAttrs['expire_time'] < time())
				unset($this->arrReplies[$nReplyId]);
		}
	}
	
	// ---
	// elementary callback
	// ---
	
	public function Command(&$pCommand) {
//		echo "command:".$pCommand->Command."(".$pCommand->id.")"."\n".
//		$pCommand->Reply."\n".
//		$pCommand->Expected."\n";	
		
//		com_print_typeinfo($pCommand);
		
		$this->addCommand($pCommand);
	}	
	public function Reply(&$pCommand) {
//		echo "reply:".$pCommand->Command."\n".
//		$pCommand->Reply."\n".
//		$pCommand->Expected."\n";
		
//		com_print_typeinfo($pCommand);

		if(!$this->addReply($pCommand))
			Wrapper::getDriver()->callback($pCommand->Reply);
	}
	
	// ---
	//
	// ---

	/**
	 * On com object attach, call this method
	 * 
	 * @param int $nStatus
	 */
	function AttachmentStatus($nStatus) {
		Wrapper::_debug("AttachmentStatus: %s(%s)", $this->objConvert->AttachmentStatusToText($nStatus), $nStatus );
		// This status handle custom user handler
		//if ( $nStatus == $this->objConvert->TextToAttachmentStatus("SUCCESS") )
		//	Wrapper::getDriver()->attach(5,false);
		if ( $nStatus == $this->objConvert->TextToAttachmentStatus("AVAILABLE") )
			Wrapper::getDriver()->attach(5,false);
		$this->bAttached = true;
	} 	
	function OnlineStatus(&$pUser, $Status ) {
//		print "Status: $pUser->Handle $Status\n";
	}
	function MessageStatus( &$pMessage, $nStatus ) {
//		Wrapper::_debug("MessageStatus: %s(%s)[%s]\n", $pMessage->Body, $pMessage->ChatName, $this->objConvert->ConnectionStatusToText($nStatus) );
	}

/*	
	public function userstatus(&$pUserStatus)
	{
		echo "userstatus:\n";
		com_print_typeinfo($pUserStatus);
		echo "\n";
	}
	public function __call($name, $arguments) {
		echo "not set '".$name."':\n";
		
		if(is_array($arguments))
//		{
			print_r($arguments);
//			foreach ($arguments as $key => $argument) {
//				echo $key.': '; 
//				com_print_typeinfo($argument); 
//				echo "\n";
//			}
//		}
		else
			com_print_typeinfo($arguments);
		echo "\n";
	}
*/
}
?>
