<?php
namespace Admin\Controller;

use Admin\Controller\AppController;

/**
 * Arctypes Controller
 *
 * @property \Admin\Model\Table\ArctypesTable $Arctypes
 *
 * @method \Admin\Model\Entity\Arctype[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArctypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $data = $this->Arctypes->findAllData();
        $typeData = $this->Arctypes->typeData();
        $stateData = $this->Arctypes->stateData();     //状态
        $colorData = $this->Arctypes->colorData();     //状态

        $this->set(compact('data', 'typeData', 'stateData', 'colorData'));
    }

    /*
     * 查找带回
     *
     * */
    public function lookup($id = null)
    {
        $data = $this->Arctypes->findAllData(0, $id);
        $typeData = $this->Arctypes->typeData();

        $this->set(compact('data', 'typeData'));
    }

    /**
     * View method
     *
     * @param string|null $id Arctype id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $arctype = $this->Arctypes->get($id, [
            'contain' => ['ParentArctypes', 'ChildArctypes', 'Articles']
        ]);

        $this->set('arctype', $arctype);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($parent_id = null)
    {
        $arctype = $this->Arctypes->newEntity();
        if ($this->request->is('post')) {
            $saveData = $this->Arctypes->changeData($this->request->getData());
            $arctype = $this->Arctypes->patchEntity($arctype, $saveData);
            if ($this->Arctypes->save($arctype)) {
                $this->jump(200, '添加成功!', 'arctypes', true);
            } else {
                $this->jump(300, '添加失败!', 'arctypes', true);
            }
        }
        $typeData = $this->Arctypes->typeData();

        if (!empty($parent_id)) {
            $data = $this->Arctypes->get($parent_id, [
                'contain' => ['ParentArctypes']
            ]);
            $this->set('data', $data);
        }

        $this->set(compact('typeData'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Arctype id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->Arctypes->get($id, [
            'contain' => ['ParentArctypes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saveData = $this->Arctypes->changeData($this->request->getData());
            $data = $this->Arctypes->patchEntity($data, $saveData);
            if ($this->Arctypes->save($data)) {
                $this->jump(200, '编辑成功!', 'arctypes', true);
            } else {
                $this->jump(300, '编辑失败!', 'arctypes', true);
            }
        }
        $typeData = $this->Arctypes->typeData();
        $stateData = $this->Arctypes->stateData();     //状态
        $this->set(compact('data', 'typeData', 'stateData'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Arctype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //判断是否存在子菜单
        $conditions['Arctypes.parent_id'] = $id;
        if ($this->Arctypes->haveChild($conditions)) {
            $this->jump(300, '删除失败,请先删除所有子栏目!', '', false);
        }

        $this->request->allowMethod(['post', 'delete']);
        $arctype = $this->Arctypes->get($id);
        if ($this->Arctypes->delete($arctype)) {
            $this->jump(200, '删除成功!', '', false);
        } else {
            $this->jump(300, '删除失败,请重试!', '', false);
        }
    }
}
