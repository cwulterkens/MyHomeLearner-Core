<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\AuditsTable&\Cake\ORM\Association\HasMany $Audits
 * @property \App\Model\Table\FilesTable&\Cake\ORM\Association\HasMany $Files
 * @property \App\Model\Table\LearnersTable&\Cake\ORM\Association\HasMany $Learners
 * @property \App\Model\Table\NotificationsTable&\Cake\ORM\Association\HasMany $Notifications
 * @property \App\Model\Table\LearnersTable&\Cake\ORM\Association\BelongsToMany $Learners
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Audits', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Files', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Learners', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Notifications', [
            'foreignKey' => 'user_id',
        ]);

        $this->belongsToMany('Learners', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'learner_id',
            'joinTable' => 'learners_users',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->email('email')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password')
            ->add('password', [
                'length' => [
                    'rule' => ['minLength', 8],
                    'message' => 'Password must be at least 8 characters long'
                ],
                'complexity' => [
                    'rule' => function ($value, $context) {
                        if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])/', $value)) {
                            return false;
                        }
                        return true;
                    },
                    'message' => 'Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character'
                ]
            ]);

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->notEmptyString('last_name');

        $validator
            ->integer('active')
            ->allowEmptyString('active');

        $validator
            ->integer('admin')
            ->allowEmptyString('admin');

        $validator
            ->integer('verified')
            ->allowEmptyString('verified');

        $validator
            ->scalar('address_line_1')
            ->maxLength('address_line_1', 255)
            ->allowEmptyString('address_line_1');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 255)
            ->allowEmptyString('address_line_2');

        $validator
            ->scalar('address_city')
            ->maxLength('address_city', 255)
            ->allowEmptyString('address_city');

        $validator
            ->scalar('address_state')
            ->maxLength('address_state', 2)
            ->allowEmptyString('address_state');

        $validator
            ->scalar('address_zip')
            ->maxLength('address_zip', 10)
            ->allowEmptyString('address_zip');

        $validator
            ->scalar('institution_name')
            ->maxLength('institution_name', 255)
            ->allowEmptyString('institution_name');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmptyString('phone');

        $validator
            ->scalar('address_country')
            ->maxLength('address_country', 50)
            ->allowEmptyString('address_country');

        $validator
            ->integer('notify_alerts')
            ->allowEmptyString('notify_alerts');

        $validator
            ->integer('notify_marketing')
            ->allowEmptyString('notify_marketing');

        $validator
            ->scalar('customer_id')
            ->maxLength('customer_id', 50)
            ->allowEmptyString('customer_id');

        $validator
            ->scalar('avatar_url')
            ->maxLength('avatar_url', 255)
            ->allowEmptyString('avatar_url');

        $validator
            ->scalar('security_token')
            ->maxLength('security_token', 255)
            ->allowEmptyString('security_token');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->isUnique(['id']), ['errorField' => 'id']);
        $rules->add($rules->isUnique(['security_token']), ['errorField' => 'security_token']);

        return $rules;
    }
}
