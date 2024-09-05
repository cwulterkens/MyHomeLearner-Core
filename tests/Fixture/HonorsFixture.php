<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HonorsFixture
 */
class HonorsFixture extends TestFixture
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
                'id' => '6324c007-9e8a-45ba-b263-3fc40d7bfe2f',
                'date' => '2023-04-25',
                'description' => 'Lorem ipsum dolor sit amet',
                'user_id' => '56277c2e-429e-4daa-98e0-dab8e61bbd16',
                'created' => '2023-04-25 20:41:34',
                'modified' => '2023-04-25 20:41:34',
                'name' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
