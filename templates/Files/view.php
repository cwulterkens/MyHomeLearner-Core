<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section profile">
    <div class="row">
        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-4 d-flex flex-column align-items-center">
                    <?php if (fnmatch('image/*', $file->type)): ?>
                        <img src="<?php echo $file->file_dir . '/' . $file->filename ?>" style="width: 100%; height: 100%;">
                    <?php elseif ($file->type === 'application/pdf'): ?>
                        <object data="<?php echo $file->file_dir . '/' . $file->filename ?>" type="application/pdf" width="100%" height="600">
                            <p>It appears you don't have a PDF plugin for this browser. No biggie... you can <a href="<?php echo $file->file_dir . '/' . $file->filename ?>">click here to download the PDF file.</a></p>
                        </object>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <div class="col-xl-4">

            <div class="card">
                <div class="card-body pt-3">

                            <h5 class="card-title">File Details</h5>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 label ">File Name</div>
                                <div class="col-lg-8 col-md-8"><code><?php echo substr($file->filename, 15) ?></code></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 label">File Type</div>
                                <div class="col-lg-8 col-md-8"><code><?php echo $file->file_type->name ?></code></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 label">File Size</div>
                                <div class="col-lg-8 col-md-8"><code><?php
                                    $size = $file->size;
                                    if ($size >= 1048576) {
                                        $size = $this->Number->toReadableSize($size, ['format' => 'short', 'precision' => 2, 'before' => '', 'after' => ' MB']);
                                    } else {
                                        $size = $this->Number->toReadableSize($size, ['format' => 'short', 'precision' => 0, 'before' => '', 'after' => ' KB']);
                                    }
                                    echo $size;
                                    ?></code></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 label">Date Uploaded</div>
                                <div class="col-lg-8 col-md-8"><code><?php echo $file->created ?></code></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 label">Last Modified</div>
                                <div class="col-lg-8 col-md-8"><code><?php echo $file->modified ?></code></div>
                            </div>

                            <div class="pt-3 btn-group btn-group-sm w-100" role="group" aria-label="Basic outlined example">
                                <?= $this->Html->link('Edit File', ['controller' => 'files', 'action' => 'edit', $file->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-secondary']);?>
                                <?= $this->Form->postLink('Delete File', ['controller' => 'files', 'action' => 'delete', $file->id], ['escape' => false, 'class' => 'btn btn-sm w-100 btn-outline-danger']);?>
                            </div>


                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
