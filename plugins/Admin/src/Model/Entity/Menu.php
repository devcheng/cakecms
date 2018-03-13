<?php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;

/**
 * Menu Entity
 *
 * @property int $id
 * @property string $name
 * @property int $parent_id
 * @property int $level
 * @property string $icon
 * @property string $target
 * @property string $reload
 * @property int $sort
 * @property int $isshow
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Admin\Model\Entity\ParentMenu $parent_menu
 * @property \Admin\Model\Entity\ChildMenu[] $child_menus
 */
class Menu extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'parent_id' => true,
        'level' => true,
        'icon' => true,
        'target' => true,
        'reload' => true,
        'sort' => true,
        'isshow' => true,
        'created' => true,
        'modified' => true,
        'parent_menu' => true,
        'child_menus' => true
    ];
}
