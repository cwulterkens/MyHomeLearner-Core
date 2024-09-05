<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HonorsLearners Model
 *
 * @property \App\Model\Table\HonorsTable&\Cake\ORM\Association\BelongsTo $Honors
 * @property \App\Model\Table\LearnersTable&\Cake\ORM\Association\BelongsTo $Learners
 *
 * @method \App\Model\Entity\HonorsLearner newEmptyEntity()
 * @method \App\Model\Entity\HonorsLearner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\HonorsLearner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HonorsLearner get($primaryKey, $options = [])
 * @method \App\Model\Entity\HonorsLearner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\HonorsLearner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HonorsLearner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HonorsLearner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HonorsLearner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HonorsLearner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HonorsLearner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\HonorsLearner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\HonorsLearner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class HonorsLearnersTable extends Table
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

        $this->setTable('honors_learners');
        $this->setDisplayField(['honor_id', 'learner_id']);
        $this->setPrimaryKey(['honor_id', 'learner_id']);

        $this->belongsTo('Honors', [
            'foreignKey' => 'honor_id',
            'joinType' => 'INNER',
        ]);
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
        $rules->add($rules->existsIn('honor_id', 'Honors'), ['errorField' => 'honor_id']);
        $rules->add($rules->existsIn('learner_id', 'Learners'), ['errorField' => 'learner_id']);

        return $rules;
    }
}
