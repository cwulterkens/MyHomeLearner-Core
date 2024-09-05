<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LearnersTable extends Table
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

        $this->setTable('learners');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Courses', [
            'foreignKey' => 'learner_id',
        ]);
        $this->hasMany('Files', [
            'foreignKey' => 'learner_id',
        ]);
        $this->hasMany('Jobs', [
            'foreignKey' => 'learner_id',
        ]);
        $this->belongsToMany('Activities', [
            'foreignKey' => 'learner_id',
            'targetForeignKey' => 'activity_id',
            'joinTable' => 'activities_learners',
        ]);
        $this->belongsToMany('Files', [
            'foreignKey' => 'learner_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'files_learners',
        ]);
        $this->belongsToMany('Honors', [
            'foreignKey' => 'learner_id',
            'targetForeignKey' => 'honor_id',
            'joinTable' => 'honors_learners',
        ]);
        $this->belongsToMany('Journal', [
            'foreignKey' => 'learner_id',
            'targetForeignKey' => 'journal_id',
            'joinTable' => 'journal_learners',
        ]);
        $this->belongsTo('Users');
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
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->uuid('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->date('date_of_birth')
            ->allowEmptyDate('date_of_birth');

        $validator
            ->date('graduation_date')
            ->allowEmptyDate('graduation_date');

        $validator
            ->scalar('avatar_url')
            ->maxLength('avatar_url', 255)
            ->allowEmptyString('avatar_url');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 255)
            ->allowEmptyString('phone');

        $validator
            ->integer('address_sync')
            ->notEmptyString('address_sync');

        $validator
            ->scalar('address_line_1')
            ->maxLength('address_line_1', 255)
            ->allowEmptyString('address_line_1');

        $validator
            ->scalar('address_line_2')
            ->maxLength('address_line_2', 255)
            ->allowEmptyString('address_line_2');

        $validator
            ->scalar('addess_city')
            ->maxLength('addess_city', 255)
            ->allowEmptyString('addess_city');

        $validator
            ->scalar('address_state')
            ->maxLength('address_state', 2)
            ->allowEmptyString('address_state');

        $validator
            ->scalar('address_zip')
            ->maxLength('address_zip', 10)
            ->allowEmptyString('address_zip');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->integer('graduated')
            ->allowEmptyString('graduated');

        return $validator;
    }

    public function findForCurrentUser(Query $query, array $options)
    {
        $currentUserId = $options['currentUserId'];

        return $query->contain(['Users'])
            ->where(['Learners.user_id' => $currentUserId]);
    }

    public function findWithUser(Query $query, array $options)
    {
        return $query->contain(['Users']);
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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
