<?php
namespace App\Globals\Legals;
use App\Frames\Generics\FrameRepository;
use App\Globals\Bases\BaseClass;
use App\Globals\Finals\Responder;
use Phalcon\Validation;
use Phalcon\Validation\Message\Group;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 4/1/18
 * Time: 01:01
 *
 * Class FrameLegal
 * @package App\Frames\Generics
 */
abstract class BaseLegal extends BaseClass
{
    /**
     * 参数
     * @var array
     */
    private $params;

    /**
     * @var FrameRepository
     */
    private $repository;

    /**
     * @var Validation
     */
    protected $validation;

    /**
     * 初始化验证数据
     * @return void
     */
    abstract protected function run();

    /**
     * 构造方法运行后的初始化方法
     */
    protected function afterInstance()
    {
        $this->params = [];
        $this->validation = new Validation();
    }

    /**
     * @param Group $messages
     * @return string
     */
    protected function getMessages(Group $messages)
    {
        $msg = '';
        foreach ($messages as $message)
        {
            $msg.= "<div style='text-align:left'>{$message}</div>";
        }
        return $msg;
    }

    /**
     * 验证开始
     * @return string
     */
    protected function validation()
    {

        $this->run();
        $messages = $this->validation->validate($this->getParams());
        $msg = $this->getMessages($messages);
        $msg.= $this->afterRun();

        return $msg;
    }

    /**
     * 验证完成后的处理
     * @return string
     */
    protected function afterRun()
    {
        return '';
    }

    final public function init(...$args)
    {
        $this->params = $args[0];
        return $this;
    }

    /**
     * @return array
     */
    final protected function getParams()
    {
        return $this->params;
    }

    /**
     * @return FrameRepository
     */
    final protected function getRepositpry()
    {
        return $this->repository;
    }


    /**
     * @param FrameRepository $repository
     * @return $this
     */
    final public function setRepository(FrameRepository $repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * 返回验证后的结果
     * @return Responder
     */
    final public function get()
    {
        $msg = $this->validation();
        $toggle = $msg ? false:true;

        $responder = Responder::getInstance();
        $responder->toggle = $toggle;
        $responder->msg = $msg;

        return $responder;

    }
}