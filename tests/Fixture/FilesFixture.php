<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FilesFixture
 */
class FilesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'c9b89fd6-697b-49f9-95e0-30430379cda0',
                'filename' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'file_type_id' => 'ce83f5cc-7555-4d47-8f7c-b19abcb21344',
                'learner_id' => 'f705747b-e384-4827-ba01-dcc2e206ddcf',
                'user_id' => '5d612a0c-dae3-448b-8dd8-64db189a6ca2',
                'created' => '2023-02-15 00:05:12',
                'modified' => '2023-02-15 00:05:12',
                'file_dir' => 'Lorem ipsum dolor sit amet',
                'type' => 'Lorem ipsum dolor sit amet',
                'size' => 1,
            ],
        ];
        parent::init();
    }
}
