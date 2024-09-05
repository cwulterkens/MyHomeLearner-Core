<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilesLearnersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilesLearnersTable Test Case
 */
class FilesLearnersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FilesLearnersTable
     */
    protected $FilesLearners;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.FilesLearners',
        'app.Files',
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
        $config = $this->getTableLocator()->exists('FilesLearners') ? [] : ['className' => FilesLearnersTable::class];
        $this->FilesLearners = $this->getTableLocator()->get('FilesLearners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FilesLearners);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FilesLearnersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
