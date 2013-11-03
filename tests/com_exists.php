<?php
// Create skype object
$skype = new COM("Skype4COM.Skype");
// Create sink object
$sink = new _ISkypeEvents($skype);
com_print_typeinfo($skype->convert());
// Connect to sink
com_event_sink($skype, $sink, "_ISkypeEvents");

// Start minimized and without splash screen
if (!$skype->client()->isRunning()) {
	$skype->client()->start(true, true);
	sleep(10);
}

//Attach to Skype
$skype->attach(5,false);
com_message_pump(1000); //Ждем пока, COM объект успеет отреагировать на attach()


//Main Loop
if ($sink->attached) {
  
  $CurrentUser = $skype->CurrentUser;
  //Message loop. Set $sink->terminated to true to quit
  while(!$sink->terminated) {
    com_message_pump(1000);
	$cmd = $skype->command(1, 'NAME skypebot', '', TRUE, 10000);
//  echo "send command\n";
//	$cmd = "NAME skypebot";
	$skype->SendCommand($cmd);
  }
}

//***************
class _ISkypeEvents {
	protected $objConnection;
	
	public $terminated = false;
	public $attached = false;

	public function __construct($objConnection) {
		$this->objConnection = $objConnection;
	}

	/**
	 * On com object attach, call this method
	 * 
	 * @param int $status
	 */
	function AttachmentStatus($status) {
		echo "AttachmentStatus\n";
		if ( $status = $this->objConnection->objConverter->TextToAttachmentStatus("AVAILABLE") )
			$this->objConnection->attach(5,false);
		$this->attached = true;
	}
  
  //***************
	function OnlineStatus(&$pUser, $Status ) {
		print "Status: $pUser->Handle $Status\n";
	}

  //***************
	function MessageStatus( &$pMessage, $Status ) {
	global $CurrentUser;
		echo 'MessageStatus: '.$pMessage->Body."(".$pMessage->ChatName.")\n".print_r($pMessage,true);
		if ( substr(strtolower($pMessage->Body),0,4) == 'ping' ) {
		  $skype->Chat($pMessage->ChatName)->SendMessage("pong");
		}
	}
	
	public function command(&$pCommand)
	{
		echo "command:".$pCommand->Command."\n".
		$pCommand->Reply."\n".
		$pCommand->Expected."\n";	
		//com_print_typeinfo($pCommand);
		//echo "\n";
	}
	
	public function reply(&$pCommand)
	{
		echo "reply:".$pCommand->Command."\n".
		$pCommand->Reply."\n".
		$pCommand->Expected."\n";
		echo "\nbject type: ". variant_get_type($pCommand). "\n";
//		com_print_typeinfo($pCommand);
//		echo "\n";
	}
	
/*	public function userstatus(&$pUserStatus)
	{
		echo "userstatus:\n";
		com_print_typeinfo($pUserStatus);
		echo "\n";
	}*/
	public function __call($name, $arguments) {
		echo "not set '".$name."':\n";
		print_r($arguments);
		com_print_typeinfo($arguments);
		echo "\n";
	}

}
?>
