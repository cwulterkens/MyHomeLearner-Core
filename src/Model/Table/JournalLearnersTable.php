<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JournalLearners Model
 *
 * @property \App\Model\Table\LearnersTable&\Cake\ORM\Association\BelongsTo $Learners
 *
 * @method \App\Model\Entity\JournalLearner newEmptyEntity()
 * @method \App\Model\Entity\JournalLearner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\JournalLearner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JournalLearner get($primaryKey, $options = [])
 * @method \App\Model\Entity\JournalLearner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\JournalLearner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JournalLearner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\JournalLearner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JournalLearner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JournalLearner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JournalLearner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\JournalLearner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\JournalLearner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class JournalLearnersTable extends Table
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

        $this->setTable('journal_learners');
        $this->setDisplayField(['journal_id', 'learner_id']);
        $this->setPrimaryKey(['journal_id', 'learner_id']);

        $this->belongsTo('Learners', [
            'foreignKey' => 'learner_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn('learner_id', 'Learners'), ['errorField' => 'learner_id']);

        return $rules;
    }
}
