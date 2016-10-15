<?php
/**
 * 文件转移
 *  
 *  User: pancke@qq.com
 *  Date: 2015-10-28
 *  Time: 下午4:29:42
 */

class Admin_Cmd_File extends Admin_Cmd_Base
{
    public function moveAction ()
    {
        $oStorage = new File_Storage();
        $sHost = $this->getParam('host');
        if (empty($sHost)) {
            echo "Please input host name!!";exit;
        }
        $iCnt = File_Model_File::getOne('SELECT COUNT(*) FROM t_file');
        for ($i = 0; $i < $iCnt; $i += 200) {
            $aList = File_Model_File::getAll("SELECT * FROM t_file LIMIT $i,200");
            foreach ($aList as $aRow) {
                $sFileKey = $aRow['sKey'] . '.' . $aRow['sExt'];
                $sFilePath = $oStorage->getDestFile($sFileKey);
                if (file_exists($sFilePath)) {
                    continue;
                }
                $sUrl = $sHost . '/view/' . $sFileKey;
                $sContent = file_get_contents($sUrl);
                $sDestFile = $oStorage->directSaveFile($aRow['sKey'], $sContent);
                
                echo "$sUrl => $sDestFile\n";
            }
        }
    }
}