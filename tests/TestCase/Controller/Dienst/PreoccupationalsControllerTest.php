<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Dienst;

use App\Controller\Dienst\PreoccupationalsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Dienst\PreoccupationalsController Test Case
 *
 * @uses \App\Controller\Dienst\PreoccupationalsController
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
        'app.PreocuppationalsTypes',
        'app.Files',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \App\Controller\Dienst\PreoccupationalsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \App\Controller\Dienst\PreoccupationalsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \App\Controller\Dienst\PreoccupationalsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \App\Controller\Dienst\PreoccupationalsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \App\Controller\Dienst\PreoccupationalsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
