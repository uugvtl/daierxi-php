<?php
namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 23/12/17
 * Time: 17:09
 *
 * Class CNsHelper
 * @package App\Helpers
 */
class CNsHelper extends CBaseHelper
{
    /**
     * 生成命名空间文件
     * @return void
     */
    public function createFile()
    {

        $fileHelper = CFileHelper::getInstance();
        list($nsPath) = $fileHelper->findRecursivePath(APP_PATH);

        if($nsPath)
        {
            $content = "<?php\n";
            $content.= "return [\n";

            foreach ($nsPath as $path)
            {
                $paths = explode('/', $path);
                $paths = array_filter($paths);
                $paths = array_map('ucfirst', $paths);
                $nsName = implode('\\', $paths);

                $content.= "\tAPP_NS.'\\{$nsName}'    => APP_PATH . '/{$path}',\n";
            }

            $content.= "];";

            $filePath = DEPLOY_PATH.'/namespaces.php';
            $fileHelper->createFile($filePath, $content);
        }
    }
}