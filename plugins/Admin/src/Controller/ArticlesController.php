<?php
namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Articles Controller
 *
 * @property \Admin\Model\Table\ArticlesTable $Articles
 *
 * @method \Admin\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public $paginate = [
        'order' => [
            'Articles.istop' => 'asc',
            'Articles.created' => 'desc'
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
        $this->paginate['contain'] = ['Arctypes', 'Users'];
        $this->paginate['fields'] = ['Articles.id', 'Articles.title', 'Articles.id', 'Articles.pubdate', 'Articles.click', 'Articles.image', 'Articles.isshow', 'Articles.isred', 'Articles.isbold', 'Articles.ishot', 'Articles.istop', 'Articles.isindex', 'Arctypes.name', 'Users.username', 'Users.nickname'];

        //栏目查询
        $conditions = array();
        if (!empty($this->request->getData('arctype_id'))) {
            $arctype_id = $this->request->getData('arctype_id');
            $conditions['Articles.arctype_id in'] = TableRegistry::get('Admin.Arctypes')->findAllId($arctype_id);
            $this->set('arctype_id', $arctype_id);
        }

        //标题查询
        if (!empty($this->request->getData('title'))) {
            $title = $this->request->getData('title');
            $conditions['Articles.title like'] = '%' . $title . '%';
            $this->set('title', $title);
        }

        //发布日期查询
        if (!empty($this->request->getData('pubdate'))) {
            $pubdate = $this->request->getData('pubdate');
            $conditions['Articles.pubdate like'] = '%' . $pubdate . '%';
            $this->set('pubdate', $pubdate);
        }

        //自定义属性查询
        if (!empty($this->request->getData('diy'))) {
            $conditions = $this->Articles->conditionsChange($this->request->getData('diy'), $conditions);
            $this->set('diy', $this->request->data['diy']);
        }

        $query = $this->Articles->find()->where($conditions);
        $data = $this->paginate($query);

        $diyData = $this->Articles->diyData();
        $stateData = $this->Articles->stateData();
        $colorData = $this->Articles->colorData();
        $arctypeData = TableRegistry::get('Admin.Arctypes')->findAllData();

        $this->set(compact('data', 'arctypeData', 'stateData', 'colorData', 'diyData'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Arctypes', 'Users']
        ]);

        $this->set('article', $article);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $saveData = $this->request->getData();
            //提取内容第一张图片为缩略图
            if ($this->request->getData('autoimage') == 1 && empty($this->request->getData('image'))) {
                $saveData['image'] = $this->Articles->autoImage($this->request->getData('content'));
            }
            $saveData['user_id'] = $this->Auth->user('id');
            $article = $this->Articles->patchEntity($article, $saveData);
            if ($this->Articles->save($article)) {
                $this->jump(200, '添加成功!', 'articles', true);
            } else {
                $this->jump(300, '添加失败!', 'articles', true);
            }
        }

        $arctypeData = TableRegistry::get('Admin.Arctypes')->findAllData();
        $this->set(compact('arctypeData'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $data = $this->Articles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $saveData = $this->request->getData();
            //提取内容第一张图片为缩略图
            if ($this->request->getData('autoimage') == 1 && empty($this->request->getData('image'))) {
                $saveData['image'] = $this->Articles->autoImage($this->request->getData('content'));
            }
            $saveData = $this->Articles->changeData($saveData);
            $data = $this->Articles->patchEntity($data, $saveData);
            if ($this->Articles->save($data)) {
                $this->jump(200, '编辑成功!', 'articles', true);
            } else {
                $this->jump(300, '编辑失败!', 'articles', true);
            }
        }

        $arctypeData = TableRegistry::get('Admin.Arctypes')->findAllData();
        $this->set(compact('data', 'arctypeData'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->jump(200, '删除成功!', '', false);
        } else {
            $this->jump(300, '删除失败,请重试!', '', false);
        }
    }

    /*
     * 批量删除
     *
     * */
    public function batchDel()
    {
        $idArr = explode(',', $this->request->getQuery('delids'));
        if($this->Articles->deleteAll(array('Articles.id in' => $idArr))) {
            $this->jump(200, '批量删除成功!', '', false);
        }else{
            $this->jump(300, '批量删除失败,请重试!', '', false);
        }
    }

    /*
     * 文章预览
     *
     * */
    public function preview($id = null)
    {
        $data = $this->Articles->get($id, [
            'contain' => ['Arctypes']
        ]);

        $this->set(compact('data'));
    }
}
