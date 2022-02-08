<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AptitudesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AptitudesTable Test Case
 */
class AptitudesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AptitudesTable
     */
    protected $Aptitudes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Aptitudes',
        'app.Preoccupationals',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Aptitudes') ? [] : ['className' => AptitudesTable::class];
        $this->Aptitudes = $this->getTableLocator()->get('Aptitudes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Aptitudes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AptitudesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
