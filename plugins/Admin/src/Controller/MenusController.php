<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * Menus Controller
 *
 * @property \Admin\Model\Table\MenusTable $Menus
 *
 * @method \Admin\Model\Entity\Menu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MenusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $data = $this->Menus->findAllMenu();
        $stateData = $this->Menus->stateData();     //状态
        $colorData = $this->Menus->colorData();     //状态

        $this->set(compact('data', 'stateData', 'colorData'));
    }

    /*
     * 菜单查找带回
     *
     * */
    public function lookup($id = null)
    {
        $data = $this->Menus->findAllMenu(0, $id);
        $this->set(compact('data'));
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => ['ParentMenus', 'ChildMenus']
        ]);

        $this->set('menu', $menu);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($parent_id = null)
    {
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            $saveData = $this->Menus->changeData($this->request->getData());
            $menu = $this->Menus->patchEntity($menu, $saveData);
            if ($this->Menus->save($menu)) {
                $this->jump(200, '添加成功!', 'menus', true);
            } else {
                $this->jump(300, '添加失败!', 'menus', true);
            }
        }
        if (!empty($parent_id)) {
            $data = $this->Menus->get($parent_id, [
                'contain' => ['ParentMenus']
            ]);
            $this->set(compact('data'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->Menus->get($id, [
            'contain' => ['ParentMenus']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saveData = $this->Menus->changeData($this->request->getData());
            $saveData = $this->Menus->patchEntity($data, $saveData);
            if ($this->Menus->save($data)) {
                $this->jump(200, '编辑成功!', 'menus', true);
            } else {
                $this->jump(300, '编辑失败!', 'menus', true);
            }
        }
        $stateData = $this->Menus->stateData();     //状态
        $this->set(compact('data', 'stateData'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //判断是否存在子菜单
        $conditions['Menus.parent_id'] = $id;
        if ($this->Menus->haveChild($conditions)) {
            $this->jump(300, '删除失败,请先删除所有子菜单!', '', false);
        }

        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);
        if ($this->Menus->delete($menu)) {
            $this->jump(200, '删除成功!', '', false);
        } else {
            $this->jump(300, '删除失败,请重试!', '', false);
        }
    }
}
