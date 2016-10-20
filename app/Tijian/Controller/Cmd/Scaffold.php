<?php
/**
 * 代码脚手架
 * @author len
 *
 */

class Tijian_Controller_Cmd_Scaffold extends Tijian_Controller_Cmd_Base
{
    public function modelAction() {
        $dbh = Util_Common::getMySQLDB();
        $aTable = $dbh->getCol('SHOW TABLES');
        
        $aFile = glob(APP_PATH . '/Model/*.php');
        foreach ($aFile as $k => $sFile) {
            $aFile[$k] = basename($sFile, '.php');
        }
        $aFile = array_flip($aFile);
        
        foreach ($aTable as $sTable) {
            $aTmp = explode('_', $sTable);
            unset($aTmp[0]);
            foreach ($aTmp as $k => $v) {
                $aTmp[$k] = ucfirst($v);                
            }
            $sFile = join('', $aTmp);
            
            if (isset($aFile[$sFile])) {
                continue;
            }
            
            $sData = 
"<?php

class Model_$sFile extends Tijian_Model_Base
{

    const TABLE_NAME = '$sTable';
}";
            file_put_contents(APP_PATH.'/Model/' . $sFile . '.php', $sData);
            echo $sTable . "=>" . $sFile . "\n";
        }
    }
}