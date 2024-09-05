<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?php echo $user->avatar_url ?>" alt="Profile" class="rounded-circle">
                    <h2><?php echo $user->first_name ?> <?php echo $user->last_name ?></h2>
                    <h3>Member Since <?php echo $user->created->format('F Y'); ?></h3>
                    <div class="mt-2">
                        <code>Account Status:</code> <?php if ($user->active == 1): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Inactive</span>
                        <?php endif; ?>
                    </div>
                    <div class="btn-group btn-group-sm w-100 pt-3" role="group" aria-label="Basic outlined example">
                        <?= $this->Html->link('Edit Profile', ['controller' => 'users', 'action' => 'edit', $user->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-secondary']);?>
                        <?= $this->Html->link('Delete Account', ['controller' => 'users', 'action' => 'delete', $user->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-danger disabled', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#officialTranscript']);?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-preferences">Preferences</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-billing">Billing</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-learners">Learners</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-history">Account History</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->first_name ?> <?php echo $user->last_name ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Institution Name</div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->institution_name ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->address_line_1 ?>, <?php if ($user->address_line_2 != null): ?><?php echo $currentUser->address_line_2 ?>, <?php endif; ?><?php echo $currentUser->address_city ?>, <?php echo $currentUser->address_state ?> <?php echo $currentUser->address_zip ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->phone ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?php echo $user->email ?></div>
                            </div>

                        </div>
<div class="tab-pane fade pt-3" id="profile-billing">

    <div class="row d-flex flex-column align-items-center ms-0">
        <?php if ($defaultPaymentMethod !== null): ?>
    <div class="credit-card">
        <div class="brand text-uppercase"><?php echo $defaultPaymentMethod->card->brand ?></div> <!-- You can dynamically change this -->
        <div class="last-four">•••• •••• •••• <?php echo $defaultPaymentMethod->card->last4 ?></div> <!-- You can dynamically change this -->
        <div class="expiration">Exp: <?php echo $defaultPaymentMethod->card->exp_month ?>/<?php echo $defaultPaymentMethod->card->exp_year ?></div> <!-- You can dynamically change this -->
    </div>
        <div class="pt-3 d-flex flex-column align-items-center"><small>Next Payment:</small> <code><?= date("m/d/Y",strtotime("+1 day",$subscriptions->data[0]->current_period_end)) ?></code></div>
        <?php endif; ?>
    </div>
    <?php if ($user->active == 0): ?>
        <?= $this->Html->link('Subscribe', ['#'], ['escape' => false, 'class' => 'mt-3 mb-3 btn btn-sm w-100 btn-outline-success', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#addPayment']);?>
    <?php else: ?>
        <?= $this->Html->link('Unsubscribe', ['#'], ['escape' => false, 'class' => 'mt-3 mb-3 btn btn-sm w-100 btn-outline-danger', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#cancel']);?>
    <?php endif; ?>
                        <div class="modal fade" id="addPayment" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Payment Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"><?= $this->Form->create(null, [
                        "action" => $this->Url->build("/users/subscribe/" . $user->id, ["fullBase" => false]),
                        "method" => "post",
                        "class" => "require-validation",
                        "data-cc-on-file" => "false",
                        "data-stripe-publishable-key" => STRIPE_KEY,
                        "id" => "payment-form"
                    ]) ?>
                                <!-- Monthly Subscription Box -->
                                <div class="col-md-12">
                                    <label class="card text-center pt-0" style="height: 100px; justify-content: center; cursor: pointer; transition: box-shadow 0.3s ease;" for="monthly">
                                        <input type="radio" name="subscriptionType" id="monthly" value="monthly" class="d-none" onclick="selectSubscription(this)">
                                        <div class="card-body">
                                            <h5 class="card-title">Monthly</h5>
                                            <p class="card-text" style="font-size: 24px;">$2.99/month</p>
                                        </div>
                                    </label>
                                </div>

                                <!-- Annual Subscription Box -->
                                <div class="col-md-12">
                                    <label class="card text-center pt-0" style="height: 100px; justify-content: center; cursor: pointer; transition: box-shadow 0.3s ease;" for="annually">
                                        <input type="radio" name="subscriptionType" id="annually" value="annually" class="d-none" onclick="selectSubscription(this)">
                                        <div class="card-body">
                                            <h5 class="card-title">Annually</h5>
                                            <p class="card-text" style="font-size: 24px;">$29.99/year</p>
                                        </div>
                                    </label>
                                </div>
                                <script>
                                    function selectSubscription(radioButton) {
                                        // Reset all boxes to default shadow
                                        document.querySelectorAll('.card').forEach(box => {
                                            box.style.boxShadow = '';
                                        });

                                        // Apply green shadow to the clicked box's parent label (which visually represents the box)
                                        radioButton.parentElement.style.boxShadow = '0 0 15px 0 rgba(0, 255, 0, 0.6)';
                                    }
                                </script>
                    <div class='form-row row'>
                        <div class='col-12 form-group required'>
                        <?= $this->Form->control('cardholder', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Name on Card',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'cardholder',
                            'value' => 'John Doe',
                            'disabled' => true
                        ]) ?>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-12 form-group required'>
                        <?= $this->Form->control('card_number', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Card Number',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'card_number',
                            'value' => '4242424242424242',
                            'default' => '4242424242424242',
                            'disabled' => true
                        ]) ?>
                        </div>
                    </div>

                    <div class='form-row row col-13'>
                        <div class='col-7 form-group required'>
                        <?= $this->Form->control('exp_month', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Expiration Month',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'exp_month',
                            'value' => '05',
                            'default' => '05',
                            'disabled' => true
                        ]) ?>
                        </div>
                        <div class='col-5 form-group required'>
                        <?= $this->Form->control('exp_year', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'Expiration Year',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'exp_year',
                            'value' => '26',
                            'default' => '26',
                            'disabled' => true
                        ]) ?>
                        </div>
                    </div>
                    <div class='form-row row col-13'>
                        <div class='col-8 form-group required'>
                            <?= $this->Form->control('billing_zip', [
                                'type' => 'text',
                                'required' => true,
                                'label' => [
                                    'text' => 'ZIP Code',
                                    'class' => 'form-label'
                                ],
                                'class' => 'form-control',
                                'id' => 'billing_zip',
                                'value' => '54313',
                                'default' => '54313',
                                'disabled' => true
                            ]) ?></div>
                        <div class='col-4 form-group required'>
                        <?= $this->Form->control('cv2', [
                            'type' => 'text',
                            'required' => true,
                            'label' => [
                                'text' => 'CV2',
                                'class' => 'form-label'
                            ],
                            'class' => 'form-control',
                            'id' => 'cv2',
                            'value' => '123',
                            'default' => '123',
                            'disabled' => true
                        ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 pt-3">
                            <button class="btn btn-primary btn-lg btn-block w-100" type="submit">Subscribe</button>
                        </div>
                    </div>

                    <?= $this->Form->end() ?></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
    <div class="modal fade" id="cancel" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <?= $this->Form->create(null, [
                        "action" => $this->Url->build("/users/cancelSubscriptions/" . $user->id, ["fullBase" => false]),
                        "method" => "post",
                        "class" => "require-validation",
                        "data-cc-on-file" => "false",
                        "data-stripe-publishable-key" => STRIPE_KEY,
                        "id" => "payment-form"
                    ]) ?>

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-danger btn-lg btn-block w-100" type="submit">Cancel</button>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Html->link('Customer Portal', $stripePortal->url, ['fullBase' => true, 'escape' => false, 'class' => 'mt-3 mb-3 btn btn-sm w-100 btn-outline-secondary']);?>
</div>
                        <div class="tab-pane fade pt-3" id="profile-learners">

                            <table id="learner-table" class="table small table-sm">
                                <thead>
                                <tr>
                                    <th scope="col"><?= __('First Name') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Last Name') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                                    <th scope="col"><?= __('Actions') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($learners as $learner) : ?>
                                    <tr>
                                        <td class="align-middle"><?= h($learner->first_name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($learner->last_name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($learner->created) ?></td>
                                        <td class="text-end"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'learners', 'action' => 'view', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?> <?= $this->Html->link('<i class="bi bi-pencil"></i>', ['controller' => 'learners', 'action' => 'edit', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-secondary']);?> <?= $this->Form->postLink('<i class="bi bi-trash"></i>', ['controller' => 'learners', 'action' => 'delete', $learner->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-danger']);?></i></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-history">
                            <table id="audit-table" class="table small table-sm">
                                <thead>
                                <tr>
                                    <th scope="col"><?= __('Message') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Component') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Action') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Created') ?></th>
                                    <th scope="col"><?= __('View') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($audits as $audit) : ?>
                                    <tr>
                                        <td><?= h($audit->message) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($audit->component_name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($audit->action_name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($audit->created) ?></td>
                                        <td class="text-middle"><?= $this->Html->link('<i class="bi bi-eye"></i>', ['controller' => 'audits', 'action' => 'view', $audit->id], ['escape' => false, 'class' => 'btn btn-sm btn-outline-primary']);?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
