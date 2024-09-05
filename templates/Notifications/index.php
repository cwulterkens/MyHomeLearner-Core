<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('Notifications') ?></div></div>
                    <div class="accordion accordion-flush" id="accordionJournal">
                        <?php foreach ($notifications as $notification) : ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header-<?= ($notification->id) ?>" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-personal-<?= ($notification->id) ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                        <?= h($notification->subject) ?> <code class="text-sm-start ps-3"><?= ($notification->created->format('m/d/Y H:i')) ?></code><div class="small ps-3"><?php if($notification->viewed == 0): ?><span class="badge bg-danger text-light"><i class="bi bi-exclamation-triangle me-1"></i> Unread</span><?php endif; ?></div>
                                    </button>
                                </h2>
                                <div id="flush-personal-<?= ($notification->id) ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne-<?= ($notification->id) ?>" data-bs-parent="#accordionJournal" style="">
                                    <div class="accordion-body text-sm-start"><?= ($notification->content) ?></div>
                                    <div class="small ps-3 mb-3"><?php if($notification->viewed == 0): ?><?= $this->Form->postLink('<i class="bi bi-check-lg"> Mark as Read</i>', ['controller' => 'notifications', 'action' => 'markAsRead', $notification->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-success']);?></i><?php endif; ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
</section>
