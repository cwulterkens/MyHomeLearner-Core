<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SchoolYearsFixture
 */
class SchoolYearsFixture extends TestFixture
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
                'id' => 'cc3f2632-6763-443f-8269-a36ea5a2deca',
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-02-17 19:33:39',
                'modified' => '2023-02-17 19:33:39',
            ],
        ];
        parent::init();
    }
}
