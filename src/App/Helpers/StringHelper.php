<?php
namespace App\Helpers;
use App\Globals\Bases\BaseSingle;
use DateTime;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/11
 * Time: 16:24
 *
 * Class CStringHelper
 */
class StringHelper extends BaseSingle
{

    /**
     * 获取dispatch过来的类名称
     * @param string $className     带有-或是_类名称
     * @return string               返回passcal类名称
     */
    public function getDistributeFileName($className)
    {
        $className = str_replace('_', ' ', $className);
        $className = str_replace('-', ' ', $className);
        $className = str_replace(' ', '', ucwords($className));
        $className = ucwords(str_replace('\\', ' ', $className));
        return str_replace(' ', '\\', $className);

    }

    /**
     * 数据库字段处理空字符串插入值
     * @param string $str   需转换字符串
     * @param int $def   转换结果值
     * @return int
     */
    public function nullStringToInteger($str,$def=0){
        if(empty($str) || is_null($str)){
            return $def;
        }
        return $str;
    }

    /**
     * 生成Guid主键
     * @return string
     */
    public function keyGen() {
        return str_replace('-','',substr($this->uuid(),1,-1));
    }

    /**
     * 获取超强的加密字符串
     * @param string $hash      需要加密的字符串
     * @param int $times        加密强度
     * @return string           128位长度的加密字符串
     */
    public function fue($hash,$times=1) {
        // Execute the encryption(s) as many times as the user wants
        for($i=$times;$i>0;$i--) {
            // Encode with base64...
            $hash=base64_encode($hash);
            // and md5...
            $hash=md5($hash);
            // sha1...
            $hash=sha1($hash);
            // sha256... (one more)
            $hash=hash("sha256", $hash);
            // sha512
            $hash=hash("sha512", $hash);
    
        }
        // Finaly, when done, return the value
        return $hash;
    }
    
    /**
     * 获取一个字符串的sha1后的md5值
     * @param string $str           需要散列的字符串
     * @return string               散列后的字符串
     */
    public function cryptString($str)
    {
        return md5(sha1($str));
    }
    
    /**
     * 把一串字符按指定的长度分解，在其中加入<br />标签
     * @param string		$origin		原始字符串
     * @param int			$length		每节字符串的长度
     * @param string		$separated	分隔符
     * @param string        $charset    字符编码
     * @return string					已经处理好的字符串
     */
    public function split($origin, $length=30, $separated="<br />", $charset='UTF-8')
    {
        
        $totalLength = mb_strlen($origin, $charset);
    
        $loopLength = ceil(($totalLength / $length));
    
        $destination = $delimiter = "";
    
        for ($i=0;$i<$loopLength;$i++)
        {
            $step = $i*$length;
            $destination.= $delimiter.mb_substr($origin, $step, $length, $charset);
            $delimiter=$separated;
        }
    
        return $destination;
    }
    
    /**
     * 生成UUID 单机使用
     * @return string
     */
    public function uuid() {
        $uuid = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        return strtolower($uuid);
    }


    /**
     * 计算字符串长度
     *
     * @param string $str 要计算的字符串
     * @param string $enc 默认utf8编码
     * @return int
     */
    public function strLen($str, $enc = 'gb2312')
    {
        return min(array(mb_strlen($str, $enc), mb_strlen($str, 'utf-8')));
    }
    
    /**
     * Add's _1 to a string or increment the ending number to allow _2, _3, etc
     *
     * @param	string	$str required
     * @param	string	$separator What should the duplicate number be appended with
     * @param	int	    $first Which number should be used for the first dupe increment
     * @return	string
     */
    public function incrementString($str, $separator = '_', $first = 1)
    {
        preg_match('/(.+)'.preg_quote($separator, '/').'([0-9]+)$/', $str, $match);
        return isset($match[2]) ? $match[1].$separator.($match[2] + 1) : $str.$separator.$first;
    }
    
    /**
     * Reduce Multiples
     *
     * Reduces multiple instances of a particular character.  Example:
     *
     * Fred, Bill,, Joe, Jimmy
     *
     * becomes:
     *
     * Fred, Bill, Joe, Jimmy
     *
     * @param	string  $str
     * @param	string	$character the character you wish to reduce
     * @param	bool	$trim TRUE/FALSE - whether to trim the character from the beginning/end
     * @return	string
     */
    public function reduceMultiples($str, $character = ',', $trim = FALSE)
    {
        $str = preg_replace('#'.preg_quote($character, '#').'{2,}#', $character, $str);
        return ($trim === TRUE) ? trim($str, $character) : $str;
    }

    /**
     * 获取以半角逗号分隔且每个元素都经过转义如 'a','b'
     * @param array $rows       一组元素列表
     * @return string           合成后的字符串
     */
    public function getSplitQuote(array $rows)
    {
        $str = '';

        if($rows)
        {
            $rows   = array_map(array('CStringHelper', 'htmlEncode'), $rows);
            $rows   = array_map(array('CStringHelper', 'quoteValue'), $rows);
            $str    = implode(',', $rows);
        }

        return $str;
    }

    /**
     * 获取SQL语句在更新或新增时的SET写法语句
     * @param array $rows               需要更新或是新增的数据key,value键值对
     * @return string                   SQL的SET写法语句
     */
    public function getAssignSql(array $rows)
    {
        $rows         = array_map(array('CStringHelper', 'htmlEncode'), $rows);
        $aQuoteRows   = array_map(array('CStringHelper', 'quoteValue'), $rows);

        $stmt = $split = "";
        foreach($aQuoteRows as $k=>$v)
        {
            $stmt.= $split."{$k}={$v}";
            $split = ",";
        }

        return $stmt;
    }
    
    /**
     * 检测密码强度
     * @param String $string
     * @return float
     *
     * Returns a float between 0 and 100. The closer the number is to 100 the
     * the stronger password is; further from 100 the weaker the password is.
     */
    public function passwordStrength($string){
        $h    = 0;
        $size = strlen($string);
        foreach(count_chars($string, 1) as $v){
            $p = $v / $size;
            $h -= $p * log($p) / log(2);
        }
        $strength = ($h / 4) * 100;
        if($strength > 100){
            $strength = 100;
        }
        return $strength;
    }
    
    /**
     * Reduce Double Slashes
     *
     * Converts double slashes in a string to a single slash,
     * except those found in http://
     *
     * http://www.some-site.com//index.php
     *
     * becomes:
     *
     * http://www.some-site.com/index.php
     *
     * @param	string
     * @return	string
     */
    public function reduceDoubleSlashes($str)
    {
        return preg_replace('#(^|[^:])//+#', '\\1/', $str);
    }
    
    /**
     * Trim Slashes
     *
     * Removes any leading/trailing slashes from a string:
     *
     * /this/that/theother/
     *
     * becomes:
     *
     * this/that/theother
     *
     * @param	string
     * @return	string
     */
    public function trimSlashes($str)
    {
        return trim($str, '/');
    }
    
    /**
     * Strip Slashes
     *
     * Removes slashes contained in a string or in an array
     *
     * @param	mixed	string or array
     * @return	mixed	string or array
     */
    public function stripSlashes($str)
    {
        if ( ! is_array($str))
        {
            return stripslashes($str);
        }
    
        foreach ($str as $key => $val)
        {
            $str[$key] = $this->stripSlashes($val);
        }
    
        return $str;
    }
    
    /**
     * Strip Quotes
     *
     * Removes single and double quotes from a string
     *
     * @param	string
     * @return	string
     */
    public function stripQuotes($str)
    {
        return str_replace(array('"', "'"), '', $str);
    }
    
    /**
     * 给字符串加上引号
     * @param string $str	需要加引号的字符串
     * @return string       加过引号的字符串
     */
    public function quoteValue($str)
    {
        $quoteValue = $str;

        if(is_string($str) || is_null($str) || is_numeric($str))
        {
            $quoteValue = addslashes(trim($str));
            $quoteValue = sprintf("'%s'", $quoteValue);
        }
        return $quoteValue;
    }

    /**
     * 字符串转码为16进制数
     * @param string $str   转码前的字符串
     * @return string       转码后的字符串
     */
    public function hexEncode($str)
    {
        return bin2hex($str);
    }
    
    /**
     * 16进制数转码为字符串
     * @param string $str  转码后的字符串
     * @return string       转码前的字符串
     */
    public function hexDecode($str)
    {
        return pack('H*', $str);
    }
    
    /**
     * 使用htmlspecialchars转码数据--主要是为了兼容性
     * @param string $str		需要用htmlspecialchars转码的数据
     * @return string			转码后的数据
     */
    public function htmlEncode($str)
    {
        return $this->encode($str);
    }
    
    /**
     * 使用htmlspecialchars转码数据
     * @param string $str		需要用htmlspecialchars转码的数据
     * @return string			转码后的数据
     */
    public function encode($str)
    {
        $quoteValue = $str;
        if(is_string($str) || is_null($str))
        {
            $quoteValue = trim($str);
            $quoteValue = htmlspecialchars($quoteValue,ENT_QUOTES,'UTF-8');
        }
    
        return $quoteValue;
    }
    
    /**
     * 解码htmlspecialchars转码的数据--主要是为了兼容性
     * @param string $str		需要用解码的数据
     * @return string			解码后的数据
     */
    public function htmlDecode($str)
    {
        return $this->decode($str);
    }
    
    /**
     * 解码htmlspecialchars转码的数据
     * @param string $str		需要用解码的数据
     * @return string			解码后的数据
     */
    public function decode($str)
    {
        return htmlspecialchars_decode($str,ENT_QUOTES);
    }
    
    /**
     * 对字符串进行压缩
     * @param string $str       原始字符串
     * @return string           压缩后的字符串
     */
    public function gzdeflate($str)
    {
        return gzdeflate($str,9);
    }

    /**
     * 对压缩后的字符串还原
     * @param string $str       压缩后的字符串
     * @return string           原始字符串
     */
    public function gzinflate($str)
    {
        return gzinflate($str);
    }
    
    /**
     * 获取订单编号
     * @return string 订单编号--长度为19
     */
    public function getNumString()
    {
        //哪年,哪天,哪一秒
        $orderSn = date('Y') . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $orderSn;
    }
    
    /**
     * 产生随机字串，可用来自动生成密码
     * 默认长度6位 字母和数字混合 支持中文
     * @param int $len 长度
     * @param int $type 字串类型
     * 0 字母 1 数字 其它 混合
     * @param string $addChars 额外字符
     * @return string
     */
     public function randomString($len=6,$type=0,$addChars='') {
        $str ='';
        switch($type) {
            case 0:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            case 1:
                $chars= str_repeat('0123456789',3);
                break;
            case 2:
                $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
                break;
            case 3:
                $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
                break;
            case 4:
                $chars = "们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借".$addChars;
                break;
            default :
                // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
                $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
                break;
        }

        if($len>10 ) {//位数过长重复字符串一定次数
            $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
        }
        if($type!=4) {
            $chars   =   str_shuffle($chars);
            $str     =   substr($chars,0,$len);
        }else{
            // 中文随机字
            for($i=0;$i<$len;$i++){
                $str.= $this->msubstr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1,'utf-8',false);
            }
        }
        return $str;
    }
    
    /**
     * Create a Random Alphanum
     *
     * Useful for generating passwords or hashes.
     *
     * @param	string	$type type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
     * @param	int	$len number of characters
     * @return	string
     */
    public function randomAlphanum($type = 'alnum', $len = 8)
    {
        $pool = '';

        switch ($type)
        {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type)
                {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique':
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt':
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }

        return $pool;
    }
    
    /**
     *  带格式生成随机字符 支持批量生成
     *  但可能存在重复
     * @param string $format 字符格式
     *     # 表示数字 * 表示字母和数字 $ 表示字母
     * @param integer $number 生成数量
     * @return string | array
     */
    public function buildFormatRand($format,$number=1) {
        $strtemp = '';
        $str  =  array();
        $length =  strlen($format);
        for($j=0; $j<$number; $j++) {
            $strtemp   = '';
            for($i=0; $i<$length; $i++) {
                $char = substr($format,$i,1);
                switch($char){
                    case "*"://字母和数字混合
                        $strtemp   .= $this->randomString(1);
                        break;
                    case "#"://数字
                        $strtemp  .= $this->randomString(1,1);
                        break;
                    case "$"://大写字母
                        $strtemp .=  $this->randomString(1,2);
                        break;
                    default://其他格式均不转换
                        $strtemp .=   $char;
                        break;
                }
            }
            $str[] = $strtemp;
        }
        return $number==1? $strtemp : $str ;
    }
    
    /**
     * 生成一定数量的随机数，并且不重复
     * @param integer $number 数量
     * @param int $length 长度
     * @param int $mode 字串类型
     * 0 字母 1 数字 其它 混合
     * @return mixed
     */
    public function buildCountRand ($number,$length=4,$mode=1) {
        if($mode==1 && $length<strlen($number) ) {
            //不足以生成一定数量的不重复数字
            return false;
        }
        $rand   =  array();
        for($i=0; $i<$number; $i++) {
            $rand[] =   $this->randomString($length,$mode);
        }
        $unqiue = array_unique($rand);
        if(count($unqiue)==count($rand)) {
            return $rand;
        }
        $count   = count($rand)-count($unqiue);
        for($i=0; $i<$count*3; $i++) {
            $rand[] =   $this->randomString($length,$mode);
        }
        $rand = array_slice(array_unique ($rand),0,$number);
        return $rand;
    }
    
    /**
     * 获取一定范围内的随机数字 位数不足补零
     * @param integer $min 最小值
     * @param integer $max 最大值
     * @return string
     */
    public function randNumber ($min, $max) {
        return sprintf("%0".strlen($max)."d", mt_rand($min,$max));
    }
    
    /**
     * 校验身份证号码
     *
     * @param string $id_card
     * @param bool|true $just_check_length 是否只校验长度
     * @return bool
     */
    public function checkIDCard($id_card, $just_check_length = true)
    {
        //长度校验
        $length_validate = preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $id_card) === 1;
        if ($just_check_length) {
            return $length_validate;
        }
    
        $city_code = array(
            11 => true, 12 => true, 13 => true, 14 => true, 15 => true,
            21 => true, 22 => true, 23 => true,
            31 => true, 32 => true, 33 => true, 34 => true, 35 => true, 36 => true, 37 => true,
            41 => true, 42 => true, 43 => true, 44 => true, 45 => true, 46 => true,
            50 => true, 51 => true, 52 => true, 53 => true, 54 => true,
            61 => true, 62 => true, 63 => true, 64 => true, 65 => true,
            71 => true,
            81 => true, 82 => true,
            91 => true,
        );
    
        //地区校验
        if (!isset($city_code[$id_card[0] . $id_card[1]])) {
            return false;
        }
    
        //生成校验码
        $make_verify_bit = function ($id_card) {
            if (strlen($id_card) != 17) {
                return null;
            }
    
            $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            //校验码对应值
            $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
            $checksum = 0;
            for ($i = 0; $i < 17; $i++) {
                $checksum += $id_card[$i] * $factor[$i];
            }
    
            $mod = $checksum % 11;
            $verify_number = $verify_number_list[$mod];
            return $verify_number;
        };
    
        $id_card_length = strlen($id_card);
        if ($id_card_length == 15) {
            //超出百岁特殊编码
            if (array_search(substr($id_card, 12, 3), array('996', '997', '998', '999')) !== false) {
                $id_card = substr($id_card, 0, 6) . '18' . substr($id_card, 6, 9);
            } else {
                $id_card = substr($id_card, 0, 6) . '19' . substr($id_card, 6, 9);
            }
    
            $id_card .= $make_verify_bit($id_card);
        } else {
            //校验最后一位
            if (strcasecmp($id_card[17], $make_verify_bit(substr($id_card, 0, 17))) != 0) {
                return false;
            }
        }
    
        //校验出生日期
        $birth_day = substr($id_card, 6, 8);
        $d = new DateTime($birth_day);
        if ($d->format('Y') > date('Y') || $d->format('m') > 12 || $d->format('d') > 31) {
            return false;
        }
    
        return true;
    }

    /**
     * 字符串截取，支持中文和其他编码
     * @static
     * @access public
     * @param string $str 需要转换的字符串
     * @param int $start 开始位置
     * @param string $length 截取长度
     * @param string $charset 编码格式
     * @param boolean $suffix 截断显示字符
     * @return string
     */
    public function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
        if(function_exists("mb_substr"))
            $slice = mb_substr($str, $start, $length, $charset);
        elseif(function_exists('iconv_substr')) {
            $slice = iconv_substr($str,$start,$length,$charset);
        }else{
            $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("",array_slice($match[0], $start, $length));
        }
        return $suffix ? $slice.'...' : $slice;
    }

    /**
     * 格式化货币的显示方式，保留两位小数
     * @param number $money     货币数量
     * @return string           格式化后的字符串
     */
    public function formatMoney($money)
    {
        return sprintf("%01.2f", $money);
    }

    /**
     * 人民币数字转人民币中文大写
     * @param number $ns    人民币数字
     * @return string       人民币中文大写
     */
    public function cny($ns)
    {
        static $cnums = array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖"),
        $cnyunits = array("圆","角","分"),
        $grees = array("拾","佰","仟","万","拾","佰","仟","亿");
        list($ns1,$ns2) = explode(".",$ns,2);
        $ns2 = array_filter(array($ns2[1],$ns2[0]));
        $ret = array_merge($ns2,array(implode("", $this->_cny_map_unit(str_split($ns1), $grees)), ""));
        $ret = implode("",array_reverse($this->_cny_map_unit($ret,$cnyunits)));
        return str_replace(array_keys($cnums), $cnums,$ret);
    }

    /**
     * 整理人民币数字转人民币中文大写
     * @param array $list
     * @param array $units
     * @return array
     */
    private function _cny_map_unit($list,$units)
    {
        $ul = count($units);
        $xs = array();
        foreach (array_reverse($list) as $x)
        {
            $l = count($xs);
            if($x!="0" || !($l%4))
            {
                 $n=($x=='0'?'':$x).($units[($l-1)%$ul]);
            }
            else
            {
                $n=is_numeric($xs[0][0]) ? $x : '';
            }
            array_unshift($xs, $n);
        }
        return $xs;
    }



}
