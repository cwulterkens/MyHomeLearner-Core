<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Journal Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LearnersTable&\Cake\ORM\Association\BelongsToMany $Learners
 *
 * @method \App\Model\Entity\Journal newEmptyEntity()
 * @method \App\Model\Entity\Journal newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Journal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Journal get($primaryKey, $options = [])
 * @method \App\Model\Entity\Journal findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Journal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Journal[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Journal|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Journal saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Journal[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Journal[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Journal[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Journal[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JournalTable extends Table
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

        $this->setTable('journal');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsToMany('Learners', [
            'foreignKey' => 'journal_id',
            'targetForeignKey' => 'learner_id',
            'joinTable' => 'journal_learners',
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmptyString('title');

        $validator
            ->scalar('content')
            ->maxLength('content', 15000)
            ->allowEmptyString('content');

        $validator
            ->uuid('user_id')
            ->allowEmptyString('user_id');

        return $validator;
    }

    public function findForUser(Query $query, array $options)
    {
        $userId = $options['user_id'];

        return $query->where(['user_id' => $userId])
            ->contain(['Users', 'Learners']);
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
