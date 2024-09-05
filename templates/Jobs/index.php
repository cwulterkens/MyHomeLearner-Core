<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('Jobs') ?></div><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-book"> Add Job</i>', ['controller' => 'jobs', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div></div>
                    <!-- Small tables -->
                    <table id="audit-table" class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th scope="col"><?= __('Employer') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Position') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Date Started') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Date Ended') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($jobs as $job) : ?>
                            <tr>
                                <td class="align-middle"><?= h($job->employer) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($job->title) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($job->start_date) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($job->end_date) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'jobs', 'action' => 'view', $job->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'jobs', 'action' => 'edit', $job->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'jobs', 'action' => 'delete', $job->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
