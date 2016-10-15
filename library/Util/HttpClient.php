<?php

class Util_HttpClient
{

    private $ch;

    public $referer;

    public $content;

    public $cookie_jar = '';

    public $charset = 'utf-8';
    
    public $user_agent = 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25';
    
    public $USER_AGENTS = array(
        "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; AcooBrowser; .NET CLR 1.1.4322; .NET CLR 2.0.50727)",
        "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Acoo Browser; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.0.04506)",
        "Mozilla/4.0 (compatible; MSIE 7.0; AOL 9.5; AOLBuild 4337.35; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)",
        "Mozilla/5.0 (Windows; U; MSIE 9.0; Windows NT 9.0; en-US)",
        "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)",
        "Mozilla/5.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 1.0.3705; .NET CLR 1.1.4322)",
        "Mozilla/4.0 (compatible; MSIE 7.0b; Windows NT 5.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; InfoPath.2; .NET CLR 3.0.04506.30)",
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN) AppleWebKit/523.15 (KHTML, like Gecko, Safari/419.3) Arora/0.3 (Change: 287 c9dfb30)",
        "Mozilla/5.0 (X11; U; Linux; en-US) AppleWebKit/527+ (KHTML, like Gecko, Safari/419.3) Arora/0.6",
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2pre) Gecko/20070215 K-Ninja/2.1.1",
        "Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9) Gecko/20080705 Firefox/3.0 Kapiko/3.0",
        "Mozilla/5.0 (X11; Linux i686; U;) Gecko/20070322 Kazehakase/0.4.5",
        "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.8) Gecko Fedora/1.9.0.8-1.fc10 Kazehakase/0.5.6",
        "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
        "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_3) AppleWebKit/535.20 (KHTML, like Gecko) Chrome/19.0.1036.7 Safari/535.20",
        "Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; fr) Presto/2.9.168 Version/11.52",
    );
    
    public function __construct ($cookie = null, $charset = 'utf-8')
    {
        $this->charset = $charset;
        $this->ch = curl_init();
        $this->cookie_jar = Util_Tools::getSysTempDir() . '/cookie.txt';
        @unlink($this->cookie_jar);
    }

    public function setUrl ($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }

    public function setHeader ($state = false)
    {
        curl_setopt($this->ch, CURLOPT_HEADER, $state);
    }

    public function setNoBody ($state = false)
    {
        curl_setopt($this->ch, CURLOPT_NOBODY, $state);
    }

    public function setFollow ($state = true)
    {
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, $state);
    }

    public function setTimeout ($seconds = 180)
    {
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $seconds);
    }

    public function setReferer ($referer = '')
    {
        if ($referer) {
            curl_setopt($this->ch, CURLOPT_REFERER, $referer);
        } elseif ($this->referer) {
            curl_setopt($this->ch, CURLOPT_REFERER, $this->referer);
        }
    }

    public function setCookie ($key, $val, $expire, $path, $domain)
    {
        $str = "$domain\tTRUE\t$path\tFALSE\t$expire\t$key\t$val\n";
        file_put_contents($this->cookie_jar, $str, FILE_APPEND);
        // localhost FALSE / FALSE 0 sssss 99F4C3F391CCA395F92F54EEDAE8EC96%7C86240473%7C180.168.3.210%7C1306325403%7C0%7C0%7C0_0%7C0_0%7C0_0%7C0_0%7C0_0%7C0_0
    }

    public function setReturn ($state = true)
    {
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, $state);
    }

    public function exec ($tran = true, $method = 'get', $data = array())
    {
        $this->setFollow(true);
        $this->setReturn(true);
        $this->setTimeout(300);
        
        $user_agent = $this->USER_AGENTS[array_rand($this->USER_AGENTS)];
        curl_setopt($this->ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie_jar);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie_jar);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 300);
        if ($method == 'post') {
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        $this->content = curl_exec($this->ch);
        if (curl_errno($this->ch)) {
            echo 'Curl error: ' . curl_error($this->ch);
        }
        if ($this->charset != 'utf-8' && $tran == true) {
            $this->content = mb_convert_encoding($this->content, "utf-8", $this->charset);
        }
        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        return $code;
    }
    
    public function get ($url, $tran = true)
    {
        $this->setUrl($url);
        $this->setHeader(false);
        $this->setNoBody(false);
        $this->setReferer();
        $code = $this->exec($tran);
        $this->referer = $url;
        echo "Get: $url, code:$code\n";
        return $code;
    }

    public function getInfo ($url)
    {
        $this->setUrl($url);
        $this->setNoBody(true);
        $this->setHeader(true);
        $this->setReferer();
        return curl_getinfo($this->ch);
    }

    public function post ($url, $data)
    {
        $this->setUrl($url);
        $this->setHeader(false);
        $this->setNoBody(false);
        $this->setReferer($url);
        $code = $this->exec(true, 'post', $data);
        $this->referer = $url;
        echo "Post: $url, code:$code\n";
        return $code;
    }
    
    public function reFormat()
    {
        $this->content = str_replace(array("\n","\r"), " ", $this->content);
    }
    
    public function dataFormat($val)
    {
        return trim(html_entity_decode($val));
    }
    
    public function matchOne($pattern, $content = null)
    {
        if (empty($content)) {
            $content = $this->content;
        }
        if (preg_match($pattern, $content, $matches)) {
            foreach ($matches as &$val) {
                $val = $this->dataFormat($val);
            }
            return $matches;
        }
        
        return null;
    }
    
    public function matchAll($pattern, $type = 'all', $content = null)
    {
        if (empty($content)) {
            $content = $this->content;
        }
        if (preg_match_all($pattern, $content, $matches)) {
            if ($type == 'all') {
                $count = count($matches);
                $ret = array();
                foreach ($matches[1] as $k => $v) {
                    for ($i = 1; $i < $count; $i++) {
                        $ret[$k][] = $this->dataFormat($matches[$i][$k]);
                    }
                }
            } elseif ($type == 'col') {
                foreach ($matches[1] as &$val) {
                    $val = $this->dataFormat($val);
                }
                $ret = $matches[1];
            }
            
            return $ret;
        }
        
        return null;
    }

    public function __destruct ()
    {
        curl_close($this->ch);
    }
}