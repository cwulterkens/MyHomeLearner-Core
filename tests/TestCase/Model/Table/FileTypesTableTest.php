<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FileTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FileTypesTable Test Case
 */
class FileTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FileTypesTable
     */
    protected $FileTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.FileTypes',
        'app.Files',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FileTypes') ? [] : ['className' => FileTypesTable::class];
        $this->FileTypes = $this->getTableLocator()->get('FileTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FileTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FileTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
