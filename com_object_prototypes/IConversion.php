<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */


class IConversion { /* GUID={8D82F88A-B307-4074-8ED5-11C3BD213452} */
        /* DISPID=1610612736 */
        function QueryInterface(
                /* VT_PTR [26] [in] --> ? [29]  */ &$riid,
                /* VT_PTR [26] [out] --> VT_PTR [26]  */ &$ppvObj
                )
        {
        }
        /* DISPID=1610612737 */
        /* VT_UI4 [19] */
        function AddRef(
                )
        {
        }
        /* DISPID=1610612738 */
        /* VT_UI4 [19] */
        function Release(
                )
        {
        }
        /* DISPID=1610678272 */
        function GetTypeInfoCount(
                /* VT_PTR [26] [out] --> VT_UINT [23]  */ &$pctinfo
                )
        {
        }
        /* DISPID=1610678273 */
        function GetTypeInfo(
                /* VT_UINT [23] [in] */ $itinfo,
                /* VT_UI4 [19] [in] */ $lcid,
                /* VT_PTR [26] [out] --> VT_PTR [26]  */ &$pptinfo
                )
        {
        }
        /* DISPID=1610678274 */
        function GetIDsOfNames(
                /* VT_PTR [26] [in] --> ? [29]  */ &$riid,
                /* VT_PTR [26] [in] --> VT_PTR [26]  */ &$rgszNames,
                /* VT_UINT [23] [in] */ $cNames,
                /* VT_UI4 [19] [in] */ $lcid,
                /* VT_PTR [26] [out] --> VT_I4 [3]  */ &$rgdispid
                )
        {
        }
        /* DISPID=1610678275 */
        function Invoke(
                /* VT_I4 [3] [in] */ $dispidMember,
                /* VT_PTR [26] [in] --> ? [29]  */ &$riid,
                /* VT_UI4 [19] [in] */ $lcid,
                /* VT_UI2 [18] [in] */ $wFlags,
                /* VT_PTR [26] [in] --> ? [29]  */ &$pdispparams,
                /* VT_PTR [26] [out] --> VT_VARIANT [12]  */ &$pvarResult,
                /* VT_PTR [26] [out] --> ? [29]  */ &$pexcepinfo,
                /* VT_PTR [26] [out] --> VT_UINT [23]  */ &$puArgErr
                )
        {
        }
        /* DISPID=1 */
        /* VT_BSTR [8] */
        function OnlineStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns online status as text. */
        }
        /* DISPID=2 */
        /* ? [29] */
        function TextToOnlineStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns online status code. */
        }
        /* DISPID=3 */
        /* VT_BSTR [8] */
        function BuddyStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns buddy status as text. */
        }
        /* DISPID=4 */
        /* ? [29] */
        function TextToBuddyStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns buddy status code. */
        }
        /* DISPID=5 */
        /* VT_BSTR [8] */
        function CallStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns call status as text. */
        }
        /* DISPID=6 */
        /* ? [29] */
        function TextToCallStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns call status code. */
        }
        /* DISPID=7 */
        /* VT_BSTR [8] */
        function CallTypeToText(
                /* ? [29] [in] */ $CallType
                )
        {
                /* Returns call type as text. */
        }
        /* DISPID=8 */
        /* ? [29] */
        function TextToCallType(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns call type code. */
        }
        /* DISPID=9 */
        /* VT_BSTR [8] */
        function UserSexToText(
                /* ? [29] [in] */ $Sex
                )
        {
                /* Returns user sex as text. */
        }
        /* DISPID=10 */
        /* ? [29] */
        function TextToUserSex(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns user sex code. */
        }
        /* DISPID=11 */
        /* VT_BSTR [8] */
        function ConnectionStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns connection status as text. */
        }
        /* DISPID=12 */
        /* ? [29] */
        function TextToConnectionStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns connection status code. */
        }
        /* DISPID=13 */
        /* VT_BSTR [8] */
        function UserStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns user status as text. */
        }
        /* DISPID=14 */
        /* ? [29] */
        function TextToUserStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns user status code. */
        }
        /* DISPID=15 */
        /* VT_BSTR [8] */
        function CallFailureReasonToText(
                /* ? [29] [in] */ $reason
                )
        {
                /* Returns failure reason as text. */
        }
        /* DISPID=16 */
        /* VT_BSTR [8] */
        function AttachmentStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns attachment status as text. */
        }
        /* DISPID=17 */
        /* VT_BSTR [8] */
        function ChatLeaveReasonToText(
                /* ? [29] [in] */ $reason
                )
        {
                /* Returns leave reason as text. */
        }
        /* DISPID=18 */
        /* VT_BSTR [8] */
        function ChatStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns chatr status as text. */
        }
        /* DISPID=19 */
        /* VT_BSTR [8] */
        function VoicemailTypeToText(
                /* ? [29] [in] */ $Type
                )
        {
                /* Returns voicemail type as text. */
        }
        /* DISPID=20 */
        /* VT_BSTR [8] */
        function VoicemailStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns voicemail status as text. */
        }
        /* DISPID=21 */
        /* ? [29] */
        function TextToVoicemailStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns voicemail status code. */
        }
        /* DISPID=22 */
        /* VT_BSTR [8] */
        function VoicemailFailureReasonToText(
                /* ? [29] [in] */ $code
                )
        {
                /* Returns voicemail failure reason as text. */
        }
        /* DISPID=23 */
        /* VT_BSTR [8] */
        function ChatMessageStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns message status as text. */
        }
        /* DISPID=24 */
        /* ? [29] */
        function TextToChatMessageStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns message status code. */
        }
        /* DISPID=25 */
        /* VT_BSTR [8] */
        function ChatMessageTypeToText(
                /* ? [29] [in] */ $Type
                )
        {
                /* Returns message type as text. */
        }
        /* DISPID=26 */
        /* ? [29] */
        function TextToChatMessageType(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns message type code. */
        }
        /* DISPID=27 */
        /* ? [29] */
        function TextToAttachmentStatus(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns attachment status code. */
        }
        /* DISPID=28 */
        /* VT_BSTR [8] */
        function GroupTypeToText(
                /* ? [29] [in] */ $Type
                )
        {
                /* Returns group type as text. */
        }
        /* DISPID=29 */
        /* ? [29] */
        function TextToGroupType(
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Returns group type code. */
        }
        /* DISPID=30 */
        /* VT_BSTR [8] */
        function CallVideoStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns call video status as text. */
        }
        /* DISPID=31 */
        /* VT_BSTR [8] */
        function CallVideoSendStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns call video send status as text. */
        }
        /* DISPID=32 */
        /* VT_BSTR [8] */
        /* Returns/sets text conversion language. */
        var $Language;

        /* DISPID=32 */
        /* Returns/sets text conversion language. */
        var $Language;

        /* DISPID=33 */
        /* VT_BSTR [8] */
        function SmsMessageStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns SMS message status as text. */
        }
        /* DISPID=34 */
        /* VT_BSTR [8] */
        function SmsMessageTypeToText(
                /* ? [29] [in] */ $Type
                )
        {
                /* Returns SMS message type as text. */
        }
        /* DISPID=35 */
        /* VT_BSTR [8] */
        function SmsTargetStatusToText(
                /* ? [29] [in] */ $Status
                )
        {
                /* Returns SMS target status as text. */
        }
}
?>
