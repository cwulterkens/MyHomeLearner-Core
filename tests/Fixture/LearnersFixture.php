<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LearnersFixture
 */
class LearnersFixture extends TestFixture
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
                'id' => '7a7e53d6-0114-4edb-9fd6-e1d7fc4b2a7e',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'user_id' => 'dfed0e41-9c17-4ae0-9ab1-bfe88174214d',
                'date_of_birth' => '2023-05-08',
                'graduation_date' => '2023-05-08',
                'avatar_url' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet',
                'address_sync' => 1,
                'address_line_1' => 'Lorem ipsum dolor sit amet',
                'address_line_2' => 'Lorem ipsum dolor sit amet',
                'addess_city' => 'Lorem ipsum dolor sit amet',
                'address_state' => 'Lo',
                'address_zip' => 'Lorem ip',
                'status' => 1,
                'graduated' => 1,
                'created' => '2023-05-08 21:23:06',
                'modified' => '2023-05-08 21:23:06',
            ],
        ];
        parent::init();
    }
}
