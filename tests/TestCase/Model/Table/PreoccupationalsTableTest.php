<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreoccupationalsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreoccupationalsTable Test Case
 */
class PreoccupationalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PreoccupationalsTable
     */
    protected $Preoccupationals;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Preoccupationals',
        'app.Candidates',
        'app.Aptitudes',
        'app.PreocuppationalsTypes',
        'app.Files',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Preoccupationals') ? [] : ['className' => PreoccupationalsTable::class];
        $this->Preoccupationals = $this->getTableLocator()->get('Preoccupationals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Preoccupationals);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PreoccupationalsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PreoccupationalsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
