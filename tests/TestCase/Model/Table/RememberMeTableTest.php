<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RememberMeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RememberMeTable Test Case
 */
class RememberMeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RememberMeTable
     */
    protected $RememberMe;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.RememberMe',
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
        $config = $this->getTableLocator()->exists('RememberMe') ? [] : ['className' => RememberMeTable::class];
        $this->RememberMe = $this->getTableLocator()->get('RememberMe', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RememberMe);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RememberMeTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RememberMeTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
