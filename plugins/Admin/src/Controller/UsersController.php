<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \Admin\Model\Table\UsersTable $Users
 *
 * @method \Admin\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['relogin']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->setPage();
        $this->paginate['contain'] = 'Roles';

        //用户名查询
        $conditions = array();
        if (!empty($this->request->getData('username'))) {
            $username = $this->request->getData('username');
            $conditions['Users.username like'] = '%' . $username . '%';
            $this->set('username', $username);
        }

        //管理用户组查询
        if (!empty($this->request->getData('role_id'))) {
            $role_id = $this->request->getData('role_id');
            $conditions['Users.role_id'] = $role_id;
            $this->set('role_id', $role_id);
        }

        $query = $this->Users->find()->where($conditions);
        $data = $this->paginate($query);

        $sexData = $this->Users->sexData();         //性别
        $stateData = $this->Users->stateData();     //状态
        $colorData = $this->Users->colorData();     //颜色
        $roleData = TableRegistry::get('Admin.Roles')->getAllRole();    //获取所有管理员组

        $this->set(compact('data', 'sexData', 'stateData', 'colorData', 'roleData'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Articles']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            //检查用户名是否已存在
            $conditions['Users.username'] = $this->request->getData('username');
            if ($this->Users->isHave($conditions)) {
                $this->jump(300, '添加失败，用户名已经存在!', 'users', true);
            }
            $user = $this->Users->newEntity();
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->jump(200, '添加成功!', 'users', true);
            } else {
                $this->jump(300, '添加失败，请重新添加!', 'users', true);
            }
        }

        $roleData = TableRegistry::get('Admin.Roles')->getAllRole();    //获取所有管理员组
        $this->set(compact('roleData'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            //检查用户名是否已存在
            $conditions['Users.id !='] = $this->request->getData('id');
            $conditions['Users.username'] = $this->request->getData('username');
            if ($this->Users->isHave($conditions)) {
                $this->jump(300, '编辑失败，用户名已经存在!', '', true);
            }
            $saveData = $this->request->getData();
            if (empty($saveData['password'])) {
                unset($saveData['password']);
            }
            $data = $this->Users->patchEntity($data, $saveData);
            if ($this->Users->save($data)) {
                $this->jump(200, '编辑成功!', 'users', true);
            } else {
                $this->jump(300, '编辑失败!', 'users', true);
            }
        }

        $stateData = $this->Users->stateData();     //状态
        $roleData = TableRegistry::get('Admin.Roles')->getAllRole();    //获取所有管理员组
        $this->set(compact('data', 'roleData', 'stateData'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->jump(200, '删除成功!', 'roles', false);
        } else {
            $this->jump(300, '删除失败,请重试!', 'roles', false);
        }
    }

    /*
     * 管理员登录
     *
     * */
    public function login()
    {
        if ($this->request->is('post')) {
            if (!empty($this->request->getData())) {
                $tip = '用户名或密码错误';
                $user = $this->Auth->identify();
                if ($user && $user['state'] == 1) {
                    $this->Auth->setUser($user);
                    return $this->redirect($this->Auth->redirectUrl());
                }
                if ($user && $user['state'] == 2) {
                    $tip = '您已被禁止登录，如有疑问，请联系管理员！';
                }
                $this->Flash->error($tip, ['key' => 'tip']);
            }
        }
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        $systemData = TableRegistry::get('Admin.Options')->getArrayData(array('Options.type' => 'system'));
        $this->set(compact('systemData'));
    }

    /*
     * 管理员注销
     *
     * */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /*
     * 重新登录弹出框  bjui框架使用
     *
     * */
    public function relogin() {
        if (!empty($this->request->getData())) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->jump(200, '登录成功!', '', true);
            } else {
                $this->jump(300, '登录失败!', '', true);
            }
        }
    }

    /*
     * 我的资料
     *
     * */
    public function myinfo()
    {
        $id = $this->Auth->user('id');
        $data = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->Users->patchEntity($data, $this->request->getData());
            if ($this->Users->save($data)) {
                $this->jump(200, '编辑成功!', '', true);
            } else {
                $this->jump(300, '编辑失败!', '', true);
            }
        }
        $this->set(compact('data'));
    }

    /*
     * 修改密码
     *
     * */
    public function resetpasswd()
    {
        $id = $this->Auth->user('id');
        $data = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Auth->identify();
            if (!$user) {
                $this->jump(300, '修改密码失败,原密码错误!', '', false);
            }
            $saveData = $this->request->getData();
            $saveData['password'] = $saveData['new'];
            $data = $this->Users->patchEntity($data, $saveData);
            if ($this->Users->save($data)) {
                $this->jump(200, '修改密码成功!', '', true);
            } else {
                $this->jump(300, '修改密码失败!', '', true);
            }
        }
        $this->set(compact('data'));
    }
}
