<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('Journal Entries') ?></div><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-cloud-upload"> Add Entry</i>', ['controller' => 'journal', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div></div>
                    <!-- Small tables -->
                    <table id="audit-table" class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th scope="col"><?= __('Title') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Learner(s)') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Tags') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($journal as $entry) : ?>
                            <tr>
                                <td class="align-middle"><?= h($entry->title) ?></td>
                                <td class="d-none align-middle d-lg-table-cell">
                                    <table>
                                        <?php if (!empty($entry->learners)): ?>
                                            <?php $learnerNames = [] ?>
                                            <?php foreach ($entry->learners as $learner): ?>
                                                <?php $learnerNames[] = h($learner->first_name) ?>
                                            <?php endforeach; ?>
                                            <td><?= implode(', ', $learnerNames) ?></td>
                                        <?php else: ?>
                                            <td>No Learners Associated</td>
                                        <?php endif; ?>
                                    </table>
                                </td>
                                <td class="d-none align-middle d-lg-table-cell"></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($entry->created) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'journal', 'action' => 'view', $entry->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'journal', 'action' => 'edit', $entry->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'journal', 'action' => 'delete', $entry->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
