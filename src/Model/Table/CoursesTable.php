<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @property \App\Model\Table\SubjectsTable&\Cake\ORM\Association\BelongsTo $Subjects
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\SchoolYearsTable&\Cake\ORM\Association\BelongsTo $SchoolYears
 * @property \App\Model\Table\LearnersTable&\Cake\ORM\Association\BelongsTo $Learners
 * @property \App\Model\Table\GradesTable&\Cake\ORM\Association\BelongsTo $Grades
 *
 * @method \App\Model\Entity\Course newEmptyEntity()
 * @method \App\Model\Entity\Course newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CoursesTable extends Table
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

        $this->setTable('courses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('SchoolYears', [
            'foreignKey' => 'school_year_id',
        ]);
        $this->belongsTo('Learners', [
            'foreignKey' => 'learner_id',
        ]);
        $this->belongsTo('Grades', [
            'foreignKey' => 'grade_id',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 10000)
            ->allowEmptyString('description');

        $validator
            ->uuid('subject_id')
            ->allowEmptyString('subject_id');

        $validator
            ->uuid('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->uuid('school_year_id')
            ->allowEmptyString('school_year_id');

        $validator
            ->uuid('learner_id')
            ->allowEmptyString('learner_id');

        $validator
            ->uuid('grade_id')
            ->allowEmptyString('grade_id');

        $validator
            ->integer('credits')
            ->allowEmptyString('credits');

        $validator
            ->integer('hidden')
            ->allowEmptyString('hidden');

        return $validator;
    }

    public function findForUser(Query $query, array $options)
    {
        $userId = $options['user_id'];

        return $query->where(['Courses.user_id' => $userId])
            ->contain(['Subjects', 'Users', 'SchoolYears', 'Learners', 'Grades']);
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
        $rules->add($rules->existsIn('subject_id', 'Subjects'), ['errorField' => 'subject_id']);
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('school_year_id', 'SchoolYears'), ['errorField' => 'school_year_id']);
        $rules->add($rules->existsIn('learner_id', 'Learners'), ['errorField' => 'learner_id']);
        $rules->add($rules->existsIn('grade_id', 'Grades'), ['errorField' => 'grade_id']);

        return $rules;
    }
}
