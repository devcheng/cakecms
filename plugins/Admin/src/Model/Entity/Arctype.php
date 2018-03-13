<?php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;

/**
 * Arctype Entity
 *
 * @property int $id
 * @property string $name
 * @property string $asname
 * @property int $parent_id
 * @property int $level
 * @property int $sort
 * @property int $type
 * @property string $image
 * @property int $isshow
 * @property int $isnav
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property string $href
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Admin\Model\Entity\ParentArctype $parent_arctype
 * @property \Admin\Model\Entity\ChildArctype[] $child_arctypes
 * @property \Admin\Model\Entity\Article[] $articles
 */
class Arctype extends Entity
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
        'asname' => true,
        'parent_id' => true,
        'level' => true,
        'sort' => true,
        'type' => true,
        'image' => true,
        'isshow' => true,
        'isnav' => true,
        'keywords' => true,
        'description' => true,
        'content' => true,
        'href' => true,
        'created' => true,
        'modified' => true,
        'parent_arctype' => true,
        'child_arctypes' => true,
        'articles' => true
    ];
}
