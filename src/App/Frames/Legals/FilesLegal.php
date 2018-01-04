<?php
namespace App\Frames\Legals;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/3/22
 * Time: 23:19
 *
 * Class FilesLogic
 * @package App\Network\Modules\Manager\Distribution\Verifies\Legals
 */
abstract class FilesLegal extends FrameLegal
{
    /**
     * 初始化数据
     */
    protected function validation()
    {
        $this->initValidation();
        $this->validation->validate($_FILES);
    }
}