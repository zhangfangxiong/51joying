<?php
//后台进程配置 i:H:d:m:w
$config = array(
    array('path' => '/sas/bonus/run', 'cron' => '15 8 * * 4', 'num' => 1),//每周四凌晨跑
    array('path' => '/sas/ciholder/run', 'cron' => '15 4 * * 3', 'num' => 1),//每周三凌晨跑
    array('path' => '/sas/cwfx/run', 'cron' => '15 5 * * 2', 'num' => 1),//每月二凌晨跑
    array('path' => '/sas/fund/run', 'cron' => '15 3 * * 1', 'num' => 1),//每月一凌晨跑
    array('path' => '/sas/holder/run', 'cron' => '15 2 * * 1', 'num' => 1),//每月一凌晨跑
    array('path' => '/sas/mfratio/run', 'cron' => '15 3 1 * *', 'num' => 1),//每月1号凌晨跑
    array('path' => '/sas/price/run', 'cron' => '15 2 * * *', 'num' => 1),//每天凌晨跑
    array('path' => '/sas/stock/run', 'cron' => '15 1 * * 1', 'num' => 1),//每周一凌晨跑
);

return $config;
