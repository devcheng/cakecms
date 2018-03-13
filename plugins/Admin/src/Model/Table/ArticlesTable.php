<?php
namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \Admin\Model\Table\ArctypesTable|\Cake\ORM\Association\BelongsTo $Arctypes
 * @property \Admin\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Admin\Model\Entity\Article get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\Article newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\Article|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\Article[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\Article findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
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

        $this->setTable('ad_articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Arctypes', [
            'foreignKey' => 'arctype_id',
            'className' => 'Admin.Arctypes'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Admin.Users'
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->allowEmpty('title');

        $validator
            ->scalar('shorttitle')
            ->maxLength('shorttitle', 36)
            ->allowEmpty('shorttitle');

        $validator
            ->scalar('color')
            ->maxLength('color', 10)
            ->allowEmpty('color');

        $validator
            ->scalar('description')
            ->maxLength('description', 250)
            ->allowEmpty('description');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 100)
            ->allowEmpty('keywords');

        $validator
            ->scalar('content')
            ->maxLength('content', 16777215)
            ->allowEmpty('content');

        $validator
            ->scalar('author')
            ->maxLength('author', 50)
            ->allowEmpty('author');

        $validator
            ->scalar('source')
            ->maxLength('source', 50)
            ->allowEmpty('source');

        $validator
            ->dateTime('pubdate')
            ->allowEmpty('pubdate');

        $validator
            ->scalar('image')
            ->maxLength('image', 200)
            ->allowEmpty('image');

        $validator
            ->allowEmpty('autoimage');

        $validator
            ->scalar('tag')
            ->maxLength('tag', 100)
            ->allowEmpty('tag');

        $validator
            ->integer('click')
            ->allowEmpty('click');

        $validator
            ->allowEmpty('isshow');

        $validator
            ->allowEmpty('isbold');

        $validator
            ->allowEmpty('istop');

        $validator
            ->allowEmpty('ishot');

        $validator
            ->allowEmpty('isindex');

        $validator
            ->allowEmpty('isred');

        $validator
            ->allowEmpty('ishref');

        $validator
            ->scalar('href')
            ->maxLength('href', 150)
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
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['arctype_id'], 'Arctypes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /*
     * 状态
     *
     * */
    public function stateData()
    {
        return $data = array(
            '1' => '正常',
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
     * 自定义属性
     *
     * */
    public function diyData()
    {
        return $data = array(
            'ishot' => '热门',
            'istop' => '置顶',
            'isindex' => '推荐',
            'isbold' => '加粗',
            'isred' => '标红',
            'ishref' => '链接',
            'isshow' => '显示',
            'ishide' => '隐藏'
        );
    }

    /*
     * 数据转换
     *
     * */
    public function changeData($data = array())
    {
        $diyNoArr = array(
            'ishot' => 2,
            'istop' => 2,
            'isindex' => 2,
            'isbold' => 2,
            'isred' => 2,
            'ishref' => 2,
            'isshow' => 1,
            'autoimage' => 2
        );

        foreach ($diyNoArr as $key => $val) {
            if (!isset($data[$key])) {
                $data[$key] = $val;
            }
        }
        return $data;
    }

    /*
     * 提取内容第一张图片为缩略图
     *
     * */
    public function autoImage($content, $order = 'ALL'){
        $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, $content, $match);
        if (isset($match[1]) && !empty($match[1])) {
            if ($order === 'ALL') {
                return $match[1][0];
            }
            if (is_numeric($order) && isset($match[1][$order])) {
                return $match[1][$order];
            }
        }
        return '';
    }

    /*
     * 搜索条件转换
     *
     * */
    public function conditionsChange($data, $conditions, $val = 1)
    {
        if (is_string($data)) {
            if ($data == 'ishide') {
                $data = 'isshow';
                $val = 2;
            }
            $conditions['Articles.' . $data] = $val;
        }

        if (is_array($data)) {
            foreach ($data as $item) {
                if ($item == 'ishide') {
                    $item = 'isshow';
                    $val = 2;
                }
                $conditions['Articles.' . $item] = $val;
            }
        }
        return $conditions;
    }
}
