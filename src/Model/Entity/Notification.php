<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property string $id
 * @property string $subject
 * @property string $content
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $emailed
 * @property string|null $user_id
 * @property int|null $viewed
 * @property string|null $importance
 *
 * @property \App\Model\Entity\User $user
 */
class Notification extends Entity
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
        'subject' => true,
        'content' => true,
        'created' => true,
        'modified' => true,
        'emailed' => true,
        'user_id' => true,
        'viewed' => true,
        'importance' => true,
        'user' => true,
    ];
}
