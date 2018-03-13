<?php
namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Menus Model
 *
 * @property \Admin\Model\Table\MenusTable|\Cake\ORM\Association\BelongsTo $ParentMenus
 * @property \Admin\Model\Table\MenusTable|\Cake\ORM\Association\HasMany $ChildMenus
 *
 * @method \Admin\Model\Entity\Menu get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\Menu newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\Menu[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\Menu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Menu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\Menu[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\Menu findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MenusTable extends Table
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

        $this->setTable('ad_menus');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentMenus', [
            'className' => 'Admin.Menus',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildMenus', [
            'className' => 'Admin.Menus',
            'foreignKey' => 'parent_id'
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
            ->allowEmpty('level');

        $validator
            ->scalar('icon')
            ->maxLength('icon', 20)
            ->allowEmpty('icon');

        $validator
            ->scalar('target')
            ->maxLength('target', 50)
            ->allowEmpty('target');

        $validator
            ->scalar('reload')
            ->maxLength('reload', 20)
            ->allowEmpty('reload');

        $validator
            ->allowEmpty('sort');

        $validator
            ->allowEmpty('isshow');

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
//        $rules->add($rules->existsIn(['parent_id'], 'ParentMenus'));
//
//        return $rules;
//    }

    /*
     * 状态
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
     * 获取所有菜单
     * @param $parent_id    父菜单id
     * @param $not_id       不包含的id及该id下的子菜单
     *
     * */
    public function findAllMenu($parent_id = 0, $not_id = null)
    {
        global $menu;
        $conditions['Menus.parent_id'] = $parent_id;
        if (!empty($not_id)) {
            $conditions['Menus.id != '] = $not_id;
        }
        $data = $this->findMenu($conditions);
        foreach ($data as $item ) {
            $menu[] = $item;
            $this->findAllMenu($item->id, $not_id);
        }
        return $menu;
    }

    /*
     * 查找菜单
     *
     * */
    public function findMenu($conditions = null) {
        $query = $this->find()
            ->where($conditions)
            ->order(['level' => 'asc', 'sort' => 'desc', 'created' => 'asc'])
            ->toArray();
        return $query;
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
        if (empty($data['icon'])) {
            $data['icon'] = ($data['level'] == 2) ? 'caret-right' : 'fa-caret-right';
        }
        return $data;
    }

    /*
     * 判断是否存在子菜单
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
     * 根据用户组来获取菜单
     *
     * */
    public function getMenu($role_id = null) {
        $roleMenu = TableRegistry::get('Admin.Roles')->getData(array('Roles.id' => $role_id));
        $menus = json_decode($roleMenu->menus);
        $menuData = array();
        if (!empty($menus)) {
            $conditions['Menus.id in'] = $menus;
            $conditions['Menus.level'] = 1;
            $conditions['Menus.isshow'] = 1;
            $menuData = $this->findMenu($conditions);
            if (!empty($menuData)) {
                foreach ($menuData as $key => $val) {
                    if (!empty($menus) && in_array($val->id, $menus)) {
                        //获取二级菜单
                        $childConditions['Menus.parent_id'] = $val->id;
                        $childConditions['Menus.isshow'] = 1;
                        $child = $this->findMenu($childConditions);
                        if (!empty($child)) {
                            foreach ($child as $ckey => $cval) {
                                if (!empty($menus) && in_array($cval->id, $menus)) {
                                    //获取三级菜单
                                    $threeConditions['Menus.parent_id'] = $cval->id;
                                    $threeConditions['Menus.isshow'] = 1;
                                    $three = $this->findMenu($threeConditions);
                                    $menuData[$key]->child = array($ckey => array('parent' => $cval));
                                    if (!empty($three)) {
                                        foreach ($three as $tkey => $tval) {
                                            if(!empty($menus) && in_array($tval->id, $menus)) {
                                                $menuData[$key]->child[$ckey]['child'][$tkey] = $tval;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $menuData;
    }
}
