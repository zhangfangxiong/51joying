<?php
/**
 * Created by PhpStorm.
 * User: yaobiqing
 * Date: 16/4/20
 * Time: 下午1:39
 */

/**
 * Class Admin_Controller_Question
 * 问题库管理
 */
class Admin_Controller_Question extends Admin_Controller_Base
{

    /**
     * 问题列表
     */
    public function listAction()
    {
        $iPage = intval($this->getParam('page'));
        if (isset($_GET['page'])) {
            $iPage = $_GET['page'];
        }
        $aWhere = array(
            'iStatus' => 1
        );
        $aList = Admin_Model_Question::getList($aWhere, $iPage, 'iAutoID DESC');
        $this->assign('aList', $aList);
    }

    /**
     * 问题添加
     */
    public function addAction()
    {

        if ($this->isPost()) {

            $iQuestionID = 0;
            $result = Admin_Model_Question::save($this->getParams(), $iQuestionID, $this->aCurrUser['iAdminID']);
            if ($result['iCode'] == 200) {
                return $this->showMsg($result['sMessage'], true);
            } else {
                return $this->showMsg($result['sMessage'], false);
            }
        } else {

            $qCatClass = Admin_Model_Type::getClass('qcat');
            $this->assign('iClassLevel', $qCatClass['iLevel']);
            $this->assign('sClassName', $qCatClass['sTitle']);
            $aQcat = Admin_Model_Type::getTypes('qcat');
            $this->assign('aQcat', $aQcat);

            $aGroupTags = $this->getTags();
            $this->assign('aTag', $aGroupTags);
        }
    }


    private function getTags()
    {
        $sql = "select *, REPLACE(REPLACE(sRemark, CHAR(10), ''), CHAR(13), '') as cat from t_type where sClass='qtag' and iStatus=1 and sRemark!='' group by REPLACE(REPLACE(sRemark, CHAR(10), ''), CHAR(13), '')";
        $group = Admin_Model_Type::query($sql);
        foreach($group as $key => $value) {
            $sql = "select * from ".Admin_Model_Type::TABLE_NAME." where sClass='qtag' and iStatus=1 and REPLACE(REPLACE(sRemark, CHAR(10), ''), CHAR(13), '')='".$value['cat']."' order by iOrder ASC";
            $aTags = Admin_Model_Type::query($sql);
            $group[$key]['aTags'] = Admin_Model_Type::query($sql);

        }
        return $group;
    }
    /**
     * 问题编辑
     */
    public function editAction()
    {
        if ($this->isPost()) {

            $iQuestionID = intval($this->getParam('iQuestionID'));
            $result = Admin_Model_Question::save($this->getParams(), $iQuestionID, $this->aCurrUser['iAdminID']);
            if ($result['iCode'] == 200) {
                return $this->showMsg($result['sMessage'], true);
            } else {
                return $this->showMsg($result['sMessage'], false);
            }
        } else {

            $iQuestionID = intval($this->getParam('id'));

            $aQuestion = Admin_Model_Question::getQuestion($iQuestionID);
            $qCatClass = Admin_Model_Type::getClass('qcat');
            $this->assign('iClassLevel', $qCatClass['iLevel']);
            $this->assign('sClassName', $qCatClass['sTitle']);
            $this->assign('aQuestion', $aQuestion);
            $aQcat = Admin_Model_Type::getTypes('qcat');
            $this->assign('aQcat', $aQcat);

            $aGroupTags = $this->getTags();
            $this->assign('aTag', $aGroupTags);
        }

    }

    /**
     * 问题删除
     *
     * @return boolean
     */
    public function delAction()
    {
        $iQuestionID = $this->getParam('id');
        if (!$iQuestionID) {
            return $this->showMsg('非法操作！', false);
        }

        if (is_string($iQuestionID) && strpos($iQuestionID, ",") === false) {
            $iQuestionID = array($iQuestionID);
        } elseif (is_string($iQuestionID) && strpos($iQuestionID, ",")) {
            $iQuestionID = explode(",", $iQuestionID);
        } else {
            return $this->showMsg('非法操作！', false);
        }

        $fail_article = array();
        foreach ($iQuestionID as $key => $value) {
            $iRet = Admin_Model_Question::delData($value);
            if ($iRet != 1) {
                $fail_article[] = $value;
            }
        }

        if (empty($fail_article)) {
            return $this->showMsg('问题删除成功！', true);
        }
        $ids = join(',', $fail_article);

        return $this->showMsg('问题' . $ids . '删除失败！', false);
    }

    /**
     * 问题答案
     */
    public function answerAction()
    {
        $iAnswerID = $this->getParam('id');
        $aQuestion = Admin_Model_Question::getQuestion($iAnswerID);
        if (!empty($aQuestion['aAnswer'])){
            foreach($aQuestion['aAnswer'] as $key => $value) {
                $aNext = Admin_Model_Question::getQuestion($value['iNextID']);
                if ($aNext) {
                    $aQuestion['aAnswer'][$key]['sNextQuestion'] = $aNext['iAutoID'].'.'.$aNext['sTitle'];
                } else {
                    $aQuestion['aAnswer'][$key]['sNextQuestion'] = '';
                }

            }
        }
//        print_r($aQuestion);
        $this->assign('aQuestion', $aQuestion);


    }

    public function answerAddAction()
    {
        $iQuestionID = $this->getParam('qid');
        $this->assign('iQuestionID', $iQuestionID);
        $aGroupTags = $this->getTags();
        $this->assign('aTag', $aGroupTags);
    }

    public function answerEditAction()
    {
        $iQuestionID = $this->getParam('qid');
        $iAnswerID = $this->getParam('aid');
        $aAnswer = Admin_Model_QuestionAnswer::getAnswer($iAnswerID);
        $this->assign('aAnswer', $aAnswer);
        $this->assign('iQuestionID', $iQuestionID);
        $aGroupTags = $this->getTags();
        $this->assign('aTag', $aGroupTags);
    }
    /**
     * 问题删除
     *
     * @return boolean
     */
    public function answerdelAction()
    {
        $iAnswerID = $this->getParam('id');
        if (!$iAnswerID) {
            return $this->showMsg('非法操作！', false);
        }

        if (is_string($iAnswerID) && strpos($iAnswerID, ",") === false) {
            $iAnswerID = array($iAnswerID);
        } elseif (is_string($iAnswerID) && strpos($iAnswerID, ",")) {
            $iAnswerID = explode(",", $iAnswerID);
        } else {
            return $this->showMsg('非法操作！', false);
        }

        $fail_answer = array();
        foreach ($iAnswerID as $key => $value) {
            $iRet = Admin_Model_QuestionAnswer::delData($value);
            if ($iRet != 1) {
                $fail_answer[] = $value;
            }
        }

        if (empty($fail_answer)) {
            return $this->showMsg('答案删除成功！', true);
        }
        $ids = join(',', $fail_answer);

        return $this->showMsg('答案' . $ids . '删除失败！', false);
    }


    /**
     * 问题答案编辑
     */
    public function answerSaveAction()
    {
        if ($this->isPost()) {

            $iAnswerID = intval($this->getParam('iAnswerID'));
//            print_r($this->aCurrUser);
            $result = Admin_Model_QuestionAnswer::save($this->getParams(), $iAnswerID, $this->aCurrUser['iAdminID']);
            if ($result['iCode'] == 200) {
                return $this->showMsg($result['sMessage'], true);
            } else {
                return $this->showMsg($result['sMessage'], false);
            }
        }
    }

    public function nextQuestionAction()
    {

        $sKey = $this->getParam('key');
        $aList = Admin_Model_Question::getAutocomplete($sKey);
        return $this->showMsg($aList, true);

    }
}