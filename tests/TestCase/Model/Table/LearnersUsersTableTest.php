<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LearnersUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LearnersUsersTable Test Case
 */
class LearnersUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LearnersUsersTable
     */
    protected $LearnersUsers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LearnersUsers',
        'app.Learners',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LearnersUsers') ? [] : ['className' => LearnersUsersTable::class];
        $this->LearnersUsers = $this->getTableLocator()->get('LearnersUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LearnersUsers);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LearnersUsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
