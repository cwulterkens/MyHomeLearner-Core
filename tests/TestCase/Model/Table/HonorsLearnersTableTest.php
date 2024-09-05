<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HonorsLearnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HonorsLearnersTable Test Case
 */
class HonorsLearnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HonorsLearnersTable
     */
    protected $HonorsLearners;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.HonorsLearners',
        'app.Honors',
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
        $config = $this->getTableLocator()->exists('HonorsLearners') ? [] : ['className' => HonorsLearnersTable::class];
        $this->HonorsLearners = $this->getTableLocator()->get('HonorsLearners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->HonorsLearners);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\HonorsLearnersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
