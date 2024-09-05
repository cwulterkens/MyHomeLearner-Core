<?php $this->extend('/layout/phoenix/standard'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Add New File Type') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create(null, [
                        'class' => 'row g-3'
                    ]) ?>
                    <?= $this->Form->create($fileType) ?>
                    <div class="col-md-12">
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'File Type',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'name'
                        ]) ?>
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
