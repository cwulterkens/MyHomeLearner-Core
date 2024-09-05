
<?php $this->extend('/layout/phoenix/standard'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Edit Activity') ?></h5>
                    <?= $this->Form->create($activity, ['type' => 'activity', 'class' => 'row g-3']) ?>
                    <div class="col-md-9">
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'required' => true,
                            'disabled' => true,
                            'label' => [
                                'text' => 'Name',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'name'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('date', [
                            'type' => 'date',
                            'required' => true,
                            'disabled' => true,
                            'label' => [
                                'text' => 'Date',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'date'
                        ]) ?>
                    </div>
                    <h5 class="card-title"><?= __('Activity Description') ?></h5>
                    <div class="col-md-12">
                        <?= $activity->description ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->control('learners._ids', [
                            'label' => [
                                'text' => 'Associated Learners',
                                'class' => 'form-check-label'
                            ],
                            'disabled' => true,
                            'div' => [
                                'class' => 'form-check form-switch'
                            ],
                            'class' => 'form-check-input me-1',
                            'options' => $learners,
                            'multiple' => 'checkbox', // Use 'checkbox' to create a checkbox control
                            'separator' => '<br>', // Use <br> as separator between the checkboxes
                        ]) ?>
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
                                'empty' => '--- Select ---'
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
