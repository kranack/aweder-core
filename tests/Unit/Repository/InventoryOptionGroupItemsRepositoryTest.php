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
     * @var InventoryOptionGroupItemsContract $repository
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
}
