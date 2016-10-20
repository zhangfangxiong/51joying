<?php

class Tijian_Plugin_ActionLog extends Yaf_Plugin
{
    public function dispatchLoopShutdown (Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $aADUSQL = Db_Orm::getADUSQL();
        if (! empty($aADUSQL)) {
            $aLog = array(
                'sIP' => $request->getClientIP(),
                'sParam' => json_encode($request->getParams()),
                'sSQL' => join("\n", $aADUSQL),
                'sUserName' => Tijian_Model_ActionLog::getUser(),
                'iType' => Tijian_Model_ActionLog::getType(),
                'sUrl' => Util_Uri::getCurrUrl()
            );
        
            Tijian_Model_ActionLog::addData($aLog);
        }
    }
}