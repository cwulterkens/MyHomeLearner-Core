<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ActivitiesLearnersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('activities_learners');

        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Learners', [
            'foreignKey' => 'learner_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('activity_id')
            ->maxLength('activity_id', 36)
            ->notEmptyString('activity_id');

        $validator
            ->scalar('learner_id')
            ->maxLength('learner_id', 36)
            ->notEmptyString('learner_id');

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
        $rules->add($rules->existsIn('activity_id', 'Activities'), ['errorField' => 'activity_id']);
        $rules->add($rules->existsIn('learner_id', 'Learners'), ['errorField' => 'learner_id']);

        return $rules;
    }
}
