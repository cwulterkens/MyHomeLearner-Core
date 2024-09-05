<?php $this->extend('/layout/phoenix/standard'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Update User Profile') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create($user, [
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
                    <div class="col-md-8">
                        <?= $this->Form->control('email', [
                            'type' => 'email',
                            'required' => true,
                            'label' => [
                                'text' => 'Email Address',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'email'
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('phone', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Home Phone',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'phone'
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->control('password', [
                            'type' => 'password',
                            'required' => false,
                            'label' => [
                                'text' => 'Password',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'password',
                            'value' => '',
                            'placeholder' => 'Leave blank to keep current'
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->control('institution_name', [
                            'type' => 'text',
                            'required' => false,
                            'label' => [
                                'text' => 'Institution Name',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'institution_name',
                            'placeholder' => 'Home Learning Academy'
                        ]) ?>
                    </div>
                    <div class="col-12">
                        <?= $this->Form->control('address_line_1', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Address Line 1',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'address_line_1'
                        ]) ?>
                    </div>
                    <div class="col-12">
                        <?= $this->Form->control('address_line_2', [
                            'type' => 'text',
                            'label' => [
                                'text' => 'Address Line 2',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'address_line_2'
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $this->Form->control('address_city', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'City',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'address_city'
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->control('address_state', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'State',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'id' => 'address_state'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('address_zip', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Zip',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'address_zip'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Form->control('address_country', [
                            'type' => 'text',
                            'placeholder' => 'United States',
                            'disabled' => true,
                            'required' => true,
                            'label' => [
                                'text' => 'Country',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-select',
                            'id' => 'address_country'
                        ]) ?>
                    </div>
                    <h5 class="card-title"><?= __('Administration') ?></h5>
                    <div class="col-md-2">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('verified', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Verified User',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'verified'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('active', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Active User',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'active'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('admin', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Administrator',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'admin'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('notify_alerts', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Account Alerts',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'notify_alerts'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check form-switch">
                            <?= $this->Form->control('notify_marketing', [
                                'type' => 'checkbox',
                                'label' => [
                                    'text' => 'Marketing Emails',
                                    'class' => 'form-check-label'
                                ],
                                'class' => 'form-check-input',
                                'id' => 'notify_marketing'
                            ]) ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <?= $this->Form->button(__('Submit'), ['class' => 'w-100 btn btn-outline-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                    <!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </div>
</section>

