<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\CentroMedico;

use App\Controller\CentroMedico\PreoccupationalsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CentroMedico\PreoccupationalsController Test Case
 *
 * @uses \App\Controller\CentroMedico\PreoccupationalsController
 */
class PreoccupationalsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Preoccupationals',
        'app.Candidates',
        'app.Aptitudes',
        'app.Preocuppationalstypes',
        'app.Files',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\CentroMedico\PreoccupationalsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\CentroMedico\PreoccupationalsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\CentroMedico\PreoccupationalsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\CentroMedico\PreoccupationalsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\CentroMedico\PreoccupationalsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
