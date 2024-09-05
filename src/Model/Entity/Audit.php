<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Audit Entity
 *
 * @property string $id
 * @property string|null $message
 * @property string|null $user_id
 * @property string|null $record_id
 * @property string|null $component_name
 * @property string|null $action_name
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $ip
 *
 * @property \App\Model\Entity\User $user
 */
class Audit extends Entity
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
        'message' => true,
        'user_id' => true,
        'record_id' => true,
        'component_name' => true,
        'action_name' => true,
        'created' => true,
        'modified' => true,
        'ip' => true,
        'user' => true,
    ];
}
