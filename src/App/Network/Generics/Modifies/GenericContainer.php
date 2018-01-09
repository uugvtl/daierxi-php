<?php
namespace App\Network\Generics\Modifies;
use App\Frames\Generics\FrameContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:41
 *
 * Class GenericContainer
 * @package App\Network\Generics\Modifies
 */
abstract class GenericContainer extends FrameContainer
{
    protected function setBaseServiceString()
    {
        $this->getGenericInjecter()->setBaseClassString('ModifyService');
    }

}