<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */

class ICommand { /* GUID={48E046A8-31D7-4E5F-A611-47BF32B86405} */
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
        /* Returns/sets command id. */
        var $Id;

        /* DISPID=1 */
        /* Returns/sets command id. */
        var $Id;

        /* DISPID=2 */
        /* VT_I4 [3] */
        /* Returns/sets wait timeout in milliseconds. */
        var $Timeout;

        /* DISPID=2 */
        /* Returns/sets wait timeout in milliseconds. */
        var $Timeout;

        /* DISPID=3 */
        /* VT_BOOL [11] */
        /* Returns/sets blocking command flag. */
        var $Blocking;

        /* DISPID=3 */
        /* Returns/sets blocking command flag. */
        var $Blocking;

        /* DISPID=4 */
        /* VT_BSTR [8] */
        /* Returns/sets command text. */
        var $Command;

        /* DISPID=4 */
        /* Returns/sets command text. */
        var $Command;

        /* DISPID=5 */
        /* VT_BSTR [8] */
        /* Returns/sets reply text. */
        var $Reply;

        /* DISPID=5 */
        /* Returns/sets reply text. */
        var $Reply;

        /* DISPID=6 */
        /* VT_BSTR [8] */
        /* Returns/sets expected reply text. */
        var $Expected;

        /* DISPID=6 */
        /* Returns/sets expected reply text. */
        var $Expected;

}
?>
