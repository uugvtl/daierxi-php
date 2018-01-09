<?php
namespace App\Network\Generics\Printing;
use App\Frames\Generics\FrameContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:41
 *
 * Class GenericContainer
 * @package App\Network\Generics\Printing
 */
abstract class GenericContainer extends FrameContainer
{
    protected function setBaseServiceString()
    {
        $this->getGenericInjecter()->setBaseClassString('PrintService');
    }

}