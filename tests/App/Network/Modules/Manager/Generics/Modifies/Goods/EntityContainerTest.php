<?php
namespace App\Network\Modules\Manager\Generics\Modifies\Goods;
use App\Datasets\Consts\ClassConst;
use App\Globals\Finals\Distributer;
use App\Network\Providers\ManagerContainerProvider;
use AppUnitTest;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 12/1/18
 * Time: 13:39
 *
 * Class EntityContainerTest
 * @package App\Network\Modules\Manager\Generics\Modifies\Goods
 */
class EntityContainerTest extends AppUnitTest
{
    public function test_upload_for_save()
    {
        /** arrange */
            $params = [
                'goods_id'       =>'10',
                'goods_image'    =>'upload/2017/04/06/original/2017406486295334492.png',
            ];
            $distributer = Distributer::getInstance();
            $distributer->init('Goods\Entity', 'Upload', ClassConst::CLASS_PREFIX);
        /** act */
            $provider = ManagerContainerProvider::getInstance();
            $container = $provider->init($distributer)->getCommitContainer($params);
        /** assert */
            $responder = $container->setBaseServicePrefix(ClassConst::UPLOAD_PREFIX)->get();
            $this->assertTrue($responder->toggle, $responder->msg);
    }
}