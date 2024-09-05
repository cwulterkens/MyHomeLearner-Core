<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $journal->title ?></h5>
                        <?= $journal->content ?>
                    </div>
                </div>
            </div>

                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title"><?= __('Entry Details') ?></h5>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 label"><?= __('Created') ?></div>
                                <div class="col-lg-8 col-md-8 align-items-end"><?php echo $journal->created ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 label"><?= __('Updated') ?></div>
                                <div class="col-lg-8 col-md-8"><?php echo $journal->modified ?></div>
                            </div>

                            <div class="pt-3 btn-group btn-group-sm w-100" role="group" aria-label="Basic outlined example">
                                <?= $this->Html->link('Edit Entry', ['controller' => 'journal', 'action' => 'edit', $journal->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-secondary']);?>
                                <?= $this->Form->postLink('Delete Entry', ['controller' => 'journal', 'action' => 'delete', $journal->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-danger']);?>
                            </div>


                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
            </div>
        </div>
