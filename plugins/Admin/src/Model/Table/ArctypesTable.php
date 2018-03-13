<?php
namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Arctypes Model
 *
 * @property \Admin\Model\Table\ArctypesTable|\Cake\ORM\Association\BelongsTo $ParentArctypes
 * @property \Admin\Model\Table\ArctypesTable|\Cake\ORM\Association\HasMany $ChildArctypes
 * @property \Admin\Model\Table\ArticlesTable|\Cake\ORM\Association\HasMany $Articles
 *
 * @method \Admin\Model\Entity\Arctype get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\Arctype newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\Arctype[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\Arctype|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Arctype patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\Arctype[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\Arctype findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArctypesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ad_arctypes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentArctypes', [
            'className' => 'Admin.Arctypes',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildArctypes', [
            'className' => 'Admin.Arctypes',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'arctype_id',
            'className' => 'Admin.Articles'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->allowEmpty('name');

        $validator
            ->scalar('asname')
            ->maxLength('asname', 50)
            ->allowEmpty('asname');

        $validator
            ->allowEmpty('level');

        $validator
            ->integer('sort')
            ->allowEmpty('sort');

        $validator
            ->allowEmpty('type');

        $validator
            ->scalar('image')
            ->maxLength('image', 50)
            ->allowEmpty('image');

        $validator
            ->allowEmpty('isshow');

        $validator
            ->allowEmpty('isnav');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 255)
            ->allowEmpty('keywords');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        $validator
            ->scalar('content')
            ->allowEmpty('content');

        $validator
            ->scalar('href')
            ->maxLength('href', 255)
            ->allowEmpty('href');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
//    public function buildRules(RulesChecker $rules)
//    {
//        $rules->add($rules->existsIn(['parent_id'], 'ParentArctypes'));
//
//        return $rules;
//    }

    /*
     * 栏目类型
     *
     * */
    public function typeData() {
        return $data = array(
            '1' => '分类栏目',
            '2' => '独立页面',
            '3' => '列表栏目',
            '4' => '图片栏目',
            '5' => '链接栏目'
        );
    }

    /*
     * 栏目状态
     *
     * */
    public function stateData()
    {
        return $data = array(
            '1' => '显示',
            '2' => '隐藏'
        );
    }

    /*
     * 颜色
     *
     * */
    public function colorData()
    {
        return $data = array(
            '1' => 'success',
            '2' => 'default'
        );
    }

    /*
     * 获取所有栏目
     * @param $parent_id    父栏目id
     * @param $not_id       不包含的id及该id下的子栏目
     *
     * */
    public function findAllData($parent_id = 0, $not_id = null)
    {
        global $tmp;    //设置全局变量，防止循环查找子栏目时，$tmp 置空
        if (!empty($not_id)) {
            $conditions['Arctypes.id != '] = $not_id;
        }
        $conditions['Arctypes.parent_id'] = $parent_id;
        $data = $this->findData($conditions);

        if (!empty($data)) {
            foreach($data as $item) {
                //判断是否有子栏目
                $childConditions['Arctypes.parent_id'] = $item->id;
                $childCount = $this->childCount($childConditions);
                $item->leaf = $childCount>0 ? 1:0;
                $tmp[$item->id] = $item;
                $this->findAllData($item->id, $not_id);  //循环查找子栏目
            }
        }
        return $tmp;
    }

    /*
     * 获取栏目数据
     *
     * */
    public function findData($conditions = array()) {
        $query = $this->find('all')
            ->where($conditions)
            ->order(['level' => 'asc', 'sort' => 'desc', 'created' => 'asc']);
        return $query;
    }

    /*
     * 获取子栏目个数
     *
     * */
    public function childCount($conditions = array()) {
        $query = $this->find('all', [
            'conditions' => $conditions
        ]);
        $total = $query->count();
        return $total;
    }

    /*
     * 判断是否存在子栏目
     *
     * */
    public function haveChild($conditions = array()) {
        $query = $this->find('all', [
            'conditions' => $conditions
        ]);
        $total = $query->count();
        $result = ($total>0) ? true : false;
        return $result;
    }

    /*
     * 数据转换
     *
     * */
    public function changeData($data = array())
    {
        $data['sort'] = !empty($data['sort']) ? $data['sort'] : 0;
        $data['parent_id'] = !empty($data['parent_id']) ? $data['parent_id'] : 0;
        $data['level'] = empty($data['parent_level']) ? 1 : $data['parent_level'] + 1;
        return $data;
    }

    /*
     * 获取所有栏目  一维数组返回
     *
     * */
    public function getAllArr() {
        $data = $this->findData();
        $tmp = array();
        foreach ($data as $item) {
            $tmp[$item->id] = $item->name;
        }
        return $tmp;
    }

    /*
     * 获取所有栏目   ID
     *
     * */
    public function findAllId($parent_id = null) {
        global $tmpId;    //设置全局变量，防止循环查找子栏目时，$tmpId 置空
        $parent_id = empty($parent_id) ? 0:$parent_id;
        $conditions['Arctypes.parent_id'] = $parent_id;
        $data = $this->findData($conditions);
        $tmpId[] = $parent_id;
        if(!empty($data)) {
            foreach($data as $item) {
                $tmpId[] = $item->id;
                $this->findAllId($item->id);  //循环查找子栏目
            }
        }
        return $tmpId;
    }
}
