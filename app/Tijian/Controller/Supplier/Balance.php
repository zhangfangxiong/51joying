<?php
/**
 * User: xcy
 * Date: 2016/5/30
 * Time: 13:00
 */
class Tijian_Controller_Supplier_Balance extends Tijian_Controller_Supplier_Base
{

	public function actionAfter ()
	{
		parent::actionAfter();
		$this->assign('sInsertItemUrl', '/supplier/balance/add/');
		$this->assign('sDeleteItemUrl', '/supplier/balance/del/');
		$this->assign('sNextItemUrl', '/supplier/balance/sign');
		$this->assign('sTicketUrl', '/supplier/balance/ticket');
	}


	/**
	 * 业务结算
	 * @return [type] [description]
	 */
	public function indexAction ()
	{	
		if (!$this->sStoreIDs) {
			return;
		}
		
		$page  = $this->getParam('page') ? intval($this->getParam('page')) : 1;
		$param = $this->getParams();
		$where = ['iStoreID IN' => $this->sStoreIDs, 'iBookStatus' => 5];
		!empty($param['iPhysicalType']) && in_array($param['iPhysicalType'], [1, 2]) 
		? $where['iPhysicalType'] = $param['iPhysicalType'] : '';
		!empty($param['sStartDate'])
		? $where['iReportTime >='] = strtotime($param['sStartDate']) : '';
		!empty($param['sEndDate'])
		? $where['iReportTime <='] = strtotime($param['sEndDate']) : '';

		//所有已结算订单
		$iPIDs = '';
		$aPhysical = Tijian_Model_BalancePhysical::getAll(['where' => [
			'iStatus' => Tijian_Model_BalancePhysical::STATUS_VALID
		]]);		
		if ($aPhysical) {
			foreach ($aPhysical as $key => $value) {
				if ($value['iPhysicalID']) {
					$iPIDs ? $iPIDs .= ',' . $value['iPhysicalID'] 
					: $iPIDs = $value['iPhysicalID'];
				}
			}
			if ($iPIDs) {
				$where['iAutoID NOT IN'] = $iPIDs;
			}
		}

		$aHasItem = [];
		$iBalanceID = intval($this->getParam('iBalanceID'));
		if ($iBalanceID 
			&& $aOrder = Tijian_Model_BalancePhysical::getAll(['where' => [
				'iBalanceID' => $iBalanceID,
				'iStatus' => Tijian_Model_BalancePhysical::STATUS_VALID
			]])) {
			$iPhysicalIDs = '';
			foreach ($aOrder as $k => $val) {
				if ($val['iPhysicalID']) {
					$iPhysicalIDs ? $iPhysicalIDs .= ',' . $val['iPhysicalID'] 
					: $iPhysicalIDs  = $val['iPhysicalID'];
				}
			}
			if ($iPhysicalIDs) {
				$aHasItem = Tijian_Model_OrderCardProduct::getAll(['where' => [
						'iAutoID IN' => $iPhysicalIDs,
						'iBookStatus' => 5 //状态为已出报告
					]
				]);
				$aHasItem = $this->packageData($aHasItem);
			}
		} 

		$aProduct = Tijian_Model_OrderCardProduct::getList($where, $page, 'iUpdateTime Desc');
		if ($aProduct['aList']) {
			$aProduct['aList'] = $this->packageData($aProduct['aList']);
		}

		$this->assign('iBalanceID', $iBalanceID);
		$this->assign('aHasItem', $aHasItem);
		$this->assign('aProduct', $aProduct);
		$this->assign('aParam', $param);
	}

	/**
	 * 检测参数
	 * @return [type] [description]
	 */
	public function checkParam()
	{
		$params = $this->getParams();
		if (!$params['id']) {
			return $this->showMsg('请选择订单', false);
		}
		$aIds = explode(',', $params['id']);
		foreach ($aIds as $key => $value) {
			$aDetail = Tijian_Model_OrderCardProduct::getDetail($value);
			if (!$aDetail || $aDetail['iBookStatus'] != 5) { //一定要已出报告的订单 
				unset($aIds[$key]);
			}
		}
		if (!$aIds) {
			return $this->showMsg('选择订单无效', false);
		}

		$params['aIds'] = $aIds;
		return $params;
	}

	/**
	 * 添加选中订单
	 */
	public function addAction ()
	{
		$aParam = $this->checkParam();
		if (empty($aParam)) {
			return null;
		}

		if (!$aParam['iBalanceID']) {
			$balance['sBalanceCode'] = Tijian_Model_Balance::initBalanceCode();
			$balance['iSupplierID'] = $this->iSupplierID;
			$balance['iStatus'] = Tijian_Model_Balance::STATUS_VALID;
			$aParam['iBalanceID'] = Tijian_Model_Balance::addData($balance);
		}

		if ($aParam['iBalanceID']) {
			foreach ($aParam['aIds'] as $key => $value) {
				$aBp['iBalanceID'] = $aParam['iBalanceID'];
				$aBp['iPhysicalID'] = $value;
				if ($row = Tijian_Model_BalancePhysical::getRow(['where' => $aBp])) {
					$data['iAutoID'] = $row['iAutoID'];
					$data['iStatus'] = Tijian_Model_BalancePhysical::STATUS_VALID;
					Tijian_Model_BalancePhysical::updData($data);
				} else {
					$aBp['iStatus'] = Tijian_Model_BalancePhysical::STATUS_VALID;
					Tijian_Model_BalancePhysical::addData($aBp);
				}				
			}

			return $this->showMsg('添加成功', true, '/supplier/balance/index/iBalanceID/'.$aParam['iBalanceID']);
		}

		return $this->showMsg('添加失败', false);
	}

	/**
	 * 删除选中订单
	 */
	public function delAction ()
	{
		$aParam = $this->checkParam();
		if (empty($aParam)) {
			return null;
		}
		if ($aParam['iBalanceID']) {
			foreach ($aParam['aIds'] as $key => $value) {
				$aBp['iBalanceID'] = $aParam['iBalanceID'];
				$aBp['iPhysicalID'] = $value;
				$aBp['iStatus'] = Tijian_Model_BalancePhysical::STATUS_VALID;
				$row = Tijian_Model_BalancePhysical::getRow(['where' => $aBp]);
				if ($row) {
					$data['iAutoID'] = $row['iAutoID'];
					$data['iStatus'] = Tijian_Model_BalancePhysical::STATUS_INVALID;
					Tijian_Model_BalancePhysical::updData($data);
				}
			}
			return $this->showMsg('删除成功', true, '/supplier/balance/index/iBalanceID/'.$aParam['iBalanceID']);
		}

		return $this->showMsg('订单无效', false);
	}


	/**
	 * 生成凭证
	 */
	public function signAction ()
	{
		$aDetail = [];
		$iBalanceID = $this->getParam('iBalanceID');
		if (!$iBalanceID) {
			$iBalanceID = $this->getParam('id');
		}

		if (!$iBalanceID || !$aBalance = Tijian_Model_Balance::getDetail($iBalanceID)) {
			return $this->redirect('/supplier/balance/index');
		}

		$balance['sMonth'] = date('Ym', time());
		$aPhysical = Tijian_Model_BalancePhysical::getAll([
			'where' => [
				'iBalanceID' => $iBalanceID,
				'iStatus' => Tijian_Model_BalancePhysical::STATUS_VALID
			]
		]);		

		$iPhysicalIDs = '';
		if ($aPhysical) {
			foreach ($aPhysical as $k => $val) {
				if ($val['iPhysicalID']) {
					$iPhysicalIDs ? $iPhysicalIDs .= ',' . $val['iPhysicalID'] 
					: $iPhysicalIDs  = $val['iPhysicalID'];
				}
			}
			if ($iPhysicalIDs) {
				$aProduct = Tijian_Model_OrderCardProduct::getListByPKIDs($iPhysicalIDs);
				if ($aProduct) {					 
					$index = $iSMoney = $iUMoney = $iAFMoney = 0;
					foreach ($aProduct as $key => $value) {
						$index++;
						$aCard = Tijian_Model_OrderCard::getDetail($value['iCardID']);
						list($sSupplierPrice, $sAFPrice) = Tijian_Model_StoreCode::getSupplierCost($value['iStoreID'], $value['iSex'], $value['iProductID']);
						$iSMoney += $sSupplierPrice;
						$iAFMoney += $sAFPrice;

						//结算个人支付 卡公司支付 = 0 卡个人支付 查支付金额
						if ($aCard['iPayType'] == 2) {
							$iUMoney = 0;
						} else {
							$aOP = Tijian_Model_OrderProduct::getDetail($value['iOPID']);
							$iUMoney = $aOP['sProductPrice'];
						}	
					}
					$balance['iBalanceID'] = $iBalanceID;
					$balance['iSMoney'] = $iSMoney;
					$balance['iAFMoney'] = $iAFMoney;
					$balance['iUMoney'] = $iUMoney;

					Tijian_Model_Balance::updData($balance);
					$aDetail = Tijian_Model_Balance::getDetail($iBalanceID);
				}				
			}
		} 

		$this->assign('iCount', $index);
		$this->assign('iBalanceID', $iBalanceID);
		$this->assign('aBalance', $aDetail);
	}

	/**
	 * 邮寄请款发票
	 * @return [type] [description]
	 */
	public function ticketAction ()
	{
		if ($this->isPost()) {
			$iBalanceID = $this->getParam('iBalanceID');
			if (!$iBalanceID || !$aBalance = Tijian_Model_Balance::getDetail($iBalanceID)) {
				return $this->redirect('/supplier/balance/index');
			}
			
			$params = $this->getParams();
			if (!$params['sExpress'] || !$params['sExpressCode'] ) {
				return $this->showMsg('请填写完整信息', false);
			}

			$balance['iBalanceID'] = $iBalanceID;
			$balance['iIsTicket'] = 1;
			$balance['iStatus'] = 2;
			$balance['sExpress'] = $params['sExpress'];
			$balance['sExpressCode'] = $params['sExpressCode'];
			Tijian_Model_Balance::updData($balance);

			return $this->showMsg('填写完成', true, '/supplier/balance/record');
		} else {
			$iBalanceID = $this->getParam('iBalanceID');
			$aBalance = Tijian_Model_Balance::getDetail($iBalanceID);
			$this->assign('aBalance', $aBalance);
			$this->assign('iBalanceID', $iBalanceID);
		}
	}

	/**
	 * 包装data
	 * @param  [type] $aProduct [description]
	 * @return [type]           [description]
	 */
	public function packageData($aProduct)
	{		
		foreach ($aProduct as $k => $val) {
			$storeInfo = Tijian_Model_Store::getDetail($val['iStoreID']);
			$aProduct[$k]['sStoreName'] = $storeInfo['sName'];
			$aProduct[$k]['sCityName'] = $this->aStoreCity[$storeInfo['iCityID']];

			$aOrder = Tijian_Model_OrderInfo::getDetail($val['iOrderID']);
			$aCard = Tijian_Model_OrderCard::getDetail($val['iCardID']);
			$userInfo = Tijian_Model_CustomerNew::getDetail($aCard['iUserID']);
			$aProduct[$k]['sRealName'] = $userInfo['sRealName'];
			$aProduct[$k]['sSex'] = ($userInfo['iSex'] == 2) ? '女' : '男';
			$aProduct[$k]['sMarriage'] = ($userInfo['iMarriage'] == 2) ? '已婚' : '未婚';
			$aProduct[$k]['sReportTime'] = $val['iReportTime'] ? date('Y-m-d H:i:s', $val['iReportTime']) : '';
			$aProduct[$k]['sPhysicalTime'] = $val['iOrderTime'] ? date('Y-m-d H:i:s', $val['iOrderTime']) : '';
			$aProduct[$k]['sOrderStatus'] = $this->aStatus[$val['iBookStatus']];
			//每张卡结算
			if ($val['iSex'] == 0) {
				$iSex = $aCard['iSex'];
				$p['iAutoID'] = $val['iAutoID'];
				$p['iSex'] = $iSex;
				Tijian_Model_OrderCardProduct::updData($p);
			} else{
				$iSex = $val['iSex'];
			}		
			list($aProduct[$k]['sCost'], $aProduct[$k]['iAFMoney']) = Tijian_Model_StoreCode::getSupplierCost($val['iStoreID'], $iSex, $val['iProductID']);
			
			//结算个人支付 卡公司支付 = 0 卡个人支付 查支付金额
			if ($aCard['iPayType'] == 2) {
				$aProduct[$k]['iUMoney'] = 0;
			} else {
				$aOP = Tijian_Model_OrderProduct::getDetail($val['iOPID']);
				$aProduct[$k]['iUMoney'] = $aOP['sProductPrice'];
			}			
		}

		return $aProduct;
	}


	/**
	 * 结算列表
	 * @return [type] [description]
	 */
	public function recordAction ()
	{
		$page  = $this->getParam('page') ? intval($this->getParam('page')) : 1;
		$where = ['iSupplierID' => $this->iSupplierID];

		$param = $this->getParams();
		!empty($param['sBalanceCode']) 
		? $where['sBalanceCode LIKE'] = '%' . trim($param['sBalanceCode']) . '%' : '';
		
		('-1' == $param['iStatus'])	|| !isset($param['iStatus'])	
		? $where['iStatus >'] = Tijian_Model_Balance::STATUS_INVALID
		: $where['iStatus '] = intval($param['iStatus']);

		$aList = Tijian_Model_Balance::getList($where, $page, 'iUpdateTime Desc');
		if ($aList['aList']) {
			foreach ($aList['aList'] as $key => $value) {
				$aList['aList'][$key]['sStatus'] = $this->aBalanceStatus[$value['iStatus']];
			}
		}

		$this->assign('aList', $aList);
		$this->assign('aParam', $param);
		$this->assign('iPage',  $page);
	}


	/**
	 * 业务结算明细
	 * @return 
	 */
	public function detailAction ()
	{
		$id = $this->getParam('id');
    	if (!intval($id)) {
    		$this->redirect('/supplier/balance/record');
    	}

    	$aDetail = Tijian_Model_Balance::getDetail(intval($id));
    	if ($aDetail && $aDetail['iStatus'] > Tijian_Model_Balance::STATUS_INVALID) {
    		$aDetail['iCount'] = 0;
    		$aPhysical = Tijian_Model_BalancePhysical::getAll(['where' => [
    			'iBalanceID' => $id,
    			'iStatus' => Tijian_Model_BalancePhysical::STATUS_VALID
    		]]);

    		$aProduct = [];
    		if ($aPhysical) {
    			$aPhysicalIDs = [];
    			$sPhysicalIDs = '';
    			foreach ($aPhysical as $key => $value) {
    				if ($value['iPhysicalID']) {
    					$aPhysicalIDs[] = $value['iPhysicalID'];
    				}    				
	    		}
	    		if ($aPhysicalIDs) {
					$sPhysicalIDs = implode(',', $aPhysicalIDs);
					$aDetail['iCount'] = count($aPhysicalIDs);

					$aProduct = Tijian_Model_OrderCardProduct::getListByPKIDs($sPhysicalIDs);
					foreach ($aProduct as $k => $val) {
						$storeInfo = Tijian_Model_Store::getDetail($val['iStoreID']);
			    		$aProduct[$k]['sStoreName'] = $storeInfo['sName'];
			    		$aProduct[$k]['sCityName'] = $this->aStoreCity[$storeInfo['iCityID']];

			    		$aCard = Tijian_Model_OrderCard::getDetail($val['iCardID']);
			    		$userInfo = Tijian_Model_CustomerNew::getDetail($aCard['iUserID']);
			    		if (!$userInfo) {
			    			unset($aProduct[$k]);
			    			continue;
			    		}
						$aProduct[$k]['sRealName'] = $userInfo['sRealName'];
						$aProduct[$k]['sSex'] = ($userInfo['iSex'] == 2) ? '女' : '男';

						$aProduct[$k]['sPhysicalTime'] = $val['iOrderTime'] ? date('Y-m-d H:i:s', $val['iOrderTime']) : '';
						$aProduct[$k]['sOrderStatus'] = $this->aStatus[$val['iBookStatus']];
					}
				}
    		}

			$this->assign('aDetail', $aDetail);
			$this->assign('aProduct', $aProduct);
    	} else {
    		$this->redirect('/supplier/balance/record');
    	}
	}

	/**
	 * 导出
	 */
	public function exportAction() {
		$id = $this->getParam('id');
		$aDetail = Tijian_Model_Balance::getDetail(intval($id));
    	if ($aDetail && $aDetail['iStatus'] > Tijian_Model_Balance::STATUS_INVALID) {
    		$aDetail['iCount'] = 0;
    		$aPhysical = Tijian_Model_BalancePhysical::getAll(['where' => [
    			'iBalanceID' => $id,
    			'iStatus' => Tijian_Model_BalancePhysical::STATUS_VALID
    		]]);

    		$aProduct = [];
    		if ($aPhysical) {
    			$aPhysicalIDs = [];
    			$sPhysicalIDs = '';
    			foreach ($aPhysical as $key => $value) {
    				if ($value['iPhysicalID']) {
    					$aPhysicalIDs[] = $value['iPhysicalID'];
    				}    				
	    		}
	    		if ($aPhysicalIDs) {
					$sPhysicalIDs = implode(',', $aPhysicalIDs);
					$aDetail['iCount'] = count($sPhysicalIDs);

					$aProduct = Tijian_Model_OrderCardProduct::getListByPKIDs($sPhysicalIDs);
					foreach ($aProduct as $k => $val) {
						$storeInfo = Tijian_Model_Store::getDetail($val['iStoreID']);
			    		$aProduct[$k]['sStoreName'] = $storeInfo['sName'];
			    		$aProduct[$k]['sCityName'] = $this->aStoreCity[$storeInfo['iCityID']];

			    		$aCard = Tijian_Model_OrderCard::getDetail($val['iCardID']);
			    		$aOrder = Tijian_Model_OrderInfo::getDetail($val['iOrderID']);
			    		$userInfo = Tijian_Model_CustomerNew::getDetail($aCard['iUserID']);
			    		if (!$userInfo) {
			    			unset($aProduct[$k]);
			    			continue;
			    		}
						$aProduct[$k]['sRealName'] = $userInfo['sRealName'];
						$aProduct[$k]['sSex'] = ($userInfo['iSex'] == 2) ? '女' : '男';
						$aProduct[$k]['sPhysicalTime'] = $val['iOrderTime'] ? date('Y-m-d H:i:s', $val['iOrderTime']) : '';
						$aProduct[$k]['sOrderStatus'] = $this->aStatus[$val['iBookStatus']];
						if ($aOrder) {
							$aProduct[$k]['sCost'] = $aOrder['sOrderAmount'];	
						} else {
							//计算cp表
							$aProduct[$k]['sCost'] = $aOrder['sOrderAmount'];	
						}
						
					}

					$aData = array ();
					foreach ( $aProduct as $v ) {
						$aData [] = array (
							'sRealName' => $v ['sRealName'],
							'sSex' => $v ['sSex'],
							'sCityName' => $v ['sCityName'],
							'iSMoney' => $v['sCost'],
							'sPhysicalTime' => $v['sPhysicalTime'],
							'sStoreName' => $v ['sStoreName'],
							'sProductName' => $v ['sProductName']								
						);
					}
					
					$aTitle = array (
						'sRealName' => '姓名',
						'sSex' => '性别',
						'sCityName' => '体检城市',
						'sProductName' => '体检项目',
						'sStoreName' => '体检门店',
						'sPhysicalTime' => '体检日期',
						'iSMoney' => '结算金额'
					);
					
					Util_File::exportCsv ('结算导出.csv', $aData, $aTitle );
					return false;
				}
    		}
    		return false;
    	}

    	return false;		
	}
}