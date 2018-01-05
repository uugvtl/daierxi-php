<?php
namespace App\Globals\Finals;
use App\Globals\Bases\BaseClass;
use App\Interfaces\Adapters\IShowAdapter;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/7
 * Time: 00:53
 *
 * Class BaseResult
 * @package App\Globals\Bases\Results
 * @property bool           $toggle
 * @property int            $total
 * @property array          $data
 * @property string         $msg;
 * @property int            $code
 * @property IShowAdapter   $adapter
 */
final class Responder extends BaseClass
{
    public $toggle;
    public $total;
    public $data;
    public $msg;
    public $code;
    public $adapter;

    protected function afterInstance()
    {
        $this->toggle = false;
        $this->total = 0;
        $this->data = [];
        $this->msg = '';
        $this->code = 0;
        $this->adapter = null;
    }
}