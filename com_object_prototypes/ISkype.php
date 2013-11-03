<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */

class ISkype { /* GUID={B1878BFE-53D3-402E-8C86-190B19AF70D5} */
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
        /* VT_I4 [3] */
        /* Returns/sets Skype API wait timeout in milliseconds. */
        var $Timeout;

        /* DISPID=1 */
        /* Returns/sets Skype API wait timeout in milliseconds. */
        var $Timeout;

        /* DISPID=2 */
        /* VT_BSTR [8] */
        /* Returns/sets USER, CALL, CHAT, CHATMESSAGE or VOICEMAIL object property value. */
        var $Property;

        /* DISPID=2 */
        /* Returns/sets USER, CALL, CHAT, CHATMESSAGE or VOICEMAIL object property value. */
        var $Property;

        /* DISPID=3 */
        /* VT_BSTR [8] */
        /* Returns/sets general variable value. */
        var $Variable;

        /* DISPID=3 */
        /* Returns/sets general variable value. */
        var $Variable;

        /* DISPID=4 */
        /* VT_BSTR [8] */
        /* Returns current user handle. */
        var $CurrentUserHandle;

        /* DISPID=5 */
        /* ? [29] */
        /* Returns/sets current user online status. */
        var $CurrentUserStatus;

        /* DISPID=5 */
        /* Returns/sets current user online status. */
        var $CurrentUserStatus;

        /* DISPID=6 */
        /* ? [29] */
        /* Returns connection status. */
        var $ConnectionStatus;

        /* DISPID=7 */
        /* VT_BOOL [11] */
        /* Returns/sets mute status. */
        var $Mute;

        /* DISPID=7 */
        /* Returns/sets mute status. */
        var $Mute;

        /* DISPID=8 */
        /* VT_BSTR [8] */
        /* Returns Skype application version. */
        var $Version;

        /* DISPID=9 */
        /* VT_BOOL [11] */
        /* Returns current user privilege. */
        var $Privilege;

        /* DISPID=10 */
        /* VT_PTR [26] */
        /* Returns current user object. */
        var $CurrentUser;

        /* DISPID=11 */
        /* VT_PTR [26] */
        /* Returns conversion object. */
        var $Convert;

        /* DISPID=12 */
        /* VT_PTR [26] */
        /* Returns collection of users in the friends list. */
        var $Friends;

        /* DISPID=13 */
        /* VT_PTR [26] */
        function SearchForUsers(
                /* VT_BSTR [8] [in] */ $Target
                )
        {
                /* Returns collection of users found as the result of search operation. */
        }
        /* DISPID=14 */
        /* VT_PTR [26] */
        /* Returns collection of calls in the call history. */
        var $Calls;

        /* DISPID=15 */
        /* VT_PTR [26] */
        /* Returns collection of currently active calls. */
        var $ActiveCalls;

        /* DISPID=16 */
        /* VT_PTR [26] */
        /* Returns collection of missed calls. */
        var $MissedCalls;

        /* DISPID=17 */
        /* VT_PTR [26] */
        /* Returns chat messages. */
        var $Messages;

        /* DISPID=18 */
        /* VT_PTR [26] */
        /* Returns collection of missed messages. */
        var $MissedMessages;

        /* DISPID=19 */
        /* ? [29] */
        /* Returns Skype API attachment status. */
        var $AttachmentStatus;

        /* DISPID=20 */
        /* VT_I4 [3] */
        /* Returns/sets Skype API protocol version. */
        var $Protocol;

        /* DISPID=20 */
        /* Returns/sets Skype API protocol version. */
        var $Protocol;

        /* DISPID=21 */
        function Attach(
                /* VT_I4 [3] [in] */ $Protocol,
                /* VT_BOOL [11] [in] */ $Wait
                )
        {
                /* Connects to Skype API. */
        }
        /* DISPID=22 */
        /* VT_PTR [26] */
        function PlaceCall(
                /* VT_BSTR [8] [in] */ $Target,
                /* VT_BSTR [8] [in] */ $Target2,
                /* VT_BSTR [8] [in] */ $Target3,
                /* VT_BSTR [8] [in] */ $Target4
                )
        {
                /* Calls specified target and returns a new call object. */
        }
        /* DISPID=23 */
        /* VT_PTR [26] */
        function SendMessage(
                /* VT_BSTR [8] [in] */ $Username,
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Sends IM message to specified user and returns a new message object. */
        }
        /* DISPID=24 */
        /* VT_PTR [26] */
        /* Returns a new user object. */
        var $User;

        /* DISPID=25 */
        /* VT_PTR [26] */
        /* Returns a new message object. */
        var $Message;

        /* DISPID=26 */
        /* VT_PTR [26] */
        /* Returns a new call object. */
        var $Call;

        /* DISPID=27 */
        function SendCommand(
                /* VT_PTR [26] [in] --> ? [29]  */ &$pCommand
                )
        {
                /* Sends Skype API command. */
        }
        /* DISPID=28 */
        /* VT_PTR [26] */
        /* Returns user IM conversations. */
        var $Chats;

        /* DISPID=29 */
        /* VT_PTR [26] */
        /* Returns new chat object. */
        var $Chat;

        /* DISPID=30 */
        function ChangeUserStatus(
                /* ? [29] [in] */ $newVal
                )
        {
                /* Changes current user online status. */
        }
        /* DISPID=31 */
        /* VT_PTR [26] */
        /* Returns a new conference object. */
        var $Conference;

        /* DISPID=32 */
        /* VT_PTR [26] */
        /* Returns collection of conferences. */
        var $Conferences;

        /* DISPID=33 */
        /* VT_BSTR [8] */
        /* Returns user profile property value. */
        var $Profile;

        /* DISPID=33 */
        /* Returns user profile property value. */
        var $Profile;

        /* DISPID=34 */
        /* VT_PTR [26] */
        /* Returns active chats. */
        var $ActiveChats;

        /* DISPID=35 */
        /* VT_PTR [26] */
        /* Returns missed chats. */
        var $MissedChats;

        /* DISPID=36 */
        /* VT_PTR [26] */
        /* Returns most recent chats. */
        var $RecentChats;

        /* DISPID=37 */
        /* VT_PTR [26] */
        /* Returns bookmarked chats. */
        var $BookmarkedChats;

        /* DISPID=38 */
        /* VT_PTR [26] */
        function CreateChatWith(
                /* VT_BSTR [8] [in] */ $Username
                )
        {
                /* Creates a new chat with a single user. */
        }
        /* DISPID=39 */
        /* VT_PTR [26] */
        function CreateChatMultiple(
                /* VT_PTR [26] [in] --> ? [29]  */ &$pMembers
                )
        {
                /* Creates a new chat with multiple members. */
        }
        /* DISPID=40 */
        /* VT_PTR [26] */
        /* Retuns voicemails. */
        var $Voicemails;

        /* DISPID=41 */
        /* VT_PTR [26] */
        function SendVoicemail(
                /* VT_BSTR [8] [in] */ $Username
                )
        {
                /* Sends voicemail to specified user. */
        }
        /* DISPID=42 */
        /* VT_PTR [26] */
        /* Returns users waiting authorization. */
        var $UsersWaitingAuthorization;

        /* DISPID=43 */
        function ClearChatHistory(
                )
        {
                /* Clears chat history. */
        }
        /* DISPID=44 */
        function ClearVoicemailHistory(
                )
        {
                /* Clears voicemail history. */
        }
        /* DISPID=45 */
        function ClearCallHistory(
                /* VT_BSTR [8] [in] */ $Username,
                /* ? [29] [in] */ $Type
                )
        {
                /* Clears call history. */
        }
        /* DISPID=46 */
        /* VT_BOOL [11] */
        /* Returns/sets automatic command identifiers. */
        var $CommandId;

        /* DISPID=46 */
        /* Returns/sets automatic command identifiers. */
        var $CommandId;

        /* DISPID=47 */
        /* VT_PTR [26] */
        /* Returns new application object. */
        var $Application;

        /* DISPID=48 */
        /* VT_PTR [26] */
        /* Returns user greeting. */
        var $Greeting;

        /* DISPID=49 */
        /* VT_BOOL [11] */
        /* Enables/disables internal API cache. */
        var $Cache;

        /* DISPID=49 */
        /* Enables/disables internal API cache. */
        var $Cache;

        /* DISPID=50 */
        function ResetCache(
                )
        {
                /* Empties command cache. */
        }
        /* DISPID=51 */
        /* VT_PTR [26] */
        /* Returns logged-in user profile object. */
        var $CurrentUserProfile;

        /* DISPID=52 */
        /* VT_PTR [26] */
        /* Returns all contact groups. */
        var $Groups;

        /* DISPID=53 */
        /* VT_PTR [26] */
        /* Returns user defined contact groups. */
        var $CustomGroups;

        /* DISPID=54 */
        /* VT_PTR [26] */
        /* Returns predefined contact groups. */
        var $HardwiredGroups;

        /* DISPID=55 */
        /* VT_PTR [26] */
        function CreateGroup(
                /* VT_BSTR [8] [in] */ $GroupName
                )
        {
                /* Creates a new custom group. */
        }
        /* DISPID=56 */
        function DeleteGroup(
                /* VT_I4 [3] [in] */ $GroupId
                )
        {
                /* Deletes a custom group. */
        }
        /* DISPID=57 */
        /* VT_PTR [26] */
        /* Returns settings object. */
        var $Settings;

        /* DISPID=58 */
        /* VT_PTR [26] */
        /* Returns client object. */
        var $Client;

        /* DISPID=59 */
        /* Sets application display name. */
        var $FriendlyName;

        /* DISPID=60 */
        /* VT_PTR [26] */
        /* Returns a new command object. */
        var $Command;

        /* DISPID=61 */
        /* VT_PTR [26] */
        /* Returns voicemail object. */
        var $Voicemail;

        /* DISPID=62 */
        /* VT_PTR [26] */
        /* Returns missed voicemails. */
        var $MissedVoicemails;

        /* DISPID=63 */
        function EnableApiSecurityContext(
                /* ? [29] [in] */ $Context
                )
        {
                /* Enables API security contexts. */
        }
        /* DISPID=64 */
        /* VT_BOOL [11] */
        /* Checks for enabled API security contexts. */
        var $ApiSecurityContextEnabled;

        /* DISPID=65 */
        /* VT_PTR [26] */
        function CreateSms(
                /* ? [29] [in] */ $MessageType,
                /* VT_BSTR [8] [in] */ $TargetNumbers
                )
        {
                /* Returns new SMS object. */
        }
        /* DISPID=66 */
        /* VT_PTR [26] */
        /* Returns SMS messages. */
        var $Smss;

        /* DISPID=67 */
        /* VT_PTR [26] */
        /* Returns missed SMS messages. */
        var $MissedSmss;

        /* DISPID=68 */
        /* VT_PTR [26] */
        function SendSms(
                /* VT_BSTR [8] [in] */ $TargetNumbers,
                /* VT_BSTR [8] [in] */ $MessageText,
                /* VT_BSTR [8] [in] */ $ReplyToNumber
                )
        {
                /* Sends a SMS messages. */
        }
        /* DISPID=69 */
        /* VT_I4 [3] */
        function AsyncSearchUsers(
                /* VT_BSTR [8] [in] */ $Target
                )
        {
                /* Search for Skype users. */
        }
        /* DISPID=70 */
        /* VT_BSTR [8] */
        /* Returns API wrapper version. */
        var $ApiWrapperVersion;

        /* DISPID=71 */
        /* VT_BOOL [11] */
        /* Returns/sets silent mode. */
        var $SilentMode;

        /* DISPID=71 */
        /* Returns/sets silent mode. */
        var $SilentMode;

        /* DISPID=72 */
        /* VT_PTR [26] */
        /* Returns file transfers. */
        var $FileTransfers;

        /* DISPID=73 */
        /* VT_PTR [26] */
        /* Returns active file transfers. */
        var $ActiveFileTransfers;

        /* DISPID=74 */
        /* VT_PTR [26] */
        /* Returns focused contacts. */
        var $FocusedContacts;

        /* DISPID=75 */
        /* VT_PTR [26] */
        function FindChatUsingBlob(
                /* VT_BSTR [8] [in] */ $Blob
                )
        {
                /* Returns chat mathing the blob. */
        }
        /* DISPID=76 */
        /* VT_PTR [26] */
        function CreateChatUsingBlob(
                /* VT_BSTR [8] [in] */ $Blob
                )
        {
                /* Returns chat mathing the blob, optionally creating the chat. */
        }
        /* DISPID=77 */
        /* VT_BSTR [8] */
        var $PredictiveDialerCountry;

}
?>
