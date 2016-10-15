<?php

class Admin_Model_Upload extends Admin_Model_Base
{

    const TABLE_NAME = 't_upload';
    const PK_FIELD = 'iAutoID';

    const TYPE_LOUPAN_TRADE = 0;

    const TYPE_LOUPAN_SUPPLY = 1;

    const TYPE_LAND_TRADE = 2;

    const TYPE_LAND_SUPPLY = 3;

    public static function upload ($iAdminID, $iCityID, $sFileKey, $sFileName, $sClass)
    {
        $iUploadID = (int) self::query("SELECT iAutoID FROM t_upload WHERE sFile='$sFileKey'", 'one');
        if ($iUploadID > 0) {
            return 0;
        }
        
        $iUploadID = self::addData(array(
            'iCityID' => $iCityID,
            'iAdminID' => $iAdminID,
            'sFile' => $sFileKey,
            'sName' => $sFileName,
            'sClass' => $sClass
        ));
        
        return $iUploadID;
    }
}