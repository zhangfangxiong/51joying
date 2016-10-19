<?php

class Tijian_Controller_Admin_Menu extends Tijian_Controller_Admin_Base
{

    /**
     * 删除菜单
     * 
     * @return boolean
     */
    public function delAction ()
    {
        $iMenuID = intval($this->getParam('id'));
        $iRet = Tijian_Model_Menu::delData($iMenuID);
        if ($iRet == 1) {
            return $this->showMsg('菜单删除成功！', true);
        } else {
            return $this->showMsg('菜单删除失败！', false);
        }
    }

    /**
     * 菜单列表
     */
    public function listAction ()
    {
        $aTree = Tijian_Model_Menu::getTree();
        $this->assign('aTree', $aTree);
        $this->assign('aColor', array(
            '',
            'success',
            'warning',
            'danger',
            'info',
            'active'
        ));
    }

    /**
     * 编辑菜单
     */
    public function editAction ()
    {
        if ($this->isPost()) {            
            $aMenu = $this->_checkData('update');
            if (empty($aMenu)) {
                return null;
            }
            $aMenu['iMenuID'] = intval($this->getParam('iMenuID'));
            $aOldMenu = Tijian_Model_Menu::getDetail($aMenu['iMenuID']);
            if (empty($aOldMenu)) {
                return $this->showMsg('菜单不存在！', false);
            }
            // 更新排序，加在最后面
            if ($aOldMenu['iParentID'] != $aMenu['iParentID']) {
                $aMenu['iOrder'] = Tijian_Model_Menu::getNextOrder($aMenu['iParentID']);
            }
            if (1 == Tijian_Model_Menu::updData($aMenu)) {
                return $this->showMsg('菜单信息更新成功！', true);
            } else {
                return $this->showMsg('菜单信息更新失败！', false);
            }
        } else {
            $iMenuID = intval($this->getParam('id'));
            $aMenu = Tijian_Model_Menu::getDetail($iMenuID);
            $aTree = Tijian_Model_Menu::getMenus();
            $this->assign('aTree', $aTree);
            $this->assign('aMenu', $aMenu);
        }
    }

    /**
     * 菜单移动
     * 
     * @return boolean
     */
    public function moveAction ()
    {
        $iMenuID = $this->getParam('id');
        $iDirect = $this->getParam('direct');
        $aMenu = Tijian_Model_Menu::getDetail($iMenuID);
        $iCnt = Tijian_Model_Menu::changeOrder($aMenu, $iDirect);
        return $this->showMsg($iCnt, true);
    }

    /**
     * 增加菜单
     */
    public function addAction ()
    {
        if ($this->isPost()) {
            $aMenu = $this->_checkData();
            if (empty($aMenu)) {
                return null;
            }
            $aMenu['iOrder'] = Tijian_Model_Menu::getNextOrder($aMenu['iParentID']);
            if (Tijian_Model_Menu::addData($aMenu) > 0) {
                return $this->showMsg('菜单增加成功！', true);
            } else {
                return $this->showMsg('菜单增加失败！', false);
            }
        } else {
            $aTree = Tijian_Model_Menu::getMenus();
            $this->assign('aTree', $aTree);
        }
    }

    /**
     * 请求数据检测
     * 
     * @return mixed
     */
    public function _checkData ($sType = 'add')
    {
        $sMenuName = $this->getParam('sMenuName');
        $sUrl = $this->getParam('sUrl');
        $iParentID = $this->getParam('iParentID');
        $sIcon = $this->getParam('sIcon');
        
        if (! Util_Validate::isLength($sMenuName, 2, 20)) {
            return $this->showMsg('菜单名长度范围为2到20个字！', false);
        }
        if (! Util_Validate::isUrl($sUrl)) {
            return $this->showMsg('输入的URL不合法！', false);
        }
        $aRow = array(
            'sMenuName' => $sMenuName,
            'sUrl' => $sUrl,
            'iParentID' => $iParentID,
            'sIcon' => $sIcon
        );
        return $aRow;
    }
}