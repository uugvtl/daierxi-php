<?php
namespace App\Console\Common;
use Phalcon\Cli\Task;
use Phalcon\Config;
/**
 * 所有命令行程序任务类的基类
 * User: leon
 * Date: 2016/11/10
 * Time: 10:12
 *
 * Class ComTask
 * @package App\Console\Common
 * @property Config $config
 */
abstract class CliTask extends Task{}