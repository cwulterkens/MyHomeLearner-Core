<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GradesFixture
 */
class GradesFixture extends TestFixture
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
                'id' => '248a643b-0f67-461b-bf9f-3251b9ef9635',
                'name' => 'Lorem ipsum dolor sit amet',
                'value' => 1.5,
                'created' => '2023-02-17 19:53:23',
                'modified' => '2023-02-17 19:53:23',
            ],
        ];
        parent::init();
    }
}
