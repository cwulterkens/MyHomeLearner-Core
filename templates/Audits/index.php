<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('User List') ?></div><?php if ($currentUser->admin == 1): ?><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-arrow-counterclockwise"> Refresh Data</i>', [], ['id' => '#button-refresh', 'escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-primary']);?></div><?php endif; ?></div>
                    <!-- Small tables -->
                    <table id="audit-table" class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th scope="col"><?= __('ID') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Record ID') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Message') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Component') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Action') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                            <th scope="col"><?= __('View') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($audits as $audit) : ?>
                            <tr>
                                <td><?= h($audit->id) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($audit->record_id) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($audit->message) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($audit->component_name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($audit->action_name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($audit->created) ?></td>
                                <td class="text-middle"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'audits', 'action' => 'view', $audit->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
