<?php

/**
 * Created by PhpStorm.
 * User: zhangfangxiong
 * Date: 2016/4/21
 * Time: 9:50
 */
class Tijian_Controller_Admin_Eproduct extends Tijian_Controller_Admin_Base
{
    const PAGESIZE = 20;

    /**
     * 编辑或查看的头部信息
     * @param $iEditHeaderIndex 当前的索引值
     * @param $iHeaderType 1：查看 2：编辑
     */
    protected function _editHeader($iEditHeaderIndex, $iHeaderType)
    {
        $aEditHeaderInfo = [
            1 => [
                'editurl' => '/tijian/admin/eproduct/editbaseinfo/',
                'viewurl' => '/tijian/admin/eproduct/viewbaseinfo/',
                'name' => '基本信息'
            ],
            2 => [
                'editurl' => '/tijian/admin/eproduct/edititem/',
                'viewurl' => '/tijian/admin/eproduct/viewitem/',
                'name' => '体检单项'
            ],
            3 => [
                'editurl' => '/tijian/admin/eproduct/addchannel/type/2/',
                'viewurl' => '/tijian/admin/eproduct/viewviewrange/',
                'name' => '渠道信息'
            ],
            4 => [
                'editurl' => '/tijian/admin/eproduct/edithasselectuser/',
                'viewurl' => '/tijian/admin/eproduct/viewhasselectuser/',
                'name' => '客户信息'
            ],
            5 => [
                'editurl' => '/tijian/admin/eproduct/editestore/',
                'viewurl' => '/tijian/admin/eproduct/viewestore/',
                'name' => '门店信息'
            ]
        ];
        $this->assign('aEditHeaderInfo', $aEditHeaderInfo);
        $this->assign('iEditHeaderIndex', $iEditHeaderIndex);
        $this->assign('iHeaderType', $iHeaderType);
    }

    /**
     * 编辑客户的头部信息
     * @param $iEditHeaderIndex 当前的索引值
     * @param $iHeaderType 1：查看 2：编辑
     */
    protected function _editUserHeader($iEditUserHeaderIndex)
    {
        $aEditUserHeaderInfo = [
            1 => [
                'editurl' => '/tijian/admin/eproduct/editbaseprice/',
                'name' => '价格与基本信息'
            ],
            2 => [
                'editurl' => '/tijian/admin/eproduct/edituserstore/',
                'name' => '供应商门店'
            ],
            4 => [
                'editurl' => '/tijian/admin/eproduct/edituserupgrade/',
                'name' => '升级产品'
            ],
            5 => [
                'editurl' => '/tijian/admin/eproduct/edituseraddtion/',
                'name' => '加项包'
            ],
        ];
        $this->assign('aEditCannelUrl', '/tijian/admin/eproduct/addhasselectuser/');
        $this->assign('aEditUserHeaderInfo', $aEditUserHeaderInfo);
        $this->assign('iEditUserHeaderIndex', $iEditUserHeaderIndex);
    }

    protected function _assignUrl()
    {
        $this->assign('sDownMatchDemoUrl', '/tijian/admin/eproduct/downMatchDemo/');
        $this->assign('sEpListUrl', '/tijian/admin/eproduct/list/');
        $this->assign('sListUrl', '/tijian/admin/product/list/');
        $this->assign('sAddBaseInfoUrl', '/tijian/admin/eproduct/addbaseinfo/');
        $this->assign('sEditBaseInfoUrl', '/tijian/admin/eproduct/editbaseinfo/');
        $this->assign('sViewBaseInfoUrl', '/tijian/admin/eproduct/viewbaseinfo/');
        $this->assign('sAddItemUrl', '/tijian/admin/eproduct/additem/');
        $this->assign('sInsertItemUrl', '/tijian/admin/eproduct/insertitem/');
        $this->assign('sDeleteItemUrl', '/tijian/admin/eproduct/deleteitem/');
        $this->assign('sAddStoreUrl', '/tijian/admin/eproduct/addstore/');
        $this->assign('sEidtUserStoreUrl', '/tijian/admin/eproduct/edituserstore/');
        $this->assign('sInsertStoreUrl', '/tijian/admin/eproduct/insertstore/');
        $this->assign('sDeleteStoreUrl', '/tijian/admin/eproduct/deletestore/');
        $this->assign('sAddUpgradeUrl', '/tijian/admin/eproduct/addupgrade/');
        $this->assign('sEditUserUpgradeUrl', '/tijian/admin/eproduct/edituserupgrade/');
        $this->assign('sInsertUpgradeUrl', '/tijian/admin/eproduct/insertupgrade/');
        $this->assign('sDeleteUpgradeUrl', '/tijian/admin/eproduct/deleteupgrade/');
        $this->assign('sAddAddtionUrl', '/tijian/admin/eproduct/addaddtion/');
        $this->assign('sEidtUserAddtionUrl', '/tijian/admin/eproduct/edituseraddtion/');
        $this->assign('sInsertAddtionUrl', '/tijian/admin/eproduct/insertaddtion/');
        $this->assign('sDeleteAddtionUrl', '/tijian/admin/eproduct/deleteaddtion/');
        $this->assign('sGetParentUrl', '/tijian/admin/eproduct/getparent/');
        $this->assign('sImportItemUrl', '/tijian/admin/eproduct/importitem/');
        $this->assign('sAddViewrangeUrl', '/tijian/admin/eproduct/addviewrange/');
        $this->assign('sInsertViewrangeUrl', '/tijian/admin/eproduct/insertviewrange/');
        $this->assign('sDeleteViewrangeUrl', '/tijian/admin/eproduct/deleteviewrange/');
        $this->assign('sAddHasSelectUserUrl', '/tijian/admin/eproduct/addhasselectuser/');
        $this->assign('sEditBasePriceUrl', '/tijian/admin/eproduct/editbaseprice/');
        $this->assign('sAddChannelUrl', '/tijian/admin/eproduct/addchannel/');
        $this->assign('sViewViewRangeUrl', '/tijian/admin/eproduct/viewviewrange/');
        $this->assign('sStoreCodeListUrl', '/tijian/admin/eproduct/storecodelist/');
        $this->assign('sDownStoreCodeDemoUrl', '/tijian/admin/eproduct/downstorecodedemo/');
        $this->assign('sImportStoreCodeUrl', '/tijian/admin/eproduct/importstorecode/');
        $this->assign('sImportCityStoreCodeUrl', '/tijian/admin/eproduct/importcitystorecode/');
        $this->assign('sEditStoreCodeUrl', '/tijian/admin/eproduct/editstorecode/');
        $this->assign('sRCardListUrl', '/tijian/admin/eproduct/rcardlist/');
        $this->assign('sCreateRCardUrl', '/tijian/admin/eproduct/creatercard/');
        $this->assign('sImportCodeByCityUrl', '/tijian/admin/eproduct/importcodebycity/');
        $this->assign('sAddEStoreUrl', '/tijian/admin/eproduct/addestore/');
        $this->assign('sEidtEStoreUrl', '/tijian/admin/eproduct/editestore/');
        $this->assign('sViewEStoreUrl', '/tijian/admin/eproduct/viewestore/');
        $this->assign('sInsertEStoreUrl', '/tijian/admin/eproduct/insertestore/');
        $this->assign('sDeleteEStoreUrl', '/tijian/admin/eproduct/deleteestore/');
        $this->assign('sSysAllUpgradeUrl', '/tijian/admin/eproduct/sysallupgrade/');
    }

    public function actionAfter()
    {
        parent::actionAfter();
        $this->_assignUrl();
        $this->assign('productcss', 1);
    }

    //实体卡列表
    public function rCardListAction()
    {
        $aParam = $this->getParams();
        $iPage = intval($this->getParam('page'));
        $aDataParam = [];
        if (!empty($aParam['sCardCode'])) {
            $aDataParam['sCardCode LIKE'] = $aParam['sCardCode'];
        }
        if (!empty($aParam['sInitNo'])) {
            $aDataParam['sInitNo LIKE'] = $aParam['sInitNo'];
        }
        if (isset($aParam['iPCard']) && $aParam['iPCard'] != -1) {
            $aDataParam['iPCard'] = $aParam['iPCard'];
        }
        if (isset($aParam['iStatus']) && $aParam['iStatus'] != -1) {
            $aDataParam['iStatus'] = $aParam['iStatus'];
        }
        if (isset($aParam['iCardType']) && $aParam['iCardType'] != -1) {
            $aDataParam['iCardType'] = $aParam['iCardType'];
        }
        if (isset($aParam['iSendStatus']) && $aParam['iSendStatus'] != -1) {
            $aDataParam['iSendStatus'] = $aParam['iSendStatus'];
        }
        $aDataParam['iOrderType'] = 2;
        $aCardList = Tijian_Model_OrderCard::getList($aDataParam, $iPage, 'iCreateTime');
        $this->assign('iType', 1);
        $this->assign('aPCard', Yaf_G::getConf('aPCard', 'product'));
        $this->assign('aCardType', Yaf_G::getConf('aCardType', 'product'));
        $this->assign('aStatus', Yaf_G::getConf('aStatus', 'card'));
        $this->assign('aSendStatus', Yaf_G::getConf('aSendStatus', 'card'));
        $this->assign('aParam', $aParam);
        $this->assign('aCardList', $aCardList);
    }

    //创建实物卡
    public function createRCardAction()
    {
        if ($this->isPost()) {
            $aParam = $this->getParams();
            if (empty($aParam['iPCard'])) {
                return $this->showMsg('请选择体检卡类别', false);
            }
            if (empty($aParam['iCardType'])) {
                return $this->showMsg('请选择体检卡渠道', false);
            }
            if (empty($aParam['sInitNo'])) {
                return $this->showMsg('请填写生成批次号', false);
            }
            if (empty($aParam['sStartDate'])) {
                return $this->showMsg('请选择开始有效期', false);
            }
            if (empty($aParam['sEndDate'])) {
                return $this->showMsg('请选择截止有效期', false);
            }
            if (empty($aParam['sNum'])) {
                return $this->showMsg('请填写生成数量', false);
            }
            $aParam['sRemark'] = $aParam['sRemark'] ? $aParam['sRemark'] : '';
            for ($i = 0; $i < $aParam['sNum']; $i++) {
                Tijian_Model_OrderCard::initRealCard($aParam['iPCard'], $aParam['iCardType'], $aParam['sInitNo'], $aParam['sStartDate'], $aParam['sEndDate'], $aParam['sRemark']);
            }
            $sUrl = '/tijian/admin/eproduct/rcardlist/';
            return $this->showMsg('生成实体卡成功！', true, $sUrl);
        }
        $this->assign('iType', 2);
        $this->assign('aPCard', Yaf_G::getConf('aPCard', 'product'));
        $this->assign('aCardType', Yaf_G::getConf('aCardType', 'product'));
    }

    //编辑门店代码
    public function editStoreCodeAction()
    {
        $iID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        if (empty($iID)) {
            return $this->showMsg('参数不全', false);
        }
        $aStoreCode = Tijian_Model_StoreCode::getDetail($iID);
        if (empty($aStoreCode)) {
            return $this->showMsg('门店代码不存在', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($aStoreCode['iProductID']);
        if (empty($aProduct)) {
            return $this->showMsg('产品不存在', false);
        }
        $aStore = Tijian_Model_Store::getDetail($aStoreCode['iStoreID']);
        if (empty($aStore)) {
            return $this->showMsg('门店不存在', false);
        }

        if ($this->isPost()) {
            $aParam = $this->getParams();
            $aParam['iStatus'] = 2;//已配置
            if (Tijian_Model_StoreCode::updData($aParam)) {
                $sUrl = '/tijian/admin/eproduct/storeCodeList/id/' . $aStoreCode['iProductID'];
                return $this->showMsg('修改成功！', true, $sUrl);
            } else {
                return $this->showMsg('修改失败！', false);
            }
        } else {
            $aWhere['iStatus >'] = 0;
            $aSupplier = Tijian_Model_Type::getOption('supplier');
            $aCity = Tijian_Model_City::getPair($aWhere, 'iCityID', 'sCityName');
            $aSex = Yaf_G::getConf('aSex', 'product');
            $this->assign('aProduct', $aProduct);
            $this->assign('aSupplier', $aSupplier);
            $this->assign('aCity', $aCity);
            $this->assign('aSex', $aSex);
            $this->assign('aStoreCode', $aStoreCode);
            $this->assign('aStore', $aStore);
            $this->assign('aProduct', $aProduct);
            $this->assign('iID', $iID);
        }
        //print_r($aStoreCode);die;
    }

    //门店代码列表
    public function storeCodeListAction()
    {
        $iPageSize = self::PAGESIZE;
        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        $aParam = $this->getParams();
        $aProduct = Tijian_Model_Product::getDetail($aParam['id']);
        if (empty($aProduct)) {
            return $this->showMsg('产品不存在', false);
        }
        if (!empty($aParam['aSupplier'])) {
            $aParam['aSupplier'] = array_keys($aParam['aSupplier']);
            $aStoreParam['where']['iSupplierID IN'] = $aParam['aSupplier'];
        }
        if (!empty($aParam['aSex'])) {
            $aParam['aSex'] = array_keys($aParam['aSex']);
            $aParam['iSex IN'] = $aParam['aSex'];
        }
        if (!empty($aParam['aCity'])) {
            $aParam['aCity'] = array_keys($aParam['aCity']);
            $aStoreParam['where']['iCityID IN'] = $aParam['aCity'];
        }
        if (!empty($aParam['aStatus'])) {
            $aParam['aStatus'] = array_keys($aParam['aStatus']);
            $aParam['iStatus IN'] = $aParam['aStatus'];
        }
        if (!empty($aParam['sKeyword'])) {
            $aStoreParam[] = '(sCode="' . $aParam['sKeyword'] . '" OR sName LIKE "%' . $aParam['sKeyword'] . '%")';
        }
        $iSelectStore = (empty($aParam['aCity']) && empty($aParam['aSupplier']) && empty($aParam['sKeyword'])) ? 0 : 1;//是否要关联门店，不带条件就不关联门店
        if ($iSelectStore) {
            $aTmp = Tijian_Model_Store::getAll($aStoreParam);//满足条件的门店
            $aStoreIDs = [];
            if (!empty($aTmp)) {
                foreach ($aTmp as $key => $value) {
                    $aStoreIDs[] = $value['iStoreID'];
                }
            }
            $aParam['iStoreID IN'] = $aStoreIDs;
        }
        if (isset($aStoreIDs) && empty($aStoreIDs)) {
            $aData['aList'] = [];
        } else {
            $aParam['iStatus >'] = 0;
            $aParam['iProductID'] = $aParam['id'];
            $aData = Tijian_Model_StoreCode::getList($aParam, $iPage, 'iUpdateTime DESC', $iPageSize);
        }
        if (!empty($aData['aList'])) {
            //整合需要的数据
            foreach ($aData['aList'] as $key => &$value) {
                $aStore = Tijian_Model_Store::getDetail($value['iStoreID']);
                $value['sStoreName'] = $aStore['sName'];
                $value['sStoreCode'] = $aStore['sStoreCode'];
                $value['iSupplierID'] = $aStore['iSupplierID'];
                $value['iCityID'] = $aStore['iCityID'];
            }
        }
        $aWhere['iStatus >'] = 0;
        $aSupplier = Tijian_Model_Type::getOption('supplier');
        $aCity = Tijian_Model_City::getPair($aWhere, 'iCityID', 'sCityName');
        $aStatus = Yaf_G::getConf('aCodeStatus', 'product');
        $aSex = Yaf_G::getConf('aSex', 'product');
        $this->assign('aProduct', $aProduct);
        $this->assign('aSupplier', $aSupplier);
        $this->assign('aCity', $aCity);
        $this->assign('aStatus', $aStatus);
        $this->assign('aSex', $aSex);
        $this->assign('aData', $aData);
        $this->assign('aParam', $aParam);
    }

    //产品列表
    public function listAction()
    {
        $iPageSize = self::PAGESIZE;
        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        $aParam = $this->getParams();
        unset($aParam['page']);

        if (!empty($aParam['aCity'])) {
            $aParam['aCity'] = array_keys($aParam['aCity']);
            $aStoreParam['where']['iCityID IN'] = $aParam['aCity'];
        }
        if (!empty($aParam['aSupplier'])) {
            $aParam['aSupplier'] = array_keys($aParam['aSupplier']);
            $aStoreParam['where']['iSupplierID IN'] = $aParam['aSupplier'];
        }

        if (!empty($aParam['aParent'])) {
            $aParam['aParent'] = array_keys($aParam['aParent']);
            $aParam['iParentID IN'] = $aParam['aParent'];
        }
        if (!empty($aParam['aStatus'])) {
            $aParam['aStatus'] = array_keys($aParam['aStatus']);
            $aParam['iStatus IN'] = $aParam['aStatus'];
        } else {
            $aParam['iStatus >'] = 0;
        }
        $iSelectStore = (empty($aParam['aCity']) && empty($aParam['aSupplier'])) ? 0 : 1;//是否要关联门店，不带条件就不关联门店
        if ($iSelectStore) {
            $aTmp = Tijian_Model_Store::getAll($aStoreParam);//满足条件的门店
            $aStoreIDs = [];
            $aProductIDs = [];
            if (!empty($aTmp)) {
                foreach ($aTmp as $key => $value) {
                    $aStoreIDs[] = $value['iStoreID'];
                }
                $aProduct = Tijian_Model_ProductStore::getDataByStores($aStoreIDs, Tijian_Model_ProductStore::EXPANDPRODUCT);
                if (!empty($aProduct)) {
                    foreach ($aProduct as $key => $value) {
                        $aProductIDs[] = $value['iProductID'];
                    }
                }
            }
            //print_r($aProductIDs);die;
            $aParam['iProductID IN'] = $aProductIDs;
        }
        $aParam['iType'] = Tijian_Model_Product::TYPE_EXPAND;
        if (!empty($aParam['sKeyword'])) {
            $aParam[] = '(sProductCode="' . $aParam['sKeyword'] . '" OR sProductName LIKE "%' . $aParam['sKeyword'] . '%")';
        }
        unset($aParam['sKeyword']);
        if (isset($aProductIDs) && empty($aProductIDs)) {
            $aData['aList'] = [];
        } else {
            $aData = Tijian_Model_Product::getList($aParam, $iPage, 'iUpdateTime DESC', $iPageSize);
        }
        if (!empty($aData['aList'])) {
            //整合需要的数据
            foreach ($aData['aList'] as $key => $value) {
                $aHasStore = Tijian_Model_ProductStore::getProductStores($value['iProductID'], Tijian_Model_ProductStore::EXPANDPRODUCT);
                $aData['aList'][$key]['iStoreNum'] = count($aHasStore);
                $aData['aList'][$key]['iCityNum'] = 0;
                $aData['aList'][$key]['iSupplierNum'] = 0;
                $aData['aList'][$key]['iComChannelNum'] = 0;
                $aData['aList'][$key]['iComUserNum'] = 0;
                $aData['aList'][$key]['iIndivChannelNum'] = 0;
                $aData['aList'][$key]['iIndivUserNum'] = 0;
                $aCityTmp = [];
                $aSupplierTmp = [];
                //统计城市和供应商数目
                if (!empty($aHasStore)) {
                    foreach ($aHasStore as $k => $val) {
                        $aProductData = Tijian_Model_Store::getDetail($val['iStoreID']);
                        $aHasStore[$k]['aStore'] = $aProductData;
                        //按城市分组
                        $aCityTmp[$aProductData['iCityID']][] = 1;
                        //按供应商分组
                        $aSupplierTmp[$aProductData['iSupplierID']][] = 1;
                    }
                    $aData['aList'][$key]['iCityNum'] = count($aCityTmp);
                    $aData['aList'][$key]['iSupplierNum'] = count($aSupplierTmp);
                }
                if ($value['sProductCode'] == 'ep61487804') {
                    //print_r($aHasStore);die;
                }
                //统计渠道和客户数量
                if (!empty($value['iCanCompany'])) {
                    $aChannel = Tijian_Model_ProductChannel::getChannelInfoByProductID($value['iProductID'], Tijian_Model_ProductChannel::TYPE_COMPANY);
                    $aData['aList'][$key]['iComChannelNum'] = count($aChannel);
                    if (!empty($aChannel)) {
                        $iNumTmp = 0;
                        $aViewList = [];
                        foreach ($aChannel as $k => $val) {
                            //统计渠道所有支持数目
                            if ($val['iViewRange'] == 0 || $val['iViewRange'] == 2) {//全部和不可见要统计渠道所有支持数目
                                $aUserParam['where']['iStatus >'] = 0;
                                $aUserParam['where']['iChannel'] = $val['iChannelID'];
                                $aChannelUser = Tijian_Model_User::getCnt($aUserParam);
                                $iNumTmp += $aChannelUser;
                                if ($val['iViewRange'] == 2) {
                                    $aViewList = Tijian_Model_Product::getUserViewlist($value['iProductID'], Tijian_Model_ProductChannel::TYPE_COMPANY, $val['iChannelID']);
                                    $iNumTmp = $iNumTmp - count($aViewList);
                                }
                            } else {
                                $aViewList = Tijian_Model_Product::getUserViewlist($value['iProductID'], Tijian_Model_ProductChannel::TYPE_COMPANY, $val['iChannelID']);
                                if (!empty($aViewList)) {
                                    $iNumTmp += count($aViewList);
                                }
                            }
                        }
                        $aData['aList'][$key]['iComUserNum'] = $iNumTmp;
                    }
                }
                if (!empty($value['iCanIndividual'])) {
                    $aChannel = Tijian_Model_ProductChannel::getChannelInfoByProductID($value['iProductID'], Tijian_Model_ProductChannel::TYPE_INDIVIDUAL);
                    $aData['aList'][$key]['iIndivChannelNum'] = count($aChannel);
                    if (!empty($aChannel)) {
                        $iNumTmp = 0;
                        $aViewList = [];
                        foreach ($aChannel as $k => $val) {
                            //统计渠道所有支持数目
                            if ($val['iViewRange'] == 0 || $val['iViewRange'] == 2) {//全部和不可见要统计渠道所有支持数目
                                $aUserParam['where']['iStatus >'] = 0;
                                $aUserParam['where']['iChannel'] = $val['iChannelID'];
                                $aChannelUser = Tijian_Model_User::getCnt($aUserParam);
                                $iNumTmp += $aChannelUser;
                                if ($val['iViewRange'] == 2) {
                                    $aViewList = Tijian_Model_Product::getUserViewlist($value['iProductID'], Tijian_Model_ProductChannel::TYPE_INDIVIDUAL, $val['iChannelID']);
                                    $iNumTmp = $iNumTmp - count($aViewList);
                                }
                            } else {
                                $aViewList = Tijian_Model_Product::getUserViewlist($value['iProductID'], Tijian_Model_ProductChannel::TYPE_INDIVIDUAL, $val['iChannelID']);
                                if (!empty($aViewList)) {
                                    $iNumTmp += count($aViewList);
                                }
                            }
                        }
                        $aData['aList'][$key]['iIndivUserNum'] = $iNumTmp;
                    }
                }
            }
        }
        $aWhere['iStatus >'] = 0;
        $aSupplier = Tijian_Model_Type::getOption('supplier');
        $aCity = Tijian_Model_City::getPair($aWhere, 'iCityID', 'sCityName');
        $aChannel = Yaf_G::getConf('aChannel');
        $aStatus = Yaf_G::getConf('aStatus', 'product');
        $aWhere['iType'] = Tijian_Model_Product::TYPE_BASE;
        $aParent = Tijian_Model_Product::getPair($aWhere, 'iProductID', 'sProductName');
        $this->assign('iType', Tijian_Model_Product::TYPE_EXPAND);
        $this->assign('aSupplier', $aSupplier);
        $this->assign('aCity', $aCity);
        $this->assign('aChannel', $aChannel);
        $this->assign('aParent', $aParent);
        $this->assign('aStatus', $aStatus);
        $this->assign('aData', $aData);
        $this->assign('aParam', $aParam);
    }

    public function getParentAction()
    {//ajax获取拓展产品属性
        $iProductID = intval($this->getParam('id'));
        if (empty($iProductID)) {
            return $this->showMsg('参数有误！', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('产品不存在！', false);
        }
        //获取以该产品为父产品的拓展产品数目
        $aParam['where']['iStatus > '] = 0;
        $aParam['where']['iType'] = Tijian_Model_Product::TYPE_EXPAND;
        $aParam['where']['iParentID'] = $iProductID;
        $iSonNum = Tijian_Model_Product::getCnt($aParam);
        $aProduct['iSonNum'] = $iSonNum;
        $aProduct['sExpandCode'] = str_pad($iSonNum + 1, 2, "0", STR_PAD_LEFT);
        $aProduct['sImageShow'] = !empty($aProduct['sImage']) ? Util_Uri::getDFSViewURL($aProduct['sImage']) : '';
        return $this->showMsg($aProduct, true);
    }

    //导入门店代码
    public function importStoreCodeAction()
    {
        $aParam = $this->getParams();
        if (empty($aParam['id'])) {
            return $this->showMsg('参数不全', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($aParam['id']);
        if (empty($aProduct)) {
            return $this->showMsg('不存在该产品', false);
        }
        $aFile = explode('.', $aParam['sItemTemplate']);
        $oFile = new File_Storage();
        $ret = $oFile->getFile($aFile[0], $aFile[1]);

        if ($ret) {
            $PHPReader = new PHPExcel_Reader_Excel2007();

            $file_path = $oFile->getDestFile($aFile[0]);
            if (!$PHPReader->canRead($file_path)) {
                $PHPReader = new PHPExcel_Reader_Excel5();
                if (!$PHPReader->canRead($file_path)) {
                    return $this->showMsg('Excel文件处理错误', false);
                }
            }
            $PHPExcel = $PHPReader->load($file_path);
            $currentSheet = $PHPExcel->getSheet(0);
            $allRow = $currentSheet->getHighestRow();

            $aAllStores = Tijian_Model_Store::getPair([
                'where' => [
                    'iStatus' => Tijian_Model_ProductItem::STATUS_VALID
                ]
            ], 'sName', 'iStoreID');
            $aSex = Yaf_G::getConf('aSex', 'product');
            $aSex = array_flip($aSex);
            $iSuccess = 0;//成功项
            $aFail = [];//失败项

            for ($i = 1; $i <= $allRow; $i++) { //第1行是表头,从第2行开始读取
                $sStoreName = $PHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                $sSex = $PHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
                $sCode = $PHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
                $sSupplierPrice = $PHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
                $sChannelPrice = $PHPExcel->getActiveSheet()->getCell("E" . $i)->getValue();
                if ($i == 1) {
                    if ($sStoreName != Tijian_Model_Store::INPORTROWNAME) {
                        return $this->showMsg('导入文件格式错误，第一列请以"' . Tijian_Model_Store::INPORTROWNAME . '"为标题', false);
                    }
                    if ($sSex != Tijian_Model_Store::INPORTROWSEX) {
                        return $this->showMsg('导入文件格式错误，第二列请以"' . Tijian_Model_Store::INPORTROWSEX . '"为标题', false);
                    }
                    if ($sCode != Tijian_Model_Store::INPORTROWCODE) {
                        return $this->showMsg('导入文件格式错误，第三列请以"' . Tijian_Model_Store::INPORTROWCODE . '"为标题', false);
                    }
                    if ($sSupplierPrice != Tijian_Model_Store::INPORTROWPRICE1) {
                        return $this->showMsg('导入文件格式错误，第四列请以"' . Tijian_Model_Store::INPORTROWPRICE1 . '"为标题', false);
                    }
                    if ($sChannelPrice != Tijian_Model_Store::INPORTROWPRICE2) {
                        return $this->showMsg('导入文件格式错误，第五列请以"' . Tijian_Model_Store::INPORTROWPRICE2 . '"为标题', false);
                    }
                    continue;
                }
                if (empty($aAllStores[$sStoreName])) {
                    $aFail[$i]['iHang'] = $i;
                    $aFail[$i]['storeName'] = $sStoreName;
                    $aFail[$i]['reason'] = '该门店不存在';
                    continue;
                }
                if (empty($aSex[$sSex])) {
                    $aFail[$i]['iHang'] = $i;
                    $aFail[$i]['storeName'] = $sStoreName;
                    $aFail[$i]['reason'] = '该性别不存在';
                    continue;
                }
                $aStore = Tijian_Model_Store::getStoreByStoreName($sStoreName);
                $aStoreCodeParam['iProductID'] = $aParam['id'];
                $aStoreCodeParam['iStoreID'] = $aStore['iStoreID'];
                $aStoreCodeParam['iSex'] = $aSex[$sSex];
                $aStoreCodeParam['sCode'] = $sCode;
                $aStoreCodeParam['sChannelPrice'] = $sChannelPrice;
                $aStoreCodeParam['sSupplierPrice'] = $sSupplierPrice;
                $aStoreCodeParam['iCreateUserID'] = $aStoreCodeParam['iUpdateUserID'] = $this->aCurrUser['iUserID'];;
                if (Tijian_Model_StoreCode::getData($aParam['id'], $aStore['iStoreID'], $aSex[$sSex])) {
                    $aFail[$i]['iHang'] = $i;
                    $aFail[$i]['storeName'] = $sStoreName;
                    $aFail[$i]['reason'] = '已导入过该门店';
                    continue;
                } else {
                    if (!Tijian_Model_StoreCode::addData($aStoreCodeParam)) {
                        $aFail[$i]['iHang'] = $i;
                        $aFail[$i]['storeName'] = $sStoreName;
                        $aFail[$i]['reason'] = '代码插入失败';
                    } else {
                        $iSuccess++;
                    }
                }
            }
            $aData['iSuccess'] = $iSuccess;
            $aData['iFail'] = count($aFail);
            $aData['aFail'] = $aFail;//报错详情（有需求再说）
            return $this->showMsg($aData, true);
        }
    }

    //按供应商城市导入门店代码
    public function importCityStoreCodeAction()
    {
        $aParam = $this->getParams();
        if (empty($aParam['id'])) {
            return $this->showMsg('参数不全', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($aParam['id']);
        if (empty($aProduct)) {
            return $this->showMsg('不存在该产品', false);
        }
        $aFile = explode('.', $aParam['sItemTemplate']);
        $oFile = new File_Storage();
        $ret = $oFile->getFile($aFile[0], $aFile[1]);

        if ($ret) {
            $PHPReader = new PHPExcel_Reader_Excel2007();

            $file_path = $oFile->getDestFile($aFile[0]);
            if (!$PHPReader->canRead($file_path)) {
                $PHPReader = new PHPExcel_Reader_Excel5();
                if (!$PHPReader->canRead($file_path)) {
                    return $this->showMsg('Excel文件处理错误', false);
                }
            }
            $PHPExcel = $PHPReader->load($file_path);
            $currentSheet = $PHPExcel->getSheet(0);
            $allRow = $currentSheet->getHighestRow();

            $aWhere['iStatus >'] = 0;
            $aSupplier = Tijian_Model_Type::getOption('supplier');
            $aSupplier = array_flip($aSupplier);
            $aCity = Tijian_Model_City::getPair($aWhere, 'sCityName', 'iCityID');
            $aSex = Yaf_G::getConf('aSex', 'product');
            $aSex = array_flip($aSex);
            $iTotal = 0;//总共项
            $iSuccess = 0;//成功项
            $aFail = [];//失败项

            for ($i = 1; $i <= $allRow; $i++) { //第1行是表头,从第2行开始读取
                $sSupperName = $PHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                $sCity = $PHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
                $sSex = $PHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
                $sCode = $PHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
                $sSupplierPrice = $PHPExcel->getActiveSheet()->getCell("E" . $i)->getValue();
                $sChannelPrice = $PHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
                if ($i == 1) {
                    if ($sSupperName != Tijian_Model_Store::INPORTROWSUPPERNAME) {
                        return $this->showMsg('导入文件格式错误，第一列请以"' . Tijian_Model_Store::INPORTROWSUPPERNAME . '"为标题', false);
                    }
                    if ($sCity != Tijian_Model_Store::INPORTROWCITY) {
                        return $this->showMsg('导入文件格式错误，第二列请以"' . Tijian_Model_Store::INPORTROWCITY . '"为标题', false);
                    }
                    if ($sSex != Tijian_Model_Store::INPORTROWSEX) {
                        return $this->showMsg('导入文件格式错误，第三列请以"' . Tijian_Model_Store::INPORTROWSEX . '"为标题', false);
                    }
                    if ($sCode != Tijian_Model_Store::INPORTROWCODE) {
                        return $this->showMsg('导入文件格式错误，第四列请以"' . Tijian_Model_Store::INPORTROWCODE . '"为标题', false);
                    }
                    if ($sSupplierPrice != Tijian_Model_Store::INPORTROWPRICE1) {
                        return $this->showMsg('导入文件格式错误，第五列请以"' . Tijian_Model_Store::INPORTROWPRICE1 . '"为标题', false);
                    }
                    if ($sChannelPrice != Tijian_Model_Store::INPORTROWPRICE2) {
                        return $this->showMsg('导入文件格式错误，第六列请以"' . Tijian_Model_Store::INPORTROWPRICE2 . '"为标题', false);
                    }
                    continue;
                }
                if (empty($aSupplier[$sSupperName])) {
                    $aTmp['iHang'] = $i;
                    $aTmp['supplierName'] = $sSupperName;
                    $aTmp['city'] = $sCity;
                    $aTmp['reason'] = '该供应商不存在';
                    $aFail[$i][] = $aTmp;
                    continue;
                }
                if (empty($aCity[$sCity])) {
                    $aTmp['iHang'] = $i;
                    $aTmp['supplierName'] = $sSupperName;
                    $aTmp['city'] = $sCity;
                    $aTmp['reason'] = '该城市不存在';
                    $aFail[$i][] = $aTmp;
                    continue;
                }
                if (empty($aSex[$sSex])) {
                    $aTmp['iHang'] = $i;
                    $aTmp['supplierName'] = $sSupperName;
                    $aTmp['city'] = $sCity;
                    $aTmp['reason'] = '该性别不存在';
                    $aFail[$i][] = $aTmp;
                    continue;
                }

                $aStoreParam['sCity'] = $aCity[$sCity];
                $aStoreParam['sSupplier'] = $aSupplier[$sSupperName];
                $aStores = Tijian_Model_Store::getData($aStoreParam);
                foreach ($aStores as $key => $value) {
                    $iTotal++;
                    $aStoreCodeParam['iProductID'] = $aParam['id'];
                    $aStoreCodeParam['iStoreID'] = $value['iStoreID'];
                    $aStoreCodeParam['iSex'] = $aSex[$sSex];
                    $aStoreCodeParam['sCode'] = $sCode;
                    $aStoreCodeParam['sChannelPrice'] = $sChannelPrice;
                    $aStoreCodeParam['sSupplierPrice'] = $sSupplierPrice;
                    $aStoreCodeParam['iCreateUserID'] = $aStoreCodeParam['iUpdateUserID'] = $this->aCurrUser['iUserID'];;
                    if (Tijian_Model_StoreCode::getData($aParam['id'], $value['iStoreID'], $aSex[$sSex])) {
                        $aTmp['iHang'] = $i;
                        $aTmp['supplierName'] = $sSupperName;
                        $aTmp['city'] = $sCity;
                        $aTmp['storeName'] = $value['sName'];
                        $aTmp['reason'] = '已导入过该门店';
                        $aFail[$i][] = $aTmp;
                        continue;
                    } else {
                        if (!Tijian_Model_StoreCode::addData($aStoreCodeParam)) {
                            $aTmp['iHang'] = $i;
                            $aTmp['supplierName'] = $sSupperName;
                            $aTmp['city'] = $sCity;
                            $aTmp['storeName'] = $value['sName'];
                            $aTmp['reason'] = '代码插入失败';
                            $aFail[$i][] = $aTmp;
                        } else {
                            $iSuccess++;
                        }
                    }
                }
            }
            $aData['iSuccess'] = $iSuccess;
            $aData['iTotal'] = $iTotal;
            $aData['iFail'] = $iTotal - $iSuccess;
            $aData['aFail'] = $aFail;//报错详情
            return $this->showMsg($aData, true);
        }
    }

    public function importItemAction()
    {//导入单项并匹配基础产品
        $aParam = $this->getParams();
        $aFile = explode('.', $aParam['sItemTemplate']);
        $oFile = new File_Storage();
        $ret = $oFile->getFile($aFile[0], $aFile[1]);

        if ($ret) {
            $PHPReader = new PHPExcel_Reader_Excel2007();

            $file_path = $oFile->getDestFile($aFile[0]);
            if (!$PHPReader->canRead($file_path)) {
                $PHPReader = new PHPExcel_Reader_Excel5();
                if (!$PHPReader->canRead($file_path)) {
                    return $this->showMsg('Excel文件处理错误', false);
                }
            }
            $PHPExcel = $PHPReader->load($file_path);
            $currentSheet = $PHPExcel->getSheet(0);
            $allRow = $currentSheet->getHighestRow();

            $aItem = Tijian_Model_Item::getPair([
                'where' => [
                    'iStatus' => Tijian_Model_ProductItem::STATUS_VALID
                ]
            ], 'sName', 'iItemID');
            $aImportItemIDs = [];

            for ($i = 1; $i <= $allRow; $i++) { //第1行是表头,从第2行开始读取
                $sItemName = $PHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                if ($i == 1) {
                    if ($sItemName != Tijian_Model_Item::INPORTROWNAME) {
                        return $this->showMsg('导入文件格式错误，第一列请以"' . Tijian_Model_Item::INPORTROWNAME . '"为标题', false);
                    }
                    continue;
                }
                if (empty($aItem[$sItemName])) {
                    continue;
                }
                $aImportItemIDs[] = $aItem[$sItemName];//需要导入的所有单项
            }
            if (!empty($aImportItemIDs)) {
                $aMatchList = Tijian_Model_ProductItem::matchProductByItem($aImportItemIDs);
                if (empty($aMatchList)) {
                    return $this->showMsg('没有匹配到相应的基础产品，请手动匹配', false);
                }
                //获取匹配的基础产品中总共有多少单项
                foreach ($aMatchList as $key => $value) {
                    $aHasItems = Tijian_Model_ProductItem::getProductItems($value['iProductID'], Tijian_Model_ProductItem::BASEPRODUCT, 1);
                    $aMatchList[$key]['iCount'] = count($aHasItems);
                }
                $aData['importItems'] = implode(',', $aImportItemIDs);
                $aData['matchList'] = $aMatchList;
                $aData['mathTitle'] = '为您推荐以下' . count($aMatchList) . '个基础产品';
                $aData['matchListhtml'] = $this->_initHtml($aMatchList);
                return $this->showMsg($aData, true);
            } else {
                return $this->showMsg('excel文件中没有找到可导入的单项，请检查', false);
            }
        }
    }

    //匹配时生成的html
    private function _initHtml($aData)
    {
        $sHtml = '';
        if (!empty($aData)) {
            foreach ($aData as $key => $value) {
                $sHtml .= '
<div class="match_list">
<label>
<input type="radio" name="match_list_radio" value="' . $value['iProductID'] . '" checked>
' . $value['sProductName'] . '(共' . $value['iCount'] . '项,' . $value['iCnt'] . '项相同)
</label>
</div>';
            }
        }
        return $sHtml;
    }

    //填写基本信息
    public function addBaseInfoAction()
    {
        if ($this->_request->isPost()) {
            $aProduct = $this->_checkClientData(1);
            if (empty($aProduct)) {
                return null;
            }
            $iPartentID = $aProduct['iParentID'];
            $aParent = Tijian_Model_Product::getDetail($iPartentID);
            $aProduct['sProductCode'] = Tijian_Model_Product::initProductCode(1);
            $aProduct['iType'] = Tijian_Model_Product::TYPE_EXPAND;
            $aProduct['iCreateUserID'] = $aProduct['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
            $aImportItemID = $aProduct['importItemID'];
            unset($aProduct['selectBaseID']);
            unset($aProduct['importItemID']);

            Tijian_Model_Product::begin();
            if ($iLastInsertID = Tijian_Model_Product::addData($aProduct)) {
                //导入基础产品的基本信息，单项，门店，加项，升级产品等信息
                //1,基本信息(暂时知道的是匹配价格，备注也匹配？其他要匹配再在这里加)
                $aBaseParam['iManPrice'] = $aParent['iManPrice'];
                $aBaseParam['iWomanPrice1'] = $aParent['iWomanPrice1'];
                $aBaseParam['iWomanPrice2'] = $aParent['iWomanPrice2'];
                $aBaseParam['sRemark'] = $aParent['sRemark'];
                $aBaseParam['iProductID'] = $iLastInsertID;
                if (!Tijian_Model_Product::updData($aBaseParam)) {
                    Tijian_Model_Product::rollback();
                    return $this->showMsg('增加失败！', false);
                }
                //2,单项
                if (!empty($aImportItemID)) {//导入item操作
                    $aImportItemID = explode(',', $aImportItemID);
                    $aItemParam['iProductID'] = $iLastInsertID;
                    $aItemParam['iType'] = Tijian_Model_ProductItem::EXPANDPRODUCT;
                    $aItemParam['iCreateUserID'] = $aItemParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                    foreach ($aImportItemID as $key => $value) {
                        $aItemParam['iItemID'] = $value;
                        //查询是否存在该item和是否已经导入过
                        $aItem = Tijian_Model_Item::getDetail($value);
                        if (empty($aItem) || Tijian_Model_ProductItem::getDataByItemID($iLastInsertID, $value, Tijian_Model_ProductItem::EXPANDPRODUCT)) {
                            continue;
                        }
                        if (!Tijian_Model_ProductItem::addData($aItemParam)) {
                            Tijian_Model_Product::rollback();
                            return $this->showMsg('增加失败！', false);
                        }
                    }
                } else {//如果是手动  匹配的，导入基础产品中的所有单项
                    $aPrentItem = Tijian_Model_ProductItem::getProductItems($iPartentID, Tijian_Model_ProductItem::BASEPRODUCT, 1);
                    $aItemParam['iProductID'] = $iLastInsertID;
                    $aItemParam['iType'] = Tijian_Model_ProductItem::EXPANDPRODUCT;
                    $aItemParam['iCreateUserID'] = $aItemParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                    if (!empty($aPrentItem)) {
                        foreach ($aPrentItem as $key => $value) {
                            $aItemParam['iItemID'] = $value['iItemID'];
                            //查询是否存在该item和是否已经导入过
                            $aItem = Tijian_Model_ProductItem::getDataByItemID($iLastInsertID, $value['iItemID'], Tijian_Model_ProductItem::EXPANDPRODUCT);
                            if (!empty($aItem)) {
                                continue;
                            }
                            if (!Tijian_Model_ProductItem::addData($aItemParam)) {
                                Tijian_Model_Product::rollback();
                                return $this->showMsg('增加失败！', false);
                            }
                        }
                    }
                }
                //3，门店
                $aPrentStore = Tijian_Model_ProductStore::getProductStores($iPartentID, Tijian_Model_ProductStore::BASEPRODUCT);
                $aStoreParam['iProductID'] = $iLastInsertID;
                $aStoreParam['iType'] = Tijian_Model_ProductStore::EXPANDPRODUCT;
                $aStoreParam['iCreateUserID'] = $aStoreParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                if (!empty($aPrentStore)) {
                    foreach ($aPrentStore as $key => $value) {
                        $aStoreParam['iStoreID'] = $value['iStoreID'];
                        //查询是否存在该store和是否已经导入过
                        $aStore = Tijian_Model_ProductStore::getDataByStoreID($iLastInsertID, $value['iStoreID'], Tijian_Model_ProductStore::EXPANDPRODUCT);
                        if (!empty($aStore)) {
                            continue;
                        }
                        if (!Tijian_Model_ProductStore::addData($aStoreParam)) {
                            Tijian_Model_Product::rollback();
                            return $this->showMsg('增加失败！', false);
                        }
                    }
                }
                //4,加项包
                $aPrentAddtion = Tijian_Model_ProductAddtion::getProductAddtions($iPartentID, Tijian_Model_ProductAddtion::BASEPRODUCT);
                $aAddtionParam['iProductID'] = $iLastInsertID;
                $aAddtionParam['iType'] = Tijian_Model_ProductAddtion::EXPANDPRODUCT;
                $aAddtionParam['iCreateUserID'] = $aAddtionParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                if (!empty($aPrentAddtion)) {
                    foreach ($aPrentAddtion as $key => $value) {
                        $aAddtionParam['iAddtionID'] = $value['iAddtionID'];
                        //查询是否存在该store和是否已经导入过
                        $aAddtion = Tijian_Model_ProductAddtion::getDataByAddtionID($iLastInsertID, $value['iAddtionID'], Tijian_Model_ProductAddtion::EXPANDPRODUCT);
                        if (!empty($aAddtion)) {
                            continue;
                        }
                        if (!Tijian_Model_ProductAddtion::addData($aAddtionParam)) {
                            Tijian_Model_Product::rollback();
                            return $this->showMsg('增加失败！', false);
                        }
                    }
                }
                //5,升级产品
                if (!empty($aProduct['iIsStand'])) {//只有标准产品才有自动导入功能
                    $aParentUpgrade = Tijian_Model_ProductUpgrade::getProductUpgrades($iPartentID, Tijian_Model_ProductAddtion::BASEPRODUCT);//该基础产品的升级产品
                    //统计升级产品ID
                    if (!empty($aParentUpgrade)) {
                        $aParentUpgradeID = [];
                        foreach ($aParentUpgrade as $key => $value) {
                            $aParentUpgradeID[] = $value['iUpgradeID'];
                        }
                        $aParentUpgradeExpend = Tijian_Model_Product::getExplandData($aParentUpgradeID);//以该升级产品为父产品的拓展产品
                        foreach ($aParentUpgradeExpend as $key => $value) {//排除不是标准产品的拓展产品
                            if (empty($value['iIsStand'])) {
                                unset($aParentUpgradeExpend[$key]);
                            }
                        }
                    }


                    $aUpgradeParam['iProductID'] = $iLastInsertID;
                    $aUpgradeParam['iType'] = Tijian_Model_ProductUpgrade::EXPANDPRODUCT;
                    $aUpgradeParam['iCreateUserID'] = $aUpgradeParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                    if (!empty($aParentUpgradeExpend)) {
                        foreach ($aParentUpgradeExpend as $key => $value) {
                            $aUpgradeParam['iUpgradeID'] = $value['iProductID'];
                            //查询是否存在该store和是否已经导入过
                            $aUpgrade = Tijian_Model_ProductUpgrade::getDataByUpgradeID($iLastInsertID, $value['iProductID'], Tijian_Model_ProductUpgrade::EXPANDPRODUCT);
                            if (!empty($aUpgrade)) {
                                continue;
                            }
                            if (!Tijian_Model_ProductUpgrade::addData($aUpgradeParam)) {
                                Tijian_Model_Product::rollback();
                                return $this->showMsg('增加失败！', false);
                            }
                        }
                    }
                }

                Tijian_Model_Product::commit();
                $sNextUrl = '/tijian/admin/eproduct/additem/id/' . $iLastInsertID;
                return $this->showMsg('添加成功!', true, $sNextUrl);
            } else {
                Tijian_Model_Product::rollback();
                return $this->showMsg('增加失败！', false);
            }
        } else {
            $this->assign('aBaseList', Tijian_Model_Product::getBaseList());
            $this->assign('aPCard', Yaf_G::getConf('aPCard', 'product'));
            $this->assign('aAttribute', Yaf_G::getConf('aAttribute', 'product'));
            $this->assign('aStatus', Yaf_G::getConf('aStatus', 'product'));
            $this->assign('aProductType', Yaf_G::getConf('aType', 'product'));
            $this->assign('aSpecialCheck', Yaf_G::getConf('aSpecial', 'product'));
        }
    }

    //同步所有标准产品的升级关系
    public function sysAllUpgradeAction()
    {
        $iUserSuccuss = 0;//用户级别同步成功数目
        $iExpSuccuss = 0;//产品界别同步成功数目
        $aProductsParam['iIsStand'] = 1;
        $aProductsParam['iStatus'] = 1;
        $aProductsParam['iType'] = Tijian_Model_Product::TYPE_EXPAND;
        $aProducts = Tijian_Model_Product::getAll($aProductsParam);
        if (!empty($aProducts)) {
            foreach ($aProducts as $aProduct) {
                $iPartentID = $aProduct['iParentID'];
                $aParentUpgrade = Tijian_Model_ProductUpgrade::getProductUpgrades($iPartentID, Tijian_Model_ProductAddtion::BASEPRODUCT);//该基础产品的升级产品
                //统计升级产品ID
                if (!empty($aParentUpgrade)) {
                    $aParentUpgradeID = [];
                    foreach ($aParentUpgrade as $key => $value) {
                        $aParentUpgradeID[] = $value['iUpgradeID'];
                    }
                    $aParentUpgradeExpend = Tijian_Model_Product::getExplandData($aParentUpgradeID);//以该升级产品为父产品的拓展产品
                    foreach ($aParentUpgradeExpend as $key => $value) {//排除不是标准产品的拓展产品
                        if (empty($value['iIsStand'])) {
                            unset($aParentUpgradeExpend[$key]);
                        }
                    }
                }

                $aUpgradeParam['iProductID'] = $aProduct['iProductID'];
                $aUpgradeParam['iType'] = Tijian_Model_ProductUpgrade::EXPANDPRODUCT;
                $aUpgradeParam['iCreateUserID'] = $aUpgradeParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                if (!empty($aParentUpgradeExpend)) {
                    //同步拓展产品
                    foreach ($aParentUpgradeExpend as $key => $value) {
                        $aUpgradeParam['iUpgradeID'] = $value['iProductID'];
                        //查询该升级产品是否已经导入过
                        $aUpgrade = Tijian_Model_ProductUpgrade::getDataByUpgradeID($aProduct['iProductID'], $value['iProductID'], Tijian_Model_ProductUpgrade::EXPANDPRODUCT);
                        if (!empty($aUpgrade)) {
                            continue;
                        }
                        if (!Tijian_Model_ProductUpgrade::addData($aUpgradeParam)) {
                            return $this->showMsg('同步失败！', false);
                        } else {
                            $iExpSuccuss++;
                        }
                    }


                    //同步用户级别升级产品
                    //1,获取某产品同步过的所有记录
                    $aUserProduct = Tijian_Model_UserProductUpgrade::getUserSysByProduct($aProduct['iProductID']);
                    if (!empty($aUserProduct)) {
                        foreach ($aUserProduct as $key => $value) {
                            //2,判断是否编辑过,没有编辑过的再从拓展产品中同步
                            $aHasEdit = Tijian_Model_UserProductUpdateStatus::getData($value['iProductID'],$value['iUserID'],$value['iType'],$value['iChannelID'],Tijian_Model_UserProductUpdateStatus::UPGRADE);
                            if (empty($aHasEdit)) {
                                foreach ($aParentUpgradeExpend as $k => $val) {
                                    //查询该升级产品是否已经导入过
                                    $aUpgrade = Tijian_Model_UserProductUpgrade::getUserHasUpgrades($value['iProductID'],$value['iUserID'],$val['iProductID'],$value['iType'],$value['iChannelID']);
                                    if (!empty($aUpgrade)) {
                                        continue;
                                    }
                                    $aUserParam['iProductID'] = $value['iProductID'];
                                    $aUserParam['iCreateUserID'] = $aUserParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                                    $aUserParam['iStatus'] = 1;
                                    $aUserParam['iUpgradeID'] = $val['iProductID'];
                                    $aUserParam['iUserID'] = $value['iUserID'];
                                    $aUserParam['iType'] = $value['iType'];
                                    $aUserParam['iChannelID'] = $value['iChannelID'];
                                    if (!Tijian_Model_UserProductUpgrade::addData($aUserParam)) {
                                        return $this->showMsg('同步失败！', false);
                                    } else {
                                        $iUserSuccuss++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $this->showMsg('同步成功|共同步'.count($aProducts).'个标准产品|共'.$iExpSuccuss.'个拓展产品级别升级关系|'.$iUserSuccuss.'个用户级别升级关系', true);
    }

    //查看基本信息
    public function viewBaseInfoAction()
    {
        $iProductID = intval($this->getParam('id'));
        if (empty($iProductID)) {
            return $this->showMsg('参数有误！', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('产品不存在！', false);
        }
        $aBaseProduct = Tijian_Model_Product::getDetail($aProduct['iParentID']);
        $aStatus = Yaf_G::getConf('aStatus', 'product');
        $aProductType = Yaf_G::getConf('aType', 'product');
        $aSpecialCheck = Yaf_G::getConf('aSpecial', 'product');
        $this->assign('aProduct', $aProduct);
        $this->assign('aBaseProduct', $aBaseProduct);
        $this->assign('aStatus', $aStatus);
        $this->assign('aProductType', $aProductType);
        $this->assign('aSpecialCheck', $aSpecialCheck);
        $this->assign('aBaseList', Tijian_Model_Product::getBaseList());
        $this->assign('aPCard', Yaf_G::getConf('aPCard', 'product'));
        $this->assign('aAttribute', Yaf_G::getConf('aAttribute', 'product'));

        //munu相关的赋值
        $this->_editHeader(1, 1);
        $this->assign('iProductID', $iProductID);
        $this->assign('aProduct', $aProduct);
    }

    //编辑基本信息
    public function editBaseInfoAction()
    {
        $iProductID = intval($this->getParam('id'));
        if (empty($iProductID)) {
            return $this->showMsg('参数有误！', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('产品不存在！', false);
        }

        if ($this->_request->isPost()) {
            $aProduct = $this->_checkClientData(2);
            if (empty($aProduct)) {
                return null;
            }
            $aProduct['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
            if (Tijian_Model_Product::updData($aProduct)) {
                return $this->showMsg('保存成功!', true);
            } else {
                return $this->showMsg('保存失败！', false);
            }
        } else {
            $aWhere['iStatus >'] = 0;
            $aWhere['iType'] = Tijian_Model_Product::TYPE_BASE;
            $aParent = Tijian_Model_Product::getPair($aWhere, 'iProductID', 'sProductName');
            $this->assign('aBaseList', $aParent);
            $this->assign('aPCard', Yaf_G::getConf('aPCard', 'product'));
            $this->assign('aAttribute', Yaf_G::getConf('aAttribute', 'product'));
            $this->assign('aStatus', Yaf_G::getConf('aStatus', 'product'));
            $this->assign('aProductType', Yaf_G::getConf('aType', 'product'));
            $this->assign('aSpecialCheck', Yaf_G::getConf('aSpecial', 'product'));
            //munu相关的赋值
            $this->_editHeader(1, 2);
            $this->assign('iProductID', $iProductID);
            $this->assign('aProduct', $aProduct);
        }
    }

    //编辑价格与基本信息
    public function editBasePriceAction()
    {
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $sUserID = $this->getParam('uid') ? intval($this->getParam('uid')) : 0;
        $iChannelType = $this->getParam('tid') ? intval($this->getParam('tid')) : 0;
        $iChannelID = $this->getParam('cid') ? intval($this->getParam('cid')) : 0;
        if (empty($iProductID) || empty($sUserID) || empty($iChannelType) || empty($iChannelID)) {
            return $this->showMsg('参数有误！', false);
        }
        $checkChannelParam = $this->_checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID);
        if (empty($checkChannelParam)) {
            return null;
        }
        $aProduct = Tijian_Model_UserProductBase::getUserProductBase($iProductID, $sUserID, $iChannelType, $iChannelID);
        if ($this->_request->isPost()) {
            $aParam = $this->_checkClientData(3);
            if (empty($aParam)) {
                return null;
            }
            if (empty($aParam['sUserID'])) {
                return $this->showMsg('非法操作!', false);
            }
            $aParam['iCreateUserID'] = $aParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
            $aParam['iUserID'] = $aParam['sUserID'];
            //判断是否已经添加过
            $aUserBase = Tijian_Model_UserProductBase::getUserHasData($iProductID, $aParam['sUserID'], $iChannelType, $iChannelID);
            $aParam['iType'] = $iChannelType;
            $aParam['iChannelID'] = $iChannelID;
            if (!empty($aUserBase)) {
                $aParam['iAutoID'] = $aUserBase['iAutoID'];
                Tijian_Model_UserProductBase::updData($aParam);
            } else {
                Tijian_Model_UserProductBase::addData($aParam);
            }
            return $this->showMsg('编辑成功！', true);
        } else {
            $aUserParam['where']['iStatus >'] = 0;
            $aUserParam['where']['iType'] = 2;
            $aUserParam['where']['iUserID'] = $sUserID;
            $aUsers = Tijian_Model_User::getPair($aUserParam, 'iUserID', 'sRealName');
            $this->_editUserHeader(1);
            $this->assign('aProduct', $aProduct);
            $this->assign('iProductID', $iProductID);
            $this->assign('sUserID', $sUserID);
            $this->assign('aUsers', $aUsers);
            $this->assign('iChannelType', $iChannelType);
            $this->assign('iChannelID', $iChannelID);
        }
    }

    //渠道设置
    public function addChannelAction()
    {
        $iType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        if (empty($iProductID)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aTmp = Yaf_G::getConf('aChannel');
        unset($aTmp[0]);
        $aCompanyChannelJoinList = $aIndividualChannelJoinList = $aTmp;//这里会清除channel表中这次没有开通的渠道
        if ($this->_request->isPost()) {
            $aProduct = $this->_checkClientData(3);
            if (empty($aProduct)) {
                return null;
            }
            if ($aProduct['iProductID'] != $iProductID) {
                return $this->showMsg('非法操作!', false);
            }
            if (!empty($aProduct['submit_type'])) {//点击的是选择可见不可见用户进来的
                $aViewParam = explode('-', $aProduct['submit_type']);
            }
            Tijian_Model_Product::begin();
            //产品表
            $aProduct['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
            if (!Tijian_Model_Product::updData($aProduct)) {
                Tijian_Model_Product::rollback();
                return $this->showMsg('操作失败', false);
            }
            if (!empty($aProduct['iCanCompany'])) {//处理公司渠道
                if (!empty($aProduct['companyChannel'])) {
                    foreach ($aProduct['companyChannel'] as $key => $value) {
                        //产品渠道表
                        $aProductChannelParam['iProductID'] = $iProductID;
                        $aProductChannelParam['iType'] = Tijian_Model_ProductChannel::TYPE_COMPANY;
                        $aProductChannelParam['iChannelID'] = $value;
                        $aProductChannelParam['iManPrice'] = !empty($aProduct['companyPrice1'][$value]) ? $aProduct['companyPrice1'][$value] : 0;
                        $aProductChannelParam['iWomanPrice1'] = !empty($aProduct['companyPrice2'][$value]) ? $aProduct['companyPrice2'][$value] : 0;
                        $aProductChannelParam['iWomanPrice2'] = !empty($aProduct['companyPrice3'][$value]) ? $aProduct['companyPrice3'][$value] : 0;
                        $aProductChannelParam['iViewRange'] = !empty($aProduct['companyViewType'][$value]) ? $aProduct['companyViewType'][$value] : 0;
                        $aProductChannelParam['iStatus'] = 1;
                        $aProductChannelParam['iCreateUserID'] = $aProductChannelParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                        $aProductChannel = Tijian_Model_ProductChannel::getData($iProductID, $aProductChannelParam['iType'], $value);
                        if (!$aProductChannel) {
                            $aProductChannelParam['iAutoID'] = Tijian_Model_ProductChannel::addData($aProductChannelParam);
                            if (!$aProductChannelParam['iAutoID']) {
                                Tijian_Model_ProductChannel::rollback();
                                return $this->showMsg('操作失败', false);
                            }
                        } else {
                            $aProductChannelParam['iAutoID'] = $aProductChannel['iAutoID'];
                            if (!Tijian_Model_ProductChannel::updData($aProductChannelParam)) {
                                Tijian_Model_ProductChannel::rollback();
                                return $this->showMsg('操作失败', false);
                            }
                        }
                        if (!empty($aViewParam) && $aViewParam[0] == $aProductChannelParam['iType'] && $aViewParam[1] == $value) {
                            $submit_type_channel_id = $aProductChannelParam['iAutoID'];
                        }
                        unset($aProductChannelParam);
                        unset($aCompanyChannelJoinList[$value]);
                    }
                }
                if (!empty($aCompanyChannelJoinList)) {//处理本次没有的渠道数据
                    foreach ($aCompanyChannelJoinList as $key => $value) {
                        $aProductChannelTmp = Tijian_Model_ProductChannel::getData($iProductID, Tijian_Model_ProductChannel::TYPE_COMPANY, $key);
                        if (!empty($aProductChannelTmp)) {
                            $aChannelTmpParam['iStatus'] = 0;
                            $aChannelTmpParam['iAutoID'] = $aProductChannelTmp['iAutoID'];
                            Tijian_Model_ProductChannel::updData($aChannelTmpParam);
                        }
                    }
                }
            }
            if (!empty($aProduct['iCanIndividual'])) {//处理个人渠道
                if (!empty($aProduct['individualChannel'])) {
                    foreach ($aProduct['individualChannel'] as $key => $value) {
                        //产品渠道表
                        $aProductChannelParam['iProductID'] = $iProductID;
                        $aProductChannelParam['iType'] = Tijian_Model_ProductChannel::TYPE_INDIVIDUAL;
                        $aProductChannelParam['iChannelID'] = $value;
                        $aProductChannelParam['iManPrice'] = !empty($aProduct['individualPrice1'][$value]) ? $aProduct['individualPrice1'][$value] : 0;
                        $aProductChannelParam['iWomanPrice1'] = !empty($aProduct['individualPrice2'][$value]) ? $aProduct['individualPrice2'][$value] : 0;
                        $aProductChannelParam['iWomanPrice2'] = !empty($aProduct['individualPrice3'][$value]) ? $aProduct['individualPrice3'][$value] : 0;
                        $aProductChannelParam['iViewRange'] = !empty($aProduct['individualViewType'][$value]) ? $aProduct['individualViewType'][$value] : 0;
                        $aProductChannelParam['iStatus'] = 1;
                        $aProductChannelParam['iCreateUserID'] = $aProductChannelParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                        $aProductChannel = Tijian_Model_ProductChannel::getData($iProductID, $aProductChannelParam['iType'], $value);
                        if (!$aProductChannel) {
                            $aProductChannelParam['iAutoID'] = Tijian_Model_ProductChannel::addData($aProductChannelParam);
                            if (!$aProductChannelParam['iAutoID']) {
                                Tijian_Model_ProductChannel::rollback();
                                return $this->showMsg('操作失败', false);
                            }
                        } else {
                            $aProductChannelParam['iAutoID'] = $aProductChannel['iAutoID'];
                            if (!Tijian_Model_ProductChannel::updData($aProductChannelParam)) {
                                Tijian_Model_ProductChannel::rollback();
                                return $this->showMsg('操作失败', false);
                            }
                        }
                        if (!empty($aViewParam) && $aViewParam[0] == $aProductChannelParam['iType'] && $aViewParam[1] == $value) {
                            $submit_type_channel_id = $aProductChannelParam['iAutoID'];
                        }
                        unset($aProductChannelParam);
                        unset($aIndividualChannelJoinList[$value]);
                    }
                }
                if (!empty($aIndividualChannelJoinList)) {//处理本次没有的渠道数据
                    foreach ($aIndividualChannelJoinList as $key => $value) {
                        $aProductChannelTmp = Tijian_Model_ProductChannel::getData($iProductID, Tijian_Model_ProductChannel::TYPE_INDIVIDUAL, $key);
                        if (!empty($aProductChannelTmp)) {
                            $aChannelTmpParam['iStatus'] = 0;
                            $aChannelTmpParam['iAutoID'] = $aProductChannelTmp['iAutoID'];
                            Tijian_Model_ProductChannel::updData($aChannelTmpParam);
                        }
                    }
                }
            }
            Tijian_Model_Product::commit();
            if (!empty($submit_type_channel_id)) {
                $sUrl = '/tijian/admin/eproduct/addviewrange/id/' . $submit_type_channel_id;
                if (!empty($iType)) {
                    $sUrl .= '/type/' . $iType;
                }
                return $this->showMsg('', true, $sUrl);
            } else {
                if ($iType == 1) {
                    $sUrl = '/tijian/admin/eproduct/viewviewrange/id/' . $iProductID;//跳转到查看页面
                    return $this->showMsg('配置成功!', true, $sUrl);
                } elseif ($iType == 2) {
                    return $this->showMsg('配置成功!', true);
                } else {
                    $sUrl = '/tijian/admin/eproduct/addhasselectuser/id/' . $iProductID;//跳转到配置客户详细内容页面
                    return $this->showMsg('配置成功!', true, $sUrl);
                }
            }
        } else {
            if ($aProduct['iCanIndividual'] == 1) {
                $aIndividualChannel = Tijian_Model_ProductChannel::getChannelInfoByProductID($iProductID, 2);
                if (!empty($aIndividualChannel)) {
                    $aTmp = [];
                    foreach ($aIndividualChannel as $key => $value) {
                        if ($value['iViewRange'] > 0) {
                            $aUsers = Tijian_Model_ProductViewRange::getDataByViewRangeID($value['iAutoID'], $value['iViewRange']);
                            $value['iViewRangeNum'] = count($aUsers);
                        }
                        $aTmp[$value['iChannelID']] = $value;
                    }
                    $aIndividualChannel = $aTmp;
                    $this->assign('aIndividualChannel', $aIndividualChannel);
                }
            }
            if ($aProduct['iCanCompany'] == 1) {
                $aCompanyChannel = Tijian_Model_ProductChannel::getChannelInfoByProductID($iProductID, 1);
                if (!empty($aCompanyChannel)) {
                    $aTmp = [];
                    foreach ($aCompanyChannel as $key => $value) {
                        if ($value['iViewRange'] > 0) {
                            $aUsers = Tijian_Model_ProductViewRange::getDataByViewRangeID($value['iAutoID'], $value['iViewRange']);
                            $value['iViewRangeNum'] = count($aUsers);
                        }
                        $aTmp[$value['iChannelID']] = $value;
                    }
                    $aCompanyChannel = $aTmp;
                    $this->assign('aCompanyChannel', $aCompanyChannel);
                }
            }
            if ($iType) {
                $this->_editHeader(3, 2);
            }
            $this->assign('aChannel', Yaf_G::getConf('aChannel'));
            $this->assign('aProduct', $aProduct);
            $this->assign('aCanView', Yaf_G::getConf('aCanView', 'product'));
            $this->assign('iProductID', $iProductID);
            $this->assign('iType', $iType);
        }
    }

    //渠道客户共用
    private function _viewrange()
    {
        $iType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $iProductChannelID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        $sKeyword = $this->getParam('sKeyword') ? $this->getParam('sKeyword') : '';
        if (empty($iProductChannelID)) {
            return $this->showMsg('参数有误', $iProductChannelID);
        }
        $aProductChannel = Tijian_Model_ProductChannel::getDetail($iProductChannelID);
        if (empty($aProductChannel)) {
            return $this->showMsg('该产品不存在该渠道!', false);
        }
        $aHasViewrange = Tijian_Model_Product::getUserViewlist($aProductChannel['iProductID'], $aProductChannel['iType'], $aProductChannel['iChannelID']);
        $aUserParam['iStatus >'] = 0;
        $aUserParam['iType'] = Tijian_Model_User::TYPE_HR;
        $aUserParam['iChannel'] = $aProductChannel['iChannelID'];//只能添加对应渠道的用户
        if (!empty($aHasViewrange)) {
            $aUserIDs = [];
            foreach ($aHasViewrange as $key => $value) {
                $aUserIDs[] = $value['iUserID'];
            }
            $aUserParam['iUserID NOT IN'] = $aUserIDs;
        }
        if (!empty($sKeyword)) {
            $aUserParam[] = '(sUserName="' . $sKeyword . '" OR sRealName LIKE "%' . $sKeyword . '%")';
        }
        $aViewrange = Tijian_Model_User::getList($aUserParam, $iPage, 'iUpdateTime DESC', self::PAGESIZE);
        $sNextUrl = !empty($iType) ? '/tijian/admin/eproduct/viewviewrange/id/' . $aProductChannel['iProductID'] : '/tijian/admin/eproduct/addchannel/id/' . $aProductChannel['iProductID'];
        $this->assign('iType', $iType);
        $this->assign('aHasViewrange', $aHasViewrange);
        $this->assign('aViewrange', $aViewrange);
        $this->assign('iProductChannelID', $iProductChannelID);
        $this->assign('sKeyword', $sKeyword);
        $this->assign('aProductChannel', $aProductChannel);
        $this->assign('aChannel', Yaf_G::getConf('aChannel'));
        $this->assign('sNextUrl', $sNextUrl);
        return true;
    }

    //选择渠道客户
    public function addViewRangeAction()
    {
        $result = $this->_viewrange();
        if (empty($result)) {
            return null;
        }
    }

    //查看渠道客户
    public function viewViewRangeAction()
    {
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        if (empty($iProductID)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aChannelConf = Yaf_G::getConf('aChannel');
        $aCanViewConf = Yaf_G::getConf('aCanView', 'product');
        //统计渠道和客户数量
        if (!empty($aProduct['iCanCompany'])) {
            $aChannel = Tijian_Model_ProductChannel::getChannelInfoByProductID($aProduct['iProductID'], Tijian_Model_ProductChannel::TYPE_COMPANY);
            if (!empty($aChannel)) {
                foreach ($aChannel as $k => $val) {
                    if (!empty($aChannelConf[$val['iChannelID']])) {
                        $aChannel[$k]['sChannelName'] = $aChannelConf[$val['iChannelID']];
                    }
                    if (!empty($aCanViewConf[$val['iViewRange']])) {
                        $aChannel[$k]['sViewName'] = $aCanViewConf[$val['iViewRange']];
                    }
                    $aChannel[$k]['iViewNum'] = !empty($val['iViewRange']) ? 0 : '/';
                    $aViewList = Tijian_Model_ProductViewRange::getDataByViewRangeID($val['iAutoID'], $val['iViewRange']);
                    if (!empty($aViewList)) {
                        $aChannel[$k]['iViewNum'] = count($aViewList);
                    }
                    if ($val['iViewRange'] == 0) {
                        $aChannel[$k]['sViewShortName'] = '';
                    } elseif ($val['iViewRange'] == 1) {
                        $aChannel[$k]['sViewShortName'] = '家可见';
                    } elseif ($val['iViewRange'] == 2) {
                        $aChannel[$k]['sViewShortName'] = '家不可见';
                    }
                }
            }
        }
        if (!empty($aProduct['iCanIndividual'])) {
            $aChannel1 = Tijian_Model_ProductChannel::getChannelInfoByProductID($aProduct['iProductID'], Tijian_Model_ProductChannel::TYPE_INDIVIDUAL);
            if (!empty($aChannel1)) {
                foreach ($aChannel1 as $k => $val) {
                    if (!empty($aChannelConf[$val['iChannelID']])) {
                        $aChannel1[$k]['sChannelName'] = $aChannelConf[$val['iChannelID']];
                    }
                    if (!empty($aCanViewConf[$val['iViewRange']])) {
                        $aChannel1[$k]['sViewName'] = $aCanViewConf[$val['iViewRange']];
                    }
                    $aChannel1[$k]['iViewNum'] = !empty($val['iViewRange']) ? 0 : '/';
                    $aViewList = Tijian_Model_ProductViewRange::getDataByViewRangeID($val['iAutoID'], $val['iViewRange']);
                    if (!empty($aViewList)) {
                        $aChannel1[$k]['iViewNum'] = count($aViewList);
                    }
                    if ($val['iViewRange'] == 0) {
                        $aChannel1[$k]['sViewShortName'] = '';
                    } elseif ($val['iViewRange'] == 1) {
                        $aChannel1[$k]['sViewShortName'] = '家可见';
                    } elseif ($val['iViewRange'] == 2) {
                        $aChannel1[$k]['sViewShortName'] = '家不可见';
                    }
                }
            }
        }

        //munu相关的赋值
        $this->assign('aChannel', $aChannel);
        $this->assign('aChannel1', $aChannel1);
        $this->_editHeader(3, 1);
        $this->assign('aProduct', $aProduct);
        $this->assign('iProductID', $iProductID);
    }

    //添加渠道客户
    public function insertViewRangeAction()
    {
        $iProductChannelID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        if (empty($iProductChannelID)) {
            return $this->showMsg('参数有误', false);
        }
        $sViewRangeID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sViewRangeID)) {
            return $this->showMsg('请先选择渠道客户', false);
        }
        $aProductChannel = Tijian_Model_ProductChannel::getDetail($iProductChannelID);
        if (empty($aProductChannel)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aParam['iViewRange'] = $aProductChannel['iViewRange'];
        $aParam['iProductChannelID'] = $iProductChannelID;
        $aParam['iCreateUserID'] = $aParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
        $aParam['iStatus'] = 1;
        if ($iCommitType) {//批量
            $aViewRangeID = explode(',', $sViewRangeID);
            $sSuccessNum = 0;
            $sTotalNum = count($aViewRangeID);
            foreach ($aViewRangeID as $key => $value) {
                //判断是否存在该渠道客户
                if (Tijian_Model_ProductViewRange::getUserByViewRangeID($iProductChannelID, $value, $aProductChannel['iViewRange'])) {
                    continue;
                }
                $aParam['iUserID'] = $value;
                if (Tijian_Model_ProductViewRange::addData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功添加' . $sSuccessNum . '个渠道客户，失败' . ($sTotalNum - $sSuccessNum) . '个渠道客户';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iUserID'] = intval($sViewRangeID);
            //判断是否存在该渠道客户
            if (Tijian_Model_ProductViewRange::getUserByViewRangeID($iProductChannelID, $aParam['iViewRangeID'], $aProductChannel['iViewRange'])) {
                return $this->showMsg('已添加过该渠道客户！', false);
            }
            if (Tijian_Model_ProductViewRange::addData($aParam)) {
                return $this->showMsg('添加成功！', true);
            } else {
                return $this->showMsg('添加失败！', false);
            }
        }
    }

    //删除已添加渠道客户
    public function deleteViewRangeAction()
    {
        $iProductChannelID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        if (empty($iProductChannelID)) {
            return $this->showMsg('参数有误', false);
        }
        $sViewRangeID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sViewRangeID)) {
            return $this->showMsg('请先选择渠道客户', false);
        }
        $aProductChannel = Tijian_Model_ProductChannel::getDetail($iProductChannelID);
        if (empty($aProductChannel)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aParam['iStatus'] = 0;
        if ($iCommitType) {//批量
            $aViewRangeID = explode(',', $sViewRangeID);
            $sSuccessNum = 0;
            $sTotalNum = count($aViewRangeID);
            foreach ($aViewRangeID as $key => $value) {
                //判断是否存在该渠道客户
                if (!Tijian_Model_ProductViewRange::getDetail($value)) {
                    continue;
                }
                $aParam['iAutoID'] = $value;
                if (Tijian_Model_ProductViewRange::updData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功删除' . $sSuccessNum . '个渠道客户，失败' . ($sTotalNum - $sSuccessNum) . '个渠道客户';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iAutoID'] = intval($sViewRangeID);
            //判断是否存在该渠道客户
            if (Tijian_Model_ProductViewRange::updData($aParam)) {
                return $this->showMsg('删除成功！', true);
            } else {
                return $this->showMsg('删除失败！', false);
            }
        }
    }

    //已选择的客户共用
    private function _addhasselectuser()
    {
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $aParam['iType'] = $this->getParam('iType') ? intval($this->getParam('iType')) : 1;
        $aParam['iChannel'] = $this->getParam('iChannel') ? intval($this->getParam('iChannel')) : 1;
        $aParam['sKeyword'] = $this->getParam('sKeyword') ? addslashes(trim($this->getParam('sKeyword'))) : '';
        $aParam['page'] = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        $aParam['pagesize'] = self::PAGESIZE;

        if (empty($iProductID)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aChanelInfo = Tijian_Model_ProductChannel::getData($iProductID, $aParam['iType'], $aParam['iChannel']);
        if (!empty($aChanelInfo)) {
            $aData = Tijian_Model_Product::getViewList($iProductID, $aParam['iType'], $aParam['iChannel'], $aParam);
            if (!empty($aData['aList'])) {//组装需要的门店升级产品等信息
                foreach ($aData['aList'] as $key => $value) {
                    //基本信息
                    $aBaseInfo = Tijian_Model_UserProductBase::getUserProductBase($iProductID, $value['iUserID'], $aParam['iType'], $aParam['iChannel']);
                    $aData['aList'][$key]['iManPrice'] = !empty($aBaseInfo) ? $aBaseInfo['iManPrice'] : 0;
                    //门店信息
                    $aStoreInfo = Tijian_Model_UserProductStore::getUserProductStore($iProductID, $value['iUserID'], $aParam['iType'], $aParam['iChannel']);
                    $aData['aList'][$key]['iStoreNum'] = !empty($aStoreInfo) ? count($aStoreInfo) : 0;
                    //升级产品信息
                    $aUpgradeInfo = Tijian_Model_UserProductUpgrade::getUserProductUpgrade($iProductID, $value['iUserID'], $aParam['iType'], $aParam['iChannel']);
                    $aData['aList'][$key]['iUpgradeNum'] = !empty($aUpgradeInfo) ? count($aUpgradeInfo) : 0;
                    //升级包信息
                    $aAddtionInfo = Tijian_Model_UserProductAddtion::getUserProductAddtion($iProductID, $value['iUserID'], $aParam['iType'], $aParam['iChannel']);
                    $aData['aList'][$key]['iAddtionNum'] = !empty($aAddtionInfo) ? count($aAddtionInfo) : 0;
                }
            }
        } else {
            $aData['aList'] = [];
        }

        $this->assign('aType', Yaf_G::getConf('aChannelType', 'product'));
        $this->assign('aChannel', Yaf_G::getConf('aChannel'));
        $this->assign('iProductID', $iProductID);
        $this->assign('aProduct', $aProduct);
        $this->assign('aParam', $aParam);
        $this->assign('aData', $aData);
        $this->assign('sNextUrl', '/tijian/admin/eproduct/list/');
        return true;
    }

    //添加已选择的客户
    public function addHasSelectUserAction()
    {
        $result = $this->_addhasselectuser();
        if (empty($result)) {
            return null;
        }
    }

    //编辑已选择的客户
    public function editHasSelectUserAction()
    {
        $result = $this->_addhasselectuser();
        if (empty($result)) {
            return null;
        }
        //munu相关的赋值
        $this->_editHeader(4, 2);
    }

    //查看已选择的客户
    public function viewHasSelectUserAction()
    {
        $result = $this->_addhasselectuser();
        if (empty($result)) {
            return null;
        }
        //munu相关的赋值
        $this->_editHeader(4, 1);
    }


    //单项共用
    private function _item()
    {
        $iPageSize = self::PAGESIZE;
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $aParam['aCategory'] = $this->getParam('aCategory') ? array_keys($this->getParam('aCategory')) : [];
        $aParam['sKeyword'] = $this->getParam('sKeyword') ? addslashes(trim($this->getParam('sKeyword'))) : '';

        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        if (empty($iProductID)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aHasItem = Tijian_Model_ProductItem::getProductItems($iProductID, Tijian_Model_ProductItem::EXPANDPRODUCT, 1);//该产品已包含的单项
        if (!empty($aHasItem)) {
            //整合需要的数据
            $aHasItemID = [];
            foreach ($aHasItem as $key => $value) {
                $aHasItemID[] = $value['iItemID'];
                $aProductData = Tijian_Model_Item::getDetail($value['iItemID']);
                $aHasItem[$key]['aItem'] = $aProductData;
            }
            $aParam['iItemID NOT IN'] = $aHasItemID;
        }
        if (!empty($aParam['aCategory'])) {
            $aParam['iCat IN'] = $aParam['aCategory'];
        }

        if (!empty($aParam['sKeyword'])) {
            $aParam[] = '(sCode="' . $aParam['sKeyword'] . '" OR sName LIKE "%' . $aParam['sKeyword'] . '%")';
        }

        unset($aParam['aCategory']);
        unset($aParam['sKeyword']);
        $aParam['iStatus'] = 1;
        $aItem = Tijian_Model_Item::getList($aParam, $iPage, 'iUpdateTime DESC', $iPageSize);
        //添加之后刷新，分页bug特殊处理
        if ((ceil($aItem['iTotal'] / $iPageSize)) != 0 && $iPage > (ceil($aItem['iTotal'] / $iPageSize))) {
            $aItem = Tijian_Model_Item::getList($aParam, 1, 'iUpdateTime DESC', $iPageSize);
        }
        //获取所有小项
        $aCatParam['where'] = [
            'iParentID >' => 0,
            'iStatus' => 1,
        ];
        $aCategory = Tijian_Model_Product_Category::getPair($aCatParam, 'iAutoID', 'sCateName');
        $sNextUrl = '/tijian/admin/eproduct/addChannel/id/' . $iProductID;
        $this->assign('aCategory', $aCategory);
        $this->assign('iProductID', $iProductID);
        $this->assign('aParam', $aParam);
        $this->assign('aItem', $aItem);
        $this->assign('aHasItem', $aHasItem);
        $this->assign('sNextUrl', $sNextUrl);
        $this->assign('aProduct', $aProduct);
        return true;
    }

    //选择单项
    public function addItemAction()
    {
        $result = $this->_item();
        if (empty($result)) {
            return null;
        }
    }

    //编辑单项
    public function editItemAction()
    {
        $result = $this->_item();
        if (empty($result)) {
            return null;
        }
        //munu相关的赋值
        $this->_editHeader(2, 2);
        $this->assign('iProductID', intval($this->getParam('id')));
    }

    //查看单项
    public function viewItemAction()
    {
        $result = $this->_item();
        if (empty($result)) {
            return null;
        }
        //munu相关的赋值
        $this->_editHeader(2, 1);
        $this->assign('iProductID', intval($this->getParam('id')));
    }

    //添加单项
    public function insertItemAction()
    {
        $iProductID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        if (empty($iProductID)) {
            return $this->showMsg('参数有误', false);
        }
        $sItemID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sItemID)) {
            return $this->showMsg('请先选择单项', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }

        $aParam['iProductID'] = $iProductID;
        $aParam['iCreateUserID'] = $aParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
        $aParam['iType'] = Tijian_Model_ProductItem::EXPANDPRODUCT;
        $aParam['iStatus'] = 1;
        if ($iCommitType) {//批量
            $aItemID = explode(',', $sItemID);
            $sSuccessNum = 0;
            $sTotalNum = count($aItemID);
            foreach ($aItemID as $key => $value) {
                //判断是否存在该单项
                if (Tijian_Model_ProductItem::getDataByItemID($iProductID, $value, Tijian_Model_ProductItem::EXPANDPRODUCT)) {
                    continue;
                }
                $aParam['iItemID'] = $value;
                if (Tijian_Model_ProductItem::addData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功添加' . $sSuccessNum . '个单项，失败' . ($sTotalNum - $sSuccessNum) . '个单项';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iItemID'] = intval($sItemID);
            //判断是否存在该单项
            if (Tijian_Model_ProductItem::getDataByItemID($iProductID, $aParam['iItemID'], Tijian_Model_ProductItem::EXPANDPRODUCT)) {
                return $this->showMsg('已添加过该单项！', false);
            }
            if (Tijian_Model_ProductItem::addData($aParam)) {
                return $this->showMsg('添加成功！', true);
            } else {
                return $this->showMsg('添加失败！', false);
            }
        }
    }

    //删除已添加单项
    public function deleteItemAction()
    {
        $iProductID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        if (empty($iProductID)) {
            return $this->showMsg('参数有误', false);
        }
        $sItemID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sItemID)) {
            return $this->showMsg('请先选择单项', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aParam['iStatus'] = 0;
        if ($iCommitType) {//批量
            $aItemID = explode(',', $sItemID);
            $sSuccessNum = 0;
            $sTotalNum = count($aItemID);
            foreach ($aItemID as $key => $value) {
                //判断是否存在该单项
                if (!Tijian_Model_ProductItem::getDetail($value)) {
                    continue;
                }
                $aParam['iAutoID'] = $value;
                if (Tijian_Model_ProductItem::updData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功删除' . $sSuccessNum . '个单项，失败' . ($sTotalNum - $sSuccessNum) . '个单项';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iAutoID'] = intval($sItemID);
            //判断是否存在该单项
            if (Tijian_Model_ProductItem::updData($aParam)) {
                return $this->showMsg('删除成功！', true);
            } else {
                return $this->showMsg('删除失败！', false);
            }
        }
    }

    /**
     * 门店共用
     * @param int $sUserID
     * @return int
     */
    private function _store($sUserID)
    {
        $iPageSize = self::PAGESIZE;
        $iChannelType = $this->getParam('tid') ? intval($this->getParam('tid')) : 0;
        $iChannelID = $this->getParam('cid') ? intval($this->getParam('cid')) : 0;
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $aParam['aCity'] = $this->getParam('aCity') ? array_keys($this->getParam('aCity')) : [];
        $aParam['aSupplier'] = $this->getParam('aSupplier') ? array_keys($this->getParam('aSupplier')) : [];
        $aParam['aType'] = $this->getParam('aType') ? array_keys($this->getParam('aType')) : [];
        $aParam['sKeyword'] = $this->getParam('sKeyword') ? addslashes(trim($this->getParam('sKeyword'))) : '';
        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        if (empty($iProductID) || empty($iChannelType) || empty($iChannelID)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = $this->_checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID);
        if (empty($aProduct)) {
            return null;
        }
        $aWhere['iStatus >'] = 0;
        $aSupplier = Tijian_Model_Type::getOption('supplier');
        $aCity = Tijian_Model_City::getPair($aWhere, 'iCityID', 'sCityName');
        $aType = Yaf_G::getConf('aStoreType', 'product');
        $sTips = '';

        $iHasData = $this->getParam('hasdata') ? intval($this->getParam('hasdata')) : 0;
        if ($iHasData) {
            $aHasParam['iStatus'] = 1;
            $aHasParam['aHasCity'] = $this->getParam('aHasCity') ? array_keys($this->getParam('aHasCity')) : [];
            $aHasParam['aHasSupplier'] = $this->getParam('aHasSupplier') ? array_keys($this->getParam('aHasSupplier')) : [];
            $aHasParam['aHasType'] = $this->getParam('aHasType') ? array_keys($this->getParam('aHasType')) : [];
            $aHasParam['sHasKeyword'] = $this->getParam('sHasKeyword') ? addslashes(trim($this->getParam('sHasKeyword'))) : '';
            if (!empty($aHasParam['aHasCity'])) {
                $aHasParam['iCityID IN'] = $aHasParam['aHasCity'];
            }
            if (!empty($aHasParam['aHasSupplier'])) {
                $aHasParam['iSupplierID IN'] = $aHasParam['aHasSupplier'];
            }
            if (!empty($aHasParam['aHasType'])) {
                $aHasParam['iType IN'] = $aHasParam['aHasType'];
            }
            if (!empty($aHasParam['sHasKeyword'])) {
                $aHasParam[] = '(sCode="' . $aHasParam['sHasKeyword'] . '" OR sName LIKE "%' . $aHasParam['sHasKeyword'] . '%")';
            }
            $aHasStore = Tijian_Model_Store::getPair($aHasParam, 'iStoreID', 'sName');
            if (!empty($aHasStore)) {
                $aHasStoreParam['iStoreID IN'] = array_keys($aHasStore);
            } else {
                $aHasStoreParam['iStoreID IN'] = 999999;//搞个永远搜索不到的数字
            }
            $this->assign('aHasParam', $aHasParam);
        }

        $aHasStoreParam['iStatus >'] = 0;
        $aHasStoreParam['iUserID'] = $sUserID;
        $aHasStoreParam['iProductID'] = $iProductID;
        $aHasStoreParam['iType'] = $iChannelType;
        $aHasStoreParam['iChannelID'] = $iChannelID;
        $aHasStore = Tijian_Model_UserProductStore::getAll($aHasStoreParam);//判断是否编辑过

        if (empty($aHasStore) && empty($iHasData)) {//同步拓展产品中的门店到客户表
            $aHasStore = Tijian_Model_ProductStore::getProductStores($iProductID, Tijian_Model_ProductStore::EXPANDPRODUCT);//该产品已包含的门店
            if (!empty($aHasStore)) {
                foreach ($aHasStore as $key => $value) {
                    $aUserParam['iProductID'] = $iProductID;
                    $aUserParam['iType'] = $iChannelType;
                    $aUserParam['iChannelID'] = $iChannelID;
                    $aUserParam['iCreateUserID'] = $aUserParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                    $aUserParam['iStatus'] = 1;
                    $aUserParam['iStoreID'] = $value['iStoreID'];
                    $aUserParam['iUserID'] = $sUserID;
                    $aHasStore[$key]['iAutoID'] = Tijian_Model_UserProductStore::addData($aUserParam);
                }
            }
        } else {
            foreach ($aHasStore as $key => $value) {
                if ($value['iStatus'] == 0) {
                    unset($aHasStore[$key]);
                }
            }
        }
        if (!empty($aHasStore)) {
            $aCityTmp = [];
            $aSupplierTmp = [];
            $aStoreIDs = [];
            //整合需要的数据
            foreach ($aHasStore as $key => $value) {
                $aStoreIDs[] = $value['iStoreID'];
                $aProductData = Tijian_Model_Store::getDetail($value['iStoreID']);
                $aHasStore[$key]['aStore'] = $aProductData;
                //按城市分组
                $aCityTmp[$aProductData['iCityID']][] = 1;
                //按供应商分组
                $aSupplierTmp[$aProductData['iSupplierID']][] = 1;
            }
            if (!empty($aStoreIDs)) {
                $aParam['iStoreID NOT IN'] = $aStoreIDs;
            }
            //生成tips
            if (!empty($aCityTmp)) {
                $sTips = '共' . count($aCityTmp) . '个城市:';
                foreach ($aCityTmp as $key => $value) {
                    $sTips .= $aCity[$key] . count($value) . '个,';
                }
                $sTips = trim($sTips, ',') . "<br>";
            }
            if (!empty($aSupplierTmp)) {
                $sTips .= '共' . count($aSupplierTmp) . '个供应商:';
                foreach ($aSupplierTmp as $key => $value) {
                    $sTips .= $aSupplier[$key] . count($value) . '个,';
                }
                $sTips = trim($sTips, ',');
            }
        }
        $aParam['iStatus'] = 1;
        if (!empty($aParam['aCity'])) {
            $aParam['iCityID IN'] = $aParam['aCity'];
        }
        if (!empty($aParam['aSupplier'])) {
            $aParam['iSupplierID IN'] = $aParam['aSupplier'];
        }
        if (!empty($aParam['aType'])) {
            $aParam['iType IN'] = $aParam['aType'];
        }
        if (!empty($aParam['sKeyword'])) {
            $aParam[] = '(sCode="' . $aParam['sKeyword'] . '" OR sName LIKE "%' . $aParam['sKeyword'] . '%")';
        }
        $aStore = Tijian_Model_Store::getList($aParam, $iPage, 'iUpdateTime DESC', $iPageSize);
        //添加之后刷新，分页bug特殊处理
        if ((ceil($aStore['iTotal'] / $iPageSize)) != 0 && $iPage > (ceil($aStore['iTotal'] / $iPageSize))) {
            $aStore = Tijian_Model_Store::getList($aParam, 1, 'iUpdateTime DESC', $iPageSize);
        }
        $sNextUrl = '/tijian/admin/eproduct/addupgrade/id/' . $iProductID;
        $this->assign('aType', $aType);
        $this->assign('aCity', $aCity);
        $this->assign('aSupplier', $aSupplier);
        $this->assign('iProductID', $iProductID);
        $this->assign('aParam', $aParam);
        $this->assign('aStore', $aStore);
        $this->assign('aHasStore', $aHasStore);
        $this->assign('sTips', $sTips);
        $this->assign('sNextUrl', $sNextUrl);
        $this->assign('aProduct', $aProduct);
        $this->assign('iChannelType', $iChannelType);
        $this->assign('iChannelID', $iChannelID);
        return $iProductID;
    }

    //编辑客户门店(不能批量)
    public function editUserStoreAction()
    {
        $sUserID = $this->getParam('uid') ? intval($this->getParam('uid')) : 0;
        if (empty($sUserID)) {
            return $this->showMsg('参数有误！', false);
        }
        $iProductID = $this->_store($sUserID);
        if (empty($iProductID)) {
            return null;
        }
        $aUserParam['where']['iStatus >'] = 0;
        $aUserParam['where']['iType'] = 2;
        $aUserParam['where']['iUserID'] = $sUserID;
        $aUsers = Tijian_Model_User::getPair($aUserParam, 'iUserID', 'sRealName');
        $this->_editUserHeader(2);
        $this->assign('sUserID', $sUserID);
        $this->assign('aUsers', $aUsers);
    }

    //添加门店
    public function insertStoreAction()
    {
        $sUserID = $this->getParam('uid') ? intval($this->getParam('uid')) : 0;
        $iProductID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $iChannelType = $this->getParam('tid') ? intval($this->getParam('tid')) : 0;
        $iChannelID = $this->getParam('cid') ? intval($this->getParam('cid')) : 0;
        $sStoreID = $this->getParam('id') ? $this->getParam('id') : 0;
        if (empty($iProductID) || empty($iChannelType) || empty($iChannelID)) {
            return $this->showMsg('参数有误', false);
        }
        if (empty($sStoreID)) {
            return $this->showMsg('请先选择门店', false);
        }
        $aProduct = $this->_checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID);
        if (empty($aProduct)) {
            return null;
        }

        $aParam['iProductID'] = $iProductID;
        $aParam['iCreateUserID'] = $aParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
        $aParam['iType'] = $iChannelType;
        $aParam['iChannelID'] = $iChannelID;
        $aParam['iUserID'] = $sUserID;
        $aParam['iStatus'] = 1;
        if ($iCommitType) {//批量
            $aStoreID = explode(',', $sStoreID);
            $sSuccessNum = 0;
            $sTotalNum = count($aStoreID);
            foreach ($aStoreID as $key => $value) {
                //判断是否存在该门店
                if (Tijian_Model_UserProductStore::getUserHasStore($iProductID, $sUserID, $value, $iChannelType, $iChannelID)) {
                    continue;
                }
                $aParam['iStoreID'] = $value;
                if (Tijian_Model_UserProductStore::addData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功添加' . $sSuccessNum . '个门店，失败' . ($sTotalNum - $sSuccessNum) . '个门店';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iStoreID'] = intval($sStoreID);
            //判断是否存在该门店
            if (Tijian_Model_UserProductStore::getUserHasStore($iProductID, $sUserID, $sStoreID, $iChannelType, $iChannelID)) {
                return $this->showMsg('已添加过该门店！', true);
            }
            if (Tijian_Model_UserProductStore::addData($aParam)) {
                return $this->showMsg('添加成功！', true);
            } else {
                return $this->showMsg('添加失败！', false);
            }
        }
    }

    //删除已添加门店
    public function deleteStoreAction()
    {
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $sStoreID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sStoreID)) {
            return $this->showMsg('请先选择门店', false);
        }
        $aParam['iStatus'] = 0;
        if ($iCommitType) {//批量
            $aStoreID = explode(',', $sStoreID);
            $sSuccessNum = 0;
            $sTotalNum = count($aStoreID);
            foreach ($aStoreID as $key => $value) {
                //判断是否存在该门店
                if (!Tijian_Model_UserProductStore::getDetail($value)) {
                    continue;
                } else {
                    $aParam['iAutoID'] = $value;
                    Tijian_Model_UserProductStore::updData($aParam);
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功删除' . $sSuccessNum . '个门店，失败' . ($sTotalNum - $sSuccessNum) . '个门店';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iAutoID'] = intval($sStoreID);
            //判断是否存在该门店
            if (Tijian_Model_UserProductStore::updData($aParam)) {
                return $this->showMsg('删除成功！', true);
            } else {
                return $this->showMsg('删除失败！', false);
            }
        }
    }

    //升级产品共用
    private function _upgrade($sUserID)
    {
        $iPageSize = self::PAGESIZE;
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $aParam['sKeyword'] = $this->getParam('sKeyword') ? addslashes(trim($this->getParam('sKeyword'))) : '';
        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        $iChannelID = $this->getParam('cid') ? intval($this->getParam('cid')) : 0;
        $iChannelType = $this->getParam('tid') ? intval($this->getParam('tid')) : 0;
        if (empty($iProductID) || empty($iChannelID) || empty($iChannelType)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = $this->_checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID);
        if (empty($aProduct)) {
            return null;
        }
        $aHasUpgrade = Tijian_Model_UserProductUpgrade::getHasEdit($iProductID, $sUserID, $iChannelType, $iChannelID);//判断是否同步过
        if (empty($aHasUpgrade)) {//同步拓展产品中的升级产品到客户表
            $aHasUpgrade = Tijian_Model_ProductUpgrade::getProductUpgrades($iProductID, Tijian_Model_ProductUpgrade::EXPANDPRODUCT);//该产品已包含的升级产品
            if (!empty($aHasUpgrade)) {
                foreach ($aHasUpgrade as $key => $value) {
                    $aUserParam['iProductID'] = $iProductID;
                    $aUserParam['iCreateUserID'] = $aUserParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                    $aUserParam['iStatus'] = 1;
                    $aUserParam['iUpgradeID'] = $value['iUpgradeID'];
                    $aUserParam['iUserID'] = $sUserID;
                    $aUserParam['iType'] = $iChannelType;
                    $aUserParam['iChannelID'] = $iChannelID;
                    $aHasUpgrade[$key]['iAutoID'] = Tijian_Model_UserProductUpgrade::addData($aUserParam);
                }
            }
        } else {
            foreach ($aHasUpgrade as $key => $value) {
                if ($value['iStatus'] == 0) {
                    unset($aHasUpgrade[$key]);
                }
            }
        }

        $aParam['iType'] = Tijian_Model_Product::TYPE_EXPAND;
        $aParam['iStatus'] = 1;
        $aParam['iManPrice >'] = $aProduct['iManPrice'];
        $aParam['iWomanPrice1 >'] = $aProduct['iWomanPrice1'];
        $aParam['iWomanPrice2 >'] = $aProduct['iWomanPrice2'];
        if (!empty($aParam['sKeyword'])) {
            $aParam[] = '(sProductCode="' . $aParam['sKeyword'] . '" OR sProductName LIKE "%' . $aParam['sKeyword'] . '%")';
        }
        if (!empty($aHasUpgrade)) {
            $aHasUpgradeIDs = [];
            foreach ($aHasUpgrade as $key => $value) {
                $aHasUpgradeIDs[] = $value['iUpgradeID'];
                $aHasProductDetail = Tijian_Model_Product::getDetail($value['iUpgradeID']);
                $aHasUpgrade[$key]['sProductName'] = $aHasProductDetail['sProductName'];
                $aHasUpgrade[$key]['sProductCode'] = $aHasProductDetail['sProductCode'];
            }
            $aParam['iProductID NOT IN'] = $aHasUpgradeIDs;
        }
        $aUpgrade = Tijian_Model_Product::getList($aParam, $iPage, 'iUpdateTime DESC', $iPageSize);
        //添加之后刷新，分页bug特殊处理
        if ((ceil($aUpgrade['iTotal'] / $iPageSize)) != 0 && $iPage > (ceil($aUpgrade['iTotal'] / $iPageSize))) {
            $aUpgrade = Tijian_Model_Product::getList($aParam, 1, 'iUpdateTime DESC', $iPageSize);
        }
        //整合需要的数据
        if (!empty($aUpgrade['aList'])) {//这块门店数目好像显示有bug，到时候查下todo
            foreach ($aUpgrade['aList'] as $key => $value) {
                $aStore = Tijian_Model_ProductStore::getProductStores($value['iProductID'], Tijian_Model_ProductStore::EXPANDPRODUCT, 1);
                $aUpgrade['aList'][$key]['iStoreNum'] = count($aStore);
            }
        }
        if (!empty($aHasUpgrade)) {
            foreach ($aHasUpgrade as $key => $value) {
                $aStore = Tijian_Model_ProductStore::getProductStores($value['iUpgradeID'], Tijian_Model_ProductStore::EXPANDPRODUCT, 1);
                $aHasUpgrade[$key]['iStoreNum'] = count($aStore);
            }
        }
        $aStatus = Yaf_G::getConf('aStatus', 'product');
        $sNextUrl = '/tijian/admin/product/addaddtion/id/' . $iProductID;
        $this->assign('iProductID', $iProductID);
        $this->assign('aParam', $aParam);
        $this->assign('aUpgrade', $aUpgrade);
        $this->assign('aHasUpgrade', $aHasUpgrade);
        $this->assign('aStatus', $aStatus);
        $this->assign('sNextUrl', $sNextUrl);
        $this->assign('aProduct', $aProduct);
        $this->assign('iChannelID', $iChannelID);
        $this->assign('iChannelType', $iChannelType);
        return true;
    }

    //编辑客户升级产品(不能批量)
    public function editUserUpgradeAction()
    {
        $sUserID = $this->getParam('uid') ? intval($this->getParam('uid')) : 0;
        if (empty($sUserID)) {
            return $this->showMsg('参数有误！', false);
        }
        $iProductID = $this->_upgrade($sUserID);
        if (empty($iProductID)) {
            return null;
        }
        $aUserParam['where']['iStatus >'] = 0;
        $aUserParam['where']['iType'] = 2;
        $aUserParam['where']['iUserID'] = $sUserID;
        $aUsers = Tijian_Model_User::getPair($aUserParam, 'iUserID', 'sRealName');
        $this->_editUserHeader(4);
        $this->assign('sUserID', $sUserID);
        $this->assign('aUsers', $aUsers);
    }

    //添加升级产品
    public function insertUpgradeAction()
    {
        $sUserID = $this->getParam('uid') ? intval($this->getParam('uid')) : 0;
        $iProductID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $iChannelID = $this->getParam('cid') ? intval($this->getParam('cid')) : 0;
        $iChannelType = $this->getParam('tid') ? intval($this->getParam('tid')) : 0;
        if (empty($iProductID) || empty($iChannelID) || empty($iChannelType)) {
            return $this->showMsg('参数有误', false);
        }
        $sUpgradeID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sUpgradeID)) {
            return $this->showMsg('请先选择升级产品', false);
        }
        $aProduct = $this->_checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID);
        if (empty($aProduct)) {
            return null;
        }
        $aParam['iProductID'] = $iProductID;
        $aParam['iCreateUserID'] = $aParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
        $aParam['iType'] = $iChannelType;
        $aParam['iChannelID'] = $iChannelID;
        $aParam['iUserID'] = $sUserID;
        $aParam['iStatus'] = 1;

        //更改修改状态
        $aRow = Tijian_Model_UserProductUpdateStatus::getData($iProductID,$sUserID,$iChannelType,$iChannelID,Tijian_Model_UserProductUpdateStatus::UPGRADE);
        if (empty($aRow)) {
            $aUpdateParam['iProductID'] = $iProductID;
            $aUpdateParam['iCreateUserID'] = $this->aCurrUser['iUserID'];
            $aUpdateParam['iType'] = $iChannelType;
            $aUpdateParam['iChannelID'] = $iChannelID;
            $aUpdateParam['iUserID'] = $sUserID;
            $aUpdateParam['iStatus'] = 1;
            $aUpdateParam['iInitType'] = Tijian_Model_UserProductUpdateStatus::UPGRADE;
            Tijian_Model_UserProductUpdateStatus::addData($aUpdateParam);
        }

        if ($iCommitType) {//批量
            $aUpgradeID = explode(',', $sUpgradeID);
            $sSuccessNum = 0;
            $sTotalNum = count($aUpgradeID);
            foreach ($aUpgradeID as $key => $value) {
                //判断是否存在该升级产品
                if (Tijian_Model_UserProductUpgrade::getUserHasUpgrades($iProductID, $sUserID, $value, $iChannelType, $iChannelID)) {
                    continue;
                }
                $aParam['iUpgradeID'] = $value;
                if (Tijian_Model_UserProductUpgrade::addData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功添加' . $sSuccessNum . '个升级产品，失败' . ($sTotalNum - $sSuccessNum) . '个升级产品';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iUpgradeID'] = intval($sUpgradeID);
            //判断是否存在该升级产品
            if (Tijian_Model_UserProductUpgrade::getUserHasUpgrades($iProductID, $sUserID, $aParam['iUpgradeID'], $iChannelType, $iChannelID)) {
                return $this->showMsg('已添加过该升级产品！', true);
            }
            if (Tijian_Model_UserProductUpgrade::addData($aParam)) {
                return $this->showMsg('添加成功！', true);
            } else {
                return $this->showMsg('添加失败！', false);
            }
        }
    }

    //删除已添加升级产品
    public function deleteUpgradeAction()
    {
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $sUpgradeID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sUpgradeID)) {
            return $this->showMsg('请先选择升级产品', false);
        }

        //更改修改状态
        $iUpGradeID = intval($sUpgradeID);
        $aUpgrade = Tijian_Model_UserProductUpgrade::getDetail($iUpGradeID);
        $iProductID = $aUpgrade['iProductID'];
        $sUserID = $aUpgrade['iUserID'];
        $iChannelType = $aUpgrade['iType'];
        $iChannelID = $aUpgrade['iChannelID'];
        $aRow = Tijian_Model_UserProductUpdateStatus::getData($iProductID,$sUserID,$iChannelType,$iChannelID,Tijian_Model_UserProductUpdateStatus::UPGRADE);
        if (empty($aRow)) {
            $aUpdateParam['iProductID'] = $iProductID;
            $aUpdateParam['iCreateUserID'] = $this->aCurrUser['iUserID'];
            $aUpdateParam['iType'] = $iChannelType;
            $aUpdateParam['iChannelID'] = $iChannelID;
            $aUpdateParam['iUserID'] = $sUserID;
            $aUpdateParam['iStatus'] = 1;
            $aUpdateParam['iInitType'] = Tijian_Model_UserProductUpdateStatus::UPGRADE;
            Tijian_Model_UserProductUpdateStatus::addData($aUpdateParam);
        }

        $aParam['iStatus'] = 0;
        if ($iCommitType) {//批量
            $aUpgradeID = explode(',', $sUpgradeID);
            $sSuccessNum = 0;
            $sTotalNum = count($aUpgradeID);
            foreach ($aUpgradeID as $key => $value) {
                //判断是否存在该升级产品
                if (!Tijian_Model_UserProductUpgrade::getDetail($value)) {
                    continue;
                } else {
                    $aParam['iAutoID'] = $value;
                    Tijian_Model_UserProductUpgrade::updData($aParam);
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功删除' . $sSuccessNum . '个升级产品，失败' . ($sTotalNum - $sSuccessNum) . '个升级产品';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iAutoID'] = intval($sUpgradeID);
            //判断是否存在该升级产品
            if (Tijian_Model_UserProductUpgrade::updData($aParam)) {
                return $this->showMsg('删除成功！', true);
            } else {
                return $this->showMsg('删除失败！', false);
            }
        }
    }

    //加项包共用
    private function _addtion($sUserID)
    {
        $iPageSize = self::PAGESIZE;
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $aParam['aType'] = $this->getParam('aType') ? array_keys($this->getParam('aType')) : [];
        $aParam['sKeyword'] = $this->getParam('sKeyword') ? addslashes(trim($this->getParam('sKeyword'))) : '';
        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        $iChannelID = $this->getParam('cid') ? intval($this->getParam('cid')) : 0;
        $iChannelType = $this->getParam('tid') ? intval($this->getParam('tid')) : 0;
        if (empty($iProductID) || empty($iChannelID) || empty($iChannelType)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = $this->_checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID);
        if (empty($aProduct)) {
            return null;
        }
        $sTips = '';
        $aType = Yaf_G::getConf('aAddtionType', 'product');

        $aHasAddtion = Tijian_Model_UserProductAddtion::getHasEdit($iProductID, $sUserID, $iChannelType, $iChannelID);//判断是否编辑过
        if (empty($aHasAddtion)) {//同步拓展产品中的门店到客户表
            $aHasAddtion = Tijian_Model_ProductAddtion::getProductAddtions($iProductID, Tijian_Model_ProductAddtion::EXPANDPRODUCT);//该产品已包含的门店
            if (!empty($aHasAddtion)) {
                foreach ($aHasAddtion as $key => $value) {
                    $aUserParam['iProductID'] = $iProductID;
                    $aUserParam['iCreateUserID'] = $aUserParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
                    $aUserParam['iStatus'] = 1;
                    $aUserParam['iAddtionID'] = $value['iAddtionID'];
                    $aUserParam['iUserID'] = $sUserID;
                    $aUserParam['iType'] = $iChannelType;
                    $aUserParam['iChannelID'] = $iChannelID;
                    $aHasAddtion[$key]['iAutoID'] = Tijian_Model_UserProductAddtion::addData($aUserParam);
                }
            }
        } else {
            foreach ($aHasAddtion as $key => $value) {
                if ($value['iStatus'] == 0) {
                    unset($aHasAddtion[$key]);
                }
            }
        }

        if (!empty($aHasAddtion)) {
            $aHasAddtionIDs = [];
            //整合需要的数据和生成tips
            $aTypeTmp = [];
            foreach ($aHasAddtion as $key => $value) {
                $aHasAddtionIDs[] = $value['iAddtionID'];
                $aHasProductDetail = Tijian_Model_Addtion::getDetail($value['iAddtionID']);
                $aHasAddtion[$key]['sName'] = $aHasProductDetail['sName'];
                $aHasAddtion[$key]['iType'] = $aHasProductDetail['iType'];
                $aHasAddtion[$key]['sCode'] = $aHasProductDetail['sCode'];
                $aHasAddtion[$key]['sPrice'] = $aHasProductDetail['sPrice'];
                $aTypeTmp[$aHasProductDetail['iType']][] = 1;
            }

            if (!empty($aTypeTmp)) {
                foreach ($aTypeTmp as $key => $value) {
                    $sTips .= $aType[$key] . "(<strong class='red'>" . count($value) . "</strong>个)&nbsp&nbsp";
                }
            }
            $aParam['iAddtionID NOT IN'] = $aHasAddtionIDs;
        }
        if (!empty($aParam['aType'])) {
            $aParam['iType IN'] = $aParam['aType'];
        }
        if (!empty($aParam['sKeyword'])) {
            $aParam[] = '(sCode="' . $aParam['sKeyword'] . '" OR sName LIKE "%' . $aParam['sKeyword'] . '%")';
        }
        $aParam['iStatus'] = 1;
        $aAddtion = Tijian_Model_Addtion::getList($aParam, $iPage, 'iUpdateTime DESC', $iPageSize);
        //添加之后刷新，分页bug特殊处理
        if ((ceil($aAddtion['iTotal'] / $iPageSize)) != 0 && $iPage > (ceil($aAddtion['iTotal'] / $iPageSize))) {
            $aAddtion = Tijian_Model_Addtion::getList($aParam, 1, 'iUpdateTime DESC', $iPageSize);
        }

        $sNextUrl = '/tijian/admin/product/list/';
        $this->assign('aType', $aType);
        $this->assign('iProductID', $iProductID);
        $this->assign('aParam', $aParam);
        $this->assign('aAddtion', $aAddtion);
        $this->assign('aHasAddtion', $aHasAddtion);
        $this->assign('sTips', $sTips);
        $this->assign('sNextUrl', $sNextUrl);
        $this->assign('aProduct', $aProduct);
        $this->assign('iChannelType', $iChannelType);
        $this->assign('iChannelID', $iChannelID);
        return true;
    }

    //编辑客户加项包(不能批量)
    public function editUserAddtionAction()
    {
        $sUserID = $this->getParam('uid') ? intval($this->getParam('uid')) : 0;
        $iProductID = $this->_addtion($sUserID);
        if (empty($iProductID)) {
            return null;
        }
        if (empty($sUserID)) {
            return $this->showMsg('参数有误！', false);
        }
        $aUserParam['where']['iStatus >'] = 0;
        $aUserParam['where']['iType'] = 2;
        $aUserParam['where']['iUserID'] = $sUserID;
        $aUsers = Tijian_Model_User::getPair($aUserParam, 'iUserID', 'sRealName');
        $this->_editUserHeader(5);
        $this->assign('sUserID', $sUserID);
        $this->assign('aUsers', $aUsers);
    }

    //添加加项包
    public function insertAddtionAction()
    {
        $sUserID = $this->getParam('uid') ? intval($this->getParam('uid')) : 0;
        $iProductID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $iChannelID = $this->getParam('cid') ? intval($this->getParam('cid')) : 0;
        $iChannelType = $this->getParam('tid') ? intval($this->getParam('tid')) : 0;

        if (empty($iProductID) || empty($iChannelID) || empty($iChannelType)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $sAddtionID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sAddtionID)) {
            return $this->showMsg('请先选择加项包', false);
        }
        $aProduct = $this->_checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID);
        if (empty($aProduct)) {
            return null;
        }

        $aParam['iProductID'] = $iProductID;
        $aParam['iCreateUserID'] = $aParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
        $aParam['iType'] = $iChannelType;
        $aParam['iChannelID'] = $iChannelID;
        $aParam['iUserID'] = $sUserID;
        $aParam['iStatus'] = 1;
        if ($iCommitType) {//批量
            $aAddtionID = explode(',', $sAddtionID);
            $sSuccessNum = 0;
            $sTotalNum = count($aAddtionID);
            foreach ($aAddtionID as $key => $value) {
                //判断是否存在该加项包
                if (Tijian_Model_UserProductAddtion::getUserHasAddtion($iProductID, $sUserID, $value, $iChannelType, $iChannelID)) {
                    continue;
                }
                $aParam['iAddtionID'] = $value;
                if (Tijian_Model_UserProductAddtion::addData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功添加' . $sSuccessNum . '个加项包，失败' . ($sTotalNum - $sSuccessNum) . '个加项包';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iAddtionID'] = intval($sAddtionID);
            //判断是否存在该加项包
            if (Tijian_Model_UserProductAddtion::getUserHasAddtion($iProductID, $sUserID, $aParam['iAddtionID'], $iChannelType, $iChannelID)) {
                return $this->showMsg('已添加过该加项包！', true);
            }
            if (Tijian_Model_UserProductAddtion::addData($aParam)) {
                return $this->showMsg('添加成功！', true);
            } else {
                return $this->showMsg('添加失败！', false);
            }
        }
    }

    //删除已添加加项包
    public function deleteAddtionAction()
    {
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $sAddtionID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sAddtionID)) {
            return $this->showMsg('请先选择加项包', false);
        }
        $aParam['iStatus'] = 0;
        if ($iCommitType) {//批量
            $aAddtionID = explode(',', $sAddtionID);
            $sSuccessNum = 0;
            $sTotalNum = count($aAddtionID);
            foreach ($aAddtionID as $key => $value) {
                //判断是否存在该加项包
                if (!Tijian_Model_UserProductAddtion::getDetail($value)) {
                    continue;
                } else {
                    $aParam['iAutoID'] = $value;
                    Tijian_Model_UserProductAddtion::updData($aParam);
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功删除' . $sSuccessNum . '个加项包，失败' . ($sTotalNum - $sSuccessNum) . '个加项包';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iAutoID'] = intval($sAddtionID);
            //判断是否存在该加项包
            if (Tijian_Model_UserProductAddtion::updData($aParam)) {
                return $this->showMsg('删除成功！', true);
            } else {
                return $this->showMsg('删除失败！', false);
            }
        }
    }

    //拓展产品门店共用
    private function _Estore()
    {
        $iPageSize = self::PAGESIZE;
        $iProductID = $this->getParam('id') ? intval($this->getParam('id')) : 0;
        $aParam['aCity'] = $this->getParam('aCity') ? array_keys($this->getParam('aCity')) : [];
        $aParam['aSupplier'] = $this->getParam('aSupplier') ? array_keys($this->getParam('aSupplier')) : [];
        $aParam['aType'] = $this->getParam('aType') ? array_keys($this->getParam('aType')) : [];
        $aParam['sKeyword'] = $this->getParam('sKeyword') ? addslashes(trim($this->getParam('sKeyword'))) : '';
        $iPage = $this->getParam('page') ? intval($this->getParam('page')) : 1;
        if (empty($iProductID)) {
            return $this->showMsg('参数有误', $iProductID);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }
        $aWhere['iStatus >'] = 0;
        $aSupplier = Tijian_Model_Type::getOption('supplier');
        $aCity = Tijian_Model_City::getPair($aWhere, 'iCityID', 'sCityName');
        $aType = Yaf_G::getConf('aStoreType', 'product');
        $sTips = '';

        $iHasData = $this->getParam('hasdata') ? intval($this->getParam('hasdata')) : 0;
        if ($iHasData) {
            $aHasParam['iStatus'] = 1;
            $aHasParam['aHasCity'] = $this->getParam('aHasCity') ? array_keys($this->getParam('aHasCity')) : [];
            $aHasParam['aHasSupplier'] = $this->getParam('aHasSupplier') ? array_keys($this->getParam('aHasSupplier')) : [];
            $aHasParam['aHasType'] = $this->getParam('aHasType') ? array_keys($this->getParam('aHasType')) : [];
            $aHasParam['sHasKeyword'] = $this->getParam('sHasKeyword') ? addslashes(trim($this->getParam('sHasKeyword'))) : '';
            if (!empty($aHasParam['aHasCity'])) {
                $aHasParam['iCityID IN'] = $aHasParam['aHasCity'];
            }
            if (!empty($aHasParam['aHasSupplier'])) {
                $aHasParam['iSupplierID IN'] = $aHasParam['aHasSupplier'];
            }
            if (!empty($aHasParam['aHasType'])) {
                $aHasParam['iType IN'] = $aHasParam['aHasType'];
            }
            if (!empty($aHasParam['sHasKeyword'])) {
                $aHasParam[] = '(sCode="' . $aHasParam['sHasKeyword'] . '" OR sName LIKE "%' . $aHasParam['sHasKeyword'] . '%")';
            }
            $aHasStore = Tijian_Model_Store::getPair($aHasParam, 'iStoreID', 'sName');
            if (!empty($aHasStore)) {
                $aHasStoreParam['iStoreID IN'] = array_keys($aHasStore);
            } else {
                $aHasStoreParam['iStoreID IN'] = 999999;//搞个永远搜索不到的数字
            }
            $this->assign('aHasParam', $aHasParam);
        }
        $aHasStoreParam['iStatus >'] = 0;
        $aHasStoreParam['iProductID'] = $iProductID;
        $aHasStoreParam['iType'] = Tijian_Model_ProductStore::EXPANDPRODUCT;
        $aHasStore = Tijian_Model_ProductStore::getAll($aHasStoreParam);//该产品已包含的门店

        if (!empty($aHasStore)) {
            $aParam['sStoreID'] = '';
            $aCityTmp = [];
            $aSupplierTmp = [];
            //整合需要的数据
            foreach ($aHasStore as $key => $value) {
                $aStoreIDs[] = $value['iStoreID'];
                $aProductData = Tijian_Model_Store::getDetail($value['iStoreID']);
                $aHasStore[$key]['aStore'] = $aProductData;
                //按城市分组
                $aCityTmp[$aProductData['iCityID']][] = 1;
                //按供应商分组
                $aSupplierTmp[$aProductData['iSupplierID']][] = 1;
            }
            $aParam['iStoreID NOT IN'] = $aStoreIDs;
            //生成tips
            if (!empty($aCityTmp)) {
                $sTips = '共' . count($aCityTmp) . '个城市:';
                foreach ($aCityTmp as $key => $value) {
                    $sTips .= $aCity[$key] . count($value) . '个,';
                }
                $sTips = trim($sTips, ',') . "<br>";
            }
            if (!empty($aSupplierTmp)) {
                $sTips .= '共' . count($aSupplierTmp) . '个供应商:';
                foreach ($aSupplierTmp as $key => $value) {
                    $sTips .= $aSupplier[$key] . count($value) . '个,';
                }
                $sTips = trim($sTips, ',');
            }
        }
        $aParam['iStatus'] = 1;
        $aParam['aCity'] = $this->getParam('aCity') ? array_keys($this->getParam('aCity')) : [];
        $aParam['aSupplier'] = $this->getParam('aSupplier') ? array_keys($this->getParam('aSupplier')) : [];
        $aParam['aType'] = $this->getParam('aType') ? array_keys($this->getParam('aType')) : [];
        $aParam['sKeyword'] = $this->getParam('sKeyword') ? addslashes(trim($this->getParam('sKeyword'))) : '';
        if (!empty($aParam['aCity'])) {
            $aParam['iCityID IN'] = $aParam['aCity'];
        }
        if (!empty($aParam['aSupplier'])) {
            $aParam['iSupplierID IN'] = $aParam['aSupplier'];
        }
        if (!empty($aParam['aType'])) {
            $aParam['iType IN'] = $aParam['aType'];
        }
        if (!empty($aParam['sKeyword'])) {
            $aParam[] = '(sCode="' . $aParam['sKeyword'] . '" OR sName LIKE "%' . $aParam['sKeyword'] . '%")';
        }
        $aStore = Tijian_Model_Store::getList($aParam, $iPage, 'iUpdateTime DESC', $iPageSize);
        //添加之后刷新，分页bug特殊处理
        if ((ceil($aStore['iTotal'] / $iPageSize)) != 0 && $iPage > (ceil($aStore['iTotal'] / $iPageSize))) {
            $aStore = Tijian_Model_Store::getList($aParam, 1, 'iUpdateTime DESC', $iPageSize);
        }
        $sNextUrl = '/tijian/admin/product/addupgrade/id/' . $iProductID;
        $this->assign('aType', $aType);
        $this->assign('aCity', $aCity);
        $this->assign('aSupplier', $aSupplier);
        $this->assign('iProductID', $iProductID);
        $this->assign('aParam', $aParam);
        $this->assign('aStore', $aStore);
        $this->assign('aHasStore', $aHasStore);
        $this->assign('sTips', $sTips);
        $this->assign('sNextUrl', $sNextUrl);
        $this->assign('aProduct', $aProduct);
        return true;
    }

    //选择拓展产品门店
    public function addEStoreAction()
    {
        $result = $this->_Estore();
        if (empty($result)) {
            return null;
        }
    }

    //编辑拓展产品门店
    public function editEStoreAction()
    {
        $result = $this->_Estore();
        if (empty($result)) {
            return null;
        }
        //munu相关的赋值
        $this->_editHeader(5, 2);
        $this->assign('id', intval($this->getParam('id')));
    }

    //查看门店
    public function viewEStoreAction()
    {
        $result = $this->_Estore();
        if (empty($result)) {
            return null;
        }
        //munu相关的赋值
        $this->_editHeader(5, 1);
        $this->assign('id', intval($this->getParam('id')));
    }

    //添加门店
    public function insertEStoreAction()
    {
        $iProductID = $this->getParam('pid') ? intval($this->getParam('pid')) : 0;
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        if (empty($iProductID)) {
            return $this->showMsg('参数有误', false);
        }
        $sStoreID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sStoreID)) {
            return $this->showMsg('请先选择门店', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('该产品不存在!', false);
        }

        $aParam['iProductID'] = $iProductID;
        $aParam['iCreateUserID'] = $aParam['iLastUpdateUserID'] = $this->aCurrUser['iUserID'];
        $aParam['iType'] = Tijian_Model_ProductStore::EXPANDPRODUCT;//基础产品
        $aParam['iStatus'] = 1;
        if ($iCommitType) {//批量
            $aStoreID = explode(',', $sStoreID);
            $sSuccessNum = 0;
            $sTotalNum = count($aStoreID);
            foreach ($aStoreID as $key => $value) {
                //判断是否存在该门店
                if (Tijian_Model_ProductStore::getDataByStoreID($iProductID, $value, Tijian_Model_ProductStore::EXPANDPRODUCT)) {
                    continue;
                }
                $aParam['iStoreID'] = $value;
                if (Tijian_Model_ProductStore::addData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功添加' . $sSuccessNum . '个门店，失败' . ($sTotalNum - $sSuccessNum) . '个门店';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iStoreID'] = intval($sStoreID);
            //判断是否存在该门店
            if (Tijian_Model_ProductStore::getDataByStoreID($iProductID, $aParam['iStoreID'], Tijian_Model_ProductStore::EXPANDPRODUCT)) {
                return $this->showMsg('已添加过该门店！', false);
            }
            if (Tijian_Model_ProductStore::addData($aParam)) {
                return $this->showMsg('添加成功！', true);
            } else {
                return $this->showMsg('添加失败！', false);
            }
        }
    }

    //删除已添加门店
    public function deleteEStoreAction()
    {
        $iCommitType = $this->getParam('type') ? intval($this->getParam('type')) : 0;
        $sStoreID = $this->getParam('id') ? $this->getParam('id') : '';
        if (empty($sStoreID)) {
            return $this->showMsg('请先选择门店', false);
        }
        $aParam['iStatus'] = 0;
        if ($iCommitType) {//批量
            $aStoreID = explode(',', $sStoreID);
            $sSuccessNum = 0;
            $sTotalNum = count($aStoreID);
            foreach ($aStoreID as $key => $value) {
                //判断是否存在该门店
                if (!Tijian_Model_ProductStore::getDetail($value)) {
                    continue;
                }
                $aParam['iAutoID'] = $value;
                if (Tijian_Model_ProductStore::updData($aParam)) {
                    $sSuccessNum++;
                }
            }
            $sMsg = '成功删除' . $sSuccessNum . '个门店，失败' . ($sTotalNum - $sSuccessNum) . '个门店';
            return $this->showMsg($sMsg, true);
        } else {
            $aParam['iAutoID'] = intval($sStoreID);
            //判断是否存在该门店
            if (Tijian_Model_ProductStore::updData($aParam)) {
                return $this->showMsg('删除成功！', true);
            } else {
                return $this->showMsg('删除失败！', false);
            }
        }
    }

    /**
     * 请求数据检测
     * @param int $iType 1:添加，2:修改,3:其他
     * @return array|bool
     */
    public function _checkClientData($iType)
    {
        $aParam = $this->getParams();
        if ($iType < 3) {
            if (!Util_Validate::isLength($aParam['sProductName'], 1, 50)) {
                return $this->showMsg('产品名称为1到50个字！', false);
            }
            if (empty($aParam['sImage'])) {
                return $this->showMsg('产品图片不能为空！', false);
            }

            //验证产品名是否存在
            $aProduct = Tijian_Model_Product::getProductByName($aParam['sProductName']);
            if (!empty($aProduct['iProductID']) && $aProduct['iProductID'] != $aParam['iProductID']) {
                return $this->showMsg('该产品名已存在！', false);
            }

            //验证实物卡类型已存在，只有定制卡，可以添加多个类型
            if (!empty($aParam['iPCard']) && $aParam['iPCard'] != 6) {
                $aWhere = array(
                    'iPCard' => $aParam['iPCard'],
                    'iStatus >' => 0
                );
                $aProduct = Tijian_Model_Product::getRow($aWhere);
                if (!empty($aProduct['iProductID']) && $aProduct['iProductID'] != $aParam['iProductID']) {
                    //return $this->showMsg('该实物卡类型已存在，不能重复添加！', false);
                }
            }
        }
        return $aParam;
    }

    //渠道参数判断
    public function _checkChannelParam($iChannelID, $iProductID, $iChannelType, $sUserID)
    {
        $aChannel = Yaf_G::getConf('aChannel');
        if (empty($aChannel[$iChannelID])) {
            return $this->showMsg('渠道不存在！', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('产品不存在！', false);
        }
        if ($aProduct['iType'] != 2) {
            return $this->showMsg('这里只能编辑拓展产品！', false);
        }
        if ($iChannelType == 1 && empty($aProduct['iCanCompany'])) {
            return $this->showMsg('该产品不支持公司渠道', false);
        }
        if ($iChannelType == 2 && empty($aProduct['iCanIndividual'])) {
            return $this->showMsg('该产品不支持个人渠道', false);
        }
        $aUser = Tijian_Model_User::getDetail($sUserID);
        if (empty($aUser)) {
            return $this->showMsg('用户不存在', false);
        }
        if ($aUser['iChannel'] != $iChannelID) {
            return $this->showMsg('用户不在该渠道', false);
        }
        return $aProduct;
    }

    public function importCodeByCityAction()
    {
        $iProductID = $this->getParam('id');
        if (empty($iProductID)) {
            return $this->showMsg('参数有误！', false);
        }
        $aProduct = Tijian_Model_Product::getDetail($iProductID);
        if (empty($aProduct)) {
            return $this->showMsg('产品不存在', false);
        }
        $aWhere['iStatus > '] = 0;
        $aCity = Tijian_Model_City::getPair($aWhere, 'iCityID', 'sCityName');
        if ($this->isPost()) {
            $aParam = $this->getParams();
            if (empty($aParam['aCityID'])) {
                return $this->showMsg('请选择城市！', false);
            }
            $aStoreCodeParam['iProductID'] = $aParam['id'];

            $iStoreNum = 0;//门店数
            $iSuccess = 0;//成功项
            $aFail = [];//失败项
            $aStoreList = [];
            $aParam['aCityID'] = array_keys($aParam['aCityID']);
            //先判断城市下是否有门店吧
            foreach ($aParam['aCityID'] as $k => $val) {
                //获取所有该城市下的门店
                $aStoreParam['iStatus'] = 1;
                $aStoreParam['iCityID'] = $val;
                $aStore = Tijian_Model_Store::getAll($aStoreParam);
                if (empty($aStore)) {
                    return $this->showMsg($aCity[$val] . '没有门店，请先添加门店', false);
                }
                $aStoreList[$val] = $aStore;
                $iStoreNum += count($aStore);
            }

            foreach ($aParam['aCityID'] as $k => $val) {
                foreach ($aStoreList[$val] as $key => $value) {
                    //全部插入三条不同性别的价格
                    $aStoreCodeParam['iStoreID'] = $value['iStoreID'];
                    $aStoreCodeParam['sCode'] = $aParam['sCode'];
                    $aStoreCodeParam['sChannelPrice'] = $aParam['sChannelPrice'];
                    $aStoreCodeParam['sSupplierPrice'] = $aParam['sSupplierPrice'];
                    $aStoreCodeParam['iCreateUserID'] = $aStoreCodeParam['iUpdateUserID'] = $this->aCurrUser['iUserID'];
                    for ($i = 1; $i <= 3; $i++) {
                        $aStoreCodeParam['iSex'] = $i;
                        if (Tijian_Model_StoreCode::getData($iProductID, $value['iStoreID'], $i)) {
                            $aTmp['iStoreID'] = $value['iStoreID'];
                            $aTmp['iSex'] = $i;
                            $aTmp['storeName'] = $value['sName'];
                            $aTmp['reason'] = '已经添加过该门店该性别代码';
                            $aFail[] = $aTmp;
                            continue;
                        }
                        if (!Tijian_Model_StoreCode::addData($aStoreCodeParam)) {
                            $aTmp['iStoreID'] = $value['iStoreID'];
                            $aTmp['iSex'] = $i;
                            $aTmp['storeName'] = $value['sName'];
                            $aTmp['reason'] = '代码插入失败';
                            $aFail[] = $aTmp;
                        } else {
                            $iSuccess++;
                        }
                    }
                }
            }
            $sFail = '失败列表：|';
            if (!empty($aFail)) {
                $aSex = Yaf_G::getConf('aSex', 'product');
                foreach ($aFail as $key => $value) {
                    $sFail .= $value['storeName'] . '的' . $aSex[$value['iSex']] . '性别' . '因为' . $value['reason'] . '导入失败|';
                }
            }
            $sMsg = '本次导入' . count($aParam['aCityID']) . '个城市数据|共有' . $iStoreNum . '个门店|导入成功' . $iSuccess . '个代码' . ',失败' . count($aFail) . '个代码|' . $sFail;
            return $this->showMsg($sMsg, true);
        }
        $this->assign('aCity', $aCity);
        $this->assign('aProduct', $aProduct);
    }

    public function downMatchDemoAction()
    {
        $filepath = '/data/wwwroot/xcy/51joying/doc/matchdemo.xls';
        $filename = '匹配推荐模板.xls';

        Util_File::download($filepath, $filename);
    }

    public function downStoreCodeDemoAction()
    {
        $filepath = '/data/wwwroot/xcy/51joying/doc/storecodedemo.xls';
        $filename = '门店代码模板.xls';
        Util_File::download($filepath, $filename);
    }
}