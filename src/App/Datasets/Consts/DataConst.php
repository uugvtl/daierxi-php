<?php
namespace App\Datasets\Consts;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 2/1/18
 * Time: 01:18
 *
 * Class DataConst
 * @package App\Datasets
 */
final class DataConst
{
    /**
     * 换行常量
     */
    const END               = PHP_EOL;

    /**
     * 扩大100倍
     */
    const SCALE_UP_100      = 100;

    /**
     * 扩大1000倍
     */
    const SCALE_UP_1000     = 1000;

    /**
     * 缩小100倍
     */
    const SCALE_DOWN_100    = 0.01;

    /**
     * 缩小1000倍
     */
    const SCALE_DOWN_1000   = 0.001;

    /**
     * 小数位数精度4位
     */
    const DECIMAL           = 4;

    /**
     * 泛化实例类的默认类名称前辍
     */
    const CLASS_PREFIX      = 'App';

    /**
     * 工厂功能目录名称
     */
    const FACTORY_CATALOG   = 'Factories';

    /**
     *
     */
    const FACTORY_PREFIX    = 'Factory';

    /**
     * 新增功能目录名称
     */
    const CREATE_CATALOG    = 'Creates';

    /**
     * 新增功能类前辍
     */
    const CREATE_PREFIX     = 'Create';

    /**
     * 修改功能目录名称
     */
    const MODIFY_CATALOG    = 'Modifies';

    /**
     * 修改功能类前辍
     */
    const MODIFY_PREFIX     = 'Modify';

    /**
     * 查询功能目录名称
     */
    const QUERY_CATALOG     = 'Queries';

    /**
     * 查询功能类前辍
     */
    const QUERY_PREFIX      = 'Query';

    /**
     * 打印功能目录名称
     */
    const PRINT_CATALOG     = 'Printing';

    /**
     * 打印功能类前辍
     */
    const PRINT_PREFIX      = 'Print';

    /**
     * 导出功能目录名称
     */
    const EXPORT_CATALOG    = 'Exports';

    /**
     * 导出功能类前辍
     */
    const EXPORT_PREFIX     = 'Export';

    /**
     * 删除功能目录名称
     */
    const REMOVE_CATALOG    = 'Removes';

    /**
     * 删除功能类前辍
     */
    const REMOVE_PREFIX     = 'Remove';
}