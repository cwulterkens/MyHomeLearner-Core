<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('School Years') ?></div><?php if ($currentUser->admin == 1): ?><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-calendar2-plus"> Add School Year</i>', ['controller' => 'schoolYears', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div><?php endif; ?></div>
                    <!-- Small tables -->
                    <table id="audit-table" class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('ID') ?></th>
                            <th scope="col"><?= __('Name') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($schoolYears as $schoolYear) : ?>
                            <tr>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($schoolYear->id) ?></td>
                                <td class="align-middle"><?= h($schoolYear->name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($schoolYear->created) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'schoolYears', 'action' => 'view', $schoolYear->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'schoolYears', 'action' => 'edit', $schoolYear->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'schoolYears', 'action' => 'delete', $schoolYear->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
