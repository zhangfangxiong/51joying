<?php

/**
 * 支付回调
 */
class Payment_Controller_Pay extends Index_Controller_Base
{

    /**
     * 自主充值
     */
    public function selfAction ()
    {
        // 判断广告主是否已登录
        $aCurrUser = $this->getCurrUser(Admin_Model_User::TYPE_AD);
        // $aCurrUser = $this->getCurrUser(Admin_Model_User::TYPE_MEDIA);
        if (empty($aCurrUser)) {
            return $this->showMsg('请先登录', false);
        }
        
        $iPayMoney = intval($this->getParam('usmoney'));
        $sPayType = $this->getParam('paytype');
        $ID = intval($this->getParam('id'));
        if ($ID != 0) {
            $iAutoID = $ID;
        } else {
            $aRow = array(
                'iUserID' => $aCurrUser['iUserID'],
                'iPayment' => Admin_Model_Finance::PAYMENT_IN,
                'iSource' => Admin_Model_Finance::SOURCE_SELF_CASH_IN,
                'sReaName' => '',
                'iPayType' => $sPayType == 'alipay' ? Admin_Model_Finance::TYPE_ALIPAY : Admin_Model_Finance::TYPE_WEIXIN,
                'iPayMoney' => $iPayMoney,
                'iUserMoney' => 0,
                'sOpenName' => '',
                'sBankName' => '',
                'sPayAccount' => '',
                'iPayStatus' => 0,
                'sPayOrder' => '',
                'sMyOrder' => '',
                'sRemark' => ''
            );
            $iAutoID = Admin_Model_Finance::addData($aRow);
        }
        $aParam = array(
            'orderid' => Admin_Model_Finance::ORDER_SELF . $iAutoID,
            'subject' => '51wom',
            'body' => '在线支付',
            'total_fee' => $iPayMoney
        );
        switch ($sPayType) {
            case 'alipay':
                return $this->showMsg('/payment/alipay/pay.html?' . http_build_query($aParam), 2);
                break;
            case 'weixin':
                return $this->showMsg('/payment/weixin/pay.html?' . http_build_query($aParam), 3);
                break;
        }
        
        return false;
    }

    /**
     * 广告支付
     */
    public function adAction ()
    {
        // 判断广告主是否已登录
        $aCurrUser = $this->getCurrUser(Admin_Model_User::TYPE_AD);
        if (empty($aCurrUser)) {
            return $this->showMsg('请先登录', false);
        }
        
        $iAdID = intval($this->getParam('id'));
        $aAd = Admin_Model_Ad::getDetail($iAdID);
        if (empty($aAd)) {
            return $this->showMsg('推广计划不存在', false);
        }
        if ($aAd['iPayStatus'] == 1) {
            return $this->showMsg('该推广计划已付款', false);
        }
        
        $paypass = $this->getParam('paypass');
        $usmoney = intval($this->getParam('usmoney'));
        $paytype = $this->getParam('paytype');
        $aUser = Admin_Model_User::getDetail($aCurrUser['iUserID']);
        
        $iPayMoney = $aAd['iTotalMoney'];
        if ($usmoney == 1) {
            if ($aUser['sPayPass'] != Admin_Model_User::makePassword($paypass)) {
                return $this->showMsg('支付密码错误', false);
            }
            
            if ($aUser['iMoney'] >= $iPayMoney) {
                $iPayID = Admin_Model_Finance::payAd($aUser, $aAd, 0);
                if ($iPayID == 0) {
                    return $this->showMsg('支付失败，请稍后再试', false);
                }
                $iPayMoney = 0;
            } else {
                $iPayMoney = $iPayMoney - $aUser['iMoney'];
            }
        }
        
        if ($iPayMoney == 0) {
            return $this->showMsg('/payment/pay/success/id/' . $iPayID . '.html', 1);
        }
        
        $aParam = array(
            'orderid' => Admin_Model_Finance::ORDER_AD . $iAdID,
            'subject' => '51wom',
            'body' => '在线支付',
            'total_fee' => $iPayMoney
        );
        switch ($paytype) {
            case 'alipay':
                return $this->showMsg('/payment/alipay/pay.html?' . http_build_query($aParam), 2);
                break;
            case 'weixin':
                return $this->showMsg('/payment/weixin/pay.html?' . http_build_query($aParam), 3);
                break;
        }
        
        return false;
    }

    /**
     * 检查付款是否成功
     */
    public function checkAction ()
    {
        $sMyOrder = $this->getParam('id', '');
        $aRow = Admin_Model_Finance::getMyOrder($sMyOrder);
        if ($aRow) {
            $this->showMsg('/payment/pay/success/id/' . $aRow['iAutoID'] . '.html', true);
        } else {
            $this->showMsg('付款还未到帐', false);
        }
    }

    public function successAction ()
    {
        $iOrderID = $this->getParam('id');
        $aData = Admin_Model_Finance::getDetail($iOrderID);
        $aUser = Admin_Model_User::getDetail($aData['iUserID']);
        // 支付成功发送邮件到公司媒介专员
        $sTitle = Admin_Model_Kv::getValue('tixing_zhifu_email_title');
        $sContent = Admin_Model_Kv::getValue('tixing_zhifu_email_content');
        $email = 'viven@51wom.com';
        Util_Mail::send($email, $sTitle, $sContent, array(
            $aUser['sEmail'],
            $aData['iPayMoney']
        ));
        $this->assign('aData', $aData);
    }

    public function failAction ()
    {
        $iOrderID = $this->getParam('id');
        $this->assign('iOrderID', $iOrderID);
    }
}