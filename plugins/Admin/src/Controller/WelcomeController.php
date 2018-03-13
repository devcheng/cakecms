<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Welcome Controller
 *
 *
 * @method \Admin\Model\Entity\Welcome[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WelcomeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $userData = $this->Auth->user();
        $menuData = TableRegistry::get('Admin.Menus')->getMenu($this->Auth->user('role_id'));
        $systemData = TableRegistry::get('Admin.Options')->getArrayData(array('Options.type' => 'system'));

        $this->set(compact('userData', 'menuData', 'systemData'));
    }

    /*
     * 我的主页
     *
     * */
    public function main()
    {

    }

}
