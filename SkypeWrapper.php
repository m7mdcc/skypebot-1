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

require_once 'Exception.php';
require_once 'PropertyTypes.php';
require_once 'objects/Object.php';
require_once 'objects/Chat.php';
require_once 'objects/ChatMessage.php';
require_once 'objects/FileTransfer.php';
require_once 'objects/Group.php';
require_once 'objects/User.php';

class SkypeWrapper extends Wrapper {
	protected	$arrCallback = array(
		'connstatus'	=> array(),
		'chat'			=> array(),
		'chatmessage'	=> array(),
		'chats'			=> array(),
		'contacts'		=> array(),
		'currentuserhandle'	=> array(),
		'filetransfer'	=> array(),
		'group'			=> array(),
		'user'			=> array(),
		'userstatus'	=> array(),
	);
	
	public $arrNoNotified = array (
		'handleSkypeversion',
		'handleProtocol'
	);

	protected	$strIdenty;
	protected	$strConnstatus = null;
	
	protected	$current_user_handle = null;
	protected	$user_status = null;

	protected	$arrChatList = array();
	protected	$arrGroupList = array();
	protected	$arrUserList = array();
	
	protected	$arrChatmessageCache = array();
	protected	$nChatmessageCacheSize = 16;
	protected	$strContactFocused = null;
	protected	$filetransfer_cache = array();
	protected	$filetransfer_cache_size = 16;

	public function __construct($strIdenty, $nProtocol = self::default_protocol, $bDebugMode = false) {
		self::$bDebugMode = $bDebugMode;
		$this->strIdenty = $strIdenty;
		self::initDriver($strIdenty, $nProtocol);
	}

	// ---
	// driver methods
	// ---
	public function connect() {
		return self::getDriver()->connect();
	}
	public function poll($nTimeout)	{
		self::getDriver()->poll($nTimeout);
	}
	public function invoke($strCommand) {
		return self::getDriver()->invoke($strCommand);
	}
	public function invokeProtocol($nProtocol) {
		self::getDriver()->invokeProtocol($nProtocol);
	}

	public function callback($m) {	}	
	public function addCallback($strType, $strCallback) {
		if (isset($this->arrCallback[$strType]) == false) {
			throw new \Exception(sprintf("unsupported callback type [%s]", $strType));
		}
		if (is_callable($strCallback, true) == false) {
			throw new \Exception(sprintf("[%s] is not callable", var_export($strCallback, true)));
		}

		$this->arrCallback[$strType][] = $strCallback;

		return true;
	}
	protected function requestCallback($arrCallbackList, $args) {
		$args = func_get_args();
		array_shift($args);

		foreach ($arrCallbackList as $strCallback) {
			call_user_func_array($strCallback, $args);
		}
	}
	
	/* {{{ Skype API (client -> Skype) */
	public function invokePing() {
		// SEARCH CHATS does not return any response (we can get results via NOTIFY method) ...why?
		list($r) = $this->invoke("PING");
	}


	/* {{{ Skype API (client -> Skype) */
	public function invokeSearchChats() {
		// SEARCH CHATS does not return any response (we can get results via NOTIFY method) ...why?
		list($r, $s) = $this->invoke("SEARCH CHATS");
		return PropertyTypes::force(array(PropertyTypes::string), $s);
	}
	public function invokeSearchFriends() {
		list($r, $s) = $this->invoke("SEARCH FRIENDS");
		return PropertyTypes::force(array(PropertyTypes::string), $s);
	}
	public function invokeSearchGroups($type) {
		list($r, $s) = $this->invoke("SEARCH GROUPS $type");
		return PropertyTypes::force(array(PropertyTypes::int), $s);
	}
	/* }}} */	
	
	/* {{{ Skype API (ChatMessage) */
	public function invokeChatmessage($nChatId, $strMessage) {
		list($r, $s) = $this->invoke("CHATMESSAGE $nChatId $strMessage");
		$this->handleChatmessage($s);

		$tmp = explode(" ", $s, 3);
		return $tmp[0];		// chatmessage_id
	}	
	public function handleChatmessage($s) {
		list($nChatmessageId, $strProperty, $strValue) = explode(" ", $s, 3);

		if (isset($this->arrChatmessageCache[$nChatmessageId]) == false) {
			if (count($this->arrChatmessageCache) >= $this->nChatmessageCacheSize) {
				array_shift($this->arrChatmessageCache);
			}
			$this->arrChatmessageCache[$nChatmessageId] = new objects\ChatMessage($nChatmessageId);
		}
		$objChatMessage = $this->arrChatmessageCache[$nChatmessageId];

		$objChatMessage->set($strProperty, $strValue);

		$this->requestCallback($this->arrCallback['chatmessage'], $objChatMessage, $nChatmessageId, $strProperty, $strValue);
	}	
	public function setChatmessage($nChatMessageId, $property, $value = null) {
		list($r, $s) = $this->invoke("SET CHATMESSAGE $nChatMessageId $property".($value?" ".$value:""));
	}	
	public function getChatmessage($nChatMessageId) {
		if (isset($this->arrChatmessageCache[$nChatMessageId]) == false) {
			$objChatMessage = new objects\ChatMessage($nChatMessageId);
			$this->arrChatmessageCache[$nChatMessageId] = $objChatMessage;
			if (count($this->arrChatmessageCache) > $this->nChatmessageCacheSize) {
				array_shift($this->arrChatmessageCache);
			}
		}
		return $this->arrChatmessageCache[$nChatMessageId];
	}
	/* }}} */
	
	/* {{{ Skype API (Chat) */
	public function invokeOpenChat($nChatId) {
		list($r, $s) = $this->invoke("OPEN CHAT $nChatId");
	}	
	public function handleChat($s) {
		list($nChatId, $property, $value) = explode(" ", $s, 3);

		if (isset($this->arrChatList[$nChatId]) == false) {
			$this->arrChatList[$nChatId] = new objects\Chat($nChatId);
		}
		$objChat = $this->arrChatList[$nChatId];

		$objChat->set($property, $value);

		$this->requestCallback($this->arrCallback['chat'], $objChat, $nChatId, $property, $value);
	}
	/* }}} */
	

	/* {{{ Skype API (Skype -> Client) */
	public function handleConnstatus($s) {
		$this->strConnstatus = $s;
		$this->requestCallback($this->arrCallback['connstatus'], $s);
	}	
	public function handleCall($s) {
		// not yet implemented
	}

	public function handleChats($s) {
		$chat_id_list = $this->parseProperty(array(self::property_type_string), $s);
		foreach ($chat_id_list as $chat_id) {
			$this->arrChatList[$chat_id] = new Skype_Chat($this, $chat_id);
		}

		$this->requestCallback($this->arrCallback['chats'], $chat_id_list);
	}

	public function handleChatmember($s) {
		// not yet implemented
	}



	public function handleContacts($s) {
		$tmp = explode(" ", $s, 2);
		if (count($tmp) <= 1) {
			// lost focus
			$this->strContactFocused = null;
		} else {
			$this->strContactFocused = $tmp[1];
		}

		$this->requestCallback($this->arrCallback['contacts'], $this->strContactFocused);
	}

	public function handleCurrentuserhandle($current_user_handle) {
		$this->current_user_handle = $current_user_handle;
		$this->requestCallback($this->arrCallback['currentuserhandle'], $current_user_handle);
	}

	public function handleFiletransfer($s) {
		list($filetransfer_id, $property, $value) = explode(" ", $s, 3);

		if (isset($this->filetransfer_cache[$filetransfer_id]) == false) {
			if (count($this->filetransfer_cache) >= $this->filetransfer_cache_size) {
				array_shift($this->filetransfer_cache);
			}
			$this->filetransfer_cache[$filetransfer_id] = new Skype_Filetransfer($this, $filetransfer_id);
		}
		$filetransfer = $this->filetransfer_cache[$filetransfer_id];

		$filetransfer->set($property, $value);

		$this->requestCallback($this->arrCallback['filetransfer'], $filetransfer, $filetransfer_id, $property, $value);
	}

	public function handleGroup($s) {
		list($nGroupId, $property, $value) = explode(" ", $s, 3);

		if (isset($this->arrGroupList[$nGroupId]) == false) {
			$this->arrGroupList[$nGroupId] = new objects\Group($nGroupId);
		}
		$group = $this->arrGroupList[$nGroupId];

		$group->set($property, $value);

		$this->requestCallback($this->arrCallback['group'], $group, $nGroupId, $property, $value);
	}

	public function handleUser($s) {
		list($nUserId, $property, $value) = explode(" ", $s, 3);

		if (isset($this->arrUserList[$nUserId]) == false) {
			$this->arrUserList[$nUserId] = new objects\User($nUserId);
		}
		$user = $this->arrUserList[$nUserId];

		$user->set($property, $value);

		$this->requestCallback($this->arrCallback['user'], $user, $nUserId, $property, $value);
	}

	public function handleUserstatus($user_status) {
		$this->user_status = $user_status;

		$this->requestCallback($this->arrCallback['userstatus'], $user_status);
	}
	/* }}} */

	/* {{{ accessor */

	public function getIdenty() {
		return $this->strIdenty;
	}
	public function getCallbackTypeList() {
		return array_keys($this->arrCallback);
	}

	public function getConnstatus() {
		return $this->strConnstatus;
	}


	public function getChat($strChatId) {
		if (isset($this->arrChatList[$strChatId]) == false) {
			$objChat = new objects\Chat($strChatId);
			$this->arrChatList[$strChatId] = $objChat;
		}

		return $this->arrChatList[$strChatId];
	}

	public function getGroup($nGroupId) {
		if (isset($this->arrGroupList[$nGroupId]) == false) {
			$objGroup = new objects\Group($nGroupId);
			$this->arrGroupList[$nGroupId] = $objGroup;
		}
		return $this->arrGroupList[$nGroupId];
	}

	public function getUser($strUserId) {
		if (isset($this->arrUserList[$strUserId]) == false) {
			$objUser = new objects\User($strUserId);
			$this->arrUserList[$strUserId] = $objUser;
		}
		return $this->arrUserList[$strUserId];
	}
	
	public function getContactfocus() {
		return $this->strContactFocused;
	}

	public function getCurrentUserHandle() {
		return $this->current_user_handle;
	}

	public function getFiletransfer($filetransfer_id) {
		if (isset($this->filetransfer_cache[$filetransfer_id]) == false) {
			$filetransfer = new Skype_Filetransfer($this, $filetransfer_id);
			$this->filetransfer_cache[$filetransfer_id] = $filetransfer;
			if (count($this->filetransfer_cache) > $this->filetransfer_cache_size) {
				array_shift($this->filetransfer_cache);
			}
		}

		return $this->filetransfer_cache[$filetransfer_id];
	}

	public function getUserStatus() {
		return $this->user_status;
	}
	/* }}} */

}
?>
