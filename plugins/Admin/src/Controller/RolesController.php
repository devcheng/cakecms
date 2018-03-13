<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Roles Controller
 *
 * @property \Admin\Model\Table\RolesTable $Roles
 *
 * @method \Admin\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{
    public $paginate = [
        'order' => [
            'Roles.sort' => 'desc',
            'Roles.created' => 'asc'
        ]
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->setPage();
        $data = $this->paginate($this->Roles);

        $this->set(compact('data'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('role', $role);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->jump(200, '保存成功!', 'roles', true);
            } else {
                $this->jump(300, '保存失败!', 'roles', true);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->Roles->patchEntity($data, $this->request->getData());
            if ($this->Roles->save($data)) {
                $this->jump(200, '编辑成功!', 'roles', true);
            } else {
                $this->jump(200, '编辑失败!', 'roles', true);
            }
        }
        $this->set(compact('data'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->jump(200, '删除成功!', 'roles', false);
        } else {
            $this->jump(300, '删除失败,请重试!', 'roles', false);
        }
    }

    /*
     * 管理员组的权限管理
     *
     * */
    public function manage($id = null) {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(array('post', 'put'))) {
            $menus = explode(',', $this->request->getData('menus'));
            $saveData = $this->request->getData();
            $saveData['menus'] = json_encode($menus);
            $role = $this->Roles->patchEntity($role, $saveData);
            if ($this->Roles->save($role)) {
                $this->jump(200, '保存成功!', 'roles', true);
            } else {
                $this->jump(300, '保存失败!', 'roles', true);
            }
        }
        $menu = TableRegistry::get('Admin.Menus')->findMenu();          //获取所有菜单
        $roleData = $this->Roles->getData(array('Roles.id' => $id));
        $haveMenus = (empty($roleData->menus)) ? array() : json_decode($roleData->menus);
        $haveMenuStr = implode(',', $haveMenus);

        $this->set(compact('menu', 'id', 'haveMenus', 'haveMenuStr'));
    }
}
