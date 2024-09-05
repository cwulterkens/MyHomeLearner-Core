<?php $this->extend('/layout/phoenix/standard');?>
<?php $this->loadHelper('TinyMce'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Edit Journal Entry') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create($journal, [
                        'class' => 'row g-3'
                    ]) ?>
                    <div class="col-md-12">
                        <?= $this->Form->control('title', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Title',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'title'
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->textarea('content', [
                            'class' => 'tinymce-editor',
                            'required' => false,
                            'label' => [
                                'text' => 'Journal Entry',
                                'class' => 'form-label'
                            ],
                            'id' => 'journal'
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->control('learners._ids', [
                            'label' => [
                                'text' => 'Associated Learners',
                                'class' => 'form-check-label'
                            ],
                            'div' => [
                                'class' => 'form-check'
                            ],
                            'class' => 'form-check-input me-1',
                            'options' => $learners,
                            'multiple' => 'checkbox', // Use 'checkbox' to create a checkbox control
                            'separator' => '<br>', // Use <br> as separator between the checkboxes
                            'value' => $journal->learners ? collection($journal->learners)->extract('id')->toList() : [],
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
                                    'empty' => '--- Select ---'
                                ]) ?>
                            </div>
                        <?php endif; ?>
                        <div class="text-center mt-3">
                            <?= $this->Form->button(__('Submit'), ['class' => 'w-100 btn btn-outline-primary']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                        <!-- End Multi Columns Form -->
                    </div>
                </div>
            </div>
        </div>
</section>

