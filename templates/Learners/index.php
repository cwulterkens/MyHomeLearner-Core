<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4">
            <?php foreach ($learners as $learner) : ?>
                <!-- Card with an image on left -->
                <div class="col mb-4">
                    <div class="card">
                        <img src="/img/avatar-placeholder.png" class="img-fluid rounded-circle p-3" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= h($learner->first_name) ?></h5>
                            <div class="row mb-0 mt-3">
                                <div class="col-lg-6 col-md-6 label">Current Age</div>
                                <div class="col-lg-6 col-md-6"><?= h($learner->age) ?></div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-lg-6 col-md-6 label">Graduation Date</div>
                                <div class="col-lg-6 col-md-6"><?= h($learner->graduation_date) ?></div>
                            </div>
                        </div>
                        <div class="card-footer small">
                            <div class="btn-group btn-group-sm w-100" role="group" aria-label="Basic outlined example">
                                <?= $this->Html->link('View File', ['controller' => 'learners', 'action' => 'view', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?>
                                <?= $this->Html->link('Journal', ['controller' => 'journal', 'action' => 'index'], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?>
                                <?= $this->Html->link('Transcript', ['controller' => 'learners', 'action' => 'pdf', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card with an image on left -->
            <?php endforeach; ?>
        </div>
        <?= $this->Html->link('Add Learner', ['controller' => 'learners', 'action' => 'add'], ['escape' => false, 'class' => 'btn btn-sm btn-success w-100']);?>
    </div>
</section>
