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
    public function canAddOptionGroupToInventory(): void
    {
        $inventoryItem = $this->createAndReturnInventoryItem(['title' => 'Turntable']);

        $this->assertDatabaseHas('inventories', [
            'title' => 'Turntable',
        ]);

        $inventoryOptionGroupName = 'Musical Equipment';

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            ['name' => $inventoryOptionGroupName]
        );

        $this->repository->addOptionGroupToInventoryItem($inventoryOptionGroup, $inventoryItem);

        $this->assertCount(1, $inventoryItem->optionGroups()->get());
        $this->assertEquals($inventoryOptionGroupName, $inventoryItem->optionGroups()->first()->name);
    }

    /**
     * @test
     */
    public function canRemoveOptionGroupFromInventory()
    {
        $inventoryItem = $this->createAndReturnInventoryItem(['title' => 'Turntable']);

        $this->assertDatabaseHas('inventories', [
            'title' => 'Turntable',
        ]);

        $inventoryOptionGroupName = 'Musical Equipment';

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            ['name' => $inventoryOptionGroupName]
        );

        $this->repository->addOptionGroupToInventoryItem($inventoryOptionGroup, $inventoryItem);
        $inventoryOptionGroup->delete();

        $this->assertCount(0, $inventoryItem->optionGroups()->get());
        $this->assertSoftDeleted($inventoryOptionGroup);
    }
}
