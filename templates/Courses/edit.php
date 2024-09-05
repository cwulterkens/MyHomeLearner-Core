<?php $this->extend('/layout/phoenix/standard'); ?>
<?php $this->loadHelper('TinyMce'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Edit Course') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create($course, [
                        'class' => 'row g-3'
                    ]) ?>
                    <div class="col-md-6">
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'required' => true,
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
                            'type' => 'select',
                            'required' => true,
                            'label' => [
                                'text' => 'Subject',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'id' => 'subject'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('learner_id', [
                            'type' => 'select',
                            'required' => true,
                            'label' => [
                                'text' => 'Learner',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'id' => 'learner'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('school_year_id', [
                            'type' => 'select',
                            'required' => true,
                            'label' => [
                                'text' => 'School Year',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'id' => 'subject'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('credits', [
                            'type' => 'number',
                            'required' => true,
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
                            'type' => 'select',
                            'required' => false,
                            'label' => [
                                'text' => 'Final Grade',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'id' => 'grade',
                            'empty' => 'Select a grade...'
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->textarea('description', [
                            'class' => 'tinymce-editor',
                            'required' => false,
                            'label' => [
                                'text' => 'Course Description',
                                'class' => 'form-label'
                            ],
                            'id' => 'description'
                        ]) ?>
                    </div>
                    <?php if ($currentUser->admin == 1): ?>
                        <h5 class="card-title"><?= __('Administration') ?></h5>
                        <div class="col-md-12">
                            <?= $this->Form->control('user_id', [
                                'type' => 'select',
                                'required' => true,
                                'label' => [
                                    'text' => 'User',
                                    'class' => 'form-label'
                                ],
                                'options' => $users,
                                'class' => 'form-select',
                                'id' => 'user_id',
                                'empty' => '--- Select ---'
                            ]) ?>
                        </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <?= $this->Form->button(__('Submit'), ['class' => 'mt-3 w-100 btn btn-outline-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                    <!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </div>
</section>
