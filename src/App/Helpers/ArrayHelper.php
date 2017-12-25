<?php
namespace App\Helpers;
use stdClass;

class ArrayHelper extends BaseHelper
{

    /**
     * 对数组进行map操作
     * @param callable  $callable   回调函数
     * @param array     $records    需要处理的数据
     * @param array     ...$args    额外参数
     * @return array
     */
    public function map(callable $callable, array $records, ...$args)
    {
        return array_map($callable, $records, ...$args);
    }

    /**
     * 对数组进行reduce操作
     * @param callable  $callable   回调函数
     * @param array     $records    需要处理的数据
     * @param mixed     $initial    回调函数使用的初始化数据
     * @return mixed
     */
    public function reduce(callable $callable, array $records, $initial = null)
    {
        return array_reduce($records, $callable, $initial);
    }

    /**
     * 使用用户自定义函数对数组中的每个元素做回调处理
     * @param callable $callable    回调函数
     * @param array $records        需要处理的数据
     * @param null $userdata        如果提供了可选参数 userdata，将被作为第三个参数传递给 callback。
     * @return bool
     */
    public function walk(callable $callable, array $records, $userdata = null)
    {
        return array_walk($records, $callable, $userdata);
    }

    /**
     * 把KV这种结构转换为纯数组结构
     * @param array $array          以KV结构的二维数组
     * @param string $keyName       原数组的key在新数组的名称
     * @param string $valName       原数组的value在新数组的名称
     * @return array
     */
    public function asso2arr(array $array, $keyName, $valName)
    {
        $results = [];

        if($array)
        {
            foreach ($array as $key=>$value)
            {
                $results[] = [
                    $keyName  =>$key,
                    $valName  =>$value
                ];
            }

        }

        return $results;
    }

    /**
     * 把纯数组这种结构转换为KV结构
     * @param array $array          二维数组
     * @param string $keyName       原数组当中的key名称
     * @param string $valName       原数组的value的名称
     * @return array
     */
    public function arr2asso(array $array, $keyName, $valName='')
    {
        $results = [];

        if($array)
        {
            foreach ($array as $rows)
            {
                $results[$rows[$keyName]] = $valName?$rows[$valName]:$rows;
            }
        }

        return $results;
    }

    /**
     * 将树型数据转换为列表数据
     * @param array $array     树型数据
     * @param string $child     树型分支结点名称
     * @return array|bool       成功返回列表数据，否则返回false
     */
    public function tree2list(array $array, $child = 'children'){
        if(!isset($array)||!is_array($array)||empty($array)){
            return false;
        }
        static $result_array = array();
        foreach($array as $key=>$value){
            if(isset($value[$child])){
                $child_list  = $value[$child];
                unset($value[$child]);
                $result_array[]=$value;
                $this->tree2list($child_list);
            }else{
                $result_array[]=$value;
            }
        }
        return $result_array;
    }

    /**
     * 将返回的数据集转换成树
     * @param  array   $list    数据集
     * @param  string  $pk      主键
     * @param  string  $pid     父节点名称
     * @param  string  $child   子节点名称
     * @param  integer $root    根节点ID
     * @param  boolean $is_sub  是否保留主键下标
     * @return array            转换后的树
     */
    public function list2tree(array $list, $pk = 'id', $pid = 'pid', $child = 'children', $root=0, $is_sub=false) {
        $tree = array();// 创建Tree
        if(is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }

            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[$data[$pk]] =& $list[$key];
                }else{
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }

        return $is_sub?$tree:array_values($tree);
    }

    /**
     * 返回数组中指定的一列--如果是5.5.0版本以上使用的是array_column
     * @param array $input          需要取出数组列的多维数组（或结果集）
     * @param mixed $column_key     需要返回值的列，它可以是索引数组的列索引，或者是关联数组的列的键。 也可以是NULL，此时将返回整个数组
     * @return array                从多维数组中返回单列数组
     */
    public function column(array $input, $column_key)
    {
        $arr = array();

        $ok = strnatcasecmp(phpversion(), '5.5.0') >= 0 ? true : false;
        if($ok)
        {
            $arr = array_column($input, $column_key);
        }
        else
        {
            if($input)
            {
                foreach($input as $v)
                {
                    if(isset($v[$column_key]))
                        $arr[] = $v[$column_key];
                }
            }
        }

        return $arr;
    }
    
    /**
     * 获取去重复且没有空白元素的纯净数组
     * @param array $array      需要净化的数组
     * @return array            净化后的数组
     */
    public function getCleanArray(array $array)
    {
        if(count($array)==count($array,1))
            $array  = array_map('trim', $array);

        $array  = array_filter($array);
        $array  = array_unique($array);

        
        return $array;
    }
    
    /**
     * Return a callback array from a string, eg: limit[10,20] would become
     * array('limit', array('10', '20'))
     *
     * @param   string  callback string
     * @return  array
     */
    public function callbackString($str)
    {
        // command[param,param]
        if (preg_match('/([^\[]*+)\[(.+)\]/', (string) $str, $match))
        {
            // command
            $command = $match[1];
    
            // param,param
            $params = preg_split('/(?<!\\\\),/', $match[2]);
            $params = str_replace('\,', ',', $params);
        }
        else
        {
            // command
            $command = $str;
    
            // No params
            $params = NULL;
        }
    
        return array($command, $params);
    }
    
    /**
     * Rotates a 2D array clockwise.
     * Example, turns a 2x3 array into a 3x2 array.
     *
     * @param   array    $source_array array to rotate
     * @param   boolean  $keep_keys keep the keys in the final rotated array. the sub arrays of the source array need to have the same key values.
     *                   if your subkeys might not match, you need to pass FALSE here!
     * @return  array
     */
    public function rotate($source_array, $keep_keys = TRUE)
    {
        $new_array = array();
        foreach ($source_array as $key => $value)
        {
            $value = ($keep_keys === TRUE) ? $value : array_values($value);
            foreach ($value as $k => $v)
            {
                $new_array[$k][$key] = $v;
            }
        }
    
        return $new_array;
    }
    
    /**
     * Removes a key from an array and returns the value.
     *
     * @param   string  $key key to return
     * @param   array   $array array to work on
     * @return  mixed   value of the requested array key
     */
    public function remove($key, &$array)
    {
        if ( ! array_key_exists($key, $array))
            return null;
    
        $val = $array[$key];
        unset($array[$key]);
    
        return $val;
    }
    
    /**
     * Extract one or more keys from an array. Each key given after the first
     * argument (the array) will be extracted. Keys that do not exist in the
     * search array will be NULL in the extracted data.
     *
     * @param   array   $search array to search
     * @param   string  $keys key name
     * @return  array
     */
    public function extract(array $search, $keys)
    {
        // Get the keys, removing the $search array
        $keys = array_slice(func_get_args(), 1);
    
        $found = array();
        foreach ($keys as $key)
        {
            if (isset($search[$key]))
            {
                $found[$key] = $search[$key];
            }
            else
            {
                $found[$key] = NULL;
            }
        }
    
        return $found;
    }
    
    /**
     * Because PHP does not have this function.
     *
     * @param   array   $array array to unshift
     * @param   string  $key key to unshift
     * @param   mixed   $val value to unshift
     * @return  array
     */
    public function unshiftAssoc( array &$array, $key, $val)
    {
        $array = array_reverse($array, TRUE);
        $array[$key] = $val;
        $array = array_reverse($array, TRUE);
    
        return $array;
    }
    
    /**
     * Because PHP does not have this function, and array_walk_recursive creates
     * references in arrays and is not truly recursive.
     *
     * @param   mixed  callback to apply to each member of the array
     * @param   array  array to map to
     * @return  array
     */
    public function mapRecursive($callback, array $array)
    {
        foreach ($array as $key => $val)
        {
            // Map the callback to the key
            $array[$key] = is_array($val) ? $this->mapRecursive($callback, $val) : call_user_func($callback, $val);
        }
    
        return $array;
    }
    
    /**
     * Binary search algorithm.
     *
     * @param   mixed    $needle the value to search for
     * @param   array    $haystack an array of values to search in
     * @param   boolean  $nearest return false, or the nearest value
     * @param   mixed    $sort sort the array before searching it
     * @return  integer
     */
    public function binarySearch($needle, array $haystack, $nearest = FALSE, $sort = FALSE)
    {
        if ($sort === TRUE)
        {
            sort($haystack);
        }
    
        $high = count($haystack);
        $low = 0;
    
        while ($high - $low > 1)
        {
            $probe = (int)(($high + $low) / 2);
            if ($haystack[$probe] < $needle)
            {
                $low = $probe;
            }
            else
            {
                $high = $probe;
            }
        }
    
        if ($high == count($haystack) OR $haystack[$high] != $needle)
        {
            if ($nearest === FALSE)
                return FALSE;
    
            // return the nearest value
            $high_distance = $haystack[intval(ceil($low))] - $needle;
            $low_distance = $needle - $haystack[intval(floor($low))];
    
            return ($high_distance >= $low_distance) ? $haystack[intval(ceil($low))] : $haystack[intval(floor($low))];
        }
    
        return $high;
    }
    
    /**
     * Overwrites an array with values from input array(s).
     * Non-existing keys will not be appended!
     *
     * @param   array   $array1 key array
     * @param   array   $array2 input array(s) that will overwrite key array values
     * @return  array
     */
    public function overwrite($array1, $array2)
    {
        foreach (array_slice(func_get_args(), 1) as $array2)
        {
            foreach ($array2 as $key => $value)
            {
                if (array_key_exists($key, $array1))
                {
                    $array1[$key] = $value;
                }
            }
        }
    
        return $array1;
    }
    
    /**
     * Fill an array with a range of numbers.
     *
     * @param   integer  $step stepping
     * @param   integer  $max ending number
     * @return  array
     */
    public function range($step = 10, $max = 100)
    {
        if ($step < 1)
            return array();
    
        $array = array();
        for ($i = $step; $i <= $max; $i += $step)
        {
            $array[$i] = $i;
        }
    
        return $array;
    }
    
    /**
     * Merges two or more arrays into one recursively.
     * If each array has an element with the same string key value, the latter
     * will overwrite the former (different from array_merge_recursive).
     * Recursive merging will be conducted if both arrays have an element of array
     * type and are having the same key.
     * For integer-keyed elements, the elements from the latter array will
     * be appended to the former array.
     * @param array $a array to be merged to
     * @param array $b array to be merged from. You can specify additional
     * arrays via third argument, fourth argument etc.
     * @return array the merged array (the original arrays are not changed.)
     * @see mergeWith
     */
    public function mergeArray($a,$b)
    {
        $args=func_get_args();
        $res=array_shift($args);
        while(!empty($args))
        {
            $next=array_shift($args);
            foreach($next as $k => $v)
            {
                if(is_integer($k))
                    isset($res[$k]) ? $res[]=$v : $res[$k]=$v;
                elseif(is_array($v) && isset($res[$k]) && is_array($res[$k]))
                $res[$k]=$this->mergeArray($res[$k],$v);
                else
                    $res[$k]=$v;
            }
        }
        return $res;
    }
    
    /**
     * 递归把数组转换为对象
     * @param array $array      需要转换的数组
     * @param string $class     对象名称
     * @return stdClass
     */
    public function arr2obj(array $array, $class = 'stdClass')
    {
        $object = new $class;

        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                // Convert the array to an object
                $value = $this->arr2obj($value, $class);
            }

            // Add the value to the object
            $object->{$key} = $value;
        }

        return $object;
    }


    /**
     * 把数据对象转换为数组
     * @param stdClass $object      数组对象
     * @return mixed                数组
     */
    public function obj2arr(stdClass $object) {
        $object =  json_decode( json_encode( $object),true);
        return  $object;
    }

    /**
     * 将xml转为array
     * @param string $xml
     * @return array
     */
    public function xml2arr($xml)
    {
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

    /**
     * array转xml
     * @param array $arr
     * @return string
     */
    public function arr2xml($arr)
    {
        $xml = '<xml>';
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val))
            {
                $xml.="<".$key.">".$val."</".$key.">";

            }
            else
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
        }
        $xml.="</xml>";
        return $xml;
    }


}
