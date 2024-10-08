<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LearnersUser Entity
 *
 * @property string $learner_id
 * @property string $user_id
 *
 * @property \App\Model\Entity\Learner $learner
 * @property \App\Model\Entity\User $user
 */
class LearnersUser extends Entity
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
        'learner' => true,
        'user' => true,
    ];
}
