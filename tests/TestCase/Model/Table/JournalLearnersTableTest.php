<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JournalLearnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JournalLearnersTable Test Case
 */
class JournalLearnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\JournalLearnersTable
     */
    protected $JournalLearners;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.JournalLearners',
        'app.Learners',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('JournalLearners') ? [] : ['className' => JournalLearnersTable::class];
        $this->JournalLearners = $this->getTableLocator()->get('JournalLearners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->JournalLearners);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\JournalLearnersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
