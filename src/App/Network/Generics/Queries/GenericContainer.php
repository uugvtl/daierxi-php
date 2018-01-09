<?php
namespace App\Network\Generics\Queries;
use App\Frames\Generics\FrameContainer;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 30/12/17
 * Time: 16:38
 *
 * Class GenericContainer
 * @package App\Network\Generics\Queries
 */
abstract class GenericContainer extends FrameContainer
{
    final protected function setBaseServiceString()
    {
        $this->getGenericInjecter()->setBaseClassString('QueryService');
    }

}