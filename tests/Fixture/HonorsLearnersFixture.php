<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HonorsLearnersFixture
 */
class HonorsLearnersFixture extends TestFixture
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
                'honor_id' => '6c24e0ee-fd0f-4975-b489-e9efc0e2cd9d',
                'learner_id' => 'd3dc8108-e43a-4d26-8037-22fa1bc27132',
            ],
        ];
        parent::init();
    }
}
