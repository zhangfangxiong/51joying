<?php

class Tijian_Controller_Cmd_Base extends Yaf_Controller
{
    
    public function actionBefore ()
    {
        $this->autoRender(false);
    }
}