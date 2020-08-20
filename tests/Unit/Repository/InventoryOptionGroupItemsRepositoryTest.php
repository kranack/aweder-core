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
    public function can_add_items_to_option_group(): void
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

        $this->repository->addItemToOptionGroup($inventoryOptionGroup, $inventoryOptionGroupItem1);
        $this->repository->addItemToOptionGroup($inventoryOptionGroup, $inventoryOptionGroupItem2);

        $this->assertCount(2, $inventoryOptionGroup->items()->get());
    }

    /**
     * @test
     */
    public function get_correct_amount_of_inventory_items_from_array(): void
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
    public function get_correct_count_by_ids_for_merchant(): void
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
            $merchant, collect([$inventoryOptionGroupItem1->id, $inventoryOptionGroupItem2->id])
        ));
    }
}
