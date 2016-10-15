<?php
$config['database']['default']['master'] = array(
    'dsn' => 'mysql:host=127.0.0.1;dbname=sas',
    'user' => 'root',
    'pass' => 'xjc.123',
    'init' => array(
        'SET CHARACTER SET utf8',
        'SET NAMES utf8'
    )
);
$config['database']['default']['salve'] = array(
    'dsn' => 'mysql:host=127.0.0.1;dbname=sas',
    'user' => 'root',
    'pass' => 'xjc.123',
    'init' => array(
        'SET CHARACTER SET utf8',
        'SET NAMES utf8'
    )
);

$config['cache']['bll'] = array(
    array(
        'host' => '127.0.0.1',
        'port' => 11211
    )
);

$config["mailer"] = array(
    'from_email' => 'pancke@163.com',
    'from_name' => 'pancke',
    'smtp_host' => 'smtp.163.com',
    'smtp_user' => 'pancke',
    'smtp_pass' => 'xjc.123',
    'smtp_port' => '25',
    'smtp_secure' => ''
);

$config['CCP'] = array(
    'host' => 'app.cloopen.com',
    // 'host' => 'sandboxapp.cloopen.com',
    'port' => '8883',
    'version' => '2013-12-26',
    'sid' => '8aaf070855c4a7270155c4ec742400b5',
    'token' => 'c9c81e8f6a4e42cab99406bddd62291e',
    'appid' => '8aaf070855c4a7270155c4ec749400bb'
);

$config['umeng'] = array(
    'appkey_android' => '5782f369e0f55a5989003612',
    'msecret_android' => 'jgujhub8j0yimnflkiagfdv4lwh7pglt',
    'umsecret_android' => '6f62475b5b20f463d99997439194acb2',
    'appkey_ios' => '5795bec4e0f55abba0002d62',
    'msecret_ios' => 'zatrmmtql0hpfnpolgig7ygs2sbcfwfx',
);

$config['wxConfig'] = [
    'APPID' => 'wxc8017e7331c66217',
    'APPSECRET' => '2ed256c70ea5dc8c8678244ababb515c',
    'TOKEN' => 'aaaabbbbccccdddd',
    'ACTIVESTART' => 'i5df1A34JOXCgjTzmSqHVGbYQ7bECYcKkd1t_A8iyYY',//浠诲姟寮�鎻愰啋妯℃澘
    'MCHID' => '1321444201', // 鍟嗘埛ID
    'PAYKEY' => '69805779a07a78588a5c07c71ce400a5', // MD5 ("m18116208033@163.com")
];

$config['mongodb']['fangjl'] = array(
    'dsn' => 'mongodb://139.196.189.143:27017/fangjl',
    'query_safety' => null
);

$config['mongodb']['fangjl2'] = array(
    'dsn' => 'mongodb://139.196.189.143:27017/fangjl2',
    'query_safety' => null
);
