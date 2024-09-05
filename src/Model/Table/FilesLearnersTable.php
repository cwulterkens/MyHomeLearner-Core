<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FilesLearners Model
 *
 * @property \App\Model\Table\FilesTable&\Cake\ORM\Association\BelongsTo $Files
 * @property \App\Model\Table\LearnersTable&\Cake\ORM\Association\BelongsTo $Learners
 *
 * @method \App\Model\Entity\FilesLearner newEmptyEntity()
 * @method \App\Model\Entity\FilesLearner newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\FilesLearner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FilesLearner get($primaryKey, $options = [])
 * @method \App\Model\Entity\FilesLearner findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\FilesLearner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FilesLearner[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FilesLearner|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilesLearner saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FilesLearner[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FilesLearner[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\FilesLearner[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\FilesLearner[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FilesLearnersTable extends Table
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

        $this->setTable('files_learners');
        $this->setDisplayField(['file_id', 'learner_id']);
        $this->setPrimaryKey(['file_id', 'learner_id']);

        $this->belongsTo('Files', [
            'foreignKey' => 'file_id',
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
        $rules->add($rules->existsIn('file_id', 'Files'), ['errorField' => 'file_id']);
        $rules->add($rules->existsIn('learner_id', 'Learners'), ['errorField' => 'learner_id']);

        return $rules;
    }
}
