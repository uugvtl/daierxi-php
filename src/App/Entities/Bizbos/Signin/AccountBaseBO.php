<?php
namespace App\Entities\Bizbos\Signin;
use App\Globals\Bizes\BaseBO;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 3/1/18
 * Time: 02:06
 *
 * Class AccountBo
 * @package App\Entities\Bizbos\Signin
 * @property int    $account_id     帐号ID，可能是公司员工,用户,会员
 * @property string $account_name   帐号名称，也叫系统管理员账号
 * @property int    $group_id       公司员工所在权限组ID
 * @property string $group_name     分组名称，或者为角色名称
 * @property int    $group_grade    组别等级，有可能为0，因为有的帐号是没有等级区分的
 * @property string $grade_name     等级名称，有可能为空，因为有的帐号没有等级区分的
 * @property int    $enabled        是否启用，1：启用，0：停用
 */
class AccountBaseBO extends BaseBO
{
    protected function column()
    {
        return [
            'account_id',
            'account_name',
            'group_id',
            'group_name',
            'group_grade',
            'grade_name',
            'enabled'
        ];
    }
}