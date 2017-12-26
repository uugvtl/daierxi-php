<?php
namespace App\Network\Providers;
use App\Interfaces\Providers\INetContainerProvider;
use App\Providers\FrameContainerProvider;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2017/7/25
 * Time: 11:55
 *
 * Class ContainerProvider
 * @package App\Network\Providers
 */
abstract class CtrlContainerProvider extends FrameContainerProvider implements INetContainerProvider{}