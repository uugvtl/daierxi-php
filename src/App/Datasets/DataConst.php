<?php
namespace App\Datasets;
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
    const END = PHP_EOL;

    /**
     * 扩大100倍
     */
    const SCALE_UP_100 = 100;

    /**
     * 扩大1000倍
     */
    const SCALE_UP_1000 = 1000;

    /**
     * 缩小100倍
     */
    const SCALE_DOWN_100 = 0.01;

    /**
     * 缩小1000倍
     */
    const SCALE_DOWN_1000 = 0.001;

    /**
     * 小数位数精度4位
     */
    const DECIMAL = 4;

    /**
     * 泛化实例类的默认类名称前辍
     */
    const CLASS_PREFIX = 'Default';

    /**
     * 工厂功能目录名称
     */
    const FACTORY_CATALOG = 'Factories';

    /**
     * 新增功能目录名称
     */
    const CATALOG_CREATE    = 'Creates';

    /**
     * 修改功能目录名称
     */
    const CATALOG_MODIFY    = 'Modifies';

    /**
     * 查询功能目录名称
     */
    const CATALOG_QUERY     = 'Queries';

    /**
     * 打印功能目录名称
     */
    const CATALOG_PRINT     = 'Printing';

    /**
     * 导出功能目录名称
     */
    const CATALOG_EXPORT    = 'Exports';

    /**
     * 删除功能目录名称
     */
    const CATALOG_REMOVE    = 'Removes';
}