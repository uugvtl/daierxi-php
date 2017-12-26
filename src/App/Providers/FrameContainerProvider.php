<?php
namespace App\Providers;
use App\Frames\FrameSingle;
use App\Interfaces\Providers\IMockContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:11
 *
 * Class MockContainerProvider
 * @package App\Network\Providers
 */
abstract class FrameContainerProvider extends FrameSingle implements IMockContainerProvider
{
//    use SpreadTrait;
//
//    /**
//     * @var IDistributerable
//     */
//    protected $distributer;
//
//    /**
//     * @var IParameterable
//     */
//    protected $parameter;
//
//
//    protected function onceConstruct()
//    {
//        parent::onceConstruct();
//        $this->parameter = $this->di->getShared('parameter');
//    }
//
//    /**
//     * @return IDistributerable
//     */
//    public function getDistributer()
//    {
//        return $this->distributer;
//    }
//
//    public function setDistributer(IDistributerable $distributer)
//    {
//        $this->distributer = $distributer;
//        return $this;
//    }
//
//    public function setFilename($filename)
//    {
//        $this->distributer->setFilename($filename);
//        return $this;
//    }
//
//    public function getFilename()
//    {
//        return $this->distributer->getFilename();
//    }
}