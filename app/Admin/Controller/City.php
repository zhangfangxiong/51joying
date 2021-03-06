<?php

class Admin_Controller_City extends Admin_Controller_Base
{

    /**
     * 城市删除
     */
    public function delAction ()
    {
        $iCityID = intval($this->getParam('id'));
        $iRet = Admin_Model_City::delData($iCityID);
        if ($iRet == 1) {
            return $this->showMsg('城市删除成功！', true);
        } else {
            return $this->showMsg('城市删除失败！', false);
        }
    }

    /**
     * 城市列表
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
        $aList = Admin_Model_City::getList($aWhere, $iPage);
        $this->assign('aList', $aList);
    }

    /**
     * 城市修改
     */
    public function editAction ()
    {
        if ($this->_request->isPost()) {
            $aCity = $this->_checkData('update');
            if (empty($aCity)) {
                return null;
            }
            $aCity['iCityID'] = intval($this->getParam('iCityID'));
            $aOldCity = Admin_Model_City::getDetail($aCity['iCityID']);
            if (empty($aOldCity)) {
                return $this->showMsg('城市不存在！', false);
            }
            if ($aOldCity['sCityName'] != $aCity['sCityName']) {
                if (Admin_Model_City::getCityByName($aCity['sCityName'])) {
                    return $this->showMsg('城市已经存在！', false);
                }
            }
            if (1 == Admin_Model_City::updData($aCity)) {
                return $this->showMsg('城市信息更新成功！', true);
            } else {
                return $this->showMsg('城市信息更新失败！', false);
            }
        } else {
            $iCityID = intval($this->getParam('id'));
            $aCity = Admin_Model_City::getDetail($iCityID);
            $this->assign('aCity', $aCity);
        }
    }

    /**
     * 增加城市
     */
    public function addAction ()
    {
        if ($this->_request->isPost()) {
            $aCity = $this->_checkData('add');
            if (empty($aCity)) {
                return null;
            }
            if (Admin_Model_City::getCityByName($aCity['sCityName'])) {
                return $this->showMsg('城市已经存在！', false);
            }
            if (Admin_Model_City::addData($aCity) > 0) {
                return $this->showMsg('城市增加成功！', true);
            } else {
                return $this->showMsg('城市增加失败！', false);
            }
        }
    }

    /**
     * 请求数据检测
     *
     * @return mixed
     */
    public function _checkData ($sType = 'add')
    {
        $sCityName = $this->getParam('sCityName');
        $sCityCode = $this->getParam('sCityCode');
        $iFrontShow = $this->getParam('iFrontShow');
        $iBackendShow = $this->getParam('iBackendShow');
        $sExt = trim($this->getParam('sExt'));

        if (! Util_Validate::isLength($sCityName, 2, 20)) {
            return $this->showMsg('城市名称长度范围为2到20个字！', false);
        }
        if (! Util_Validate::isLength($sCityCode, 2, 50)) {
            return $this->showMsg('城市代码长度范围为2到50个字母！', false);
        }
        if (! Util_Validate::isRange($iFrontShow, 0, 1)) {
            return $this->showMsg('城市前台是否启用输入不合法！', false);
        }
        if (! Util_Validate::isRange($iBackendShow, 0, 1)) {
            return $this->showMsg('城市后台是否启用输入不合法！', false);
        }

        $aRow = array(
            'sCityName' => $sCityName,
            'sCityCode' => $sCityCode,
            'sExt' => $sExt,
            'iFrontShow' => $iFrontShow,
            'iBackendShow' => $iBackendShow
        );

        return $aRow;
    }
}