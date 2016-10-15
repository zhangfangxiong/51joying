<?php
/**
 * Created by PhpStorm.
 * User: yaobiqing
 * Date: 16/5/5
 * Time: 下午12:59
 */

class Admin_Controller_Wxuser extends Admin_Controller_Base
{
    public function listAction()
    {
        $iPage = max($this->getParam('page'), 1);
        $iPageSize = 20;
        $aWhere = [
            'iStatus' => 1
        ];
        $sOrder = 'iUserID DESC';
        $aList = Admin_Model_WxUser::getList($aWhere, $iPage, $sOrder, $iPageSize);
        $this->assign('aList', $aList);
    }
}