<?php $this->extend('/layout/phoenix/standard'); ?>
    <section class="section">
        <div class="align-items-top">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row"><div class="w-50 card-title"><?= __('User List') ?></div><?php if ($currentUser->admin == 1): ?><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-person-plus"> Add User</i>', ['controller' => 'users', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div><?php endif; ?></div>
                        <!-- Small tables -->
                        <table class="table small table-sm datatable">
                            <thead>
                            <tr>
                                <th scope="col"><?= __('Email') ?></th>
                                <th class="d-none d-lg-table-cell" scope="col"><?= __('First Name') ?></th>
                                <th class="d-none d-lg-table-cell" scope="col"><?= __('Last Name') ?></th>
                                <th class="d-none d-lg-table-cell" scope="col"><?= __('Learners') ?></th>
                                <th class="d-none d-lg-table-cell" scope="col"><?= __('Active') ?></th>
                                <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                                <th scope="col"><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user) : ?>
                            <tr>
                                <td class="align-middle"><?= h($user->email) ?> <?php if($user->verified == 0): ?><span class="badge bg-warning text-light"><i class="bi bi-exclamation-triangle me-1"></i> Unverified</span><?php endif; ?> <?php if($user->admin == 1): ?><span class="badge bg-info text-dark"><i class="bi bi-info-circle me-1"></i> Admin</span><?php endif; ?><div><code><?= h($user->id) ?></code></div></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($user->first_name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($user->last_name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($user['numberOfLearners']) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?php if($user->active == 1): ?><span class="badge bg-success text-light"><i class="bi bi-star me-1"></i> Active</span><?php else: ?><span class="badge bg-danger text-light"><i class="bi bi-exclamation-triangle me-1"></i> Inactive</span><?php endif; ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($user->created) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'users', 'action' => 'view', $user->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'users', 'action' => 'edit', $user->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'users', 'action' => 'delete', $user->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End small tables -->
            </div>
        </div>
    </section>
