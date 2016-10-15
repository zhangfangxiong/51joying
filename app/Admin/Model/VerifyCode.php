<?php

class Admin_Model_VerifyCode extends Admin_Model_Base
{

    const TABLE_NAME = 't_verify_code';

    const TYPE_USER_ACTIVE = 0;

    const TYPE_USER_FORGET = 1;

    /**
     * 生成激活码|忘记密码
     *
     * @param unknown $aUser
     * @return string
     */
    public static function makeCode ($aUser, $iType)
    {
        $sCryptkey = Util_Common::getConf('cryptkey', 'passwd');
        $sActiveCode = md5($sCryptkey . $aUser['sEmail'] . $aUser['iType'] . time());
        Admin_Model_VerifyCode::addData(array(
            'sUser' => $aUser['sUser'],
            'iType' => $iType,
            'sCode' => $sActiveCode
        ));

        return $sActiveCode;
    }

    /**
     * 增加一个码
     *
     * @param unknown $aUser
     * @return string
     */
    public static function addCode ($sMobile, $iType, $sCode)
    {
        return self::replace(array(
            'sUser' => $sMobile,
            'iType' => $iType,
            'sCode' => $sCode
        ));
    }

    /**
     * 取得最后一条验证码
     *
     * @param unknown $sUser
     * @param unknown $iType
     * @param string $sCode
     * @return Ambigous <number, multitype:, mixed>
     */
    public static function getCode ($sUser, $iType, $sCode = null)
    {

        $aWhere = array(
            'sUser' => $sUser,
            'iType' => $iType,
            'iStatus' => 1
        );

        if (! empty($sCode)) {
            $aWhere['sCode'] = $sCode;
        }

        return self::getRow(array(
            'where' => $aWhere,
            'order' => 'iAutoID DESC'
        ));
    }
}