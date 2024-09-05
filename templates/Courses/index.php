<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('Course List') ?></div><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-book"> Add Course</i>', ['controller' => 'courses', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div></div>
                    <!-- Small tables -->
                    <table id="audit-table" class="table small table-sm datatable">
                        <thead>
                        <tr>
                            <th scope="col"><?= __('Name') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Subject') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('School Year') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Learner') ?></th>
                            <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                            <th scope="col"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($courses as $course) : ?>
                            <tr>
                                <td class="align-middle"><?= h($course->name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($course->subject->name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($course->school_year->name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($course->learner->first_name) ?></td>
                                <td class="d-none align-middle d-lg-table-cell"><?= h($course->created) ?></td>
                                <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'courses', 'action' => 'view', $course->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'courses', 'action' => 'edit', $course->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'courses', 'action' => 'delete', $course->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- End small tables -->
                </div>
            </div>
</section>
