<?php
namespace App\Globals\Legals;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/4/9
 * Time: 19:17
 *
 * Class LoopLogic
 * @package App\Network\Modules\Manager\Distribution\Verifies\Legals
 */
abstract class LoopLegal extends BaseLegal
{
    /**
     * 单条验证数据
     * @var array
     */
    protected $rows=[];

    /**
     * 验证数据的索引
     * @var string|int
     */
    protected $key;

    /**
     * 验证开始
     */
    protected function validation()
    {
        $msg = '';
        $params = $this->getParams();

        foreach ($params as $key=>$rows)
        {
            $this->rows = $rows;
            $this->key = $key;
            $this->initValidation();
            $messages = $this->validation->validate($rows);
            $msg.= $this->getMessages($messages);
            $msg.= $this->afterValidation();
        }

        return $msg;
    }
}