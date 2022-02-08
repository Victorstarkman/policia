<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PreocuppationalstypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PreocuppationalstypesTable Test Case
 */
class PreocuppationalstypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PreocuppationalstypesTable
     */
    protected $Preocuppationalstypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Preocuppationalstypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Preocuppationalstypes') ? [] : ['className' => PreocuppationalstypesTable::class];
        $this->Preocuppationalstypes = $this->getTableLocator()->get('Preocuppationalstypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Preocuppationalstypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PreocuppationalstypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
