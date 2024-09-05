<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubjectsFixture
 */
class SubjectsFixture extends TestFixture
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
                'id' => '325da928-c716-46dd-a078-2f41d59e4b42',
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-02-17 19:45:50',
                'modified' => '2023-02-17 19:45:50',
            ],
        ];
        parent::init();
    }
}
