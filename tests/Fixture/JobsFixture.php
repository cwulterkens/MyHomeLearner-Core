<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JobsFixture
 */
class JobsFixture extends TestFixture
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
                'id' => '91d98259-fc7e-4638-8dfe-7fc65416032c',
                'employer' => 'Lorem ipsum dolor sit amet',
                'title' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2023-05-08',
                'end_date' => '2023-05-08',
                'current_job' => 1,
                'learner_id' => '4e9055e8-4f88-4a1e-b77f-affc7d445e0c',
                'user_id' => '27cf15d0-a0bd-4e94-bfcb-402f6a2cee72',
                'created' => '2023-05-08 19:56:09',
                'modified' => '2023-05-08 19:56:09',
            ],
        ];
        parent::init();
    }
}
