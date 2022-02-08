<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PreoccupationalsFixture
 */
class PreoccupationalsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'candidate_id' => 1,
                'appointment' => '2022-02-01 18:24:28',
                'created' => '2022-02-01 18:24:28',
                'modified' => '2022-02-01 18:24:28',
                'status' => 1,
                'aptitude_id' => 1,
                'preocuppationalsType_id' => 1,
            ],
        ];
        parent::init();
    }
}
