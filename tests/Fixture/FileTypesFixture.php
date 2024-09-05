<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FileTypesFixture
 */
class FileTypesFixture extends TestFixture
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
                'id' => 'ddbb486c-0690-4b8c-b7a1-3cf5a8aa6498',
                'name' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-02-14 04:24:15',
                'modified' => '2023-02-14 04:24:15',
            ],
        ];
        parent::init();
    }
}
