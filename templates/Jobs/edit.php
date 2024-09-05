<?php $this->extend('/layout/phoenix/standard'); ?>
<?php $this->loadHelper('TinyMce'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Edit Job') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create($job, [
                        'class' => 'row g-3'
                    ]) ?>
                    <div class="col-md-6">
                        <?= $this->Form->control('employer', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Employer',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'employer'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('title', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Position/Title',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'title'
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
                        <?= $this->Form->control('current_job', [
                            'type' => 'select',
                            'options' => [
                                '1' => 'Yes',
                                '0' => 'No',
                            ],
                            'label' => [
                                'text' => 'Currently Employed?',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'id' => 'current_job'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('start_date', [
                            'type' => 'date',
                            'required' => true,
                            'label' => [
                                'text' => 'Start Date',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'start_date'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('end_date', [
                            'type' => 'date',
                            'required' => false,
                            'label' => [
                                'text' => 'End Date',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'end_date'
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
