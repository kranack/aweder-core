<?php

namespace Tests\Unit\Repository;

use App\Contract\Repositories\InventoryOptionGroupItemContract;
use App\Traits\HelperTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class InventoryOptionGroupItemsRepositoryTest
 * @package Tests\Unit\Repository
 * @group Inventory
 * @coversDefaultClass
 */
class InventoryOptionGroupItemsRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use HelperTrait;

    /**
     * @var InventoryOptionGroupItemContract $repository
     */
    protected InventoryOptionGroupItemContract $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(InventoryOptionGroupItemContract::class);
    }

    /**
     * @test
     */
    public function canAddItemsToOptionGroup(): void
    {
        $inventoryOptionGroupName = 'Musical Equipment';

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            ['name' => $inventoryOptionGroupName]
        );

        $inventoryOptionGroupItem1 = $this->createAndReturnInventoryOptionGroupItem(
            ['name' => 'Pioneer Turntable']
        );

        $inventoryOptionGroupItem2 = $this->createAndReturnInventoryOptionGroupItem(
            ['name' => 'Fender Guitar']
        );

        $this->assertCount(0, $inventoryOptionGroup->items()->get());

        $this->repository->addItemToOptionGroup($inventoryOptionGroupItem1, $inventoryOptionGroup);
        $this->repository->addItemToOptionGroup($inventoryOptionGroupItem2, $inventoryOptionGroup);

        $this->assertCount(2, $inventoryOptionGroup->items()->get());
    }

    /**
     * @test
     */
    public function getCorrectAmountOfInventoryItemsFromArray()
    {
        $inventoryOptionGroupItem1 = $this->createAndReturnInventoryOptionGroupItem(
            ['name' => 'Pioneer Turntable']
        );

        $inventoryOptionGroupItem2 = $this->createAndReturnInventoryOptionGroupItem(
            ['name' => 'Fender Guitar']
        );

        $inventoryOptionGroupItem3 = $this->createAndReturnInventoryOptionGroupItem(
            ['name' => 'Korg Keyboard']
        );

        $this->assertDatabaseHas('inventory_option_group_items', [
            'name' => 'Pioneer Turntable'
        ]);

        $this->assertCount(2, $this->repository->getItemsFromIdArray([
            $inventoryOptionGroupItem1->id,
            $inventoryOptionGroupItem2->id
        ]));
    }

    /**
     * @test
     */
    public function getCorrectCountByIdsForMerchant()
    {
        $merchant = $this->createAndReturnMerchant();
        $merchant2 = $this->createAndReturnMerchant();

        $inventory = $this->createAndReturnInventoryItem([
            'merchant_id' => $merchant->id
        ]);

        $inventory2 = $this->createAndReturnInventoryItem([
            'merchant_id' => $merchant2->id
        ]);

        $inventoryOptionGroupName = 'Musical Equipment';

        $inventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            [
                'name' => $inventoryOptionGroupName,
                'inventory_id' => $inventory->id
            ]
        );

        $otherInventoryOptionGroupName = 'Different Option Group';

        $otherInventoryOptionGroup = $this->createAndReturnInventoryOptionGroup(
            [
                'name' => $otherInventoryOptionGroupName,
                'inventory_id' => $inventory2->id
            ]
        );

        $inventoryOptionGroupItem1 = $this->createAndReturnInventoryOptionGroupItem(
            [
                'name' => 'Pioneer Turntable',
                'inventory_option_group_id' => $inventoryOptionGroup->id
            ]
        );

        $inventoryOptionGroupItem2 = $this->createAndReturnInventoryOptionGroupItem(
            [
                'name' => 'Fender Guitar',
                'inventory_option_group_id' => $inventoryOptionGroup->id
            ]
        );

        $inventoryOptionGroupItem3 = $this->createAndReturnInventoryOptionGroupItem(
            [
                'name' => 'Korg Keyboard',
                'inventory_option_group_id' => $otherInventoryOptionGroup->id
            ]
        );

        $this->assertDatabaseHas('inventory_option_group_items', [
            'name' => 'Fender Guitar'
        ]);

        $this->assertEquals(2, $this->repository->getItemCountByIdForMerchant(
            collect([$inventoryOptionGroupItem1->id, $inventoryOptionGroupItem2->id]),
            $merchant
        ));
    }
}
