<?php

class Admin_Model_Admin extends Admin_Model_Base
{

    const TABLE_NAME = 't_admin';
    const PK_FIELD = 'iAdminID';

    public static function getAdminByName ($sAdminName)
    {
        return self::getRow(array(
            'where' => array(
                'sAdminName' => $sAdminName,
                'iStatus' => self::STATUS_VALID
            )
        ));
    }

    //显示当前作者能看到的城市
    public static function getCitiesByAdmin($iAdminID)
    {
        $aAdmin = self::getDetail($iAdminID);
        if (!empty($aAdmin)) {
            if ($aAdmin['sCityID'] == "-1") {
                return Admin_Model_City::getPairCitys();
            }
            $aAdminCityID = explode(',',$aAdmin['sCityID']);
            return Admin_Model_City::getPairCitysByIDS($aAdminCityID);
        }
    }

    /*
     * 模糊查询用户
     * @author cjj
     */
    public static  function searchAdminByName($sAdminName)
    {
        if (empty($sAdminName)) {
            return null;
        }
        $aWhere['sAdminName LIKE'] = '%' . $sAdminName . '%';
        $aWhere['iStatus'] = self::STATUS_VALID;

        $aParam = array(
            'where' => $aWhere,
        );

        return self::getAll($aParam);
    }
}