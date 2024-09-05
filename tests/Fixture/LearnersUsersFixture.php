<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LearnersUsersFixture
 */
class LearnersUsersFixture extends TestFixture
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
                'learner_id' => 'fd76ba73-a3b4-40a1-b357-f16fcbd681f1',
                'user_id' => '59c86048-923e-4cf8-9bc2-f98bb3111a65',
            ],
        ];
        parent::init();
    }
}
