<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $subject_id
 * @property string|null $user_id
 * @property string|null $school_year_id
 * @property string|null $learner_id
 * @property string|null $grade_id
 * @property int|null $credits
 * @property int|null $hidden
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Subject $subject
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\SchoolYear $school_year
 * @property \App\Model\Entity\Learner $learner
 * @property \App\Model\Entity\Grade $grade
 */
class Course extends Entity
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
        'name' => true,
        'description' => true,
        'subject_id' => true,
        'user_id' => true,
        'school_year_id' => true,
        'learner_id' => true,
        'grade_id' => true,
        'credits' => true,
        'hidden' => true,
        'created' => true,
        'modified' => true,
        'subject' => true,
        'user' => true,
        'school_year' => true,
        'learner' => true,
        'grade' => true,
    ];
}
