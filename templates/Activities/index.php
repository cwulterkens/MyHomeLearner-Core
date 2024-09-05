<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('Activities') ?></div><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-lightning"> Add Activity</i>', ['controller' => 'activities', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div></div>
                    <!-- Small tables -->
                    <table id="audit-table" class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Description') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Learner') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Date') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($activities as $activity) : ?>
                            <tr>
                                <td class="align-middle"><?= h($activity->name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?php echo strip_tags($activity->description) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><table>
                                        <?php if (!empty($activity->learners)): ?>
                                            <?php $learnerNames = [] ?>
                                            <?php foreach ($activity->learners as $learner): ?>
                                                <?php $learnerNames[] = h($learner->first_name) ?>
                                            <?php endforeach; ?>
                                            <td><?= implode(', ', $learnerNames) ?></td>
                                        <?php else: ?>
                                            <td>No Learners Associated</td>
                                        <?php endif; ?>

                                    </table></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($activity->date) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'activities', 'action' => 'view', $activity->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'activities', 'action' => 'edit', $activity->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'activities', 'action' => 'delete', $activity->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
