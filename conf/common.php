<?php
//登录cookie配置
$config['cookie']['prefix'] = 'tpa';
$config['cookie']['authkey'] = 'auth';
$config['cookie']['cryptkey'] = 'kdi##20.83(&%$63ldwl';
$config['cookie']['ad'] = 'ad';
$config['cookie']['media'] = 'media';
$config['cookie']['frontexpire'] = 86400 * 30;
$config['cookie']['signkey'] = 'fangjl@31241kd8i';
$config['cookie']['indexuserkey'] = 'authindex';//前端用户cookie的key

//密码加密
$config['passwd']['cryptkey'] = 'kdil2!!@8EfJI37.020##dEie';

//URL规则
$config['route']['rewrite'] = array(
    '/^$/'         => '/fangjl/web/index/index',
    '/^makesign/'  => '/fangjl/web/index/make',
    '/^aboutus$/'  => '/fangjl/web/index/aboutus',
    '/^contactus$/'  => '/fangjl/web/index/contactus',

    // Image View
    '/^view\/(?<biz>banner)\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)\.(?<ext>jpg|gif|png|bmp)$/i'            => '/file/index/view',
    '/^view\/(?<biz>banner)\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)_(?<crop>c)\.(?<ext>jpg|gif|png|bmp)$/i' => '/file/index/view',
    '/^view\/(?<biz>banner)\/(?<key>[a-z0-9]{40})\.(?<ext>.*)$/i'                                 => '/file/index/view',
    '/^view\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)\.(?<ext>jpg|gif|png|bmp)$/i'                                 => '/file/index/view',
    '/^view\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)_(?<crop>c)\.(?<ext>jpg|gif|png|bmp)$/i'                      => '/file/index/view',
    '/^view\/(?<key>[a-z0-9]{40})\.(?<ext>.*)$/i'                                                      => '/file/index/view',

    // File Download
    '/^download\/(?<biz>banner)\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)\.(?<ext>jpg|gif|png|bmp)$/i'            => '/file/index/download',
    '/^download\/(?<biz>banner)\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)_(?<crop>c)\.(?<ext>jpg|gif|png|bmp)$/i' => '/file/index/download',
    '/^download\/(?<biz>banner)\/(?<key>[a-z0-9]{40})\.(?<ext>.*)$/i'                                 => '/file/index/download',
    '/^download\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)\.(?<ext>jpg|gif|png|bmp)$/i'                                 => '/file/index/download',
    '/^download\/(?<key>[a-z0-9]{40})\/(?<w>\d+)x(?<h>\d+)_(?<crop>c)\.(?<ext>jpg|gif|png|bmp)$/i'                      => '/file/index/download',
    '/^download\/(?<key>[a-z0-9]{40})\.(?<ext>.*)$/i'                                => '/file/index/download',
);

$config['sImgFont'] = APP_PATH.'/../conf/STZHONGS.ttf';

$config['domain']['www']        = ENV_DOMAIN;
$config['domain']['static']     = ENV_DOMAIN;
$config['domain']['file']       = ENV_DOMAIN;

// LOG配置
$config['logger']['sBaseDir'] = APP_PATH . '/../logs';
$config['logger']['common'] = array(
    'sSplit' => 'Ymd',
    'sDir' => 'common'
);

// URL配置
$config['url']['upload'] = 'http://' . ENV_DOMAIN . '/file/upload';
$config['url']['dfsview'] = 'http://' . ENV_DOMAIN . '/view';
$config['url']['bannerupload'] = 'http://' . ENV_DOMAIN . '/file/bannerupload';

// 邮箱跳转
$config['aMailServer'] = array(
    '163.com' => 'http://mail.163.com',
    'gmail.com' => 'https://gmail.com',
    'qq.com' => 'http://mail.qq.com',
    '126.com' => 'http://mail.126.com',
    'sohu.com' => 'http://mail.sohu.com',
    'sina.com.cn' => 'http://mail.sina.com.cn',
    '139.com' => 'http://mail.10086.cn',
    'tom.com' => 'http://mail.tom.com',
    'aliyun.com' => 'https://mail.aliyun.com'
);

// 短信模板
$config['aSmsTempID'] = array(
     8 => 101953,        //修改账户
     11 => 101951,		 //登录验证
);

$config['aRoomType'] = array(
    '一房',
    '二房',
    '三房',
    '四房',
    '五房',
    '六房',
    '七房',
    '八房',
    '复式',
    '联排',
    '叠加',
    '独栋',
    '双拼',
    '其他'
);

$config['aSaleStatus'] = array(
    '未公开',
    '形象',
    '蓄水期',
    '预售',
    '销售',
    '尾盘',
    '售罄',
    '烂尾楼'
);

$config['newsType'] = array(
    1 => '营销活动',
    2 => '成交动态',
    3 => '供应动态',
    4 => '价格变化',
    5 => '资讯动态'
);

// 1:营销活动；2：成交动态；3：供应动态；4：价格变化

$config['sourceType'] = array(
    'anjuke' => '安居客',
    'fang' => '搜房',
    'fangjl' => '房精灵'
);


// 消费类别
$config['aConsumeType'] = array(
    '1' => '提现',
    '2' => '充值',
    '3' => '增值业务'
);

// 消费项目
$config['aConsumeIterm'] = array(
    '1' => '提现',
    '2' => '续费',
    '3' => '竞品添加'
);
//子帐号最大添加个数
$config['iUserChildMax'] = 5;

// 动态类型对应icon
$config['newsTypeIcon'] = array(
    1 => 'dy_yx',
    2 => 'dy_chj',
    3 => 'dy_gy',
    4 => 'dy_jg'
);



return $config;