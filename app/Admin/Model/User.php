<?php

class Admin_Model_User extends Admin_Model_Base
{

    //所有用户初始密码都定为用户名

    const TABLE_NAME = 't_user';
    const PK_FIELD = 'iuserID'; 

    /**
     * 根据邮箱取得用户
     *
     * @param string $sEmail            
     * @param string $iType            
     * @return array
     */
    public static function getUserByEmail ($sEmail, $iType, $iUserID = 0)
    {
        $aWhere = array(
            'sEmail' => $sEmail,
            'iType' => $iType
        );
        if ($iUserID > 0) {
            $aWhere['iUserID !='] = $iUserID;
        }
        return self::getRow(array(
            'where' => $aWhere
        ));
    }

    /**
     * 根据手机取得用户
     *
     * @param string $sMobile            
     * @param string $iType            
     * @return array
     */
    public static function getUserByMobile ($sMobile, $iType, $iUserID = 0)
    {
        $aWhere = array(
            'sMobile' => $sMobile,
            'iType' => $iType
        );
        if ($iUserID > 0) {
            $aWhere['iUserID !='] = $iUserID;
        }
        return self::getRow(array(
            'where' => $aWhere
        ));
    }

    //根据用户名获取用户
    public static function getUserByUserName($sUserName,$iType)
    {
        $aWhere = array(
            'sUserName' => $sUserName,
            'iType' => $iType
        );
        return self::getRow(array(
            'where' => $aWhere
        ));
    }

    //生成用户名（前端注册后，用户名是自动生成的）
    public static function initUserName($iType)
    {
        //生成规则未定？
        //E88-46634562
        $sUserName = 'E'.$iType.'-'.Util_Tools::passwdGen(8,1);
        if(self::getUserByUserName($sUserName,$iType)) {
            self::initUserName($iType);
        }
        return $sUserName;
    }

    //根据身份证获取用户
    public static function getUserByIdentityCard($sIdentityCard,$iType)
    {
        $aWhere = array(
            'sIdentityCard' => $sIdentityCard,
            'iType' => $iType
        );
        return self::getRow(array(
            'where' => $aWhere
        ));
    }

    //根据体检卡获取用户
    public static function getUserByMedicalCard($sMedicalCard,$iType)
    {
        $aWhere = array(
            'sMedicalCard' => $sMedicalCard,
            'iType' => $iType
        );
        return self::getRow(array(
            'where' => $aWhere
        ));
    }
}