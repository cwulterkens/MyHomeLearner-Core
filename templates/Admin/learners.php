<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('Learner Administration') ?></div><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-person-plus"> Add User</i>', ['controller' => 'users', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div></div>
                    <!-- Small tables -->
                    <table class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><i class="bi bi-hurricane px-1"></i></th>
                            <th class="d-none d-lg-table-cell" scope="col"><i class="bi bi-lightning px-1"></i></th>
                            <th class="d-none d-lg-table-cell" scope="col"><i class="bi bi-award px-1"></i></th>
                            <th class="d-none d-lg-table-cell" scope="col"><i class="bi bi-briefcase px-1"></i></th>
                            <th class="d-none d-lg-table-cell" scope="col"><i class="bi bi-folder px-1"></i></th>
                            <th class="d-none d-lg-table-cell" scope="col"><i class="bi bi-journal px-1"></i></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($learners as $learner) : ?>
                            <tr>
                                <td class="align-middle"><?= h($learner->last_name) ?>, <?= h($learner->first_name) ?> <?php if($learner->graduated == 1): ?><span class="badge bg-success text-light"><i class="bi bi-check-circle me-1"></i> Graduated</span><?php endif; ?> <?php if($learner->status == 0): ?><span class="badge bg-info text-dark"><i class="bi bi-info-circle me-1"></i> Inactive</span><?php endif; ?><div><code><?= h($learner->id) ?></code></div></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($learner->courseCount) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($learner->activityCount) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($learner->honorCount) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($learner->jobCount) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($learner->fileCount) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($learner->journalCount) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($learner->created) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'learners', 'action' => 'view', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'learners', 'action' => 'edit', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'learners', 'action' => 'delete', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
