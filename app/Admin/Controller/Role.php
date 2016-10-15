<?php

class Admin_Controller_Role extends Admin_Controller_Base
{

    /**
     * 删除角色
     *
     * @return boolean
     */
    public function delAction ()
    {
        $iRoleID = intval($this->getParam('id'));
        $iRet = Admin_Model_Role::delData($iRoleID);
        if ($iRet == 1) {
            return $this->showMsg('角色删除成功！', true);
        } else {
            return $this->showMsg('角色删除失败！', false);
        }
    }

    /**
     * 角色列表
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
        $aList = Admin_Model_Role::getList($aWhere, $iPage);
        $this->assign('aList', $aList);
    }

    /**
     * 编辑角色
     *
     * @return NULL boolean
     */
    public function editAction ()
    {
        if ($this->isPost()) {
            $aRole = $this->_checkData('update');
            if (empty($aRole)) {
                return null;
            }
            $aRole['iRoleID'] = intval($this->getParam('iRoleID'));
            if (1 == Admin_Model_Role::updData($aRole)) {
                return $this->showMsg('角色信息更新成功！', true);
            } else {
                return $this->showMsg('角色信息更新失败！', false);
            }
        } else {
            $iRoleID = intval($this->getParam('id'));
            $aRole = Admin_Model_Role::getDetail($iRoleID);
            $aRole['aPermission'] = explode(',', $aRole['sPermission']);
            $aRole['aModule'] = explode(',', $aRole['sModule']);
            $this->assign('aRole', $aRole);
            $this->assign('aPermissionList', Admin_Model_Permission::getAllPermissions());
            $this->assign('aMenuList', Admin_Model_Menu::getMenus());
        }
    }

    /**
     * 增加角色
     *
     * @return NULL boolean
     */
    public function addAction ()
    {
        if ($this->isPost()) {
            $aRole = $this->_checkData();
            if (empty($aRole)) {
                return null;
            }
            if (Admin_Model_Role::addData($aRole) > 0) {
                return $this->showMsg('角色增加成功！', true);
            } else {
                return $this->showMsg('角色增加失败！', false);
            }
        } else {
            $this->assign('aPermissionList', Admin_Model_Permission::getAllPermissions());
            $this->assign('aMenuList', Admin_Model_Menu::getMenus());
        }
    }

    /**
     * 请求数据检测
     *
     * @return mixed
     */
    public function _checkData ($sType = 'add')
    {
        $sRoleName = $this->getParam('sRoleName');
        $sDesc = $this->getParam('sDesc');
        $aPermission = $this->getParam('aPermission');
        $aModule = $this->getParam('aModule');
        
        if (! Util_Validate::isLength($sRoleName, 2, 20)) {
            return $this->showMsg('角色名长度范围为2到20个字！', false);
        }
        if (empty($aPermission)) {
            return $this->showMsg('至少给这个角色选择一个权限吧！', false);
        }
        if (empty($aModule)) {
            $aModule = array();
        }
        $aRow = array(
            'sRoleName' => $sRoleName,
            'sDesc' => $sDesc,
            'sPermission' => join(',', $aPermission),
            'sModule' => join(',', $aModule)
        );
        return $aRow;
    }
}