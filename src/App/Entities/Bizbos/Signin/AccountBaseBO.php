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
 * @property int    $team_id        公司员工所在权限组ID
 * @property string $team_name      分组名称，或者为角色名称
 * @property bool   $enabled        是否启用状态，启用为true,否则为false
 */
class AccountBaseBO extends BaseBO
{
    protected function column()
    {
        return [
            'account_id',
            'account_name',
            'team_id',
            'team_name',
            'enabled'
        ];
    }
}