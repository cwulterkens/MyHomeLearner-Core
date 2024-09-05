<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NotificationsFixture
 */
class NotificationsFixture extends TestFixture
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
                'id' => 'ae8bb0eb-894f-412e-88aa-790aae31caa9',
                'subject' => 'Lorem ipsum dolor sit amet',
                'content' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-02-14 04:24:16',
                'modified' => '2023-02-14 04:24:16',
                'emailed' => 1,
                'user_id' => '0bc4409f-5c28-4a8d-9d68-3116cedfef8e',
                'viewed' => 1,
                'importance' => 'Lorem ip',
            ],
        ];
        parent::init();
    }
}
