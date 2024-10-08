<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Journal Entity
 *
 * @property string $id
 * @property string|null $title
 * @property string|null $content
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $user_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Learner[] $learners
 */
class Journal extends Entity
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
        'title' => true,
        'content' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'user' => true,
        'learners' => true,
    ];
}
