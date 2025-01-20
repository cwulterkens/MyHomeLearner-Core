<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section profile">

    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="<?php echo $learner->avatar_url ?>" alt="Profile" class="rounded-circle">
                    <h2><?php echo $learner->first_name ?> <?php echo $learner->last_name ?></h2>
                    <span class="badge bg-success">Active</span>
                    <div class="mt-2 align-items-center">
                        <code><?php if ($learner->graduated == '0'): ?>Anticipated <?php endif; ?>Graduation Date:</code></div>
                    <div class="align-items-center">
                        <?php if ($learner->graduation_date !== null) {
                            echo $learner->graduation_date->format('F jS, Y');
                        } else {
                            echo 'Not Entered';
                        }
                        ?>
                    </div>
                    <div class="align-items-center pt-3">
                        <?php if ($learner->graduated == 0): ?>
                            <?= $this->Html->link('<i class="bi bi-check-lg"></i> Graduate Learner', ['controller' => 'learners', 'action' => 'graduate', $learner->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-primary disabled', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#graduateLearner']); ?>
                        <?php else: ?>
                            <?= $this->Html->link('<i class="bi bi-check-lg"></i> Learner Graduated', ['controller' => 'learners', 'action' => 'graduate', $learner->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-secondary disabled']); ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <div class="btn-group btn-group-sm w-100" role="group" aria-label="Basic outlined example">
                <?= $this->Html->link('Edit Profile', ['controller' => 'learners', 'action' => 'edit', $learner->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-secondary']);?>
                <?= $this->Html->link('Generate Transcript', ['controller' => 'learners', 'action' => 'pdf', $learner->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-success', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#officialTranscript']);?>
            </div>
            <div class="w-100 pb-4" role="group" aria-label="Basic outlined example">
                <div class="modal fade" id="officialTranscript" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Official Transcript</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                This feature is currently unavailable.  By Summer of 2024, you will be able to request an official copy of your transcript be sent directly to the learning institution of your choice.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <?= $this->Html->link('Submit Transcript Request', ['controller' => 'learners', 'action' => 'pdf', $learner->id], ['escape' => false, 'class' => 'btn btn-success']);?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="graduateLearner" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Are you sure?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="align-items-center text-xl-center text-danger">Notice!</div>
                                <div class="align-items-center text-center">Graduating the learner will prevent any modifications to learner course records.  Please review the transcript carefully.  If you need support for a graduated learner, please email:</div>
                                <div class="h5 text-lg-center mt-3 border"><a href="mailto:support@myhomelearner.com">support@myhomelearner.com</a></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <?= $this->Form->postLink('<i class="bi bi-check-lg"></i> Graduate Learner', ['controller' => 'learners', 'action' => 'graduate', $learner->id], ['escape' => false, 'class' => 'btn btn-primary']);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-pills nav-tabs-bordered small">

                        <li class="nav-item flex-fill">
                            <button class="nav-link active w-100" data-bs-toggle="tab" data-bs-target="#learner-overview">Overview</button>
                        </li>

                        <li class="nav-item flex-fill">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#learner-courses">Courses</button>
                        </li>

                        <li class="nav-item flex-fill">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#learner-honors">Honors & Awards</button>
                        </li>

                        <li class="nav-item flex-fill">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#learner-activities">Activities</button>
                        </li>

                        <li class="nav-item flex-fill">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#learner-jobs">Jobs</button>
                        </li>

                        <li class="nav-item flex-fill">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#learner-files">Files</button>
                        </li>

                        <li class="nav-item flex-fill">
                            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#learner-history">Learner History</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="learner-overview">
                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8"><?php echo $learner->first_name ?> <?php echo $learner->last_name ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                                <div class="col-lg-9 col-md-8"><?php echo $learner->date_of_birth ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8">LINE 1 LINE 2, CITY, STATE ZIP</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8"><?php echo $learner->phone ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?php echo $learner->email ?></div>
                            </div>

                        </div>

                        <div class="tab-pane fade pt-3" id="learner-courses">

                            <table id="learner-table" class="table small table-sm">
                                <thead>
                                <tr>
                                    <th scope="col"><?= __('School Year') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Name') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Subject') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Credits') ?></th>
                                    <th scope="col"><?= __('Grade') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($learner->courses as $courses) : ?>
                                    <tr>
                                        <td class="align-middle"><?= h($courses->school_year->name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($courses->name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($courses->subject->name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($courses->credits) ?></td>
                                        <td><?php echo ($courses->grade !== null) ? $courses->grade->name : "In Progress"; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade pt-3" id="learner-honors">

                            <table id="honors-table" class="table small table-sm">
                                <thead>
                                <tr>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Date Earned') ?></th>
                                    <th scope="col"><?= __('Honor or Award') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($learner->honors as $honor) : ?>
                                    <tr>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($honor->date) ?></td>
                                        <td class="align-middle"><?= h($honor->name) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade pt-3" id="learner-activities">

                            <table id="activities-table" class="table small table-sm">
                                <thead>
                                <tr>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Date') ?></th>
                                    <th scope="col"><?= __('Activity Name') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($learner->activities as $activity) : ?>
                                    <tr>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($activity->date) ?></td>
                                        <td class="align-middle"><?= h($activity->name) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade pt-3" id="learner-jobs">

                            <table id="activities-table" class="table small table-sm">
                                <thead>
                                <tr>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Date') ?></th>
                                    <th scope="col"><?= __('Employer') ?></th>
                                    <th scope="col"><?= __('Position') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($learner->jobs as $job) : ?>
                                    <tr>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($job->start_date) ?></td>
                                        <td class="align-middle"><?= h($job->employer) ?></td>
                                        <td class="align-middle"><?= h($job->title) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade pt-3" id="learner-files">

                            <table id="learner-table" class="table small table-sm">
                                <thead>
                                <tr>
                                    <th scope="col"><?= __('Name') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Type') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Uploaded') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($learner->files as $file) : ?>
                                    <tr>
                                        <td class="align-middle"><?= h($file->name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($file->file_type->name) ?></td>
                                        <td class="d-none align-middle d-lg-table-cell"><?= h($file->created) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade pt-3" id="learner-history">
                            <table id="audit-table" class="table small table-sm datatable">
                                <thead>
                                <tr>
                                    <th scope="col"><?= __('Message') ?></th>
                                    <th class="d-none d-lg-table-cell" scope="col"><?= __('Date/Time') ?></th>
                                    <th scope="col"><?= __('View') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($audits as $audit) : ?>
                                    <tr>
                                        <td><?= h($audit->message) ?></td>
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
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">

            <div class="card">
                <div class="card-body">
                    <div class="row"><div class="w-50 card-title"><?= __('Journal Entries') ?></div><div class="w-50 card-title"><?= $this->Html->link('<i class="bi bi-cloud-upload"> Add Entry</i>', ['controller' => 'journal', 'action' => 'add'], ['escape' => false, 'class' => 'w-100 btn btn-sm btn-outline-success']);?></div></div>
                                       <div class="accordion accordion-flush" id="accordionJournal">
		   <?php foreach ($learner->journal as $journal) : ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header-<?= ($journal->id) ?>" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-personal-<?= ($journal->id) ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <?= h($journal->title) ?> written <?= ($journal->created->format('F jS, Y')) ?></code>
                                </button>
                            </h2>
                            <div id="flush-personal-<?= ($journal->id) ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne-<?= ($journal->id) ?>" data-bs-parent="#accordionJournal" style="">
                                <div class="accordion-body text-sm-start"><?= ($journal->content) ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
