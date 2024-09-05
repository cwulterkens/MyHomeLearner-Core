<?php $this->extend('/layout/phoenix/standard'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Add New Learner') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create($learner, [
                        'class' => 'row g-3'
                    ]) ?>
                    <div class="col-md-6">
                        <?= $this->Form->control('first_name', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'First Name',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'first_name'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('last_name', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Last Name',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'last_name'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('date_of_birth', [
                            'type' => 'date',
                            'required' => true,
                            'label' => [
                                'text' => 'Date of Birth',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'date_of_birth'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('graduation_date', [
                            'type' => 'date',
                            'required' => false,
                            'label' => [
                                'text' => 'Graduation Date',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'graduation_date'
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->control('files._ids', [
                            'label' => [
                                'text' => 'Associated Files',
                                'class' => 'form-check-label'
                            ],
                            'div' => [
                                'class' => 'form-check'
                            ],
                            'class' => 'form-check-input me-1',
                            'options' => $files,
                            'multiple' => 'checkbox', // Use 'checkbox' to create a checkbox control
                            'separator' => '<br>', // Use <br> as separator between the checkboxes
                        ]) ?>
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
                        'empty' => '--- Select ---',
                        'default' => $currentUser->id
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
