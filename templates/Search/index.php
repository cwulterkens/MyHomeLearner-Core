<?php $this->extend('/layout/phoenix/standard'); ?>

<style>
    .result-card {
        position: relative;
    }

    .view-button {
        position: absolute;
        bottom: 10px;
        right: 10px;
    }
</style>

<h1>Search Results for "<?php echo h($searchTerm); ?>"</h1>

<section class="section">
    <div class="align-items-top">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content pt-2">
                        <?php if (!empty($results)): ?>
                            <?php foreach ($results as $result): ?>
                                <div class="result-card">
                                    <h1><strong><?php echo h($result['entity']); ?></strong>: <?php echo h($result['title']); ?></h1><br>
                                    <?php echo h($result['content']); ?>
                                    <a href="<?php echo $this->Url->build(['controller' => $result['entity'], 'action' => 'view', $result['id']]); ?>" class="btn btn-primary view-button">View Item</a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">No results found.</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
