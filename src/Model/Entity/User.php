<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property string $id
 * @property string|null $email
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int $active
 * @property int $admin
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $address_city
 * @property string|null $address_state
 * @property string|null $address_zip
 * @property string|null $institution_name
 * @property string|null $phone
 * @property string|null $address_country
 * @property int|null $notify_alerts
 * @property int|null $notify_marketing
 * @property string|null $customer_id
 * @property string|null $avatar_url
 *
 * @property \App\Model\Entity\Audit[] $audits
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Learner[] $learners
 * @property \App\Model\Entity\Notification[] $notifications
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'active' => true,
        'verified' => true,
        'admin' => true,
        'created' => true,
        'modified' => true,
        'address_line_1' => true,
        'address_line_2' => true,
        'address_city' => true,
        'address_state' => true,
        'address_zip' => true,
        'institution_name' => true,
        'phone' => true,
        'address_country' => true,
        'notify_alerts' => true,
        'notify_marketing' => true,
        'customer_id' => true,
        'avatar_url' => true,
        'security_token' => true,
        'audits' => true,
        'files' => true,
        'learners' => true,
        'notifications' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
    protected function _setPassword($password)
    {
        if ($password !== null && strlen($password) > 0) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($password);
        }

        return $this->getOriginal('password');
    }

}
