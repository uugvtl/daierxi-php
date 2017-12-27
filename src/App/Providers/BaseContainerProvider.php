<?php
namespace App\Providers;
use App\Globals\Bases\BaseSingle;
use App\Globals\Finals\Distributer;
use App\Globals\Finals\Parameter;
use App\Injecters\GenericInjecter;
use App\Interfaces\Providers\IMockContainerProvider;
use InvalidArgumentException;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 14:11
 *
 * Class MockContainerProvider
 * @package App\Network\Providers
 */
abstract class BaseContainerProvider extends BaseSingle implements IMockContainerProvider
{
    /**
     * @var Distributer
     */
    protected $distributer;

    /**
     * @var Parameter
     */
    protected $parameter;

    /**
     * @var GenericInjecter
     */
    protected $genericInjecter;

    public function init(...$args)
    {
        $distributer = $args[0];

        if($distributer instanceof Distributer)
            $this->distributer = $args[0];
        else
            throw new InvalidArgumentException('tripleInteger function only accepts Class Distributer. Input was: '.$distributer);

        $this->parameter = Parameter::getInstance();
        $this->genericInjecter = GenericInjecter::getInstance();

        return $this;
    }

}