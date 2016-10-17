<?php

class Bootstrap extends Yaf_Bootstrap
{
    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new Tpa_Plugin_ActionLog());
    }
}