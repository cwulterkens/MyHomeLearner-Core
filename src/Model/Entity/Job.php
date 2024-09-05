<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity
 *
 * @property string $id
 * @property string $employer
 * @property string $title
 * @property string|null $description
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate|null $end_date
 * @property bool|null $current_job
 * @property string $learner_id
 * @property string $user_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Learner $learner
 * @property \App\Model\Entity\User $user
 */
class Job extends Entity
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
        'employer' => true,
        'title' => true,
        'description' => true,
        'start_date' => true,
        'end_date' => true,
        'current_job' => true,
        'learner_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'learner' => true,
        'user' => true,
    ];
}
