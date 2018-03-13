<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Routing\Router;

/**
 * Options Controller
 *
 * @property \Admin\Model\Table\OptionsTable $Options
 *
 * @method \Admin\Model\Entity\Option[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OptionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($type = null)
    {
        $data = $this->Options->getArrayData();
        $this->set(compact('type', 'data'));
        if ($this->request->is('post')) {
            if ($this->Options->saveData($type, $this->request->getData())) {
                $this->jump(200, '保存成功!', '', false, Router::url('/admin/options/index/' . $type));
            }
        }
    }
}
