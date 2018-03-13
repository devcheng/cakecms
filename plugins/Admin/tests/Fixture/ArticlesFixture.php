<?php
namespace Admin\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticlesFixture
 *
 */
class ArticlesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '自增id', 'autoIncrement' => true, 'precision' => null],
        'arctype_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '栏目id', 'precision' => null, 'autoIncrement' => null],
        'title' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '标题', 'precision' => null, 'fixed' => null],
        'shorttitle' => ['type' => 'string', 'length' => 36, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '短标题', 'precision' => null, 'fixed' => null],
        'color' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '颜色', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '描述', 'precision' => null, 'fixed' => null],
        'keywords' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '关键字', 'precision' => null, 'fixed' => null],
        'content' => ['type' => 'text', 'length' => 16777215, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '内容', 'precision' => null],
        'author' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '作者', 'precision' => null, 'fixed' => null],
        'source' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '来源', 'precision' => null, 'fixed' => null],
        'pubdate' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '发布时间', 'precision' => null],
        'image' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '缩略图', 'precision' => null, 'fixed' => null],
        'autoimage' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '是否提取图片，1是，2否。提取内容中第一个图片为缩略图', 'precision' => null],
        'tag' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '标签', 'precision' => null, 'fixed' => null],
        'click' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '点击次数', 'precision' => null, 'autoIncrement' => null],
        'isshow' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '是否显示，1显示，2隐藏', 'precision' => null],
        'isbold' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '是否加粗，1是，2否', 'precision' => null],
        'istop' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '是否置顶，1是，2否', 'precision' => null],
        'ishot' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '是否热门，1是，2否', 'precision' => null],
        'isindex' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '是否首页，1是，2否', 'precision' => null],
        'isred' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '是否标红，1是，2否', 'precision' => null],
        'ishref' => ['type' => 'tinyinteger', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '是否链接，1是，2否', 'precision' => null],
        'href' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '链接URL', 'precision' => null, 'fixed' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '管理员id', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '创建时间', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '修改时间', 'precision' => null],
        '_indexes' => [
            'created' => ['type' => 'index', 'columns' => ['created'], 'length' => []],
        ],
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
            'arctype_id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'shorttitle' => 'Lorem ipsum dolor sit amet',
            'color' => 'Lorem ip',
            'description' => 'Lorem ipsum dolor sit amet',
            'keywords' => 'Lorem ipsum dolor sit amet',
            'content' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'author' => 'Lorem ipsum dolor sit amet',
            'source' => 'Lorem ipsum dolor sit amet',
            'pubdate' => '2018-03-13 10:16:29',
            'image' => 'Lorem ipsum dolor sit amet',
            'autoimage' => 1,
            'tag' => 'Lorem ipsum dolor sit amet',
            'click' => 1,
            'isshow' => 1,
            'isbold' => 1,
            'istop' => 1,
            'ishot' => 1,
            'isindex' => 1,
            'isred' => 1,
            'ishref' => 1,
            'href' => 'Lorem ipsum dolor sit amet',
            'user_id' => 1,
            'created' => '2018-03-13 10:16:29',
            'modified' => '2018-03-13 10:16:29'
        ],
    ];
}
