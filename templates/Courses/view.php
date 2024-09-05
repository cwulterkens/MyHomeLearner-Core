<?php $this->extend('/layout/phoenix/standard'); ?>
<?php $this->loadHelper('TinyMce'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('View Course') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create($course, [
                        'class' => 'row g-3'
                    ]) ?>
                    <div class="col-md-6">
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'required' => true,
                            'disabled' => true,
                            'label' => [
                                'text' => 'Course Name',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'name'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('subject_id', [
                            'type' => 'text',
                            'disabled' => true,
                            'label' => [
                                'text' => 'Subject',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'value' => $course->subject->name
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('learner_id', [
                            'type' => 'text',
                            'disabled' => true,
                            'label' => [
                                'text' => 'Learner',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'value' => $course->learner->first_name
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('school_year_id', [
                            'type' => 'text',
                            'disabled' => true,
                            'label' => [
                                'text' => 'School Year',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'value' => $course->school_year->name
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('credits', [
                            'type' => 'number',
                            'required' => true,
                            'disabled' => true,
                            'label' => [
                                'text' => 'Credit Hours',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'credits'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('grade_id', [
                            'type' => 'text',
                            'disabled' => true,
                            'label' => [
                                'text' => 'Final Grade',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'value' => \Cake\Utility\Hash::get($course, 'grade.name', 'Incomplete'),
                            'empty' => 'Select a grade...'
                        ]) ?>
                    </div>
                    <h5 class="card-title"><?= __('Course Description') ?></h5>
                    <div class="col-md-12">
                        <?= $course->description ?>
                    </div>
                    <?php if ($currentUser->admin == 1): ?>
                        <h5 class="card-title"><?= __('Administration') ?></h5>
                        <div class="col-md-12">
                            <?= $this->Form->control('user_id', [
                                'type' => 'select',
                                'required' => true,
                                'disabled' => true,
                                'label' => [
                                    'text' => 'User',
                                    'class' => 'form-label'
                                ],
                                'options' => $users,
                                'class' => 'form-select',
                                'id' => 'user_id',
                                'empty' => '--- Select ---',
                                'default' => $currentUser->id
                            ]) ?>
                        </div>
                    <?php endif; ?>
                    <?= $this->Form->end() ?>
                    <!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </div>
</section>
