<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FileType $fileType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit File Type'), ['action' => 'edit', $fileType->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete File Type'), ['action' => 'delete', $fileType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fileType->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List File Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New File Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="fileTypes view content">
            <h3><?= h($fileType->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($fileType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($fileType->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($fileType->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($fileType->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
