<?php

namespace Tests\Unit\Repository;

use App\Contract\Repositories\InventoryOptionGroupContract;
use App\Traits\HelperTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class InventoryOptionGroupRepositoryTest
 * @package Tests\Unit\Repository
 * @group Inventory
 * @coversDefaultClass
 */
class InventoryOptionGroupRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use HelperTrait;

    /**
     * @var InventoryOptionGroupContract $repository
     */
    protected InventoryOptionGroupContract $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(InventoryOptionGroupContract::class);
    }

    /**
     * @test
     */
    public function can_add_option_group_to_inventory(): void
    {
        $inventoryItem = $this->createAndReturnInventoryItem(['title' => 'Turntable']);

        $this->assertDatabaseHas('inventories', [
            'title' => 'Turntable',
        ]);

        $inventoryOptionGroupName = 'Musical Equipment';

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            ['name' => $inventoryOptionGroupName]
        );

        $this->repository->addOptionGroupToInventoryItem($inventoryItem, $inventoryOptionGroup);

        $this->assertCount(1, $inventoryItem->optionGroups()->get());
        $this->assertEquals($inventoryOptionGroupName, $inventoryItem->optionGroups()->first()->name);
    }

    /**
     * @test
     */
    public function can_remove_option_group_from_inventory(): void
    {
        $inventoryItem = $this->createAndReturnInventoryItem(['title' => 'Turntable']);

        $this->assertDatabaseHas('inventories', [
            'title' => 'Turntable',
        ]);

        $inventoryOptionGroupName = 'Musical Equipment';

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            ['name' => $inventoryOptionGroupName]
        );

        $this->repository->addOptionGroupToInventoryItem($inventoryItem, $inventoryOptionGroup);
        $inventoryOptionGroup->delete();

        $this->assertCount(0, $inventoryItem->optionGroups()->get());
        $this->assertSoftDeleted($inventoryOptionGroup);
    }
}
