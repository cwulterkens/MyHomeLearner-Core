<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AuditsFixture
 */
class AuditsFixture extends TestFixture
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
                'id' => '767d9627-02b7-484c-8f2b-722b8479d04d',
                'message' => 'Lorem ipsum dolor sit amet',
                'user_id' => 'Lorem ipsum dolor sit amet',
                'record_id' => 'Lorem ipsum dolor sit amet',
                'component_name' => 'Lorem ipsum dolor sit amet',
                'action_name' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-02-14 04:24:14',
                'modified' => '2023-02-14 04:24:14',
                'ip' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
