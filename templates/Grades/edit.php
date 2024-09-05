<?php $this->extend('/layout/phoenix/standard'); ?>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= __('Update Grade Value') ?></h5>

                    <!-- Multi Columns Form -->
                    <?= $this->Form->create(null, [
                        'class' => 'row g-3'
                    ]) ?>
                    <?= $this->Form->create($grade) ?>
                    <div class="col-md-6">
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Grade',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'name'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('value', [
                            'type' => 'number',
                            'required' => true,
                            'label' => [
                                'text' => 'Value',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'value'
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
