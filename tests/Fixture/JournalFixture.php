<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JournalFixture
 */
class JournalFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'journal';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'bf3a60cc-7814-48d7-9aeb-f84c5d8ae587',
                'title' => 'Lorem ipsum dolor sit amet',
                'content' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-02-21 20:17:32',
                'modified' => '2023-02-21 20:17:32',
                'user_id' => '13f65769-d147-452a-8899-ab5c4b07a023',
            ],
        ];
        parent::init();
    }
}
