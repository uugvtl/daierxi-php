<?php
namespace App\Entities\Bizdos\Accounts;
use App\Globals\Bizes\BaseDO;
use App\Helpers\SqlHelper;
use App\Helpers\StringHelper;
use App\Tables\Manager\IManagerTable;

/**
 * Created by PhpStorm.
 * User: leon
 * Date: 7/1/18
 * Time: 02:07
 *
 * Class ManagerBaseDo
 * @package App\Entities\Bizdos\Accounts
 * @property int    $manager_id     公司员工ID，也叫系统管理员ID
 * @property string $manager_name   公司员工账号，也叫系统管理员账号
 * @property int    $group_id       公司员工所在权限组ID
 * @property int    $enabled        是否启用，1：启用，0：停用
 * @property string $real_name      真实姓名
 * @property string $birthday       出生日期
 */
class ManagerBaseDO extends BaseDO
{

    protected function column()
    {
        return [
            'manager_id',
            'manager_name',
            'group_id',
            'enabled',
            'real_name',
            'birthday'
        ];
    }

    /**
     * @return int
     */
    public function primaryKey()
    {
        return $this->manager_id;
    }

    public function insert()
    {
        $sqlHelper = SqlHelper::getInstance();

        $table = IManagerTable::Name;

        $fields = $this->getProperties();
        $fields['namehash'] = md5($this->manager_name);
        $fields['password'] = md5(sha1(DEFAULT_PASSWORD));

        $sql = $sqlHelper->getCreateString($fields, $table, SqlHelper::SQL_CREATE_IGNORE);
        $lastId = $this->getCache()->getDao()->insert($sql);
        if($lastId)
        {
            $this->setPersistent(YES);
            $this->setProperty('manager_id', $lastId);
            $this->getCache()->updateCacheDependencies($table);
        }

        return $this;
    }

    public function submit()
    {
        $table = IManagerTable::Name;

        $stringHelper = StringHelper::getInstance();
        $sqlHelper = SqlHelper::getInstance();

        $id = $stringHelper->quoteValue($this->manager_id);
        $where = 'AND manager_id='.$id;


        $sql =  $sqlHelper->getUpdateString($this->getProperties(), $table, $where);

        $toggle = $this->getCache()->getDao()->commit($sql);
        $this->setPersistent(YES);
        $toggle && $this->getCache()->updateCacheDependencies($table);

        return $this;
    }

}