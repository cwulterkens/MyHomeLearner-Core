<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JournalLearnersFixture
 */
class JournalLearnersFixture extends TestFixture
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
                'journal_id' => '8f91ebe9-93e2-44f6-af33-7e104666d67a',
                'learner_id' => 'e09069f1-875f-4cbc-a2c9-e2ae3494f38d',
            ],
        ];
        parent::init();
    }
}
