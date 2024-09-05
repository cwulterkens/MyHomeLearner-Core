<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ActivitiesLearner Entity
 *
 * @property string $activity_id
 * @property string $learner_id
 *
 * @property \App\Model\Entity\Activity $activity
 * @property \App\Model\Entity\Learner $learner
 */
class ActivitiesLearner extends Entity
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
        'activity_id' => true,
        'learner_id' => true,
        'activity' => true,
        'learner' => true,
    ];
}
