<?php
/**
 * Created by PhpStorm.
 * User: yaobiqing
 * Date: 16/4/20
 * Time: 上午10:29
 */

class Admin_Model_Question extends Admin_Model_Base
{

    const TABLE_NAME = 't_question';
    const PK_FIELD = 'iAutoID';


    const TITLE_IS_EMPTY = 201;
    const CATEGORY_IS_EMPTY = 202;
    const TAG_IS_EMPTY = 203;

    private static $aMessage = [
        self::TITLE_IS_EMPTY => '问题不能为空',
        self::CATEGORY_IS_EMPTY => '问题分类不能为空',
        self::TAG_IS_EMPTY => '问题标签不能为空',
    ];

    public static function getList($aWhere, $iPage, $sOrder = '', $iPageSize = 20, $sUrl = '', $aArg = array(), $bReturnPager = true)
    {
        $result = parent::getList($aWhere, $iPage, $sOrder, $iPageSize, $sUrl, $aArg, $bReturnPager);
        if ($result['aList']) {
            foreach($result['aList'] as $key => $value) {
                $result['aList'][$key] = self::getQuestion($value['iAutoID']);
            }
        }
        return $result;
    }

    /**
     * 操作问题
     * iAutoID 大于0则更新 否则新增
     */
    public static function save($aData, $iAutoID = 0, $iUserID = 0)
    {
        $mResult = self::checkData($aData);
        if ($mResult === true) {
            if(is_array($aData['sTag'])) {
                $aData['sTag'] = implode(',', $aData['sTag']);
            }
            if ($iAutoID > 0) {
                $aData['iUpdateUserID'] = $iUserID;
                $aData['iAutoID'] = $iAutoID;
                self::updData($aData);
            } else {
                $aData['iCreateUserID'] = $aData['iUpdateUserID'] = $iUserID;
                $iAutoID = self::addData($aData);
            }
            return ['iCode' => 200, 'sMessage' => '问题信息提交成功', 'iQuestionID' => $iAutoID];
        }
        return $mResult;

    }

    /**
     * @param $aData
     * 检测参数的有效性
     */
    public static function checkData($aData)
    {
        if (empty($aData['sTitle'])) {
            return ['iCode' => self::TITLE_IS_EMPTY, 'sMessage' => self::$aMessage[self::TITLE_IS_EMPTY]];
        }

        if(!isset($aData['iCategoryID']) || $aData['iCategoryID'] == 0) {
            return ['iCode' => self::CATEGORY_IS_EMPTY, 'sMessage' => self::$aMessage[self::CATEGORY_IS_EMPTY]];
        }

//        if (empty($aData['sTag'])) {
//
//            return ['iCode' => self::TAG_IS_EMPTY, 'sMessage' => self::$aMessage[self::TAG_IS_EMPTY]];
//        }

        return true;
    }

    /**
     * @param $iQuestionID
     * @return array|int
     * 获取某个问题的详情
     */
    public static function getQuestion($iQuestionID) {

        $aQuestion = self::getRow(
            [
                'where' => [
                    'iStatus' => 1,
                    'iAutoID' => $iQuestionID
                ]
            ]
        );
        if ($aQuestion) {
            //分类信息
            $aQuestion['aCategory'] = Admin_Model_Type::getDetail($aQuestion['iCategoryID']);
            if($aQuestion['sTag']) {
                $aQuestion['aTag'] = Admin_Model_Type::getAll(
                    [
                        'where' => [
                            'iTypeID IN' => explode(',', $aQuestion['sTag']),
                            'iStatus' => 1
                        ]
                    ]
                );
            } else {
                $aQuestion['aTag'] = [];
            }

            //答案列表
            $aQuestion['aAnswer'] = Admin_Model_QuestionAnswer::getQuestionAnswer($aQuestion['iAutoID']);
        }
        return $aQuestion;
    }

    /**
     * @param int $iAnswerID
     * 获取某个答案的后续问题
     */
    public static function getNextQuestion($iAnswerID = 0)
    {
        $aQuestion = [];
        if ($iAnswerID > 0) {
            $row = Admin_Model_QeustionAnswer::getRow(
                [
                    'where' => [
                        'iStatus' => 1,
                        'iAutoID' => $iAnswerID
                    ]
                ]
            );
            if ($row) {
                $aQuestion = self::getQuestion($row['iNextID']);
            }
        }

        return $aQuestion;
    }


    public static function getAutocomplete($sKey)
    {
        $where = array(
            'iStatus' => 1
        );
        if (! empty($sKey)) {
            $where['sTitle LIKE'] = '%' . $sKey . '%';
        }
        $aList = self::getAll(array(
                'where' => $where,
                'limit' => 20
            ));

        foreach($aList as &$v) {
            $v['sTitle'] = $v['iAutoID'].'.'.$v['sTitle'];
            unset($v['iCategoryID'],$v['sDesc'],$v['sTag'],$v['iStatus'],$v['iCreateTime'],$v['iUpdateTime'],$v['iCreateUserID'],$v['iUpdateUserID']);
        }

        return $aList;
    }
}