<?php
/**
 * Created by PhpStorm.
 * User: yaobiqing
 * Date: 16/5/25
 * Time: 下午4:37
 */

class Admin_Cmd_Order extends Admin_Cmd_Base
{

    /**
     * 同步订单数据
     */
    public function getOrderAction()
    {
        $key = 'youzan_order_sync_lastdate';
        $oYouzanClient = Util_Common::getYouzanClient();
        $method = 'kdt.trades.sold.get';
        $runtime = date('Y-m-d H:i:s');
        $time = $this->getParam('time');
        if (empty($time)) {
            $time = Admin_Model_Kv::getValue($key);
            if (empty($time)) {
                $time = $runtime;
            }
            Admin_Model_Kv::setValue($key, $runtime);
        }

        $pagesize = 100;
        $page = 1;
        $param = [];
        $param['status'] = 'WAIT_BUYER_CONFIRM_GOODS';
        $param['start_update'] = $time;


        do{

            $param['page_size'] = $pagesize;
            $param['page_no'] = $page;
            $orderList = $oYouzanClient->post($method, $param, []);
//            print_r($orderList);//exit;
            if (isset($orderList['error_response'])) {
                break;
            }
            if ($orderList['response']['total_results'] == 0) {
                break;
            }
            $iTotalPage = ceil($orderList['response']['total_results']/$pagesize);
            foreach($orderList['response']['trades'] as $key => $value) {
                $sOutID = $value['orders'][0]['outer_item_id'];
                print_r($value);
                if (empty($sOutID)) {
                    continue;
                }
                $arr = explode('_', $value['orders'][0]['outer_item_id']);
                print_r($arr);
                if (count($arr) == 2) {
                    if ($arr['0'] == 'dashang') {
                        $row = Admin_Model_JudgmentReward::getRow([
                                'where' => [
                                    'sOutID' => $sOutID
                                ]
                            ]);
                        print_r($row);
                        if ($row) {
                            $updata = [];
                            $updata['iAutoID'] = $row['iAutoID'];
                            $updata['iPay'] = 2;
                            Admin_Model_JudgmentReward::updData($updata);
                            Admin_Model_Youzan::offGood($row['sGoodNum']);
                        } else {
                            continue;
                        }
                    } else if ($arr['0'] == 'zixunfei') {
                        $row = Admin_Model_CustomerConsultation::getRow([
                                'where' => [
                                    'sOutID' => $sOutID
                                ]
                            ]);
                        print_r($row);
                        if ($row) {
                            $updata = [];
                            $updata['iAutoID'] = $row['iAutoID'];
                            $updata['iPay'] = 2;
                            Admin_Model_JudgmentReward::updData($updata);
                            Admin_Model_Youzan::offGood($row['sGoodNum']);
                        } else {
                            continue;
                        }
                    }
                } else {
                    continue;
                }


            }
            $page++;
            if ($page > $iTotalPage) {
                break;
            }

        }while(true);

        echo '数据同步完成', PHP_EOL;

    }
}