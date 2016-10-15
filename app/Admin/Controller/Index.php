<?php

class Admin_Controller_Index extends Admin_Controller_Base
{

    protected $bCheckLogin = false;

    public function indexAction ()
    {
        $aCookie = Util_Cookie::get(Yaf_G::getConf('authkey', 'cookie'));
        $sUrl = '/admin/login';

        if ($aCookie) {
            $aPermissions = Admin_Model_Permission::getUserPermissions($aCookie['iAdminID']);
            if (is_array($aPermissions) && !empty($aPermissions)) {
                $aTmp = array_keys($aPermissions);
                $sUrl = $aTmp[0];
            } else {
                $sUrl = '/admin/city/list.html';
            }
        }

        return $this->redirect($sUrl);
    }

    public function loginAction ()
    {}

    public function logoutAction ()
    {
        Util_Cookie::delete(Yaf_G::getConf('authkey', 'cookie'));
        $this->redirect('/admin/login');
    }

    public function signinAction ()
    {
        $sAdminName = $this->getParam('username');
        $sPassword = $this->getParam('password');
        $bRemember = $this->getParam('remember');
        $aUser = Admin_Model_Admin::getAdminByName($sAdminName);
        if (empty($aUser)) {
            return $this->showMsg('帐号不存在！', false);
        }
        if ($aUser['iStatus'] == 0) {
            return $this->showMsg('帐号被禁用！', false);
        }
        if ($aUser['sPassword'] != md5(Yaf_G::getConf('cryptkey', 'cookie') . $sPassword)) {
            return $this->showMsg('密码不正确！', false);
        }
        $aCookie = array(
            'iAdminID' => $aUser['iAdminID'],
            'iCityID' => $aUser['iCityID'],
            'sAdminName' => $aUser['sAdminName'],
            'sRealName' => $aUser['sRealName']
        );
        if ($bRemember) {
            $expire = 86400 * 7;
        } else {
            $expire = 0;
        }
        Util_Cookie::set(Yaf_G::getConf('authkey', 'cookie'), $aCookie, $expire);

        $aPermissions = Admin_Model_Permission::getUserPermissions($aCookie['iAdminID']);

        $sUrl = '/admin/city/list.html';
        if (is_array($aPermissions) && !empty($aPermissions)) {
            $aTmp = array_keys($aPermissions);
            $sUrl = $aTmp[0];
        }
        return $this->showMsg([
            'msg' => '登录成功！',
            'sUrl' => $sUrl
        ], true);
    }

    /**
     * 更换城市
     */
    public function changeAction ()
    {
        // 当前用户
        $aCookie = Util_Cookie::get(Yaf_G::getConf('authkey', 'cookie'));
        if (empty($aCookie)) {
            return $this->redirect('/admin/login');
        }
        $this->aCurrUser = $aCookie;

        $iCityID = $this->getParam('id');
        $aCity = Admin_Model_City::getDetail($iCityID);
        if (empty($aCity) || $aCity['iBackendShow'] == 0 || $aCity['iStatus'] == 0) {
            return $this->showMsg('城市不存在或未开放！', false);
        }
        $aUser = Admin_Model_Admin::getDetail($this->aCurrUser['iAdminID']);
        $aCityID = explode(',', $aUser['sCityID']);
        if ($aUser['sCityID'] != '-1' && ! in_array($iCityID, $aCityID)) {
            return $this->showMsg('您没有访问该城市的权限，请联系管理员！', false);
        }
        Util_Cookie::set('city', $iCityID);
        return $this->showMsg('城市切换成功!', true);
    }
}