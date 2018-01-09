<?php
namespace App\Network\Generics\Removes;
use App\Frames\Generics\FrameContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:38
 *
 * Class GenericContainer
 * @package App\Network\Generics\Removes
 */
abstract class GenericContainer extends FrameContainer
{
    protected function setBaseServiceString()
    {
        $this->getGenericInjecter()->setBaseClassString('RemoveService');
    }
}