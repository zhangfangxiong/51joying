<?php

/**
 * 提供验证码服务
 * Created by PhpStorm.
 * User: xiejinci
 * Date: 14/12/24
 * Time: 下午2:32
 */
class Index_Controller_Verify extends Yaf_Controller
{

    /**
     * 获取图片验证码
     */
    public function imageAction ()
    {
        $iType = (int) $this->getParam('type');
        $sImg = Util_Verify::makeImageCode($iType);
        $this->getResponse()->setHeader('Content-Type', 'gif');
        echo $sImg;
        return false;
    }

    /*
     * 
     */
    public function checkImageCodeAction()
    {
        $sCode = trim($this->getParam('code'));
        $iType = (int) $this->getParam('type');
        $ret = Util_Verify::checkImageCode($iType, $sCode);
        if ($ret) {
            return $this->retData(0, '图片验证码正确');
        }

        return $this->retData(0, '图片验证码错误');
    }

    /**
     * 发送手机验证码
     */
    public function smsAction ()
    {
        $sMobile = $this->getParam('mobile');
        $iType = $this->getParam('type');

        $aRet = Util_Verify::makeSMSCode($sMobile, $iType);

        if ($aRet['status']) {
            return $this->retData(0, '手机验证码发送成功');
        } else {
            return $this->retData(1, $aRet['data']);
        }
    }
}