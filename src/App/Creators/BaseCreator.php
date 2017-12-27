<?php
namespace App\Creators;
use App\Globals\Bases\BaseSingle;
use App\Injecters\GenericInjecter;
use InvalidArgumentException;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 00:22
 *
 * Class BaseCreator
 * @package App\Creators
 */
abstract class BaseCreator extends BaseSingle
{
    /**
     * 新建类实例
     * @param string $classname     类的全名，例如BaseCreator::class 这样
     * @param array ...$args        扩展参数
     * @return mixed
     */
    abstract public function create($classname, ...$args);

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
}