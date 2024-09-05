<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'id' => 'bb4e1c50-f1ac-449b-adaf-11b21c690296',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'remember_me_id' => '509b8c3c-efd2-4df3-8712-dfd9c9833987',
                'active' => 1,
                'admin' => 1,
                'created' => '2023-02-18 13:18:54',
                'modified' => '2023-02-18 13:18:54',
                'address_line_1' => 'Lorem ipsum dolor sit amet',
                'address_line_2' => 'Lorem ipsum dolor sit amet',
                'address_city' => 'Lorem ipsum dolor sit amet',
                'address_state' => 'Lo',
                'address_zip' => 'Lorem ip',
                'institution_name' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor ',
                'address_country' => 'Lorem ipsum dolor sit amet',
                'notify_alerts' => 1,
                'notify_marketing' => 1,
                'customer_id' => 'Lorem ipsum dolor sit amet',
                'avatar_url' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
