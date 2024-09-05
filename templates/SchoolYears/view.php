<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SchoolYear $schoolYear
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit School Year'), ['action' => 'edit', $schoolYear->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete School Year'), ['action' => 'delete', $schoolYear->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolYear->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List School Years'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New School Year'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schoolYears view content">
            <h3><?= h($schoolYear->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($schoolYear->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($schoolYear->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($schoolYear->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($schoolYear->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Courses') ?></h4>
                <?php if (!empty($schoolYear->courses)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Subject Id') ?></th>
                            <th><?= __('Learner Id') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Credits') ?></th>
                            <th><?= __('Grade Id') ?></th>
                            <th><?= __('School Year Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($schoolYear->courses as $courses) : ?>
                        <tr>
                            <td><?= h($courses->id) ?></td>
                            <td><?= h($courses->name) ?></td>
                            <td><?= h($courses->created) ?></td>
                            <td><?= h($courses->modified) ?></td>
                            <td><?= h($courses->subject_id) ?></td>
                            <td><?= h($courses->learner_id) ?></td>
                            <td><?= h($courses->description) ?></td>
                            <td><?= h($courses->credits) ?></td>
                            <td><?= h($courses->grade_id) ?></td>
                            <td><?= h($courses->school_year_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Courses', 'action' => 'view', $courses->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Courses', 'action' => 'edit', $courses->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Courses', 'action' => 'delete', $courses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courses->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
