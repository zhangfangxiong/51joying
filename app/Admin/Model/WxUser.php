<?php
/**
 * Created by PhpStorm.
 * User: yaobiqing
 * Date: 16/5/4
 * Time: 下午4:37
 */

/**
 * Class Admin_Model_WxUser
 * 微信用户
 */
class Admin_Model_WxUser extends Admin_Model_Base {


    const TABLE_NAME = 't_wx_user';
    const PK_FIELD = 'iuserID';

    /**
     * @param $sOpenID
     * 根据sOpenID获取信息
     */
    public static function getUserByOpenID($sOpenID)
    {
        return self::getRow(
            [
                'where' => [
                    'sOpenID' => $sOpenID
                ]
            ]
        );
    }

    public static function getUserInfoByOpenID($sToken, $sOpenID, $oUserApi, $scope=0)
    {
        $aData = self::getUserByOpenID($sOpenID);
        if (empty($aData)) {
            //插入新数据
            $aData = [];
            $aData['sOpenID'] = $sOpenID;
            $aData['sIP'] = Util_Tools::getRemoteAddr();
            $iUserID = self::addData($aData);
            $aData['iUserID'] = $iUserID;
        }
        if (empty($aData)) {
            return $aData;
        }
        //获取微信信息
        if($scope) {
            $aWxUserInfo = $oUserApi->getOauthWxUserInfo($sToken, $sOpenID);
        } else {
            $aWxUserInfo = $oUserApi->getWxUserInfo($sToken, $sOpenID);
        }
        if (!isset($aWxUserInfo['errcode'])) {
            $aData['sSex'] = $aWxUserInfo['sex'];
            $aData['sHead'] = $aWxUserInfo['headimgurl'];
            $aData['sCity'] = $aWxUserInfo['city'];
            $aData['sCountry'] = $aWxUserInfo['country'];
            $aData['sProvince'] = $aWxUserInfo['province'];
            $aData['sName'] = $aWxUserInfo['nickname'];
            self::updData($aData);
        }
        return $aData;
    }
}