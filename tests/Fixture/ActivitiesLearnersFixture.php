<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActivitiesLearnersFixture
 */
class ActivitiesLearnersFixture extends TestFixture
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
                'activity_id' => 'Lorem ipsum dolor sit amet',
                'learner_id' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
