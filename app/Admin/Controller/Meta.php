<?php

class Admin_Controller_Meta extends Admin_Controller_Base
{

    /**
     * Meta删除
     */
    public function delAction ()
    {
        $sPage = $this->getParam('id');
        $iRet = Admin_Model_Meta::delData($sPage);
        if ($iRet == 1) {
            return $this->showMsg('页面删除成功！', true);
        } else {
            return $this->showMsg('页面删除失败！', false);
        }
    }

    /**
     * Meta列表
     */
    public function listAction ()
    {
        $iPage = intval($this->getParam('page'));
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        }
        $aWhere = array(
            'iStatus' => 1
        );
        $aList = Admin_Model_Meta::getList($aWhere, $iPage);
        $this->assign('aList', $aList);
    }

    /**
     * Meta修改
     */
    public function editAction ()
    {
        if ($this->_request->isPost()) {
            $aMeta = $this->_checkData('update');
            if (empty($aMeta)) {
                return null;
            }
            if (1 == Admin_Model_Meta::updData($aMeta)) {
                return $this->showMsg('页面信息更新成功！', true);
            } else {
                return $this->showMsg('页面信息更新失败！', false);
            }
        } else {
            $sPage = $this->getParam('id');
            $aMeta = Admin_Model_Meta::getDetail($sPage);
            $this->assign('aMeta', $aMeta);
        }
    }

    /**
     * 增加页面
     */
    public function addAction ()
    {
        if ($this->_request->isPost()) {
            $aMeta = $this->_checkData('add');
            if (empty($aMeta)) {
                return null;
            }
            
            if (Admin_Model_Meta::getDetail($aMeta['sPage'])) {
                return $this->showMsg('页面已经存在！', false);
            }
            Admin_Model_Meta::addData($aMeta);
            return $this->showMsg('页面增加成功！', true);
        }
    }

    /**
     * 请求数据检测
     *
     * @return mixed
     */
    public function _checkData ($sType = 'add')
    {
        $sPage = $this->getParam('sPage');
        $sTitle = $this->getParam('sTitle');
        $sKeyword = $this->getParam('sKeyword');
        $sDescription = $this->getParam('sDescription');
        
        if (! Util_Validate::isLength($sPage, 2, 20)) {
            return $this->showMsg('页面名称长度范围为2到20个字符！', false);
        }
        if (! Util_Validate::isLength($sTitle, 2, 50)) {
            return $this->showMsg('Title长度范围为2到50个字！', false);
        }
        if (! Util_Validate::isLength($sKeyword, 2, 255)) {
            return $this->showMsg('Keyword长度范围为2到50个字！', false);
        }
        if (! Util_Validate::isLength($sDescription, 2, 255)) {
            return $this->showMsg('Description长度范围为2到50个字！', false);
        }
        
        $aRow = array(
            'sPage' => $sPage,
            'sTitle' => $sTitle,
            'sKeyword' => $sKeyword,
            'sDescription' => $sDescription
        );
        
        return $aRow;
    }
}