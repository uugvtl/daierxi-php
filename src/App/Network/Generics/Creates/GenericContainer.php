<?php
namespace App\Network\Generics\Creates;
use App\Frames\Generics\FrameContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:41
 *
 * Class GenericContainer
 * @package App\Network\Generics\Creates
 */
abstract class GenericContainer extends FrameContainer
{
    protected function setBaseServiceString()
    {
        $this->getGenericInjecter()->setBaseClassString('CreateService');
    }
}