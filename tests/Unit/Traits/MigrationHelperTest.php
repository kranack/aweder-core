<?php

namespace Tests\Unit\Traits;

use App\Traits\MigrationHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class MigrationHelperTest
 * @package Tests\Traits
 * @group Traits
 */
class MigrationHelperTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function index_found_for_table(): void
    {
        $model = new class extends Model {
            use MigrationHelper;
        };

        $result = $model->doesTableHaveForeignKey('orders', 'orders_merchant_id_foreign');

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function index_not_found_for_table_that_doesnt_exist(): void
    {
        $model = new class extends Model {
            use MigrationHelper;
        };

        $result = $model->doesTableHaveForeignKey($this->faker->word, $this->faker->word);

        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function index_not_found_for_table(): void
    {
        $model = new class extends Model {
            use MigrationHelper;
        };

        $result = $model->doesTableHaveForeignKey('orders', $this->faker->word);

        $this->assertFalse($result);
    }
}
