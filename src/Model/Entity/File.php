<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property string $id
 * @property string $filename
 * @property string|null $name
 * @property string $file_type_id
 * @property string|null $learner_id
 * @property string $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $file_dir
 * @property string|null $type
 * @property int|null $size
 *
 * @property \App\Model\Entity\FileType $file_type
 * @property \App\Model\Entity\Learner[] $learners
 * @property \App\Model\Entity\User $user
 */
class File extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'filename' => true,
        'name' => true,
        'file_type_id' => true,
        'learner_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'file_dir' => true,
        'type' => true,
        'size' => true,
        'file_type' => true,
        'learners' => true,
        'user' => true,
    ];
}
