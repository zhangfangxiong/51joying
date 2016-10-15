<?php

/**
 * 提供网站首页
 * Created by PhpStorm.
 * User: xiejinci
 * Date: 14/12/24
 * Time: 下午2:32
 */
class Index_Controller_Index extends Yaf_Controller
{

    public function indexAction()
    {
        $this->setFrame('none.phtml');
    }
}