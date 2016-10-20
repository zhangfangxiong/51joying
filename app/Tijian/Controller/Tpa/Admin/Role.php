<?php

/**
 * @Author xuchuyuan
 */
class Tijian_Controller_Tpa_Admin_Role extends Tijian_Controller_Tpa_Admin_Base
{

    public function assignUrl()
    {
        $this->assign('sRoleListUrl', '/tpa/admin/role/list');
        $this->assign('sRoleAddUrl', '/tpa/admin/role/add');
        $this->assign('sRoleEditUrl', '/tpa/admin/role/edit');
        $this->assign('sRoleDelUrl', '/tpa/admin/role/del');
    }

    public function actionBefore()
    {
        parent::actionBefore();

        $this->assignUrl();
    }

    /**
     * 角色列表
     */
    public function listAction()
    {
        $iPage = intval($this->getParam('page'));
        $aParam['iType'] = intval($this->getParam('iType'));
        $aParam['sRoleName'] = trim($this->getParam('sRoleName'));
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        }
        $aWhere = array(
            'iStatus > ' => 0
        );
        if (!empty($aParam['iType'])) {
            $aWhere['iType'] = $aParam['iType'];
        }
        if (!empty($aParam['sRoleName'])) {
            $aWhere['sRoleName LIKE'] = '%'.$aParam['sRoleName'].'%';
        }
        $aData = Tijian_Model_Tpa_Role::getList($aWhere, $iPage, '', 20);
        $this->assign('sHrRoleName', Tijian_Model_Tpa_Role::HRROLENAME);
        $this->assign('sSupplierRoleName', Tijian_Model_Tpa_Role::SUPPLIERROLENAME);
        $this->assign('aData', $aData);
        $this->assign('aParam', $aParam);
        $this->assign('aType', Tijian_Model_Tpa_Admin::$aType);
        $this->assign('aStatus', Tijian_Model_Tpa_Role::$aStatus);
    }

    /**
     * 编辑角色
     *
     * @return NULL boolean
     */
    public function editAction()
    {
        $iType = $this->getParam('type');
        if ($this->isPost()) {
            $aRole = $this->_checkData('update');
            if (empty($aRole)) {
                return null;
            }
            $aRole['iRoleID'] = intval($this->getParam('iRoleID'));
            $aRole['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
            $aRole['sLastUpDataUserName'] = $this->aCurrUser['sUserName'];
            if (1 == Tijian_Model_Tpa_Role::updData($aRole)) {
                return $this->showMsg('角色信息更新成功！', true);
            } else {
                return $this->showMsg('角色信息更新失败！', false);
            }
        } else {
            $iRoleID = intval($this->getParam('id'));
            $aRole = Tijian_Model_Tpa_Role::getDetail($iRoleID);
            $aRole['aPermission'] = explode(',', $aRole['sPermission']);
            $aRole['aModule'] = explode(',', $aRole['sModule']);
            $this->assign('aRole', $aRole);
            $this->assign('aPermissionList', Tijian_Model_Tpa_Permission::getAllPermissions());
            $this->assign('aMenuList', Tijian_Model_Tpa_Menu::getMenus());
            $this->assign('aType', Tijian_Model_Tpa_Admin::$aType);
            $this->assign('iType', !empty($iType) ? $iType : $aRole['iType']);
            $this->assign('aStatus', Tijian_Model_Tpa_Role::$aStatus);
        }
    }

    /**
     * 增加角色
     *
     * @return NULL boolean
     */
    public function addAction()
    {
        $iType = $this->getParam('type');
        $iType = in_array($iType, array_keys(Tijian_Model_Tpa_Admin::$aType)) ? $iType : 1;
        if ($this->isPost()) {
            $aRole = $this->_checkData();
            if (empty($aRole)) {
                return null;
            }
            $aRole['iCreateUserID'] = $this->aCurrUser['iUserID'];
            $aRole['sCreateUserName'] = $aRole['sLastUpDataUserName'] = $this->aCurrUser['sUserName'];
            if (Tijian_Model_Tpa_Role::addData($aRole) > 0) {
                return $this->showMsg('角色增加成功！', true);
            } else {
                return $this->showMsg('角色增加失败！', false);
            }
        } else {
            $this->assign('aPermissionList', Tijian_Model_Tpa_Permission::getAllPermissions());
            $this->assign('aMenuList', Tijian_Model_Tpa_Menu::getMenus());
            $this->assign('aType', Tijian_Model_Tpa_Admin::$aType);
            $this->assign('iType', $iType);
            $this->assign('aStatus', Tijian_Model_Tpa_Role::$aStatus);
        }
    }


    /**
     * 删除角色
     * @return boolean
     */
    public function delAction()
    {
        $iRoleID = intval($this->getParam('id'));
        $iRet = Tijian_Model_Tpa_Role::delData($iRoleID);
        if ($iRet == 1) {
            return $this->showMsg('角色删除成功！', true);
        } else {
            return $this->showMsg('角色删除失败！', false);
        }
    }


    /**
     * 请求数据检测
     *
     * @return mixed
     */
    public function _checkData($sType = 'add')
    {
        $sRoleName = $this->getParam('sRoleName');
        $iType = intval($this->getParam('iType'));
        $aPermission = $this->getParam('aPermission');
        $aModule = $this->getParam('aModule');
        $iStatus = intval($this->getParam('iStatus'));

        if (!Util_Validate::isLength($sRoleName, 2, 20)) {
            return $this->showMsg('角色名长度范围为2到20个字！', false);
        }

        if ($sType == 'add' && Tijian_Model_Tpa_Role::getRoleByName($sRoleName, $iType)) {
            return $this->showMsg('该权限名已存在！', false);
        }


        if (empty($aPermission) && empty($aModule) && $iType == 1) {
            return $this->showMsg('至少给这个角色选择一个权限吧！', false);
        }
        if (empty($aModule)) {
            $aModule = array();
        }

        $aRow = array(
            'sRoleName' => $sRoleName,
            'iType' => $iType,
            'sPermission' => join(',', $aPermission),
            'sModule' => join(',', $aModule),
            'iStatus' => $iStatus
        );
        return $aRow;
    }
}