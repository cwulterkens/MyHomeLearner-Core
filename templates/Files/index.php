<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('File List') ?></div><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-cloud-upload"> Add File</i>', ['controller' => 'files', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div></div>
                    <!-- Small tables -->
                    <table id="audit-table" class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Category') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('File Name') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Learner(s)') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Size') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Type') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($files as $file) : ?>
                            <tr>
                                <td class="align-middle"><?= h($file->name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($file->file_type->name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($file->filename) ?></td>
                                <td class="d-none align-middle d-lg-table-cell">
                                    <table>
                                        <?php if (!empty($file->learners)): ?>
                                            <?php $learnerNames = [] ?>
                                            <?php foreach ($file->learners as $learner): ?>
                                                <?php $learnerNames[] = h($learner->first_name) ?>
                                            <?php endforeach; ?>
                                            <td><?= implode(', ', $learnerNames) ?></td>
                                        <?php else: ?>
                                            <td>No Learners Associated</td>
                                        <?php endif; ?>

                                    </table>
                                </td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($file->created) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?php
                                    $size = $file->size;
                                    if ($size >= 1048576) {
                                        $size = $this->Number->toReadableSize($size, ['format' => 'short', 'precision' => 2, 'before' => '', 'after' => ' MB']);
                                    } else {
                                        $size = $this->Number->toReadableSize($size, ['format' => 'short', 'precision' => 0, 'before' => '', 'after' => ' KB']);
                                    }
                                    echo $size;
                                    ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($file->type) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'files', 'action' => 'view', $file->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'files', 'action' => 'edit', $file->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'files', 'action' => 'delete', $file->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
