<?php
namespace App\Network\Common;
use App\Globals\Finals\Responder;
use App\Globals\Traits\TranslationTrait;
use App\Helpers\ArrayHelper;
use App\Helpers\JsonHelper;
use Phalcon\Mvc\Controller;
use Phalcon\Config;
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 16/8/25
 * Time: 13:18
 * @property Config $config
 */
abstract class NetController extends Controller
{
    use TranslationTrait;

    /**
     * 内部跳转到指定的动作
     * @param string $controller        控制器名称
     * @param string $action            动作名称
     * @param array $params             参数列表
     */
    protected function forward($controller, $action, array $params=[])
    {
        $this->dispatcher->forward(
            array(
                'controller' => $controller,
                'action' => $action,
                'params' => $params
            )
        );
    }

    /**
     * @param Responder $responder
     * @return void
     */
    protected function toJsonData(Responder $responder)
    {
        $json = array(
            'total'=>$responder->total,
            'data'=>$responder->data,
            'msg' =>$responder->msg
        );
        $json['success'] = $responder->toggle ? true:false;

        $jsonHelper = JsonHelper::getInstance();

        $this->response->setContent($jsonHelper->encode($json));
        $this->response->send();
    }

    /**
     * @param Responder $responder
     * @return void
     */
    protected function toJsonMsg(Responder $responder)
    {
        $json = array(
            'success'=>$responder->toggle,
            'code'=>$responder->code,
            'msg' =>$responder->msg
        );
        $jsonHelper = JsonHelper::getInstance();
        $this->response->setContent($jsonHelper->encode($json));
        $this->response->send();
    }


    /**
     * 获取全部GET参数
     * @return array mixed
     */
    protected function getQueryParams()
    {
        $queries = $this->request->getQuery();
        return $queries;
    }

    /**
     * 获取所有GET参数
     * @return mixed
     */
    protected function getPostParams()
    {
        $posts = $this->request->getPost();
        return $posts;
    }

    /**
     * 获取除去分页与路由和排序的所有GET参数
     * @return array
     */
    public function getSearchParams()
    {
        $queries = $this->request->getQuery();
        unset($queries['_url'], $queries['page'], $queries['start'], $queries['limit'], $queries['sort'], $queries['dir']);

        return $queries;
    }

    /**
     * 获取主键ID列表
     * @return array
     */
    protected function getPrimaryIds()
    {
        $arrayHelper = ArrayHelper::getInstance();

        $aId = array();
        $ids = $this->request->getPost('ids');
        if ($ids) {
            $aId = explode(',', $ids);
            $aId = $arrayHelper->getCleanArray($aId);
        }
        return $aId;
    }

    /**
     * 显示视图
     * @param string $randerView    视图文件名称
     * @return static
     */
    protected function display($randerView='')
    {
        $tpl = $randerView ? $randerView : $this->router->getControllerName();
        $tpl = str_replace('\\', '/', $tpl);
        $this->view->pick($tpl);
        return $this;
    }

    /**
     * Set a single view parameter
     *
     * <code>
     * $this->view->setVar("products", $products);
     * </code>
     *
     * @param string $key
     * @param mixed $value
     * @return static
     */
    protected function assign($key, $value)
    {
        $this->view->setVar($key, $value);
        return $this;
    }

    /**
     * Set all the render params
     *
     * <code>
     * $this->view->setVars(
     *     [
     *         "products" => $products,
     *     ]
     * );
     * </code>
     *
     * @param array $params
     * @param bool $merge
     * @return static
     */
    protected function assigns($params, $merge = true)
    {
        $this->view->setVars($params, $merge);
        return $this;
    }
}