<?php
/**
 * 自媒体后台处理
 *
 *  User: pancke@qq.com
 *  Date: 2015-10-28
 *  Time: 下午4:29:42
 */

class Admin_Cmd_Pay extends Admin_Cmd_Base
{
    public function checkpayAction ()
    {
        $aList = Admin_Model_Pay::query('SELECT * FROM t_pay WHERE iStatus=0 LIMIT 100');
        $oCtl = new Payment_Controller_Weixin();
        foreach ($aList as $aRow) {
            $data = json_decode($aRow['sData'], true);
            $iPayID = $oCtl->callback($data);
            if ($iPayID > 0) {
                
            }
        }
    }
}