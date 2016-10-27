<?php

/**
 * 支付回调
 */
class Tijian_Controller_Payment_Pay extends Tijian_Controller_Index_Base
{
    /**
     * 检查付款是否成功
     */
    public function checkAction ()
    {
        $sMyOrder = $this->getParam('id', '');
        $aRow = Tijian_Model_Pay::checkPay($sMyOrder);

        if ($aRow) {
            $aOrder = Tijian_Model_OrderInfo::getRow(['where' => ['sOrderCode' => $aRow['sMyOrderID']]]);
            if (in_array($aOrder['iOrderType'], [3, 4, 5])) {
                $aOP = Tijian_Model_OrderProduct::getRow(['where' => [
                    'iOrderID' => $aOrder['iOrderID']
                ]]);
                $aCP = Tijian_Model_OrderCardProduct::getRow(['where' => [
                    'iOrderID' => $aOrder['iOrderID']
                ]]);
                
                $aAttr = json_decode($aOP['sProductAttr'], true);
                $url = '/tijian/index/order/buyfourth/id/'.$aAttr['iCardID'].'/pid/'.$aCP['iProductID'].'/sid/'.$aAttr['iStoreID'];
                
                // 支付成功发送邮件
                Tijian_Model_OrderInfo::sendMailMsg($aOrder, 1, $aCP['sProductName']);
            } else {
                $url = "/tijian/payment/pay/success/id/" . $aRow['iAutoID'] . '.html';

                // 支付成功发送邮件
                Tijian_Model_OrderInfo::sendMailMsg($aOrder, 2);
            }            

            // return $this->show404('支付成功', true,'/payment/pay/success/id/' . $url);
            return $this->show404('支付成功', true, $url);
        } else {
            return $this->show404('付款还未到帐', false);
        }
    }

    public function successAction ()
    {
        $this->_frame = 'pcbasic.phtml';

        $iOrderID = $this->getParam('id');
        //判断订单状态是否正常
        $aPay = Tijian_Model_Pay::getDetail($iOrderID);
        if (empty($aPay)) {
            return $this->show404('订单未支付成功', false);
        }
        $aOrderInfo = Tijian_Model_OrderInfo::getOrderByOrderCode($aPay['sMyOrderID']);
        if (empty($aOrderInfo['iPayStatus'])) {
            return $this->show404('订单状态有误，请联系管理员', false);
        }

        $aOP = Tijian_Model_OrderProduct::getAll(['where' => [
            'iOrderID' => $iOrderID
        ]]);
        $sProduct = '';
        if ($aOP) {
            foreach ($aOP as $key => $value) {
                $aProduct = Tijian_Model_UserProductBase::getUserProductBase($value['iProductID'], $this->aUser['iCreateUserID'], 2, $this->aUser['iChannelID']);
                $sProduct .= $aProduct['sProductName'] . '(';

                $aCard = Tijian_Model_OrderCard::getAll(['where' => [
                    'iOPID' => $value['iAutoID']
                ]]);
                foreach ($aCard as $k => $v) {
                    if (empty($v['iUserID'])) {
                        $status = '未绑定';
                    } else {
                        $status = '已绑定';
                    }
                    $sProduct .= $v['sCardCode'] . '[' . $status . ' ]';
                }

                $sProduct .= ')';
            }
        }
        $aUser = Tijian_Model_Customer::getDetail($aOrderInfo['iUserID']);

        $this->assign('aData', $aOrderInfo);
        $this->assign('aUser', $aUser);
    }

    public function failAction ()
    {
        $iOrderID = $this->getParam('id');
        $this->assign('iOrderID', $iOrderID);
    }
}