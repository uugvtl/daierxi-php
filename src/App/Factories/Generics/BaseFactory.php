<?php
namespace App\Factories\Generics;
use App\Globals\Bases\BaseSingle;
use App\Injecters\GenericInjecter;
use InvalidArgumentException;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 26/12/17
 * Time: 13:12
 *
 * Class BaseFactory
 * @package App\Factories\Generics
 */
abstract class BaseFactory extends BaseSingle
{
    /**
     * @var GenericInjecter
     */
    protected $genericInjecter;

    public function init(...$args)
    {
        $injecter = $args[0];
        if($injecter instanceof GenericInjecter)
            $this->genericInjecter = $args[0];
        else
            throw new InvalidArgumentException('tripleInteger function only accepts Class GenericInjecter. Input was: '.$injecter);

        return $this;
    }

    abstract public function createService();
    
    abstract public function createRepository();

    abstract public function createLogic();
}