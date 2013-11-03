<?php
class IChatMessage { /* GUID={4CFF5C70-3C95-4566-824A-FA16458
6D535} */
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
        /* Returns message id. */
        var $Id;

        /* DISPID=2 */
        /* VT_DATE [7] */
        /* Returns message timestamp. */
        var $Timestamp;

        /* DISPID=3 */
        /* VT_BSTR [8] */
        /* Returns message from handle. */
        var $FromHandle;

        /* DISPID=4 */
        /* VT_BSTR [8] */
        /* Returns message from display name. */
        var $FromDisplayName;

        /* DISPID=5 */
        /* ? [29] */
        /* Returns message type. */
        var $Type;

        /* DISPID=6 */
        /* ? [29] */
        /* Returns message status. */
        var $Status;

        /* DISPID=7 */
        /* ? [29] */
        /* Returns chat leave reason. */
        var $LeaveReason;

        /* DISPID=8 */
        /* VT_BSTR [8] */
        /* Returns/sets message body. */
        var $Body;

        /* DISPID=9 */
        /* VT_BSTR [8] */
        /* Returns chat name. */
        var $ChatName;

        /* DISPID=10 */
        /* VT_PTR [26] */
        /* Returns people added to chat. */
        var $Users;

        /* DISPID=11 */
        /* Sets message seen status. */
        var $Seen;

        /* DISPID=12 */
        /* VT_PTR [26] */
        /* Returns message chat object. */
        var $Chat;

        /* DISPID=13 */
        /* VT_PTR [26] */
        /* Returns message sender. */
        var $Sender;

        /* DISPID=14 */
        /* VT_BSTR [8] */
        /* Returns last message editor Skypename. */
        var $EditedBy;

        /* DISPID=15 */
        /* VT_DATE [7] */
        /* Returns last message edit timestamp. */
        var $EditedTimestamp;

        /* DISPID=8 */
        /* Returns/sets message body. */
        var $Body;

        /* DISPID=16 */
        /* ? [29] */
        /* Returns changed member role. */
        var $Role;

        /* DISPID=17 */
        /* VT_I4 [3] */
        /* Returns changed chat options. */
        var $Options;

        /* DISPID=18 */
        /* VT_BOOL [11] */
        /* Returns true if the message can be edited. */
        var $IsEditable;

        /* DISPID=19 */
        /* VT_BSTR [8] */
        /* Returns chat message unique identifier. */
        var $Guid;

}
?>
