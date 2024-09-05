<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Learner Entity
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $user_id
 * @property \Cake\I18n\FrozenDate|null $date_of_birth
 * @property \Cake\I18n\FrozenDate|null $graduation_date
 * @property string|null $avatar_url
 * @property string|null $email
 * @property string|null $phone
 * @property int $address_sync
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $addess_city
 * @property string|null $address_state
 * @property string|null $address_zip
 * @property int|null $status
 * @property int|null $graduated
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Course[] $courses
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Job[] $jobs
 * @property \App\Model\Entity\Activity[] $activities.php
 * @property \App\Model\Entity\Honor[] $honors
 * @property \App\Model\Entity\Journal[] $journal
 */
class Learner extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'user_id' => true,
        'date_of_birth' => true,
        'graduation_date' => true,
        'avatar_url' => true,
        'email' => true,
        'phone' => true,
        'address_sync' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'addess_city' => true,
        'address_state' => true,
        'address_zip' => true,
        'status' => true,
        'graduated' => true,
        'created' => true,
        'modified' => true,
        'users' => true,
        'courses' => true,
        'files' => true,
        'jobs' => true,
        'activities' => true,
        'honors' => true,
        'journal' => true,
        'age' => true
    ];
}
