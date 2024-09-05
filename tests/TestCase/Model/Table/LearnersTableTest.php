<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LearnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LearnersTable Test Case
 */
class LearnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LearnersTable
     */
    protected $Learners;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Learners',
        'app.Users',
        'app.Courses',
        'app.Files',
        'app.Jobs',
        'app.Activities',
        'app.Honors',
        'app.Journal',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Learners') ? [] : ['className' => LearnersTable::class];
        $this->Learners = $this->getTableLocator()->get('Learners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Learners);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LearnersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LearnersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
