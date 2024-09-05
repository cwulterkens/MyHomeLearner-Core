<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActivitiesFixture
 */
class ActivitiesFixture extends TestFixture
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
                'id' => '9b8579f8-9356-4ca6-8dd7-a7ddca78cac1',
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'user_id' => 'eacf5205-7604-405f-9b16-8ad9b827c99e',
                'date' => '2023-04-27',
                'created' => '2023-04-27 21:24:10',
                'modified' => '2023-04-27 21:24:10',
            ],
        ];
        parent::init();
    }
}
