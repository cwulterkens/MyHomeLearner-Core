<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoursesFixture
 */
class CoursesFixture extends TestFixture
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
                'id' => '66a85ff2-3513-4fcd-a2db-db4412a557d6',
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'subject_id' => '920a280d-93da-4477-87f2-4f9ce6b33f66',
                'user_id' => 'a3497673-c36e-4bfc-bfe3-1543408758cf',
                'school_year_id' => '7128a3ec-8195-438e-856b-f4fe991306f6',
                'learner_id' => '00d56b77-d1c2-41d5-9d11-36dd9b265df6',
                'grade_id' => '97906386-80ad-41d9-b2f6-e867f8781ed5',
                'credits' => 1,
                'hidden' => 1,
                'created' => '2023-03-07 20:33:42',
                'modified' => '2023-03-07 20:33:42',
            ],
        ];
        parent::init();
    }
}
