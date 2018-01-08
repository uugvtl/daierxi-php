<?php
namespace App\Console\Providers;
use App\Interfaces\Providers\IConsoleContainerProvider;
use App\Providers\BaseContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 28/12/17
 * Time: 21:09
 *
 * Class CliContainerProvider
 * @package App\Console\Providers
 */
abstract class ConsoleContainerProvider extends BaseContainerProvider implements IConsoleContainerProvider {}