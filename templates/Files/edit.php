
<?php $this->extend('/layout/phoenix/standard'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Edit File') ?></h5>
                    <?= $this->Form->create($file, ['type' => 'file', 'class' => 'row g-3']) ?>
                    <div class="col-md-6">
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'File Name',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'name'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('file_type_id', [
                            'type' => 'select',
                            'required' => true,
                            'label' => [
                                'text' => 'File Category',
                                'class' => 'form-label'
                            ],
                            'options' => $fileTypes,
                            'class' => 'form-select',
                            'id' => 'file_type_id',
                            'empty' => '--- Select ---'
                        ]) ?>
                    </div>
                <div class="card-body pt-4 d-flex flex-column align-items-center">
                    <?php if (fnmatch('image/*', $file->type)): ?>
                        <img src="<?php echo $file->file_dir . '/' . $file->filename ?>" style="width: 100%; height: 100%;">
                    <?php elseif ($file->type === 'application/pdf'): ?>
                        <object data="<?php echo $file->file_dir . '/' . $file->filename ?>" type="application/pdf" width="100%" height="600">
                            <p>It appears you don't have a PDF plugin for this browser. No biggie... you can <a href="<?php echo $file->file_dir . '/' . $file->filename ?>">click here to download the PDF file.</a></p>
                        </object>
                    <?php endif; ?>
                </div>
                    <div class="col-md-12">
                        <?= $this->Form->control('learners._ids', [
                            'label' => [
                                'text' => 'Associated Learners',
                                'class' => 'form-check-label'
                            ],
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
                        <?= $this->Form->button(__('Submit'), ['class' => 'w-100 btn btn-outline-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                    <!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </div>
</section>

