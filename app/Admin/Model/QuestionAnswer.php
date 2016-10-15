<?php
/**
 * Created by PhpStorm.
 * User: yaobiqing
 * Date: 16/4/20
 * Time: 上午10:31
 */

class Admin_Model_QuestionAnswer extends Admin_Model_Base
{
    const TABLE_NAME = 't_question_answer';
    const PK_FIELD = 'iAutoID';
    
    const NO_BELONG_QUESTION = 101;
    const ANSWER_IS_EMPTY = 102;

    private static $aMessage = [
        self::NO_BELONG_QUESTION => '没有所属问题',
        self::ANSWER_IS_EMPTY => '答案不能为空',
    ];

    /**
     * 操作问题
     * iAutoID 大于0则更新 否则新增
     */
    public static function save($aData, $iAutoID = 0, $iUserID = 0)
    {
        $mResult = self::checkData($aData);
        if ($mResult === true) {
            if ($iAutoID > 0) {
                $aData['iUpdateUserID'] = $iUserID;
                $aData['iAutoID'] = $iAutoID;
                self::updData($aData);
            } else {
                $aData['iCreateUserID'] = $aData['iUpdateUserID'] = $iUserID;
                $iAutoID = self::addData($aData);
            }
            return ['iCode' => 200, 'sMessage' => '答案信息提交成功', 'iQuestionID' => $iAutoID];
        }
        return $mResult;

    }

    public static function getQuestionAnswer($iQuestionID)
    {
        return Admin_Model_QuestionAnswer::getAll(
            [
                'where' => [
                    'iBelongID' => $iQuestionID,
                    'iStatus' => 1
                ],
                'order' => 'iOrder DESC, iAutoID DESC'
            ]);
    }

    public static function getAnswer($iAnswerID) {
        $aAnswer = self::getRow(
            [
                'where' => [
                    'iStatus' => 1,
                    'iAutoID' => $iAnswerID
                ]
            ]
        );
        if ($aAnswer) {
            //分类信息
            if($aAnswer['sTag']) {
                $aAnswer['aTag'] = Admin_Model_Type::getAll(
                    [
                        'where' => [
                            'iTypeID IN' => explode(',', $aAnswer['sTag']),
                            'iStatus' => 1
                        ]
                    ]
                );
            } else {
                $aAnswer['aTag'] = [];
            }
            if ($aAnswer['iNextID']) {
                $aNext = Admin_Model_Question::getDetail($aAnswer['iNextID']);
            } else {
                $aNext = [];
            }
            $aAnswer['aNext'] = $aNext;

        }
        return $aAnswer;
    }
    /**
     * @param $aData
     * 检测参数的有效性
     */
    public static function checkData($aData)
    {
        if(!isset($aData['iBelongID']) || $aData['iBelongID'] == 0) {
            return ['iCode' => self::NO_BELONG_QUESTION, 'sMessage' => self::$aMessage[self::NO_BELONG_QUESTION]];
        }

        if (empty($aData['sAnswer'])) {
            return ['iCode' => self::ANSWER_IS_EMPTY, 'sMessage' => self::$aMessage[self::ANSWER_IS_EMPTY]];
        }

        return true;
    }
}