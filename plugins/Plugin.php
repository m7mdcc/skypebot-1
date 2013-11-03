<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper\plugins;

use SkypeWrapper\objects\Chat;
use SkypeWrapper\objects\ChatMessage;

class Plugin {
	protected	$pregChatTopicFilter = null;
	protected	$pregChatIdFilter = null;

	public function __construct($parameter) {

		if (isset($parameter['chat_topic_filter'])) {
			$this->pregChatTopicFilter = $parameter['chat_topic_filter'];
		}
		if (isset($parameter['chat_id_filter'])) {
			$this->pregChatIdFilter = $parameter['chat_id_filter'];
		}
	}
	public function handleCall() {
	}
	public function handleChat(Chat $objChat, $nChatId, $property, $value) {
	}
	public function handleChats($chat_id_list) {
	}
	public function handleChatmember() {
	}
	public function handleChatmessage(ChatMessage $chatmessage, $chatmessage_id, $property, $value) {
	}
	public function handleConnstatus($status) {
	}
	public function handleContacts($contact_focus) {
	}
	public function handleCurrentuserhandle($current_user_handle) {
	}
	public function handleFiletransfer($filetransfer, $filetransfer_id, $property, $value) {
	}
	public function handleGroup($group, $group_id, $property, $value) {
	}
	public function handleUser($user, $user_id, $property, $value) {
	}
	public function handleUserstatus($user_status) {
	}
	protected function filterChat(Chat $objChat) {
		if ($this->pregChatTopicFilter != null) {
			if (preg_match($this->pregChatTopicFilter, $objChat->get('TOPIC'))) {
				return false;
			}
		}
		if ($this->pregChatIdFilter != null) {
			if (preg_match($this->pregChatIdFilter, $objChat->getId())) {
				return false;
			}
		}
		return true;
	}
}
?>
