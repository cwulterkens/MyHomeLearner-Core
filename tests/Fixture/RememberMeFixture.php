<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RememberMeFixture
 */
class RememberMeFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'remember_me';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 'e21c1c6c-44a3-4bb0-b6aa-266421d21477',
                'user_id' => 'c65e1695-2935-4aeb-b38b-0d55b7d4c489',
                'token' => '',
                'created' => '2023-02-18 13:19:09',
                'modified' => '2023-02-18 13:19:09',
            ],
        ];
        parent::init();
    }
}
