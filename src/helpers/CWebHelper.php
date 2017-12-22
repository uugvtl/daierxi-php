<?php

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/11
 * Time: 16:24
 *
 * Class CWebHelper
 */
class CWebHelper extends CBaseHelper
{
    /**
     * 获取标准域名
     * @param string $domain        一般域名
     * @return string               标准域名
     */
    public function getRegularDomain($domain)
    {
        if (substr ( $domain, 0, 7 ) == 'http://') {
            $domain = substr ( $domain, 7 );
        }
        if (strpos ( $domain, '/' ) !== false) {
            $domain = substr ( $domain, 0, strpos ( $domain, '/' ) );
        }
        return strtolower ( $domain );
    }

    /**
     * 获取顶级域名
     * @param string $domain        一般域名
     * @return string               顶级域名
     */
    public function getTopDomain($domain) {
        $domain = $this->getRegularDomain ( $domain );
        $iana_root = array (
            'ac',
            'ad',
            'ae',
            'aero',
            'af',
            'ag',
            'ai',
            'al',
            'am',
            'an',
            'ao',
            'aq',
            'ar',
            'arpa',
            'as',
            'asia',
            'at',
            'au',
            'aw',
            'ax',
            'az',
            'ba',
            'bb',
            'bd',
            'be',
            'bf',
            'bg',
            'bh',
            'bi',
            'biz',
            'bj',
            'bl',
            'bm',
            'bn',
            'bo',
            'bq',
            'br',
            'bs',
            'bt',
            'bv',
            'bw',
            'by',
            'bz',
            'ca',
            'cat',
            'cc',
            'cd',
            'cf',
            'cg',
            'ch',
            'ci',
            'ck',
            'cl',
            'cm',
            'cn',
            'co',
            'com',
            'coop',
            'cr',
            'cu',
            'cv',
            'cw',
            'cx',
            'cy',
            'cz',
            'de',
            'dj',
            'dk',
            'dm',
            'do',
            'dz',
            'ec',
            'edu',
            'ee',
            'eg',
            'eh',
            'er',
            'es',
            'et',
            'eu',
            'fi',
            'fj',
            'fk',
            'fm',
            'fo',
            'fr',
            'ga',
            'gb',
            'gd',
            'ge',
            'gf',
            'gg',
            'gh',
            'gi',
            'gl',
            'gm',
            'gn',
            'gov',
            'gp',
            'gq',
            'gr',
            'gs',
            'gt',
            'gu',
            'gw',
            'gy',
            'hk',
            'hm',
            'hn',
            'hr',
            'ht',
            'hu',
            'id',
            'ie',
            'il',
            'im',
            'in',
            'info',
            'int',
            'io',
            'iq',
            'ir',
            'is',
            'it',
            'je',
            'jm',
            'jo',
            'jobs',
            'jp',
            'ke',
            'kg',
            'kh',
            'ki',
            'km',
            'kn',
            'kp',
            'kr',
            'kw',
            'ky',
            'kz',
            'la',
            'lb',
            'lc',
            'li',
            'lk',
            'lr',
            'ls',
            'lt',
            'lu',
            'lv',
            'ly',
            'ma',
            'mc',
            'md',
            'me',
            'mf',
            'mg',
            'mh',
            'mil',
            'mk',
            'ml',
            'mm',
            'mn',
            'mo',
            'mobi',
            'mp',
            'mq',
            'mr',
            'ms',
            'mt',
            'mu',
            'museum',
            'mv',
            'mw',
            'mx',
            'my',
            'mz',
            'na',
            'name',
            'nc',
            'ne',
            'net',
            'nf',
            'ng',
            'ni',
            'nl',
            'no',
            'np',
            'nr',
            'nu',
            'nz',
            'om',
            'org',
            'pa',
            'pe',
            'pf',
            'pg',
            'ph',
            'pk',
            'pl',
            'pm',
            'pn',
            'pr',
            'pro',
            'ps',
            'pt',
            'pw',
            'py',
            'qa',
            're',
            'ro',
            'rs',
            'ru',
            'rw',
            'sa',
            'sb',
            'sc',
            'sd',
            'se',
            'sg',
            'sh',
            'si',
            'sj',
            'sk',
            'sl',
            'sm',
            'sn',
            'so',
            'sr',
            'ss',
            'st',
            'su',
            'sv',
            'sx',
            'sy',
            'sz',
            'tc',
            'td',
            'tel',
            'tf',
            'tg',
            'th',
            'tj',
            'tk',
            'tl',
            'tm',
            'tn',
            'to',
            'tp',
            'tr',
            'travel',
            'tt',
            'tv',
            'tw',
            'tz',
            'ua',
            'ug',
            'uk',
            'um',
            'us',
            'uy',
            'uz',
            'va',
            'vc',
            've',
            'vg',
            'vi',
            'vn',
            'vu',
            'wf',
            'ws',
            'xxx',
            'ye',
            'yt',
            'za',
            'zm',
            'zw'
        );
        $sub_domain = explode ( '.', $domain );
        $top_domain = '';
        $top_domain_count = 0;
        for($i = count ( $sub_domain ) - 1; $i >= 0; $i --) {
            if ($i == 0) {
                // just in case of something like NAME.COM
                break;
            }
            if (in_array ( $sub_domain [$i], $iana_root )) {
                $top_domain_count ++;
                $top_domain = '.' . $sub_domain [$i] . $top_domain;
                if ($top_domain_count >= 2) {
                    break;
                }
            }
        }
        $top_domain = $sub_domain [count ( $sub_domain ) - $top_domain_count - 1] . $top_domain;
        return $top_domain;
    }

    /**
     * 获取超文本协议
     * @return string       http:// 或是 https://
     */
    public function getProtocol()
    {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
                    && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        return $http_type;
    }

    /**
     * 采集远程文件内容
     * @param string $url       远程目标文件
     * @param string $ref       请求中的来源引用
     * @param array $post       请求参数
     * @param string $ua        浏览器参数
     * @param boolean $print     是否打印
     * @return mixed
     */
    public function xcurl($url,$ref=null,$post=array(),$ua="Mozilla/5.0 (X11; Linux x86_64; rv:2.2a1pre) Gecko/20110324 Firefox/4.2a1pre",$print=false) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        if(!empty($ref)) {
            curl_setopt($ch, CURLOPT_REFERER, $ref);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if(!empty($ua)) {
            curl_setopt($ch, CURLOPT_USERAGENT, $ua);
        }
        if(count($post) > 0){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $output = curl_exec($ch);
        curl_close($ch);
        if($print) {
            print($output);
            return true;
        } else {
            return $output;
        }

    }
    
    /**
     * Creates data URI string of an image file for CSS image embedding.
     * @param  string $file path to the file
     * @return string       data URI string
     */
    public function getDataUri($file) {
    
        $contents = file_get_contents($file);
        $base64 = base64_encode($contents);
        $imagetype = exif_imagetype($file);
        $mime = image_type_to_mime_type($imagetype);
        return "data:$mime;base64,$base64";
    }

    /**
     * 如果采用的fast_cgi模式可以使用此方法快速输出页面数据而不中断程序
     * @return boolean      如果存在此函数输出数据到client，且返回true, 否则返回false
     */
    public function fastcgi_finish_request()
    {
        $toggle = false;
        if(function_exists('fastcgi_finish_request'))
        {
            fastcgi_finish_request();
            $toggle = true;
        }
        return $toggle;

    }
    
    /**
     * 采集远程文件
     * @param string $remote 远程文件名
     * @param string $local 本地保存文件名
     * @return void
     */
    public function curlDownload($remote,$local)
    {
        $cp = curl_init($remote);
        $fp = fopen($local,"w");
        curl_setopt($cp, CURLOPT_FILE, $fp);
        curl_setopt($cp, CURLOPT_HEADER, 0);
        curl_exec($cp);
        curl_close($cp);
        fclose($fp);
    }
    
    
    /**
     * 获取真实的IP地址
     * @return string
     */
    public function getIp(){
        $realip = '';
        $unknown = 'unknown';
        if (isset($_SERVER)){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach($arr as $ip){
                    $ip = trim($ip);
                    if ($ip != 'unknown'){
                        $realip = $ip;
                        break;
                    }
                }
            }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){
                $realip = $_SERVER['REMOTE_ADDR'];
            }else{
                $realip = $unknown;
            }
        }else{
            if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){
                $realip = getenv("HTTP_CLIENT_IP");
            }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){
                $realip = getenv("REMOTE_ADDR");
            }else{
                $realip = $unknown;
            }
        }
        $realip = preg_match('/[\d\.]{7,15}/', $realip, $matches) ? $matches[0] : $unknown;
        return $realip;
    }
    
    /**
     * 返回IP的整数形式
     *
     * @param string $ip
     * @return string
     */
    public function getLongIp($ip = '')
    {
        if ($ip == '') {
            $ip = $this->getIp();
        }
    
        return sprintf("%u", ip2long($ip));
    }

    /**
     * 获取IP地址的真实位置
     * @param string $ip        IP地址
     * @return bool|mixed       IP地址的地理信息
     */
    public function GetIpLookup($ip = ''){
        if(empty($ip)){
            $ip = $this->getIp();
        }
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
        if(empty($res)){ return false; }
        $jsonMatches = array();
        preg_match('#\{.+?\}#', $res, $jsonMatches);
        if(!isset($jsonMatches[0])){ return false; }
        $json = json_decode($jsonMatches[0], true);
        if(isset($json['ret']) && $json['ret'] == 1){
            $json['ip'] = $ip;
            unset($json['ret']);
        }else{
            return false;
        }
        return $json;
    }

    /**
     * 判断是否微信端
     * @return bool     如果是微信访问返回true,否则返回false
     */
    public function is_weixin()
    {

        return strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false?true:false;

    }

    /**
     * 远程获取数据，POST模式
     * @param string $url 指定URL完整路径地址
     * @param array $para 请求的数据
     * @return mixed
     */
    public function getHttpResponsePOST($url, $para) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
        curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
        curl_setopt($curl,CURLOPT_POST,true); // post传输数据
        curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
        $responseText = curl_exec($curl);
        curl_close($curl);
        return $responseText;
    }

    /**
     * 远程获取数据，GET模式
     * @param string $url 指定URL完整路径地址
     * @return mixed
     */
    public function getHttpResponseGET($url) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
        $responseText = curl_exec($curl);
        curl_close($curl);
        return $responseText;
    }

    /**
     * 获取当前URL
     * @return string
     */
    public function getCurrentUrl(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        return $url;
    }
}

