<?php

class Admin_Controller_Type extends Admin_Controller_Base
{

    public function autoAction ()
    {
        $sClass = $this->getParam('class');
        $sKey = $this->getParam('key');
        $aList = Admin_Model_Type::getAutocomplete($sClass, $sKey);
        return $this->showMsg($aList, true);
    }

    /**
     * (non-PHPdoc)
     *
     * @see Yaf_Controller::__call()
     */
    public function __call ($sMethod, $aArg)
    {
        $sClass = str_replace('Action', '', $sMethod);
        $aClass = Admin_Model_Type::getClass($sClass);
        if (empty($aClass)) {
            parent::__call($sMethod, $aArg);
            return false;
        }
        $this->listAction($sClass);
        $this->setViewScript('/Type/list.phtml');
    }

    /**
     * 删除菜单
     *
     * @return boolean
     */
    public function delAction ()
    {
        $iTypeID = $this->getParam('id');
        $aType = Admin_Model_Type::getDetail($iTypeID);
        $sClassName = Admin_Model_Type::getClass($aType['sClass'], 'title');
        $iRet = Admin_Model_Type::delData($iTypeID);
        if ($iRet == 1) {
            return $this->showMsg($sClassName . '删除成功！', true);
        } else {
            return $this->showMsg($sClassName . '删除失败！', false);
        }
    }

    /**
     * 菜单列表
     */
    public function listAction ($sClass = '')
    {
        if (empty($sClass)) {
            $sClass = $this->getParam('class', '');
        }

        $aClass = Admin_Model_Type::getClass($sClass);
        $aTree = Admin_Model_Type::getTree($sClass);
        $this->assign('aTree', $aTree);
        $this->assign('aClass', $aClass);
        $this->assign('sClass', $sClass);
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

            $aType = $this->_checkData('update');
            if (empty($aType)) {
                return null;
            }

            $aClass = Admin_Model_Type::getClass($aType['sClass']);
            $sClassName = $aClass['sTitle'];
            $aType['iTypeID'] = intval($this->getParam('iTypeID'));
            $aOldType = Admin_Model_Type::getDetail($aType['iTypeID']);
            if (empty($aOldType)) {
                return $this->showMsg($sClassName . '不存在！', false);
            }

            // 更新排序，加在最后面
            if ($aOldType['iParentID'] != $aType['iParentID']) {
                $aType['iOrder'] = Admin_Model_Type::getNextOrder($aType['iParentID']);
            }
            if (1 == Admin_Model_Type::updData($aType)) {
                return $this->showMsg($sClassName . '信息更新成功！', true);
            } else {
                return $this->showMsg($sClassName . '信息更新失败！', false);
            }
        } else {
            $iTypeID = intval($this->getParam('id'));
            $aType = Admin_Model_Type::getDetail($iTypeID);
            $sClass = $aType['sClass'];
            $aClass = Admin_Model_Type::getClass($sClass);
            $aTree = Admin_Model_Type::getTypes($sClass);
            $this->assign('aTree', $aTree);
            $this->assign('aType', $aType);
            $this->assign('aClass', $aClass);
            $this->assign('sClass', $sClass);
        }
    }

    /**
     * 增加菜单
     */
    public function addAction ()
    {
        if ($this->isPost()) {
            $aType = $this->_checkData();
            if (empty($aType)) {
                return null;
            }

            $aClass = Admin_Model_Type::getClass($aType['sClass']);
            $sClassName = $aClass['sTitle'];
            $aType['iOrder'] = Admin_Model_Type::getNextOrder($aType['iParentID']);
            if (Admin_Model_Type::addData($aType) > 0) {
                return $this->showMsg($sClassName . '增加成功！', true);
            } else {
                return $this->showMsg($sClassName . '增加失败！', false);
            }
        } else {
            $sClass = $this->getParam('class', '');
            $aClass = Admin_Model_Type::getClass($sClass);

            $aTree = Admin_Model_Type::getTypes($sClass);
            $this->assign('aTree', $aTree);
            $this->assign('aClass', $aClass);
            $this->assign('sClass', $sClass);
        }
    }

    /**
     * 菜单移动
     *
     * @return boolean
     */
    public function moveAction ()
    {
        $iTypeID = $this->getParam('id');
        $iDirect = $this->getParam('direct');
        $aType = Admin_Model_Type::getDetail($iTypeID);
        $iCnt = Admin_Model_Type::changeOrder($aType, $iDirect);
        return $this->showMsg($iCnt, true);
    }

    /**
     * 请求数据检测
     *
     * @return mixed
     */
    public function _checkData ($sType = 'add')
    {
    	$aRow = array(
			'sTypeName' => $this->getParam('sTypeName', ''),
    		'sClass' => $this->getParam('sClass', ''),
    		'iParentID' => $this->getParam('iParentID', '0'),
    		'sRemark' => $this->getParam('sRemark', ''),
    		'sImage' => $this->getParam('sImage', ''),
    		'sDiy1' => $this->getParam('sDiy1', ''),
    		'sDiy2' => $this->getParam('sDiy2', ''),
    		'sDiy3' => $this->getParam('sDiy3', ''),
    		'sDiy4' => $this->getParam('sDiy4', ''),
    		'sDiy5' => $this->getParam('sDiy5', ''),
    		'sDiy6' => $this->getParam('sDiy6', '')
    	);
        $aClass = Admin_Model_Type::getClass($aRow['sClass']);
        if (! Util_Validate::isLength($aRow['sTypeName'], 2, 20)) {
            return $this->showMsg($aClass['sName'] . '名称长度范围为2到20个字！', false);
        }

        return $aRow;
    }
}