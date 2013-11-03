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
use SkypeWrapper\objects\ChatMessage;

class Log extends Plugin {
	private		$strDirectory;
	private		$strFormat = "{TIMESTAMP}\t[{TYPE}]\t{FROM_DISPNAME}({FROM_HANDLE})\t{BODY}{EDITED}\n";

	public function __construct($parameter) {
		parent::__construct($parameter);

		if (isset($parameter['dir']) == false || is_dir($parameter['dir']) == false) {
			throw new Exception(sprintf("parameter [dir] seems to be invalid or not set"));
		}
		$this->strDirectory = $parameter['dir'];

		if (isset($parameter['format'])) {
			$this->strFormat = $parameter['format'];
		}
	}

	public function handleChatmessage(ChatMessage $objChatMessage, $nChatMessageId, $property, $value) {
		if ($property != 'BODY' && $property != 'STATUS') {
			return;
		}
		if ($property == 'STATUS' && ($value == ChatMessage::STATUS_READ || $value == ChatMessage::STATUS_SENDING)) {
			return;
		}
		
		$arrPropertyList = $objChatMessage->toArray();
		// beautify
		$arrPropertyList['TIMESTAMP'] = strftime('%Y/%m/%d %H:%M:%S', $arrPropertyList['TIMESTAMP']);
		if ($arrPropertyList['EDITED_BY']) {
			$arrPropertyList['EDITED'] = sprintf(" (%s: %s edited)", strftime('%Y/%m/%d %H:%M:%S', $arrPropertyList['EDITED_TIMESTAMP']), $arrPropertyList['EDITED_BY']);
		} else {
			$arrPropertyList['EDITED'] = '';
		}

		$this->append(Wrapper::getWrapper()->getChat($objChatMessage->get('CHATNAME')), $this->strFormat, $arrPropertyList);
	}

	private function append( Chat $objChat, $strFormat, array $arrParameters) {
		if ($this->filterChat($objChat) == false)
			return false;

		// TODO: pluggable log file format
		$r = array('#' => '', '/' => '-', '$' => '', ';' => '-');
		$nChatId = preg_replace('/([#$;\/])/e', "\$r['\$1']", $objChat->getId());
		$strFilePath = sprintf("%s/%s.%s.log", $this->strDirectory, $nChatId, strftime('%Y%m%d'));
		$fp = fopen($strFilePath, "a");
		if (!$fp) {
			return false;
		}
		fwrite($fp, self::format($strFormat, $arrParameters));
		fclose($fp);

		return true;
	}

	private static function format($strFormat, $arrParameter) {
		// :(
		foreach ($arrParameter as $key => $value) {
			if (is_array($value)) {
				// anyway
				continue;
			}
			$strFormat = str_replace("{{$key}}", $value, $strFormat);
		}

		return $strFormat;
	}
}
?>
