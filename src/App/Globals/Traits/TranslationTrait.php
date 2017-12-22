<?php
namespace App\Globals\Traits;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2016/11/8
 * Time: 16:01
 */
trait TranslationTrait
{
    static private $translations = [];
    /**
     * 获取语言的路径
     * @return string
     */
    private function getTranslationFile()
    {
        $cfg = require CONFIG_PATH.'/main.php';
        return MSGS_PATH . '/' . $cfg['language'];
    }

    /**
     * 获取语言名的包的翻译
     * @param string $filename      文件名称，如果名称当中有.则转义为/
     * @param string $translate     翻译名称
     * @return string               翻译后的名称
     */
    protected function t($filename, $translate)
    {
        $msg = '';
        $filename = str_replace('.', '/', $filename);
        $translationFile = $this->getTranslationFile().'/'.$filename.'.php';

        // Check if we have a translation file for that lang
        if (is_file($translationFile))
        {
            if(!isset(self::$translations[$translationFile]))
            {
                $message = require $translationFile;
                self::$translations[$translationFile] = $message;
            }
            else
            {
                $message = self::$translations[$translationFile];
            }


            $msg = isset($message[$translate]) ? $message[$translate]:'';
        }


        return $msg;
    }
}