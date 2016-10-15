<?php

class Admin_Model_ActionLog extends Admin_Model_Base
{

    const TABLE_NAME = 't_log';
    
    const PK_FIELD = 'iAutoID';

    const TYPE_FRONT = 1;
    
    const TYPE_BACKEND = 2;
    
    private static $_sUserName = '';

    private static $_iType = 0;

    /**
     * 取得当前用户
     * @return unknown
     */
    public static function getUser()
    {
        return self::$_sUserName;
    }
    
    /**
     * 取得当前类型
     * @return unknown
     */
    public static function getType()
    {
        return self::$_iType;
    }
    
    /**
     * 设置当前用户名
     * @param unknown $sUserName
     */
    public static function setUser ($sUserName)
    {
        self::$_sUserName = $sUserName;
    }

    /**
     * 设置当前类型
     * @param unknown $iType
     */
    public static function setType ($iType)
    {
        self::$_iType = $iType;
    }
    
    public static function addLog ($request)
    {
        $aLog = array(
            'sIP' => $request->getClientIP(),
            'sParam' => json_encode($request->getParams()),
            'sUrl' => Util_Uri::getCurrUrl()
        );
        
        self::addData($aLog);
    }
}