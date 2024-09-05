<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FilesLearnersFixture
 */
class FilesLearnersFixture extends TestFixture
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
                'file_id' => 'b834bd47-4029-4100-9484-61b7bb98c686',
                'learner_id' => '683c3187-85b5-4111-807a-a23abaff26a9',
            ],
        ];
        parent::init();
    }
}
