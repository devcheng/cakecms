<?php
namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Options Model
 *
 * @method \Admin\Model\Entity\Option get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\Option newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\Option[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\Option|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Option patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\Option[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\Option findOrCreate($search, callable $callback = null, $options = [])
 */
class OptionsTable extends Table
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

        $this->setTable('ad_options');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->scalar('field')
            ->maxLength('field', 50)
            ->allowEmpty('field');

        $validator
            ->scalar('value')
            ->allowEmpty('value');

        $validator
            ->scalar('type')
            ->maxLength('type', 50)
            ->allowEmpty('type');

        $validator
            ->scalar('autoload')
            ->maxLength('autoload', 20)
            ->allowEmpty('autoload');

        return $validator;
    }

    /*
     * 更新数据
     *
     * */
    public function saveData($type, $data)
    {
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $saveData['type'] = $type;
                $saveData['field'] = $key;
                $saveData['value'] = $val;
                $this->execute($saveData);
            }
        }
        return true;
    }

    /*
     * 具体执行方法
     *
     * */
    public function execute($saveData)
    {
        $conditions['type'] = $saveData['type'];
        $conditions['field'] = $saveData['field'];
        $query = $this->find()
            ->where($conditions)
            ->first();
        $data = empty($query) ? $this->newEntity() : $this->get($query['id']);
        $data = $this->patchEntity($data, $saveData);
        $this->save($data);
    }

    /*
     * 获取所有数据  以数组形式返回
     *
     * */
    public function getArrayData($conditions = array())
    {
        $query = $this->find('list', [
            'keyField' => 'field',
            'valueField' => 'value',
            'conditions' => $conditions
        ]);
        return $query->toArray();
    }
}
