<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
              <h5 class="card-title"><?= __('Send New Notification') ?></h5>
                <?= $this->Form->create(null, [
                    'url' => ['controller' => 'Admin', 'action' => 'notifications'], // Adjust the route as needed
                    'class' => 'row g-3'
                ]) ?>
                <div class="col-md-12">
                    <?= $this->Form->control('subject', [
                        'type' => 'text',
                        'required' => true,
                        'label' => [
                            'text' => 'Subject',
                            'class' => 'form-label'
                        ],
                        'class' => 'form-control',
                        'id' => 'subject'
                    ]) ?>
                    <?= $this->Form->control('content', [
                        'type' => 'textarea',
                        'required' => 'false',
                        'label' => [
                            'text' => 'Content',
                            'class' => 'form-label'
                        ],
                        'class' => 'textbox',
                        'id' => 'content'
                    ]) ?>
                </div>
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
                    <div class="col-md-12">
                        <?= $this->Form->control('importance', [
                            'type' => 'select',
                            'required' => true,
                            'label' => [
                                'text' => 'Importance',
                                'class' => 'form-label'
                            ],
                            'options' => ['warning','danger'],
                            'class' => 'form-select',
                            'id' => 'importance',
                            'empty' => '--- Select ---',
                            'default' => ''
                        ]) ?>
                    </div>
                    <h5 class="card-title"><?= __('Administration') ?></h5>
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('is_emailed', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Send as Email',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'is_emailed',
                                'hiddenField' => false
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('include_inactive', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Include Inactive',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'include_inactive',
                                'hiddenField' => false
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('include_unverified', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Include Unverified',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'include_unverified',
                                'hiddenField' => false
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3 pb-3">
                    <?= $this->Form->button(__('Submit'), ['class' => 'w-100 btn btn-outline-primary']) ?>
                </div>
                <?= $this->Form->end() ?>

            </div>
          </div>
        </div>

      </div>
    </section>
