<?php
/**
 * Created by PhpStorm.
 * Author: wangsufei
 * CreateTime: 2015/9/21 15:17
 * Description: FangjiaTradeStat.php
 */

class Admin_Model_Exception extends Admin_Model_Base 
{
    const TABLE_NAME = 't_exception';
    const PK_FIELD = 'iAutoID';
    
    public static function addException($sType, $oExp)
    {
        $sMsg = Yaf_G::parseException($oExp);
        $aData = array(
            'sType' => $sType,
            'sMsg' => $sMsg 
        );
        
        return self::addData($aData);
    }
    
    public static function addMsg($sType, $sMsg) {
        $aData = array(
            'sType' => $sType,
            'sMsg' => $sMsg
        );
        
        return self::addData($aData);
    }
}