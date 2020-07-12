<?php

namespace Tests\Unit\Command;

use App\Contract\Repositories\InventoryVariantContract;
use App\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

/**
 * Class CreateInventoryVariantsFromCurrentInventoryTest
 * @package Tests\Unit\Command
 * @group Inventory
 */
class CreateInventoryVariantsFromCurrentInventoryTest extends TestCase
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
    public function commandOutputsNothingFoundWhenNoInventoryItemsPresent()
    {
        $this->artisan('inventory:create_inventory_variants_from_current_inventory')
            ->expectsOutput('No items to update')
            ->assertExitCode(0);
    }

    /**
     * @test
     */
    public function commandOutputsTotalCountOfFoundInventoryItemsNeededConverting()
    {
        factory(Inventory::class, 10)->create();

        $this->artisan('inventory:create_inventory_variants_from_current_inventory')
            ->expectsOutput('10 Found and will have singular variants created for them.')
            ->assertExitCode(0);
    }

    /**
     * @test
     */
    public function commandCreatesIndividualInventoryVariantForInventoryItem()
    {
        $inventory = factory(Inventory::class)->create();

        $this->assertCount(0, $inventory->variants);

        $this->artisan('inventory:create_inventory_variants_from_current_inventory')
            ->expectsOutput('1 Found and will have singular variants created for them.')
            ->assertExitCode(0);

        $this->assertDatabaseHas(
            'inventory_variants',
            [
                'inventory_id' => $inventory->id,
            ]
        );

        $this->assertDatabaseHas(
            'inventories',
            [
                'price' => null,
                'id' => $inventory->id,
            ]
        );
    }

    /**
     * @test
     */
    public function commandFailsToCreateInventoryItemTestingCreationOfVariant()
    {
        $inventory = factory(Inventory::class)->create();

        $this->assertCount(0, $inventory->variants);

        $this->instance(
            InventoryVariantContract::class,
            Mockery::mock(InventoryVariantContract::class, function ($mock) {
                $mock->shouldReceive('addVariantToInventoryItem')
                    ->once()
                    ->andReturn(false);
            })
        );

        $this->artisan('inventory:create_inventory_variants_from_current_inventory')
            ->expectsOutput('1 Found and will have singular variants created for them.')
            ->expectsOutput('There was an error creating a variant for item ' . $inventory->id)
            ->assertExitCode(0);

        $this->assertDatabaseMissing(
            'inventory_variants',
            [
                'inventory_id' => $inventory->id,
            ]
        );

        $this->assertDatabaseMissing(
            'inventories',
            [
                'price' => null,
                'id' => $inventory->id,
            ]
        );
    }
}
