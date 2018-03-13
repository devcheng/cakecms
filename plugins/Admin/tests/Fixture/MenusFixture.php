<?php
namespace Admin\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MenusFixture
 *
 */
class MenusFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'menus';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '自增id', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '菜单名称', 'precision' => null, 'fixed' => null],
        'parent_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '上级菜单id', 'precision' => null, 'autoIncrement' => null],
        'level' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '菜单级别', 'precision' => null],
        'icon' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '菜单图标', 'precision' => null, 'fixed' => null],
        'target' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '菜单链接', 'precision' => null, 'fixed' => null],
        'reload' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '重新载入某个标签', 'precision' => null, 'fixed' => null],
        'sort' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '菜单排序', 'precision' => null],
        'isshow' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '是否显示。1显示，2隐藏', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '创建时间', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '修改时间', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'parent_id' => 1,
            'level' => 1,
            'icon' => 'Lorem ipsum dolor ',
            'target' => 'Lorem ipsum dolor sit amet',
            'reload' => 'Lorem ipsum dolor ',
            'sort' => 1,
            'isshow' => 1,
            'created' => '2018-03-13 10:16:36',
            'modified' => '2018-03-13 10:16:36'
        ],
    ];
}
