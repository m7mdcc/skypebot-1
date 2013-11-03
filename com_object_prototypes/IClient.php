<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */

class IClient { /* GUID={838731B0-88E7-4BED-81DC-B35CA8433341} */
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
        function Start(
                /* VT_BOOL [11] [in] */ $Minimized,
                /* VT_BOOL [11] [in] */ $Nosplash
                )
        {
                /* Starts Skype application. */
        }
        /* DISPID=2 */
        function Minimize(
                )
        {
                /* Hides Skype application window. */
        }
        /* DISPID=3 */
        function Shutdown(
                )
        {
                /* Closes Skype application. */
        }
        /* DISPID=4 */
        /* VT_BOOL [11] */
        /* Returns Skype application running status. */
        var $IsRunning;

        /* DISPID=5 */
        function OpenProfileDialog(
                )
        {
                /* Opens current user profile dialog. */
        }
        /* DISPID=6 */
        function OpenUserInfoDialog(
                /* VT_BSTR [8] [in] */ $Username
                )
        {
                /* Opens user information dialog. */
        }
        /* DISPID=7 */
        function OpenConferenceDialog(
                )
        {
                /* Opens create conference dialog. */
        }
        /* DISPID=8 */
        function OpenSearchDialog(
                )
        {
                /* Opens search dialog. */
        }
        /* DISPID=9 */
        function OpenOptionsDialog(
                /* VT_BSTR [8] [in] */ $Page
                )
        {
                /* Opens options dialog. */
        }
        /* DISPID=10 */
        function OpenCallHistoryTab(
                )
        {
                /* Opens call history tab. */
        }
        /* DISPID=11 */
        function OpenContactsTab(
                )
        {
                /* Opens contacts tab. */
        }
        /* DISPID=12 */
        function OpenDialpadTab(
                )
        {
                /* Opens dial pad tab. */
        }
        /* DISPID=13 */
        function OpenSendContactsDialog(
                /* VT_BSTR [8] [in] */ $Username
                )
        {
                /* Opens send contacts dialog. */
        }
        /* DISPID=14 */
        function OpenBlockedUsersDialog(
                )
        {
                /* Opens blocked users dialog. */
        }
        /* DISPID=15 */
        function OpenImportContactsWizard(
                )
        {
                /* Opens import contacts wizard. */
        }
        /* DISPID=16 */
        function OpenGettingStartedWizard(
                )
        {
                /* Opens getting started wizard. */
        }
        /* DISPID=17 */
        function OpenAuthorizationDialog(
                /* VT_BSTR [8] [in] */ $Username
                )
        {
                /* Opens authorization dialog. */
        }
        /* DISPID=18 */
        function OpenDialog(
                /* VT_BSTR [8] [in] */ $Name,
                /* VT_BSTR [8] [in] */ $Param1,
                /* VT_BSTR [8] [in] */ $Param2
                )
        {
                /* Open dialog. */
        }
        /* DISPID=19 */
        function OpenVideoTestDialog(
                )
        {
                /* Opens video test dialog. */
        }
        /* DISPID=20 */
        function OpenAddContactDialog(
                /* VT_BSTR [8] [in] */ $Username
                )
        {
                /* Opens "Add a Contact" dialog. */
        }
        /* DISPID=21 */
        function OpenMessageDialog(
                /* VT_BSTR [8] [in] */ $Username,
                /* VT_BSTR [8] [in] */ $Text
                )
        {
                /* Opens "Send an IM Message" dialog. */
        }
        /* DISPID=22 */
        function OpenFileTransferDialog(
                /* VT_BSTR [8] [in] */ $User,
                /* VT_BSTR [8] [in] */ $Folder
                )
        {
                /* Opens file transfer dialog. */
        }
        /* DISPID=23 */
        function Focus(
                )
        {
                /* Sets focus to Skype application window. */
        }
        /* DISPID=24 */
        function ButtonPressed(
                /* VT_BSTR [8] [in] */ $Key
                )
        {
                /* Sends button button pressed to client. */
        }
        /* DISPID=25 */
        function ButtonReleased(
                /* VT_BSTR [8] [in] */ $Key
                )
        {
                /* Sends button released event to client. */
        }
        /* DISPID=26 */
        function OpenSmsDialog(
                /* VT_BSTR [8] [in] */ $SmsId
                )
        {
                /* Opens SMS window */
        }
        /* DISPID=27 */
        /* VT_PTR [26] */
        function CreateEvent(
                /* VT_BSTR [8] [in] */ $EventId,
                /* VT_BSTR [8] [in] */ $Caption,
                /* VT_BSTR [8] [in] */ $Hint
                )
        {
                /* Creates new plugin event. */
        }
        /* DISPID=28 */
        /* VT_PTR [26] */
        function CreateMenuItem(
                /* VT_BSTR [8] [in] */ $MenuItemId,
                /* ? [29] [in] */ $PluginContext,
                /* VT_BSTR [8] [in] */ $CaptionText,
                /* VT_BSTR [8] [in] */ $HintText,
                /* VT_BSTR [8] [in] */ $IconPath,
                /* VT_BOOL [11] [in] */ $Enabled,
                /* ? [29] [in] */ $ContactType,
                /* VT_BOOL [11] [in] */ $MultipleContacts
                )
        {
                /* Creates new tools menu item */
        }
        /* DISPID=29 */
        /* VT_BSTR [8] */
        /* Returns/sets wallpaper. */
        var $Wallpaper;

        /* DISPID=29 */
        /* Returns/sets wallpaper. */
        var $Wallpaper;

        /* DISPID=30 */
        function OpenLiveTab(
                )
        {
                /* Opens Live tab. */
        }
}

?>
