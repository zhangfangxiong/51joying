<?php

class Admin_Controller_User extends Admin_Controller_Base
{

    /**
     * 用户信息
     */
    public function infoAction ()
    {
        $iAdminID = $this->aCurrUser['iAdminID'];
        $aUser = Admin_Model_Admin::getDetail($iAdminID);
        $aUser['aCityID'] = explode(',', $aUser['sCityID']);
        $aUser['aRoleID'] = explode(',', $aUser['sRoleID']);
        $this->assign('aUser', $aUser);
        $this->assign('aCity', Admin_Model_City::getPairCitys());
        $this->assign('aRole', Admin_Model_Role::getPairRoles());
    }

    /**
     * 密码修改
     */
    public function chgpwdAction ()
    {
        if ($this->isPost()) {
            $sOldPass = $this->getParam('oldpass');
            $sNewPass = $this->getParam('newpass');
            $aUser = Admin_Model_Admin::getDetail($this->aCurrUser['iAdminID']);
            $sCryptkey = Yaf_G::getConf('cryptkey', 'cookie');
            if ($aUser['sPassword'] != md5($sCryptkey . $sOldPass)) {
                return $this->showMsg('旧密码不正确！', false);
            }
            Admin_Model_Admin::updData(array(
                'iAdminID' => $this->aCurrUser['iAdminID'],
                'sPassword' => md5($sCryptkey . $sNewPass)
            ));
            return $this->showMsg('密码修改成功！', true);
        }
        $this->_request->getMethod();
    }

    /**
     * 用户删除
     */
    public function delAction ()
    {
        $iAdminID = intval($this->getParam('id'));
        $iRet = Admin_Model_Admin::delData($iAdminID);
        if ($iRet == 1) {
            return $this->showMsg('用户删除成功！', true);
        } else {
            return $this->showMsg('用户删除失败！', false);
        }
    }

    /**
     * 用户列表
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
        $aParam = $this->getParams();
        if (! empty($aParam['iCityID'])) {
            $aWhere['iCityID'] = $aParam['iCityID'];
        }
        if (! empty($aParam['sAdminName'])) {
            $aWhere['sAdminName'] = $aParam['sAdminName'];
        }
        if (! empty($aParam['sRealName'])) {
            $aWhere['sRealName'] = $aParam['sRealName'];
        }
        if (! empty($aParam['sMobile'])) {
            $aWhere['sMobile'] = $aParam['sMobile'];
        }
        if (! empty($aParam['iRoleID'])) {
            $aWhere['sWhere'] = 'FIND_IN_SET("' . $aParam['iRoleID'] . '",sRoleID)';
        }
        
        $aList = Admin_Model_Admin::getList($aWhere, $iPage, $this->getParam('sOrder', ''));
        foreach ($aList['aList'] as $k => $aUser) {
            if ($aUser['sRoleID'] == - 1) {
                $aList['aList'][$k]['sRoleName'] = '系统管理员';
            } else {
                $aRoleName = Admin_Model_Role::getCol(array(
                    'where' => array(
                        'iRoleID IN' => $aUser['sRoleID']
                    )
                ), 'sRoleName');
                $aList['aList'][$k]['sRoleName'] = join(',', $aRoleName);
            }
        }
        $this->assign('aList', $aList);
        $this->assign('aParam', $aParam);
        $this->assign('aCity', Admin_Model_City::getPairCitys());
        $this->assign('aRole', Admin_Model_Role::getPairRoles());
    }

    /**
     * 用户修改
     */
    public function editAction ()
    {
        if ($this->_request->isPost()) {
            
            $aUser = $this->_checkData('update');
            if (empty($aUser)) {
                return null;
            }
            $aUser['iAdminID'] = intval($this->getParam('iAdminID'));
            $aOldUser = Admin_Model_Admin::getDetail($aUser['iAdminID']);
            if (empty($aOldUser)) {
                return $this->showMsg('用户不存在！', false);
            }
            if ($aOldUser['sAdminName'] != $aUser['sAdminName']) {
                if (Admin_Model_Admin::getAdminByName($aUser['sAdminName'])) {
                    return $this->showMsg('用户已经存在！', false);
                }
            }
            if (1 == Admin_Model_Admin::updData($aUser)) {
                return $this->showMsg('用户信息更新成功！', true);
            } else {
                return $this->showMsg('用户信息更新失败！', false);
            }
        } else {
            $iAdminID = intval($this->getParam('id'));
            $aUser = Admin_Model_Admin::getDetail($iAdminID);
            $aUser['aCityID'] = explode(',', $aUser['sCityID']);
            $aUser['aRoleID'] = explode(',', $aUser['sRoleID']);
            $this->assign('aUser', $aUser);
            $this->assign('aCity', Admin_Model_City::getPairCitys());
            $this->assign('aRole', Admin_Model_Role::getPairRoles());
        }
    }

    /**
     * 增加用户
     */
    public function addAction ()
    {
        if ($this->_request->isPost()) {
            $aUser = $this->_checkData('add');
            if (empty($aUser)) {
                return null;
            }
            if (Admin_Model_Admin::getAdminByName($aUser['sAdminName'])) {
                return $this->showMsg('用户已经存在！', false);
            }
            if (Admin_Model_Admin::addData($aUser) > 0) {
                return $this->showMsg('用户增加成功！', true);
            } else {
                return $this->showMsg('用户增加失败！', false);
            }
        } else {
            $this->assign('aCity', Admin_Model_City::getPairCitys());
            $this->assign('aRole', Admin_Model_Role::getPairRoles());
        }
    }

    /**
     * 请求数据检测
     *
     * @return mixed
     */
    public function _checkData ($sType = 'add')
    {
        $sAdminName = $this->getParam('sAdminName');
        $sPassword = $this->getParam('sPassword');
        $sMobile = $this->getParam('sMobile');
        $sEmail = $this->getParam('sEmail');
        $sRealName = $this->getParam('sRealName');
        $iCityID = $this->getParam('iCityID');
        $aCityID = $this->getParam('aCityID');
        $sAllCityID = $this->getParam('sAllCityID');
        $aRoleID = $this->getParam('aRoleID');
        $sAdminID = $this->getParam('sAdminID');
        if (! Util_Validate::isLength($sAdminName, 3, 50)) {
            return $this->showMsg('用户名长度范围为3到30个字！', false);
        }
        if (($sType == 'add' || ! empty($sPassword)) && ! Util_Validate::isLength($sPassword, 6, 20)) {
            return $this->showMsg('登录密码长度范围为6到20字符！', false);
        }
        if (! Util_Validate::isMobile($sMobile)) {
            return $this->showMsg('输入的手机号码不合法！', false);
        }
        if (! Util_Validate::isEmail($sEmail)) {
            return $this->showMsg('输入的邮箱地址不合法！', false);
        }
        if (! Util_Validate::isLength($sRealName, 2, 20)) {
            return $this->showMsg('真实姓名长度范围为2到20字符！', false);
        }
        $aCity = Admin_Model_City::getPairCitys();
        if (! isset($aCity[$iCityID])) {
            return $this->showMsg('选择的城市不存在！', false);
        }
        
        // 将默认城市加入到城市权限中
        if ($sAllCityID == '1') {
            $aCityID = array(
                - 1
            );
        } elseif (empty($aCityID) || ! in_array($iCityID, $aCityID)) {
            $aCityID[] = $iCityID;
        }
        
        // 将默认城市加入到城市权限中
        if ($sAdminID == '1') {
            $aRoleID = array(
                - 1
            );
        } elseif (empty($aRoleID)) {
            return $this->showMsg('请至少选择一个角色!', false);
        }
        
        $aRow = array(
            'sAdminName' => $sAdminName,
            'sMobile' => $sMobile,
            'sEmail' => $sEmail,
            'sRealName' => $sRealName,
            'iCityID' => $iCityID,
            'sCityID' => join(',', $aCityID),
            'sRoleID' => join(',', $aRoleID)
        );
        if (! empty($sPassword)) {
            $aRow['sPassword'] = md5(Yaf_G::getConf('cryptkey', 'cookie') . $sPassword);
        }
        return $aRow;
    }

    /**
     * 用户列表
     */
    public function logAction ()
    {
        $iPage = intval($this->getParam('page'));
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        }
        $aWhere = array(
            'iStatus' => 1
        );
        $aParam = $this->getParams();
        if (! empty($aParam['iType'])) {
            $aWhere['iType'] = $aParam['iType'];
        }
        if (! empty($aParam['sUserName'])) {
            $aWhere['sUserName'] = $aParam['sUserName'];
        }
        if (! empty($aParam['sParam'])) {
            $aWhere['sParam LIKE'] = '%' . $aParam['sParam'] . '%';
        }
        if (! empty($aParam['sSQL'])) {
            $aWhere['sSQL LIKE'] = '%' . $aParam['sSQL'] . '%';
        }
        
        $sOrder = $this->getParam('sOrder', '');
        $aList = Admin_Model_ActionLog::getList($aWhere, $iPage, $sOrder);
        $this->assign('aList', $aList);
        $this->assign('aParam', $aParam);
    }
}