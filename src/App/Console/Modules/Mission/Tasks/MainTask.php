<?php
namespace App\Console\Modules\Mission\Tasks;
use App\Console\Modules\Mission\Common\AppTask;
use App\Helpers\CNsHelper;
use FilesystemIterator;
use Phar;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/10/17
 * Time: 13:49
 *
 * Class MainTask
 * @package App\Console\Modules\Mission\Tasks
 */
class MainTask extends AppTask
{
    /**
     * 主任务入口
     */
    public function indexAction()
    {
        $this->dispatcher->forward(array(
            'task'      =>'main',
            'action'    =>'env'
        ));
    }

    /**
     * 配置环境初始化
     */
    public function envAction()
    {
        switch ($this->config->path('env.runtime'))
        {
            case 'dev':
                $src    = CONFIG_PATH . '/env/dev/db.php';
                $dist   = CONFIG_PATH . '/db.php';
                copy($src, $dist);
                break;
            case 'test':
                $src    = CONFIG_PATH . '/env/test/db.php';
                $dist   = CONFIG_PATH . '/db.php';
                copy($src, $dist);
                break;
            case 'prod':
                $src    = CONFIG_PATH . '/env/prod/db.php';
                $dist   = CONFIG_PATH . '/db.php';
                copy($src, $dist);
                break;
        }

        switch ($this->config->path('env.runtime'))
        {
            case 'dev':
                $src    = CONFIG_PATH . '/env/dev/custom.php';
                $dist   = CONST_PATH  . '/custom.php';
                copy($src, $dist);
                break;
            case 'test':
                $src    = CONFIG_PATH . '/env/test/custom.php';
                $dist   = CONST_PATH  . '/custom.php';
                copy($src, $dist);
                break;
            case 'prod':
                $src    = CONFIG_PATH . '/env/prod/custom.php';
                $dist   = CONST_PATH  . '/custom.php';
                copy($src, $dist);
                break;
        }

        echo "env db domain are ok.\n";

        $this->dispatcher->forward(array(
            'task'      =>'main',
            'action'    =>'namespace'
        ));
    }


    /**
     * 命名空间初始化
     */
    public function namespaceAction()
    {
        $file = 'app.phar';

        $phar = new Phar('../bin/'.$file, FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, $file);

        // 开始打包
        $phar->startBuffering();

        // 建立压缩目录
        $phar->buildFromDirectory(SRC_PATH . '/');

        // 设置入口
        $phar->setStub("<?php
            Phar::mapPhar('{$file}');
            require 'phar://{$file}/public/index.php';
            __HALT_COMPILER();"
        );
        $phar->stopBuffering();

        // 压缩格式
        $phar->compressFiles(Phar::GZ);


        $nsHelper = CNsHelper::getInstance();
        $nsHelper->createFile();
        echo "namespace init done!.\n";
    }
}